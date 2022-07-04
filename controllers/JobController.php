<?php

namespace app\controllers;

use app\models\Room;
use app\models\SystemList;
use app\models\User;
use mdm\autonumber\AutoNumber;
use Yii;
use app\models\JobRequest;
use app\models\JobRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\html;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use app\models\Uploads;
use yii\db\Expression;

/**
 * JobController implements the CRUD actions for JobRequest model.
 */
class JobController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all JobRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->identity->role==99) {
            return $this->redirect(['index-admin']);
            exit();
        }

        $searchModel = new JobRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere([ 'question_by' => Yii::$app->user->identity->username]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexAdmin()
    {
        if(Yii::$app->user->identity->role<>99) {
            return $this->redirect(['index']);
            exit();
        }

        $searchModel = new JobRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->query->andFilterWhere([ 'iss_off_loc_code' => Yii::$app->user->identity->username]);

        return $this->render('index-admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JobRequest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new JobRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
    public function actionCreate()
    {
        $model = new JobRequest();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
*/

    public function actionEndBySelf($id) {
        $model = $this->findModel($id);
        $model->job_status = '4';
        $model->save();

        Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
            [
                'title' => 'การแจ้งเตือน',
                'text' => 'ระบบได้ "ยุติปัญหาโดยตนเอง" เรื่อง "'.$model->title.'" เรียบร้อยแล้ว',
                'confirmButtonText' => 'ตกลง',
            ]

        ]);
        return $this->redirect(['view', 'id' => $model->id]);
    }
    public function actionCreate()
    {
        $model = new JobRequest();
        $model->iss_off_loc_code = Yii::$app->user->identity->offLocCode;
        $model->question_by = Yii::$app->user->identity->username;
        //$model->job_ref = AutoNumber::generate('D{Ymd}.???');
        $model->job_status=1;
        $model->job_request_date = new Expression('NOW()');
        $model->content_question ='
        <ul>
            <li>เบอร์โทรติดต่อกลับ :</li>
            <li>(เบอร์ IP Phone/เบอร์สำนักงาน/เบอร์มือถือ) :</li>
            <li> เลขทะเบียนรถ/รย. :</li>
            <li> [รหัสโปรแกรม] :</li>
            <li> ข้อมูลอื่นๆ :</li>
            <li> ปัญหาที่พบ/ข้อซักถาม :</li>
        </ul>
        ';

        if ($model->load(Yii::$app->request->post()) ) {

            $this->Uploads(false);
            $model->job_ref = AutoNumber::generate('D{Ymd}.???');
            if($model->save()){
                $book = $this->findModel($model->id);
                $message = "บันทึกรายการแจ้งปัญหา  \"ระบบ ".$book->sys_ref." : ".SystemList::getFullSystemNameByRef($book->sys_ref) ."\"\r\n เรื่อง : ".$book->title."\r\n รายละเอียด : ".$book->getContentQuestion()."\r\n จาก : " . User::getFullNameByUsername($model->question_by) . " (".$book->dltOffice->OFF_LOC_DESC.")\r\n รหัสอ้างอิง : ".$book->job_ref."\r\n";
                $res = $this->notify_messageToGroup($message,$book->system->system_line);

                Yii::$app->session->setFlash(\dominus77\sweetalert2\Alert::TYPE_SUCCESS, [
                    [
                        'title' => 'การแจ้งเตือน',
                        'text' => 'ระบบได้บันทึก '.$model->title.' เรียบร้อยแล้ว',
                        'confirmButtonText' => 'ตกลง',
                    ]

                ]);
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        list($initialPreview,$initialPreviewConfig) = $this->getInitialPreview($model->ref);

        if ($model->load(Yii::$app->request->post())) {
            $this->Uploads(false);

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'initialPreview'=>$initialPreview,
            'initialPreviewConfig'=>$initialPreviewConfig
        ]);

    }

    public function actionAnswer($id)
    {
        $model = $this->findModel($id);

        $model->answer_by = Yii::$app->user->identity->username;
        list($initialPreview,$initialPreviewConfig) = $this->getInitialPreview($model->ref);

        if ($model->load(Yii::$app->request->post())) {
            $this->Uploads(false);
            $model->job_close_date =date("Y-m-d h:i:s");
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('answer', [
            'model' => $model,
            'initialPreview'=>$initialPreview,
            'initialPreviewConfig'=>$initialPreviewConfig
        ]);

    }
    public function actionUpdateEditable() {
        if (Yii::$app->request->post('hasEditable')) {

            Yii::$app->response->format = Response::FORMAT_JSON;

            $model = $this->findModel(Yii::$app->request->post('editableKey'));

            $out = [
                'output'    => '',
                'message'   => '',
            ];
            $posted = current($_POST[$model->formName()]);
            $post[$model->formName()] = $posted;
            Yii::info('processed post:' . print_r($posted,true));

            if ($model->load($post)) {
                if (!$model->save()) {
                    $out = [
                        'output'    => '',
                        'message'   => $model->getFirstError(),
                    ];
                }
                Yii::info('editable returns:' . print_r($out,true));
                return $out;
            }
        }
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        //remove upload file & data
        $this->removeUploadDir($model->ref);
        Uploads::deleteAll(['ref'=>$model->ref]);

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the JobRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JobRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JobRequest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUploadAjax(){
        $this->Uploads(true);
    }
    public function actionUploadimg(){
        $this->Uploads(true);
    }

    private function CreateDir($folderName){
        if($folderName != NULL){
            $basePath = JobRequest::getUploadPath();
            if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
                BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir){
        BaseFileHelper::removeDirectory(JobRequest::getUploadPath().$dir);
    }

    private function Uploads($isAjax=false) {
        if (Yii::$app->request->isPost) {
            $images = UploadedFile::getInstancesByName('upload_ajax');
            if ($images) {

                if($isAjax===true){
                    $ref =Yii::$app->request->post('ref');
                }else{
                    $PhotoLibrary = Yii::$app->request->post('JobRequest');
                    $ref = $PhotoLibrary['ref'];
                }

                $this->CreateDir($ref);

                foreach ($images as $file){
                    $fileName       = $file->baseName . '.' . $file->extension;
                    $realFileName   = md5($file->baseName.time()) . '.' . $file->extension;
                    $savePath       = JobRequest::UPLOAD_FOLDER.'/'.$ref.'/'. $realFileName;
                    if($file->saveAs($savePath)){

                        if($this->isImage(Url::base(true).'/'.$savePath)){
                            $this->createThumbnail($ref,$realFileName);
                        }

                        $model                  = new Uploads;
                        $model->ref             = $ref;
                        $model->file_name       = $fileName;
                        $model->real_filename   = $realFileName;
                        $model->save();

                        if($isAjax===true){
                            echo json_encode(['success' => 'true']);
                        }

                    }else{
                        if($isAjax===true){
                            echo json_encode(['success'=>'false','eror'=>$file->error]);
                        }
                    }

                }
            }
        }
    }

    private function getInitialPreview($ref) {
        $datas = Uploads::find()->where(['ref'=>$ref])->all();
        $initialPreview = [];
        $initialPreviewConfig = [];
        foreach ($datas as $key => $value) {
            array_push($initialPreview, $this->getTemplatePreview($value));
            array_push($initialPreviewConfig, [
                'caption'=> $value->file_name,
                'width'  => '120px',
                'url'    => Url::to(['/job/deletefile-ajax']),
                'key'    => $value->upload_id
            ]);
        }
        return  [$initialPreview,$initialPreviewConfig];
    }

    public function isImage($filePath){
        return @is_array(getimagesize($filePath)) ? true : false;
    }

    private function getTemplatePreview(Uploads $model){
        $filePath = JobRequest::getUploadUrl().$model->ref.'/thumbnail/'.$model->real_filename;
        $isImage  = $this->isImage($filePath);
        if($isImage){
            $file = Html::img($filePath,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
        }else{
            $file =  "<div class='file-preview-other'> " .
                "<h2><i class='fa fa-eye'></i></h2>" .
                "</div>";
        }
        return $file;
    }

    private function createThumbnail($folderName,$fileName,$width=250){
        $uploadPath   = JobRequest::getUploadPath().'/'.$folderName.'/';
        $file         = $uploadPath.$fileName;
        $image        = Yii::$app->image->load($file);
        $image->resize($width);
        $image->save($uploadPath.'thumbnail/'.$fileName);
        return;
    }

    public function actionDeletefileAjax(){

        $model = Uploads::findOne(Yii::$app->request->post('key'));
        if($model!==NULL){
            $filename  = JobRequest::getUploadPath().$model->ref.'/'.$model->real_filename;
            $thumbnail = JobRequest::getUploadPath().$model->ref.'/thumbnail/'.$model->real_filename;
            if($model->delete()){
                @unlink($filename);
                @unlink($thumbnail);
                echo json_encode(['success'=>true]);
            }else{
                echo json_encode(['success'=>false]);
            }
        }else{
            echo json_encode(['success'=>false]);
        }
    }


    public function notify_messageToGroup($message,$lineToken) {
        $line_api = 'https://notify-api.line.me/api/notify';
        $line_token = $lineToken;
        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array('http' => array('method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\n" . "Authorization: Bearer " . $line_token . "\r\n" . "Content-Length: " . strlen($queryData) . "\r\n", 'content' => $queryData));
        $context = stream_context_create($headerOptions);
        $result = file_get_contents($line_api, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }
}
