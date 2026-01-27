<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "skills".
 *
 * @property int $id
 * @property int $cv_id
 * @property string $name
 * @property int $sort_order
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Cv $cv
 */
class Skill extends ActiveRecord
{
    public static function tableName()
    {
        return 'skills';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['cv_id', 'sort_order', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cv_id' => 'CV',
            'name' => 'Skill Name',
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
     * Relation: Skill → CV (N:1)
     */
    public function getCv()
    {
        return $this->hasOne(Cv::class, ['id' => 'cv_id']);
    }

    /**
     * Format for CV output
     */
    public function toArraySkill()
    {
        return $this->name;
    }

    /**
     * Get skills for a specific CV
     */
    public static function getByCv(int $cvId): array
    {
        $skills = self::find()
            ->where(['cv_id' => $cvId])
            ->orderBy(['sort_order' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        return array_map(
            fn($skill) => $skill->toArraySkill(),
            $skills
        );
    }
}
