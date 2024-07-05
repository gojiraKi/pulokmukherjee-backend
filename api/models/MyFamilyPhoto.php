<?php

namespace app\models;

use Yii;

class MyFamilyPhoto extends \yii\db\ActiveRecord
{
    public function fields()
    {
        $fields = parent::fields();

        // return $fields;
        return [
            'url',
            'alt'
        ];
    }
}
