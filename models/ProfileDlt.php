<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile_dlt".
 *
 * @property int $id
 * @property string $id_no
 * @property string $username
 * @property string $accessToken
 * @property string $title
 * @property string $name
 * @property string $surname
 * @property string $positionDesc
 * @property string|null $orgFullNameDes
 * @property string|null $offLocDesc
 * @property string $offLocCode
 * @property string $role
 * @property int|null $create_at
 * @property int|null $update_at
 */
class ProfileDlt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile_dlt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['id_no', 'username', 'title', 'name', 'surname', 'positionDesc', 'offLocCode'], 'required'],
            [['create_at', 'update_at','rolex'], 'integer'],
            [['id_no'], 'string', 'max' => 15],
            [['username', 'orgFullNameDes', 'offLocDesc'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 50],
            [['name', 'surname'], 'string', 'max' => 120],
            [['positionDesc'], 'string', 'max' => 200],
            [['offLocCode'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_no' => 'Id No',
            'username' => 'Username',
            'accessToken' => 'Access Token',
            'title' => 'Title',
            'name' => 'Name',
            'surname' => 'Surname',
            'positionDesc' => 'Position Desc',
            'orgFullNameDes' => 'Org Full Name Des',
            'offLocDesc' => 'Off Loc Desc',
            'offLocCode' => 'Off Loc Code',
            'roles'=>'Role',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }

    public static function getFullDescription($username){
        $model =ProfileDlt::find()->where(['username'=>$username])->one();
        return @$model->orgFullNameDes;
    }
    public static function getIssOffLocCode($username){
        $model =ProfileDlt::find()->where(['username'=>$username])->one();
        return $model->offLocDesc;
    }
    public static function getFullname($username){
        $model =ProfileDlt::find()->where(['username'=>$username])->one();
        return $model->title.''.$model->name.' '.$model->surname;
    }

    public  function getIssRole($username){
        $model =ProfileDlt::find()->where(['username'=>$username])->one();
        return $model->role;
    }

    public static function getRolex($username){
        $model =ProfileDlt::find()->where(['username'=>$username])->one();
        return @$model->rolex;
    }

}
