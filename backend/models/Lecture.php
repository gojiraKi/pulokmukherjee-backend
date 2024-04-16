<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lecture".
 *
 * @property int $id
 * @property int $lecture_type
 * @property string $title
 * @property string $article
 * @property int $created_on
 * @property int|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class Lecture extends \yii\db\ActiveRecord
{
    const INTERNATIONAL = 1;
    const NATIONAL = 2;

    const INACTIVE = 9;
    const ACTIVE = 10;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lecture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lecture_type', 'title', 'article', 'created_on'], 'required'],
            [['lecture_type', 'status', 'created_on', 'updated_on'], 'integer'],
            [['article'], 'string'],
            [['title', 'remark_one', 'remark_two'], 'string', 'max' => 255],

            ['lecture_type', 'in', 'range' => [self::INTERNATIONAL, self::NATIONAL]],

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
            'lecture_type' => Yii::t('app', 'Lecture Type'),
            'title' => Yii::t('app', 'Title'),
            'article' => Yii::t('app', 'Article'),
            'status' => Yii::t('app', 'Status'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'remark_one' => Yii::t('app', 'Remark One'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }

    public static function LectureType($type) {
        $lectureType = [
            "1" => "International",
            "2" => "National"
        ];
        return $lectureType[(string) $type];
    }

    public static function Status($type) {
        $status = [
            "9" => "Inactive",
            "10" => "Active"
        ];
        return $status[(string) $type];
    }
}
