<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\About;

/**
 * AboutSearch represents the model behind the search form of `app\models\About`.
 */
class AboutSearch extends About
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['photo', 'name', 'qualification', 'field_one', 'field_two', 'field_three', 'field_four', 'field_five', 'field_six', 'field_seven', 'email_one', 'email_two', 'article', 'created_on', 'updated_on', 'remark_one', 'remark_two'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = About::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created_on' => $this->created_on,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'qualification', $this->qualification])
            ->andFilterWhere(['like', 'field_one', $this->field_one])
            ->andFilterWhere(['like', 'field_two', $this->field_two])
            ->andFilterWhere(['like', 'field_three', $this->field_three])
            ->andFilterWhere(['like', 'field_four', $this->field_four])
            ->andFilterWhere(['like', 'field_five', $this->field_five])
            ->andFilterWhere(['like', 'field_six', $this->field_six])
            ->andFilterWhere(['like', 'field_seven', $this->field_seven])
            ->andFilterWhere(['like', 'field_seven', $this->email_one])
            ->andFilterWhere(['like', 'field_seven', $this->email_two])
            ->andFilterWhere(['like', 'article', $this->article])
            ->andFilterWhere(['like', 'remark_one', $this->remark_one])
            ->andFilterWhere(['like', 'remark_two', $this->remark_two]);

        return $dataProvider;
    }
}
