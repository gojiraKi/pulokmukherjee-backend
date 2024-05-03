<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $article
 * @property int $created_on
 * @property int|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class Activity extends \yii\db\ActiveRecord
{
    const INACTIVE = 9;
    const ACTIVE = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'article', 'created_on'], 'required'],
            [['id', 'status', 'created_on', 'updated_on'], 'integer'],
            [['article'], 'string'],
            [['remark_one', 'remark_two'], 'string', 'max' => 255],
            [['id'], 'unique'],

            ['status', 'default', 'value' => self::ACTIVE],
            ['status', 'in', 'range' => [self::ACTIVE, self::INACTIVE]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'article' => Yii::t('app', 'Article'),
            'status' => Yii::t('app', 'Status'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }
}
