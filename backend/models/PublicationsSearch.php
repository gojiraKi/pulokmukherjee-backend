<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Publications;

/**
 * PublicationsSearch represents the model behind the search form of `app\models\Publications`.
 */
class PublicationsSearch extends Publications
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'year', 'sort_order', 'created_by', 'created_on', 'updated_by', 'updated_on'], 'integer'],
            [['authors', 'title', 'published_to', 'link', 'remark_one', 'remark_two'], 'safe'],
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
        $query = Publications::find();

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
            'year' => $this->year,
            'sort_order' => $this->sort_order,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'authors', $this->authors])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'published_to', $this->published_to])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'remark_one', $this->remark_one])
            ->andFilterWhere(['like', 'remark_two', $this->remark_two]);

        return $dataProvider;
    }
}
