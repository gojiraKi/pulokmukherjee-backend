<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "my_family_photo".
 *
 * @property int $id
 * @property string $file_path
 * @property string|null $url
 * @property string|null $alt
 * @property int $status
 * @property int $created_on
 * @property int|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class MyFamilyPhoto extends \yii\db\ActiveRecord
{
    public $imageFiles;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'my_family_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_path', 'status', 'created_on'], 'required'],
            [['status', 'created_on', 'updated_on'], 'integer'],
            [['file_path', 'url', 'alt', 'remark_one', 'remark_two'], 'string', 'max' => 255],

            [['imageFiles'], 'safe'],
            [['imageFiles'], 'file', 'extensions'=>'jpg, jpeg, png', 'maxFiles' => 10],
            [['imageFiles'], 'file', 'maxSize'=>'20000000'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'file_path' => Yii::t('app', 'File Path'),
            'url' => Yii::t('app', 'Url'),
            'alt' => Yii::t('app', 'Alt'),
            'status' => Yii::t('app', 'Status'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }
}
