<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "cv_images".
 *
 * @property int $id
 * @property int $cv_id
 * @property string $type
 * @property string $image_path
 * @property int $created_at
 * @property int $updated_at
 * @property \yii\web\UploadedFile $imageFile
 *
 * @property Cv $cv
 */
class CvImage extends ActiveRecord
{
    /**
     * @var \yii\web\UploadedFile
     */
    public $imageFile;

    public static function tableName()
    {
        return 'cv_images';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            [['cv_id', 'type', 'image_path'], 'required'],
            [['cv_id'], 'integer'],
            [['type'], 'string', 'max' => 50],
            [['image_path'], 'string', 'max' => 255],
            [
                ['cv_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Cv::class,
                'targetAttribute' => ['cv_id' => 'id']
            ],

            [
                ['imageFile'],
                'file',
                'extensions' => ['jpg', 'jpeg', 'png'],
                'mimeTypes' => ['image/jpeg', 'image/jpg', 'image/png'],
                'maxSize' => 2 * 1024 * 1024,
                'tooBig' => 'Image size must be less than 2MB',
                'wrongMimeType' => 'Only JPG and PNG images are allowed',
                'skipOnEmpty' => true,
            ],
        ];
    }

    public function getCv()
    {
        return $this->hasOne(Cv::class, ['id' => 'cv_id']);
    }

    /**
     * Handle profile image upload for a CV
     *
     * @param int $cvId
     * @param \yii\web\UploadedFile|null $image
     * @return bool
     */
    public static function handleProfileImageUpload(int $cvId, ?UploadedFile $image): bool
    {
        if (!$image) {
            return true; // No image to process, return success
        }

        // Validate the uploaded file
        $cvImage = new self();
        $cvImage->imageFile = $image;

        if (!$cvImage->validate(['imageFile'])) {
            // Add validation errors to session flash
            foreach ($cvImage->getErrors('imageFile') as $error) {
                Yii::$app->session->setFlash('error', $error);
            }
            return false;
        }

        // Prepare upload directory
        $uploadDir = Yii::getAlias('@webroot/uploads/cv/');
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0775, true);
        }

        // Generate unique filename
        $fileName = uniqid('cv_') . '.' . $image->extension;
        $fullPath = $uploadDir . $fileName;
        $dbPath = '/uploads/cv/' . $fileName;

        if ($image->saveAs($fullPath)) {
            // Delete old profile image if exists
            $oldImage = self::findOne([
                'cv_id' => $cvId,
                'type' => 'profile'
            ]);

            if ($oldImage) {
                $oldFile = Yii::getAlias('@webroot') . $oldImage->image_path;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
                $oldImage->delete();
            }

            // Save new image record
            $cvImage = new self();
            $cvImage->cv_id = $cvId;
            $cvImage->type = 'profile';
            $cvImage->image_path = $dbPath;
            return $cvImage->save(false);
        }

        return false;
    }

    /**
     * Remove profile image for a CV
     *
     * @param int $cvId
     * @return bool
     */
    public static function removeProfileImage(int $cvId): bool
    {
        $oldImage = self::findOne([
            'cv_id' => $cvId,
            'type' => 'profile'
        ]);

        if ($oldImage) {
            $oldFile = Yii::getAlias('@webroot') . $oldImage->image_path;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
            return $oldImage->delete();
        }

        return true; // No image to remove, return success
    }
}
