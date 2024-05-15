<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MyFamilyPhoto;

/**
 * MyFamilyPhotoSearch represents the model behind the search form of `app\models\MyFamilyPhoto`.
 */
class MyFamilyPhotoSearch extends MyFamilyPhoto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_on', 'updated_on'], 'integer'],
            [['file_path', 'url', 'alt', 'remark_one', 'remark_two'], 'safe'],
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
        $query = MyFamilyPhoto::find();

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
            'status' => $this->status,
            'created_on' => $this->created_on,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'file_path', $this->file_path])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'alt', $this->alt])
            ->andFilterWhere(['like', 'remark_one', $this->remark_one])
            ->andFilterWhere(['like', 'remark_two', $this->remark_two]);

        return $dataProvider;
    }
}
