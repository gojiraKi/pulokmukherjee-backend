<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publication_year".
 *
 * @property int $id
 * @property string $year_range
 * @property string $created_on
 * @property string|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 *
 * @property Publications[] $publications
 */
class PublicationYear extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publication_year';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year_range', 'created_on'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['year_range', 'remark_one', 'remark_two'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'year_range' => Yii::t('app', 'Year Range'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }

    /**
     * Gets query for [[Publications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        return $this->hasMany(Publications::class, ['year' => 'id']);
    }
}
