<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "my_family".
 *
 * @property int $id
 * @property string $article
 * @property int $created_on
 * @property int|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class MyFamily extends \yii\db\ActiveRecord
{
    // filter out some fields, best used when you want to inherit the parent implementation
    // and exclude some sensitive fields.
    public function fields()
    {
        $fields = parent::fields();

        // remove fields that contain sensitive information
        unset(
            $fields['id'],
            $fields['remark_one'],
            $fields['remark_two'],
            $fields['created_on'],
            $fields['updated_on']
        );

        // return $fields;
        return [
            'article'
        ];
    }
}
