<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "about".
 *
 * @property int $id
 * @property string $photo
 * @property string $name
 * @property string $qualification
 * @property string|null $field_one
 * @property string|null $field_two
 * @property string|null $field_three
 * @property string|null $field_four
 * @property string|null $field_five
 * @property string|null $field_six
 * @property string|null $field_seven
 * @property string|null $article
 * @property string $created_on
 * @property string|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class About extends \yii\db\ActiveRecord
{
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
            [['photo', 'name', 'qualification', 'created_on'], 'required'],
            [['article'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['photo', 'name', 'qualification', 'field_one', 'field_two', 'field_three', 'field_four', 'field_five', 'field_six', 'field_seven', 'remark_one', 'remark_two'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'qualification' => Yii::t('app', 'Qualification'),
            'field_one' => Yii::t('app', 'Field One'),
            'field_two' => Yii::t('app', 'Field Two'),
            'field_three' => Yii::t('app', 'Field Three'),
            'field_four' => Yii::t('app', 'Field Four'),
            'field_five' => Yii::t('app', 'Field Five'),
            'field_six' => Yii::t('app', 'Field Six'),
            'field_seven' => Yii::t('app', 'Field Seven'),
            'article' => Yii::t('app', 'Article'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }
}
