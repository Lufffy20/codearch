<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "social".
 *
 * @property int $id
 * @property int $cv_id
 * @property string $platform
 * @property string $url
 * @property int $sort_order
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Cv $cv
 */
class Social extends ActiveRecord
{
    public static function tableName()
    {
        return 'social';
    }

    public function rules()
    {
        return [
            [
                ['platform', 'url'],
                'required',
                'when' => function ($model) {
                    return trim($model->platform) !== '' || trim($model->url) !== '';
                }
            ],

            [['cv_id', 'sort_order', 'created_at', 'updated_at'], 'integer'],
            [['platform', 'url'], 'string', 'max' => 255],

            // URL validation only if filled
            [['url'], 'url', 'skipOnEmpty' => true],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cv_id' => 'CV',
            'platform' => 'Platform',
            'url' => 'URL',
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
     * Relation: Social → CV (N:1)
     */
    public function getCv()
    {
        return $this->hasOne(Cv::class, ['id' => 'cv_id']);
    }

    /**
     * Format for CV output
     */
    public function toArraySocial()
    {
        return [
            'platform' => $this->platform,
            'url' => $this->url,
        ];
    }

    /**
     * Get social links for a specific CV
     */
    public static function getByCv(int $cvId): array
    {
        $social = self::find()
            ->where(['cv_id' => $cvId])
            ->orderBy(['sort_order' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        $result = [];
        foreach ($social as $item) {
            $result[$item->platform] = $item->url;
        }

        return $result;
    }
}
