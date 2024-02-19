<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "media".
 *
 * @property int $id
 * @property string $file_name
 * @property string $file_type
 * @property string $url
 * @property int $created_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class Media extends \yii\db\ActiveRecord
{
    public $file; // for uploading photo
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_name', 'file_type', 'url', 'created_on'], 'required'],
            [['created_on'], 'integer'],
            [['file_name', 'url', 'remark_one', 'remark_two'], 'string', 'max' => 255],
            [['file_type'], 'string', 'max' => 45],

            [['file'], 'safe'],
            [['file'], 'file', 'extensions' => 'jpg, jpeg, png, pdf, doc, docx', 'maxFiles' => 1],
            [['file'], 'file', 'maxSize' => '262144'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'file_name' => Yii::t('app', 'File Name'),
            'file_type' => Yii::t('app', 'File Type'),
            'url' => Yii::t('app', 'Url'),
            'created_on' => Yii::t('app', 'Created On'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }
}
