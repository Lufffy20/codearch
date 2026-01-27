<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Experience;

/**
 * ExperienceSearch represents the model behind the search form of `common\models\Experience`.
 */
class ExperienceSearch extends Experience
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cv_id', 'sort_order', 'created_at', 'updated_at'], 'integer'],
            [['company', 'position', 'duration', 'description'], 'safe'],
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
        $query = Experience::find();

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

        $query->andFilterWhere(['like', 'company', $this->company])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'duration', $this->duration])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
