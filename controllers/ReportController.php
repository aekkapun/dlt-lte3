<?php

namespace app\controllers;

use Yii;
use app\models\Booking;
use app\models\BookingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReportController implements the CRUD actions for Booking model.
 */
class ReportController extends Controller
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
     * Lists all Booking models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTrDateOffice() {
        $model = new Entryform();
        $model->OFF_LOC_CODE = Yii::$app->user->identity->off_loc_code;
        $model->scenario = Entryform::SCENARIO_BETWEENDATE2;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //$STR_DATE = MyDate::getDateInt($model->START_DATE);
            //$END_DATE = MyDate::getDateInt($model->END_DATE);
            //$query = MacTestVehCert::find()->where(['between', 'PMT_DATE', $model->START_DTE, $model->END_DTE]);
            $query = PblPerson::find()
                ->where("DATE(CREATE_AT) >= '$model->START_DATE' AND DATE(CREATE_AT) <='$model->END_DATE' AND CREATE_OFF_LOC_CODE ='$model->OFF_LOC_CODE' ");
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => false,
            ]);
            return $this->render('tr-date-office', [
                'post' => 1,
                'model' => $model,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('tr-date-office', ['model' => $model]);
        }
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Booking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Booking();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Booking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Booking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Booking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Booking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Booking::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
