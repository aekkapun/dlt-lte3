<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LineToken;

/**
 * LineTokenSearch represents the model behind the search form about `app\models\LineToken`.
 */
class LineTokenSearch extends LineToken
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'zone'], 'integer'],
            [['line_token', 'line_desc'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = LineToken::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'zone' => $this->zone,
        ]);

        $query->andFilterWhere(['like', 'line_token', $this->line_token])
            ->andFilterWhere(['like', 'line_desc', $this->line_desc]);

        return $dataProvider;
    }
}
