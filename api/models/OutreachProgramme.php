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
    const INACTIVE = 9;
    const ACTIVE = 10;

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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo' => 'Photo',
            'thmb_photo' => 'Thmb Photo',
            'caption' => 'Caption',
            'status' => 'Status',
            // 'remark_one' => 'Remark One',
            // 'remark_two' => 'Remark Two',
        ];
    }

    // filter out some fields, best used when you want to inherit the parent implementation
    // and exclude some sensitive fields.
    public function fields()
    {
        $fields = parent::fields();

        // remove fields
        unset(
            $fields['photo'], 
            $fields['thmb_photo'], 
            $fields['status'], 
            $fields['remark_one'], 
            $fields['remark_two']
        );

        return $fields;
    }
}
