<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publications".
 *
 * @property int $id
 * @property int $year
 * @property string $authors
 * @property string $title
 * @property string $published_to
 * @property string|null $link
 * @property int $sort_order
 * @property int $created_by
 * @property int $created_on
 * @property int|null $updated_by
 * @property int|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class Publications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year', 'authors', 'title', 'published_to', 'sort_order', 'created_by', 'created_on'], 'required'],
            [['year', 'sort_order', 'created_by', 'created_on', 'updated_by', 'updated_on'], 'integer'],
            [['title'], 'string'],
            [['authors', 'published_to', 'link', 'remark_one', 'remark_two'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'year' => Yii::t('app', 'Year'),
            'authors' => Yii::t('app', 'Authors'),
            'title' => Yii::t('app', 'Title'),
            'published_to' => Yii::t('app', 'Published To'),
            'link' => Yii::t('app', 'Link'),
            'sort_order' => Yii::t('app', 'Sort Order'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }
}
