<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string|null $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string|null $email
 * @property int $role
 * @property int $status
 * @property string $positionDesc จังหวัด
 * @property string|null $orgFullNameDes รหัสจังหวัด
 * @property string|null $offLocDesc ชื่อ-สกุล
 * @property string $offLocCode รหัสบัตรประจำตัวประชาชน
 * @property string|null $id_no
 * @property string|null $title
 * @property string|null $name ตำแหน่ง
 * @property string|null $surname
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class UserDlt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'positionDesc', 'offLocCode'], 'required'],
            [['password_reset_token'], 'string'],
            [['role', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'email', 'surname'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['positionDesc'], 'string', 'max' => 120],
            [['orgFullNameDes'], 'string', 'max' => 150],
            [['offLocDesc', 'name'], 'string', 'max' => 100],
            [['offLocCode', 'title'], 'string', 'max' => 20],
            [['id_no'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'role' => 'Role',
            'status' => 'Status',
            'positionDesc' => 'ตำแหน่ง',
            'orgFullNameDes' => 'ตำแหน่ง/สนง',
            'offLocDesc' => 'สนง.',
            'offLocCode' => 'Off Loc Code',
            'id_no' => 'Id No',
            'title' => 'คำนำหน้า',
            'name' => 'ชื่อ',
            'surname' => 'นามสกุล',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function getFullName(){
        return $this->title.''.$this->name.'  '.$this->surname;
    }
    public function getStatusx() {
        switch ($this->status) {
            case '10':
                return 'Active ';
            case 'Y':
                return 'InActive';
        }

        return NULL;
    }
    public function getRoles() {
        switch ($this->role) {
            case '10':
                return 'User ';
            case '99':
                return 'Admin';
        }

        return NULL;
    }
}
