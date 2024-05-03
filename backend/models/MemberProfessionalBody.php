<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member_professional_body".
 *
 * @property int $id
 * @property string $title
 * @property string $article
 * @property int|null $status
 * @property int $created_on
 * @property int|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 */
class MemberProfessionalBody extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'member_professional_body';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'article', 'created_on'], 'required'],
            [['article'], 'string'],
            [['status', 'created_on', 'updated_on'], 'integer'],
            [['title', 'remark_one', 'remark_two'], 'string', 'max' => 255],
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
