<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Entryform extends Model {


    public $START_DATE;
    public $END_DATE;

    public function rules() {
        return [
            [['START_DTE', 'END_DTE'], 'safe'],
        ];
    }

    const SCENARIO_BETWEENDATE = 'between_date';


    public function scenarios() {
        return [
            self::SCENARIO_BETWEENDATE => ['START_DATE', 'END_DATE'],
        ];
    }

    public function attributeLabels() {
        return [

            'START_DATE' => 'จากวันที่ ',
            'END_DATE' => 'ถึงวันที่ ',
        ];
    }

}
