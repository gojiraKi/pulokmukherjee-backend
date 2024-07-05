<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "last_update".
 *
 * @property int $id
 * @property string $last_updated
 * @property string|null $remark_one
 */
class LastUpdate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['last_updated'], 'required'],
            [['last_updated'], 'safe'],
            [['remark_one'], 'string', 'max' => 255],
        ];
    }
}
