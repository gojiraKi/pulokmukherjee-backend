<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Lecture;

/**
 * LectureSearch represents the model behind the search form of `app\models\Lecture`.
 */
class LectureSearch extends Lecture
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lecture_type', 'status', 'created_on', 'updated_on'], 'integer'],
            [['title', 'article', 'content', 'remark_one', 'remark_two'], 'safe'],
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
        $query = Lecture::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC
                ]
            ]
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
            'lecture_type' => $this->lecture_type,
            'status' => $this->status,
            'created_on' => $this->created_on,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'article', $this->article])
            ->andFilterWhere([
                'or',
                ['like', 'content', $this->title],
                ['like', 'content', $this->article],
            ])
            ->andFilterWhere(['like', 'remark_one', $this->remark_one])
            ->andFilterWhere(['like', 'remark_two', $this->remark_two]);

        return $dataProvider;
    }
}
