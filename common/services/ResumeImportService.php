<?php

namespace common\services;

use common\models\{
    Cv,
    PersonalDetails,
    Education,
    Experience,
    Skill,
    Social
};
use yii\web\UploadedFile;

class ResumeImportService
{
    public static function import(UploadedFile $file): array
    {
        $resumeText = ResumeParserService::parseResume($file);
        $data = ResumeParserService::extractResumeData($resumeText);

        return [
            'cv' => self::buildCv(),
            'personal' => self::buildPersonal($data),
            'educations' => self::buildEducations($data['education'] ?? []),
            'experiences' => self::buildExperiences($data['experience'] ?? []),
            'skills' => self::buildSkills($data['skills'] ?? []),
            'socials' => [new Social()],
            'projects'     => [new \common\models\Project()],
            'achievements' => [new \common\models\Achievement()],
            'languages'    => [new \common\models\Language()],
            'awards'       => [new \common\models\Award()],
            'courses'      => [new \common\models\Course()],

        ];
    }

    private static function buildCv(): Cv
    {
        return new Cv([
            'title' => 'Imported CV - ' . date('Y-m-d'),
        ]);
    }

    private static function buildPersonal(array $data): PersonalDetails
    {
        return new PersonalDetails([
            'name' => $data['name'] ?? '',
            'email' => $data['email'] ?? '',
            'phone' => $data['phone'] ?? '',
            'location' => $data['location'] ?? '',
        ]);
    }

    private static function buildEducations(array $items): array
    {
        if (empty($items)) return [new Education()];

        return array_map(function ($edu) {
            $parts = array_map('trim', explode(',', $edu));
            return new Education([
                'degree' => $parts[0] ?? '',
                'institute' => $parts[1] ?? '',
                'year' => $parts[2] ?? '',
            ]);
        }, $items);
    }

    private static function buildExperiences(array $items): array
    {
        if (empty($items)) return [new Experience()];

        return array_map(fn($exp) => new Experience([
            'position' => $exp,
        ]), $items);
    }

    private static function buildSkills(array $items): array
    {
        if (empty($items)) return [new Skill()];

        return array_map(fn($skill) => new Skill([
            'name' => $skill,
        ]), $items);
    }
}
