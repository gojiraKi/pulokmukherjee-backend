<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "about_research".
 *
 * @property int $id
 * @property string $title
 * @property string $created_on
 * @property string|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class AboutResearch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about_research';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'created_on'], 'required'],
            [['title'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['remark_one', 'remark_two'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }
}
