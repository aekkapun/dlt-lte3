<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\db\Expression;
use yii\helpers\VarDumper;
use app\models\Upload;
use yii\helpers\Url;

/**
 * This is the model class for table "job_request".
 *
 * @property int $id
 * @property string|null $job_ref
 * @property string $sys_ref
 * @property string $content_question
 * @property string $content_answer
 * @property string $iss_off_loc_code
 * @property string $question_by
 * @property string|null $answer_by
 * @property string|null $job_status
 * @property string|null $job_request_date
 * @property string|null $job_close_date
 * @property string|null $create_at
 * @property string|null $update_at
 * @property int|null $create_by
 * @property int|null $update_by
 */
class JobRequest extends \yii\db\ActiveRecord
{

    const UPLOAD_FOLDER='photo_qa';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job_request';
    }
    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_at',
                'updatedAtAttribute' => 'update_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'create_by',
                'updatedByAttribute' => 'update_by'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sys_ref','ref','title', 'content_question',  'iss_off_loc_code', 'question_by'], 'required'],
            [['content_question', 'content_answer'], 'string'],
            [['iss_off_loc_code', 'job_request_date', 'job_close_date', 'create_at', 'update_at'], 'safe'],
            [['create_by', 'update_by','job_status'], 'integer'],
            [['job_ref'], 'string', 'max' => 15],
            [['sys_ref'], 'string', 'max' => 11],
            [['question_by', 'answer_by'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_ref' => 'รหัส',
            'ref' => 'เลข fk กับ upload ใช้กับ upload ajax',
            'title'=>'เรื่อง',
            'sys_ref' => 'ระบบงาน',
            'content_question' => 'รายละเอียด',
            'content_answer' => 'วิธีแก้ไข/สาเหตุ',
            'iss_off_loc_code' => 'สำนักงาน',
            'question_by' => 'ผููถาม',
            'answer_by' => 'ผู้ตอบ',
            'job_status' => 'สถานะ',
            'job_request_date' => 'วันที่สอบถาม',
            'job_close_date' => 'วันที่แอดมินดำเนินการล่าสุด',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'create_by' => 'Create By',
            'update_by' => 'Update By',
        ];
    }

    public function getSystem() {
        return $this->hasOne(SystemList::className(), ['ref' => 'sys_ref']);
    }
    public function getDltOffice() {
        return $this->hasOne(OffLocCode::className(), ['OFF_LOC_CODE' => 'iss_off_loc_code']);
    }

    public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }
    public function getStatus() {
        switch ($this->job_status) {
            case '1':
                return '<span class="label label-danger">รอตรวจสอบ</span> ';
            case '2':
                return '<span class="label label-warning">กำลังตรวจสอบ</span> ';
            case '3':
                return '<span class="label label-primary">ยุติปัญหาโดยแอดมิน</span> ';
            case '4':
                return '<span class="label label-primary">ยุติปัญหาโดยตนเอง</span> ';

        }

        return NULL;
    }

    public function getContentQuestion() {
        $returnVal = '';

        $returnVal = str_replace("<ul>","",$this->content_question);
        $returnVal = str_replace("</ul>","",$returnVal);
        $returnVal = str_replace("            <li>","- ",$returnVal);
        $returnVal = str_replace("</li>","",$returnVal);

        return $returnVal;
    }

    public function getThumbnails($ref,$event_name){
        $uploadFiles   = Uploads::find()->where(['ref'=>$ref])->all();
        $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url'=>self::getUploadUrl(true).$ref.'/'.$file->real_filename,
                'src'=>self::getUploadUrl(true).$ref.'/thumbnail/'.$file->real_filename,
                'options' => ['title' => $event_name]
            ];
        }
        return $preview;
    }
}
