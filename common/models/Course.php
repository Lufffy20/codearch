<?php

namespace common\models;

use yii\db\ActiveRecord;

class Course extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%courses}}';
    }

    public function rules()
    {
        return [
            [['cv_id', 'title'], 'required'],
            [['cv_id'], 'integer'],
            [['title', 'provider', 'certificate_url'], 'string', 'max' => 255],
            [['certificate_url'], 'url'],
            [['year'], 'string', 'max' => 10],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cv_id' => 'CV',
            'title' => 'Course Title',
            'provider' => 'Provider',
            'year' => 'Year',
            'certificate_url' => 'Certificate URL',
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

    public function toArrayCourse(): array
    {
        return [
            'name' => $this->title,        // template: {{courses.name}}
            'org'  => $this->provider,     // template: {{courses.org}}
            'year' => $this->year,
            'url'  => $this->certificate_url,
        ];
    }
}
