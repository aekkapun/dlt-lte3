<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "off_loc_code".
 *
 * @property integer $id
 * @property string $OFF_LOC_CODE
 * @property string $OFF_LOC_DESC
 * @property string $OFF_LOC_ENG_DESC
 * @property string $OLD_REGION_CODE
 * @property string $BOR_FLAG
 * @property string $OFF_LEV9_FLAG
 * @property string $OFF_NODE
 * @property string $OFF_REG_DESC
 * @property string $ZIP_CODE
 * @property string $INSPECT_REGION
 * @property string $GRP_LOC_CODE
 * @property string $CANC_FLAG
 * @property string $WAN_TYPE
 * @property string $OLD_OFF_LOC_CODE
 * @property string $OFF_LOC_FLAG
 * @property string $CREATE_TIME
 */
class OffLocCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tabt_office_location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CREATE_TIME'], 'safe'],
            [['OFF_LOC_CODE', 'OFF_LEV9_FLAG', 'OFF_NODE', 'INSPECT_REGION', 'GRP_LOC_CODE'], 'string', 'max' => 7],
            [['OFF_LOC_DESC', 'OFF_LOC_ENG_DESC', 'OLD_REGION_CODE'], 'string', 'max' => 50],
            [['BOR_FLAG'], 'string', 'max' => 2],
            [['OFF_REG_DESC'], 'string', 'max' => 100],
            [['ZIP_CODE'], 'string', 'max' => 6],
            [['CANC_FLAG', 'WAN_TYPE'], 'string', 'max' => 1],
            [['OLD_OFF_LOC_CODE'], 'string', 'max' => 10],
            [['OFF_LOC_FLAG'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'OFF_LOC_CODE' => 'รหัสสำนักงาน',
            'OFF_LOC_DESC' => 'ชื่อสำนักงาน',
            'OFF_LOC_ENG_DESC' => 'Off  Loc  Eng  Desc',
            'OLD_REGION_CODE' => 'Old  Region  Code',
            'BOR_FLAG' => 'Bor  Flag',
            'OFF_LEV9_FLAG' => 'Off  Lev9  Flag',
            'OFF_NODE' => 'Off  Node',
            'OFF_REG_DESC' => 'Off  Reg  Desc',
            'ZIP_CODE' => 'Zip  Code',
            'INSPECT_REGION' => 'Inspect  Region',
            'GRP_LOC_CODE' => 'Grp  Loc  Code',
            'CANC_FLAG' => 'Canc  Flag',
            'WAN_TYPE' => 'Wan  Type',
            'OLD_OFF_LOC_CODE' => 'Old  Off  Loc  Code',
            'OFF_LOC_FLAG' => 'Off  Loc  Flag',
            'CREATE_TIME' => 'Create  Time',
        ];
    }
}
