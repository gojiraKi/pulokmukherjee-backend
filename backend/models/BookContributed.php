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
    const INACTIVE = 9;
    const ACTIVE = 10;
    
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
            [['status', 'created_on', 'updated_on'], 'safe'],
            [['author', 'title', 'remark_one'], 'string', 'max' => 255],
            [['remark_two'], 'string', 'max' => 225],

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
            'author' => Yii::t('app', 'Author'),
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }

    public static function Status($type) {
        $status = [
            self::INACTIVE => "Inactive",
            self::ACTIVE => "Active"
        ];
        return $status[(string) $type];
    }
}
