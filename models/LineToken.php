<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "line_token".
 *
 * @property int $id
 * @property string|null $line_token
 * @property int|null $status
 * @property int|null $zone เขต
 * @property string|null $desc กลุ่มไลน์
 */
class LineToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'line_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'zone'], 'integer'],
            [['line_token'], 'string', 'max' => 255],
            [['line_desc'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'line_token' => 'Line Token',
            'status' => 'Status',
            'zone' => 'Zone',
            'line_desc' => 'line_desc',
        ];
    }
}
