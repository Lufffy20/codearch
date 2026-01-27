<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "experience".
 *
 * @property int $id
 * @property int $cv_id
 * @property string $company
 * @property string $position
 * @property string|null $duration
 * @property string $description
 * @property int $sort_order
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Cv $cv
 */
class Experience extends ActiveRecord
{
    public static function tableName()
    {
        return 'experience';
    }

    public function rules()
    {
        return [
            [['company', 'position', 'description'], 'required'],
            [['cv_id', 'sort_order', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['company', 'position', 'duration'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cv_id' => 'CV',
            'company' => 'Company',
            'position' => 'Position',
            'duration' => 'Duration',
            'description' => 'Description',
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
     * Relation: Experience → CV (N:1)
     */
    public function getCv()
    {
        return $this->hasOne(Cv::class, ['id' => 'cv_id']);
    }

    /**
     * Format for CV output
     */
    public function toArrayExperience()
    {
        return [
            'company' => $this->company,
            'position' => $this->position,
            'duration' => $this->duration,
            'description' => $this->description,
        ];
    }

    /**
     * Get experience list for a specific CV
     */
    public static function getByCv(int $cvId): array
    {
        $experiences = self::find()
            ->where(['cv_id' => $cvId])
            ->orderBy(['sort_order' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        return array_map(
            fn($exp) => $exp->toArrayExperience(),
            $experiences
        );
    }
}
