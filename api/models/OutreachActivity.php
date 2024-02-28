<?php

namespace app\models;

use Yii;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'outreach_activity';
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
            'remark_one' => Yii::t('app', 'Remark One'),
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

    public static function FirstPhotos($id)
    {
        return OutreachActivityPhoto::find()->where(['outreach_activity_id' => $id])->limit(1)->one();
    }

    // filter out some fields, best used when you want to inherit the parent implementation
    // and exclude some sensitive fields.
    public function fields()
    {
        $fields = parent::fields();

        // remove fields
        unset(
            // $fields['photo'], 
            $fields['created_on'], 
            $fields['updated_on'], 
            $fields['remark_one'], 
            $fields['remark_two']
        );

        return $fields;
    }
}
