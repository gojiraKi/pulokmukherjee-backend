<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "about".
 *
 * @property int $id
 * @property string $bio_photo
 * @property string $article
 * @property int $created_by
 * @property int $created_on
 * @property int|null $updated_by
 * @property int|null $updated_on
 * @property int|null $created
 */
class About extends \yii\db\ActiveRecord
{
    public $imageFile; // for uploading photo
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bio_photo', 'article', 'created_by', 'created_on'], 'required'],
            [['article'], 'string'],
            [['created_by', 'created_on', 'updated_by', 'updated_on', 'created'], 'integer'],
            [['bio_photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bio_photo' => 'Bio Photo',
            'article' => 'Article',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'created' => 'Created',
        ];
    }
}
