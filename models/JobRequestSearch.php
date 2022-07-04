<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JobRequest;

/**
 * JobRequestSearch represents the model behind the search form of `app\models\JobRequest`.
 */
class JobRequestSearch extends JobRequest
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'create_by', 'update_by'], 'integer'],
            [['job_ref', 'sys_ref','title', 'content_question', 'content_answer', 'iss_off_loc_code', 'question_by', 'answer_by', 'job_status', 'job_request_date', 'job_close_date', 'create_at', 'update_at'], 'safe'],
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
        $query = JobRequest::find();

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
            'iss_off_loc_code' => $this->iss_off_loc_code,
            'job_request_date' => $this->job_request_date,
            'job_close_date' => $this->job_close_date,
            'create_at' => $this->create_at,
            'update_at' => $this->update_at,
            'create_by' => $this->create_by,
            'update_by' => $this->update_by,
        ]);

        $query->andFilterWhere(['like', 'job_ref', $this->job_ref])
            ->andFilterWhere(['like', 'title', $this->sys_ref])
            ->andFilterWhere(['like', 'sys_ref', $this->sys_ref])
            ->andFilterWhere(['like', 'content_question', $this->content_question])
            ->andFilterWhere(['like', 'content_answer', $this->content_answer])
            ->andFilterWhere(['like', 'question_by', $this->question_by])
            ->andFilterWhere(['like', 'answer_by', $this->answer_by])
            ->andFilterWhere(['like', 'job_status', $this->job_status]);

        return $dataProvider;
    }
}
