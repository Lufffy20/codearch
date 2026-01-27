<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Education;

/**
 * EducationSearch represents the model behind the search form of `common\models\Education`.
 */
class EducationSearch extends Education
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cv_id', 'sort_order', 'created_at', 'updated_at'], 'integer'],
            [['degree', 'institute', 'year'], 'safe'],
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Education::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'cv_id' => $this->cv_id,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'degree', $this->degree])
            ->andFilterWhere(['like', 'institute', $this->institute])
            ->andFilterWhere(['like', 'year', $this->year]);

        return $dataProvider;
    }
}
