<?php

namespace common\services;

use Yii;
use common\models\{
    Cv,
    PersonalDetails,
    Education,
    Experience,
    Skill,
    Social
};

class CvService
{
    public static function saveCv(
        Cv $cv,
        PersonalDetails $personal,
        array $post,
        // bool $isUpdate = false
    ) {
        $transaction = Yii::$app->db->beginTransaction();

        try {

            if (!$cv->validate() || !$personal->validate()) {
                return false;
            }

            $cv->save(false);

            $personal->cv_id = $cv->id;
            $personal->save(false);

            self::saveMultiple(Education::class, 'Education', $cv->id, $post, ['degree', 'institute']);
            self::saveMultiple(Experience::class, 'Experience', $cv->id, $post, ['company', 'description']);
            self::saveMultiple(Skill::class, 'Skill', $cv->id, $post, ['name']);
            self::saveMultiple(Social::class, 'Social', $cv->id, $post, ['platform', 'url']);

            $transaction->commit();
            return true;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    private static function saveMultiple($class, $key, $cvId, $post, array $requiredFields)
    {
        $class::deleteAll(['cv_id' => $cvId]);

        foreach ($post[$key] ?? [] as $data) {

            foreach ($requiredFields as $field) {
                if (!empty($data[$field])) {
                    $model = new $class();
                    $model->setAttributes($data);
                    $model->cv_id = $cvId;
                    $model->save(false);
                    break;
                }
            }
        }
    }
}
