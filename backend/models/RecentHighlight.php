<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "recent_highlight".
 *
 * @property int $id
 * @property string $title
 * @property string|null $article
 * @property int|null $status
 * @property int|null $created_on
 * @property int|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class RecentHighlight extends \yii\db\ActiveRecord
{
    const DRAFT = 8;
    const ARCHIVE = 9;
    const PUBLISHED = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recent_highlight';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['article'], 'string'],
            [['status', 'created_on', 'updated_on'], 'integer'],
            [['title', 'remark_one', 'remark_two'], 'string', 'max' => 255],

            ['status', 'default', 'value' => self::DRAFT],
            ['status', 'in', 'range' => [self::DRAFT, self::PUBLISHED]]
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
            'article' => Yii::t('app', 'Article'),
            'status' => Yii::t('app', 'Status'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }
}
