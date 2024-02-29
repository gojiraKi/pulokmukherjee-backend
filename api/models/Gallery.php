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
    public $imageFiles; // for uploading photo

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
            // [['photo', 'photo_thmb', 'photo_frnt'], 'required'],
            [['photo', 'photo_thmb', 'photo_frnt', 'caption', 'alt_text', 'remark_one', 'remark_two'], 'string', 'max' => 255],
        ];
    }
}
