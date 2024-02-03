<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property string $photo
 * @property string $photo_thmb
 * @property string $photo_frnt
 * @property string|null $caption
 * @property string|null $alt_text
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo', 'photo_thmb', 'photo_frnt'], 'required'],
            [['photo', 'photo_thmb', 'photo_frnt', 'caption', 'alt_text', 'remark_one', 'remark_two'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'photo' => Yii::t('app', 'Photo'),
            'photo_thmb' => Yii::t('app', 'Photo Thmb'),
            'photo_frnt' => Yii::t('app', 'Photo Frnt'),
            'caption' => Yii::t('app', 'Caption'),
            'alt_text' => Yii::t('app', 'Alt Text'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }
}
