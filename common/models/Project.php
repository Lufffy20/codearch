<?php

namespace common\models;

use yii\db\ActiveRecord;

class Project extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%projects}}';
    }

    public function rules()
    {
        return [
            [['cv_id', 'title'], 'required'],
            [['cv_id'], 'integer'],
            [['description'], 'string'],
            [['title', 'tech_stack', 'project_url'], 'string', 'max' => 255],
            [['project_url'], 'url'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cv_id' => 'CV',
            'title' => 'Project Title',
            'description' => 'Description',
            'tech_stack' => 'Tech Stack',
            'project_url' => 'Project URL',
        ];
    }

    public function toArrayProject(): array
    {
        return [
            'title'       => $this->title,
            'description' => $this->description,
            'tech'        => $this->tech_stack,
            'url'         => $this->project_url,
        ];
    }
}
