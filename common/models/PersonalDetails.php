<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "personal_details".
 *
 * @property int $id
 * @property string $name
 * @property int $cv_id
 * @property string $role
 * @property string $email
 * @property string $phone
 * @property string $location
 * @property int $created_at
 * @property int $updated_at
 */
class PersonalDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'personal_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // REQUIRED FIELDS
            [['name', 'role', 'email'], 'required'],

            // DATA TYPES
            [['cv_id', 'created_at', 'updated_at'], 'integer'],

            // STRING LENGTH
            [['name', 'role', 'email', 'phone', 'location'], 'string', 'max' => 255],

            // EMAIL FORMAT
            [['email'], 'email'],

            // PHONE (optional but recommended)
            [['phone'], 'match', 'pattern' => '/^[0-9+\-\s]{8,15}$/'],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cv_id' => 'CV',
            'role' => 'Role',
            'email' => 'Email',
            'phone' => 'Phone',
            'location' => 'Location',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCv()
    {
        return $this->hasOne(Cv::class, ['id' => 'cv_id']);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
            ],
        ];
    }

    /**
     * Get personal details as an array matching the JSON structure
     * @return array
     */
    public function toArrayPersonal()
    {
        return [
            'name' => $this->name,
            'role' => $this->role,
            'email' => $this->email,
            'phone' => $this->phone,
            'location' => $this->location,
        ];
    }
}
