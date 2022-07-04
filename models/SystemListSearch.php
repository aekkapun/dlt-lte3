<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SystemList;

/**
 * SystemListSearch represents the model behind the search form about `app\models\SystemList`.
 */
class SystemListSearch extends SystemList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ref', 'org_id', 'system_title', 'system_detail', 'system_img', 'system_option', 'system_line'], 'safe'],
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
        $query = SystemList::find();

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
        ]);

        $query->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'org_id', $this->org_id])
            ->andFilterWhere(['like', 'system_title', $this->system_title])
            ->andFilterWhere(['like', 'system_detail', $this->system_detail])
            ->andFilterWhere(['like', 'system_img', $this->system_img])
            ->andFilterWhere(['like', 'system_option', $this->system_option])
            ->andFilterWhere(['like', 'system_line', $this->system_line]);

        return $dataProvider;
    }
}
