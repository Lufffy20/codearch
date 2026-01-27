<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cv_templates".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $template_file
 * @property string $category
 * @property string|null $thumbnail_url
 * @property bool $is_active
 * @property int $sort_order
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Cv[] $cvs
 */
class CvTemplate extends ActiveRecord
{

    public $thumbnailFile;


    public static function tableName()
    {
        return 'cv_templates';
    }

    public function rules()
    {
        return [
            [['name', 'template_file'], 'required'],
            [['description'], 'string'],
            [['is_active'], 'boolean'],
            [['sort_order', 'created_at', 'updated_at'], 'integer'],
            [['name', 'template_file', 'category', 'thumbnail_url'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['template_file'], 'unique'],
            [
                ['thumbnailFile'],
                'file',
                'extensions' => ['jpg', 'jpeg', 'png', 'webp'],
                'maxSize' => 2 * 1024 * 1024, // 2MB
                'skipOnEmpty' => true,
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Template Name',
            'description' => 'Description',
            'template_file' => 'Template File',
            'category' => 'Category',
            'thumbnail_url' => 'Thumbnail URL',
            'is_active' => 'Active',
            'sort_order' => 'Sort Order',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * Gets query for [[Cvs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCvs()
    {
        return $this->hasMany(Cv::class, ['template_id' => 'id']);
    }

    /**
     * Get category options
     */
    public function getCategoryOptions()
    {
        return [
            'professional' => 'Professional',
            'creative' => 'Creative',
            'modern' => 'Modern',
            'classic' => 'Classic',
            'minimal' => 'Minimal'
        ];
    }

    /**
     * Get active templates
     */
    public static function getActiveTemplates()
    {
        return self::find()
            ->where(['is_active' => true])
            ->orderBy(['sort_order' => SORT_ASC, 'id' => SORT_ASC])
            ->all();
    }

    /**
     * Get template content from file
     */
    public function getTemplateContent()
    {
        $templatePath = \Yii::getAlias("@backend/views/templates/{$this->template_file}");
        if (file_exists($templatePath)) {
            return file_get_contents($templatePath);
        }
        return '';
    }
}
