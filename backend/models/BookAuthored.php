<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book_authored".
 *
 * @property int $id
 * @property string|null $book_art
 * @property string $author
 * @property string $title
 * @property string|null $book_art_path
 * @property string $created_on
 * @property string|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remarl_two
 */
class BookAuthored extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_authored';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author', 'title', 'created_on'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['book_art', 'author', 'title', 'book_art_path', 'remark_one', 'remark_two'], 'string', 'max' => 255],

            [['imageFile'], 'safe'],
            [['imageFile'], 'file', 'extensions'=>'jpg, jpeg, png', 'maxFiles' => 1],
            [['imageFile'], 'file', 'maxSize'=>'102400'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'book_art' => Yii::t('app', 'Book Art'),
            'author' => Yii::t('app', 'Author'),
            'title' => Yii::t('app', 'Title'),
            'book_art_path' => Yii::t('app', 'Book Art Path'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }
}
