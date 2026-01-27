<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Cv extends ActiveRecord
{
    public static function tableName()
    {
        return 'cv';
    }

    /* ================= RULES ================= */

    public function rules()
    {
        return [
            [['title', 'user_id'], 'required'],
            [['user_id', 'template_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [TimestampBehavior::class];
    }

    /* ================= RELATIONS ================= */

    public function getPersonalDetails()
    {
        return $this->hasOne(PersonalDetails::class, ['cv_id' => 'id']);
    }

    public function getEducations()
    {
        return $this->hasMany(Education::class, ['cv_id' => 'id'])
            ->orderBy(['sort_order' => SORT_ASC]);
    }

    public function getExperiences()
    {
        return $this->hasMany(Experience::class, ['cv_id' => 'id'])
            ->orderBy(['sort_order' => SORT_ASC]);
    }

    public function getSkills()
    {
        return $this->hasMany(Skill::class, ['cv_id' => 'id'])
            ->orderBy(['sort_order' => SORT_ASC]);
    }

    public function getSocials()
    {
        return $this->hasMany(Social::class, ['cv_id' => 'id'])
            ->orderBy(['sort_order' => SORT_ASC]);
    }

    public function getTemplate()
    {
        return $this->hasOne(CvTemplate::class, ['id' => 'template_id']);
    }

    /* ================= HELPERS ================= */

    public function shouldUseTemplate(bool $force = false): bool
    {
        return (bool) ($this->template_id || $force);
    }

    private function resolveTemplate(): ?CvTemplate
    {
        return $this->template
            ?? CvTemplate::findOne(['is_active' => true, 'template_file' => 'classic.php'])
            ?? CvTemplate::findOne(['is_active' => true]);
    }

    /* ================= DATA ================= */

    public function getCvData(): array
    {
        return [
            'personal' => $this->personalDetails?->toArrayPersonal(),

            'education' => array_map(
                fn($e) => $e->toArrayEducation(),
                $this->educations
            ),

            'experience' => array_map(
                fn($e) => $e->toArrayExperience(),
                $this->experiences
            ),

            'skills' => array_map(
                fn($s) => ['name' => $s->name],
                $this->skills
            ),

            'social' => array_map(
                fn($s) => [
                    'platform' => $s->platform,
                    'url' => $s->url,
                ],
                $this->socials
            ),
        ];
    }

    /* ================= TEMPLATE RENDER ================= */

    public function renderWithTemplate(?int $templateId = null): array
    {
        // 🔹 Priority: passed template_id (temporary)
        if ($templateId) {
            $template = CvTemplate::findOne($templateId);
        } else {
            // 🔹 Fallback: saved/default template
            $template = $this->resolveTemplate();
        }

        if (!$template) {
            return [
                'html' => '<p>No template available</p>',
                'css'  => ''
            ];
        }

        // 🔹 Template HTML
        $html = $template->getTemplateContent();

        // 🔹 Inject CV data
        $html = $this->replacePlaceholders(
            $html,
            $this->getCvData()
        );

        return [
            'html' => $html,
            'css'  => $template->css_content ?? '',
        ];
    }


    /* ================= PLACEHOLDER ENGINE ================= */

    private function replacePlaceholders(string $template, array $data, string $prefix = ''): string
    {
        foreach ($data as $key => $value) {
            $placeholder = '{{' . ($prefix ? $prefix . '.' : '') . $key . '}}';

            if (is_array($value)) {
                if (in_array($key, ['education', 'experience', 'skills', 'social'], true)) {
                    $template = $this->processLoop($template, $key, $value);
                } else {
                    $template = $this->replacePlaceholders($template, $value, $key);
                }
            } else {
                $template = str_replace(
                    $placeholder,
                    htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'),
                    $template
                );
            }
        }

        return $template;
    }


    private function processLoop(string $template, string $section, array $items): string
    {
        $pattern = '/\{\{' . $section . '\.loop\}\}(.*?)\{\{' . $section . '\.endloop\}\}/s';

        if (!preg_match($pattern, $template, $matches)) {
            return $template;
        }

        $rowTemplate = $matches[1];
        $result = '';

        foreach ($items as $item) {
            $row = $rowTemplate;
            foreach ($item as $key => $value) {
                $row = str_replace(
                    '{{' . $section . '.' . $key . '}}',
                    htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'),
                    $row
                );
            }
            $result .= $row;
        }

        return preg_replace($pattern, $result, $template);
    }
}
