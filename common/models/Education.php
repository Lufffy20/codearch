<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "education".
 *
 * @property int $id
 * @property int $cv_id
 * @property string $degree
 * @property string $institute
 * @property string|null $year
 * @property int $sort_order
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Cv $cv
 */
class Education extends ActiveRecord
{
    public static function tableName()
    {
        return 'education';
    }

    public function rules()
    {
        return [
            // REQUIRED
            [['degree', 'institute'], 'required'],

            // DATA TYPES
            [['cv_id', 'sort_order', 'created_at', 'updated_at'], 'integer'],

            // STRINGS
            [['degree', 'institute'], 'string', 'max' => 255],

            // YEAR (Education year / passing year)
            [['year'], 'string', 'max' => 10],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cv_id' => 'CV',
            'degree' => 'Degree',
            'institute' => 'Institute',
            'year' => 'Year',
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
     * Relation: Education → CV (N:1)
     */
    public function getCv()
    {
        return $this->hasOne(Cv::class, ['id' => 'cv_id']);
    }

    /**
     * Format for CV output
     */
    public function toArrayEducation()
    {
        return [
            'degree' => $this->degree,
            'institute' => $this->institute,
            'year' => $this->year,
        ];
    }

    /**
     * Get education list for a specific CV
     */
    public static function getByCv(int $cvId): array
    {
        $education = self::find()
            ->where(['cv_id' => $cvId])
            ->orderBy(['sort_order' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        return array_map(
            fn($edu) => $edu->toArrayEducation(),
            $education
        );
    }
}
