<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "outreach_activity".
 *
 * @property int $id
 * @property string $activity_name
 * @property int $created_on
 * @property int|null $updated_on
 * @property string|null $remark_one
 * @property string|null $remark_two
 *
 * @property OutreachActivityPhoto[] $outreachActivityPhotos
 */
class OutreachActivity extends \yii\db\ActiveRecord
{
    public $imageFiles;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'outreach_activity';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'activity_name',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['activity_name', 'remark_one', 'created_on'], 'required'],
            [['created_on', 'updated_on'], 'integer'],
            [['activity_name', 'slug', 'remark_one', 'remark_two'], 'string', 'max' => 255],

            [
                'activity_name', 
                'match', 'pattern' => '/^[a-zA-Z0-9\'.,\s()]+$/',
                'message' => 'Invalid character in name.'
            ],

            // remark_one utilized to store year
            [
                'remark_one', 
                'match', 'pattern' => '/^\d{4}-\d{2}-\d{2}$/',
                'message' => 'Enter year in format YYYY-MM-DD.'
            ],

            [['imageFiles'], 'safe'],
            [['imageFiles'], 'file', 'extensions'=>'jpg, jpeg, png', 'maxFiles' => 10],
            [['imageFiles'], 'file', 'maxSize'=>'20000000'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'activity_name' => Yii::t('app', 'Activity Name'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'remark_one' => Yii::t('app', 'Year'),
            'remark_two' => Yii::t('app', 'Remark Two'),
        ];
    }

    /**
     * Gets query for [[OutreachActivityPhotos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOutreachActivityPhotos()
    {
        return $this->hasMany(OutreachActivityPhoto::class, ['outreach_activity_id' => 'id']);
    }
}
