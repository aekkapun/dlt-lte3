<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $desc
 * @property string|null $value
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code'], 'string', 'max' => 5],
            [['desc'], 'string', 'max' => 120],
            [['value'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'desc' => 'Desc',
            'value' => 'Value',
        ];
    }
}
