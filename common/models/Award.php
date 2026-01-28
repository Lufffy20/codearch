<?php

namespace common\models;

use yii\db\ActiveRecord;

class Award extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%awards}}';
    }

    public function rules()
    {
        return [
            [['cv_id', 'title'], 'required'],
            [['cv_id'], 'integer'],
            [['title', 'organization'], 'string', 'max' => 255],
            [['year'], 'string', 'max' => 10],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cv_id' => 'CV',
            'title' => 'Award Title',
            'organization' => 'Organization',
            'year' => 'Year',
        ];
    }

    public function toArrayAward(): array
    {
        return [
            'title'        => $this->title,
            'organization' => $this->organization,
            'year'         => $this->year,
        ];
    }
}
