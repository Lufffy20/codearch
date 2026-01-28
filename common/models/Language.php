<?php

namespace common\models;

use yii\db\ActiveRecord;

class Language extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%languages}}';
    }

    public function rules()
    {
        return [
            [['cv_id', 'name'], 'required'],
            [['cv_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['proficiency'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cv_id' => 'CV',
            'name' => 'Language',
            'proficiency' => 'Proficiency',
        ];
    }

    public function toArrayLanguage(): array
    {
        return [
            'name'  => $this->name,
            'level' => $this->proficiency,
        ];
    }
}
