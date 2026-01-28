<?php

namespace common\models;

use yii\db\ActiveRecord;

class Achievement extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%achievements}}';
    }

    public function rules()
    {
        return [
            [['cv_id', 'title'], 'required'],
            [['cv_id'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['year'], 'string', 'max' => 10],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cv_id' => 'CV',
            'title' => 'Title',
            'description' => 'Description',
            'year' => 'Year',
        ];
    }

    public function toArrayAchievement(): array
    {
        return [
            'title'       => $this->title,
            'description' => $this->description,
            'year'        => $this->year,
        ];
    }
}
