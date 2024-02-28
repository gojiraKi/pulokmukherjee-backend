<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outreach_activity_photo".
 *
 * @property int $id
 * @property int|null $outreach_activity_id
 * @property string|null $url
 * @property string|null $alt
 *
 * @property OutreachActivity $outreachActivity
 */
class OutreachActivityPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'outreach_activity_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['outreach_activity_id'], 'integer'],
            [['url', 'alt'], 'string', 'max' => 255],
            [['outreach_activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => OutreachActivity::class, 'targetAttribute' => ['outreach_activity_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'outreach_activity_id' => Yii::t('app', 'Outreach Activity ID'),
            'url' => Yii::t('app', 'Url'),
            'alt' => Yii::t('app', 'Alt'),
        ];
    }

    /**
     * Gets query for [[OutreachActivity]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOutreachActivity()
    {
        return $this->hasOne(OutreachActivity::class, ['id' => 'outreach_activity_id']);
    }
}
