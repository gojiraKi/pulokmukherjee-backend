<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outreach_programme".
 *
 * @property int $id
 * @property string $photo
 * @property string $thmb_photo
 * @property string|null $caption
 * @property int $status
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class OutreachProgramme extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'outreach_programme';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['id', 'photo', 'thmb_photo', 'status'], 'required'],
            [['id', 'status'], 'integer'],
            [['photo', 'thmb_photo', 'caption'], 'string', 'max' => 255],
            [['remark_one', 'remark_two'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo' => 'Photo',
            'thmb_photo' => 'Thmb Photo',
            'caption' => 'Caption',
            'status' => 'Status',
            'remark_one' => 'Remark One',
            'remark_two' => 'Remark Two',
        ];
    }
}
