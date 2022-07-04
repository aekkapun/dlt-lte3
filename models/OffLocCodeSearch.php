<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OffLocCode;

/**
 * OffLocCodeSearch represents the model behind the search form about `app\modules\setting\models\OffLocCode`.
 */
class OffLocCodeSearch extends OffLocCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['OFF_LOC_CODE', 'OFF_LOC_DESC', 'OFF_LOC_ENG_DESC', 'OLD_REGION_CODE', 'BOR_FLAG', 'OFF_LEV9_FLAG', 'OFF_NODE', 'OFF_REG_DESC', 'ZIP_CODE', 'INSPECT_REGION', 'GRP_LOC_CODE', 'CANC_FLAG', 'WAN_TYPE', 'OLD_OFF_LOC_CODE', 'OFF_LOC_FLAG', 'CREATE_TIME'], 'safe'],
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
        $query = OffLocCode::find();

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
            'CREATE_TIME' => $this->CREATE_TIME,
        ]);

        $query->andFilterWhere(['like', 'OFF_LOC_CODE', $this->OFF_LOC_CODE])
            ->andFilterWhere(['like', 'OFF_LOC_DESC', $this->OFF_LOC_DESC])
            ->andFilterWhere(['like', 'OFF_LOC_ENG_DESC', $this->OFF_LOC_ENG_DESC])
            ->andFilterWhere(['like', 'OLD_REGION_CODE', $this->OLD_REGION_CODE])
            ->andFilterWhere(['like', 'BOR_FLAG', $this->BOR_FLAG])
            ->andFilterWhere(['like', 'OFF_LEV9_FLAG', $this->OFF_LEV9_FLAG])
            ->andFilterWhere(['like', 'OFF_NODE', $this->OFF_NODE])
            ->andFilterWhere(['like', 'OFF_REG_DESC', $this->OFF_REG_DESC])
            ->andFilterWhere(['like', 'ZIP_CODE', $this->ZIP_CODE])
            ->andFilterWhere(['like', 'INSPECT_REGION', $this->INSPECT_REGION])
            ->andFilterWhere(['like', 'GRP_LOC_CODE', $this->GRP_LOC_CODE])
            ->andFilterWhere(['like', 'CANC_FLAG', $this->CANC_FLAG])
            ->andFilterWhere(['like', 'WAN_TYPE', $this->WAN_TYPE])
            ->andFilterWhere(['like', 'OLD_OFF_LOC_CODE', $this->OLD_OFF_LOC_CODE])
            ->andFilterWhere(['like', 'OFF_LOC_FLAG', $this->OFF_LOC_FLAG]);

        return $dataProvider;
    }
}
