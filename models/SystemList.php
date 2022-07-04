<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "system_list".
 *
 * @property int $id
 * @property string|null $ref
 * @property string|null $org_id
 * @property string|null $system_title
 * @property string|null $system_detail
 * @property string|null $system_img
 * @property string|null $system_option
 * @property string|null $system_color
 */
class SystemList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['system_detail', 'system_line'], 'string'],
            [['ref'], 'string', 'max' => 50],
            [['org_id'], 'string', 'max' => 10],
            [['system_title', 'system_img', 'system_option'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref' => 'รหัสระบบงาน',
            'org_id' => 'Org ID',
            'system_title' => 'ชื่อระบบงาน',
            'system_detail' => 'System Detail',
            'system_img' => 'System Img',
            'system_option' => 'System Option',
            'system_line' => 'Line Token',
        ];
    }

    public function getFullSystemName() {
        return @$this->ref . ' : ' . @$this->system_title;
    }

    public static function getFullSystemNameByRef($systemRef)
    {
        $returnVal = '';

        $data = self::find()->select(['system_title'])->where(['ref' => $systemRef])->one();
        $returnVal = @$data->system_title;

        return $returnVal;
    }

    public static function getFullSystemNameAndAbrevByRef($systemRef)
    {
        $returnVal = '';

        $data = self::find()->select(['system_title'])->where(['ref' => $systemRef])->one();
        $returnVal = $systemRef . ' : ' . @$data->system_title;

        return $returnVal;
    }

}
