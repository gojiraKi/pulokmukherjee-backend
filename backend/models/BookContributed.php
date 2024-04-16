<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book_contributed".
 *
 * @property int $id
 * @property string $author
 * @property string $title
 * @property string $created_on
 * @property string|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class BookContributed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_contributed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author', 'title', 'created_on'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['author', 'title', 'remark_one'], 'string', 'max' => 255],
            [['remark_two'], 'string', 'max' => 225],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'author' => Yii::t('app', 'Author'),
            'title' => Yii::t('app', 'Title'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }
}
