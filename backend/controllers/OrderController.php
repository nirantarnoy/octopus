<?php

namespace backend\controllers;

use common\models\OrderFile;
use Yii;
use backend\models\Order;
use backend\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Modelfile;
use yii\web\UploadedFile;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    public $enableCsrfValidation = false;
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $orderfile = \common\models\OrderFile::find()->where(['order_id'=>$id,'file_type'=>1])->all();
        $orderimage = \common\models\OrderFile::find()->where(['order_id'=>$id,'file_type'=>2])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'orderfile' => $orderfile,
            'orderimage' => $orderimage,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();
        $modelfile = new Modelfile();

        if ($model->load(Yii::$app->request->post()) && $modelfile->load(Yii::$app->request->post())) {

            $uploadfile = UploadedFile::getInstances($modelfile,'file');
            $uploadimage = UploadedFile::getInstances($modelfile,'file_photo');

            if($model->save()){

                if(!empty($uploadfile)){
                    foreach($uploadfile as $file){
                        $file->saveAs(Yii::getAlias('@backend') .'/web/uploads/files/'.$file);
                        $modelfile = new \common\models\OrderFile();
                        $modelfile->order_id = $model->id;
                        $modelfile->file_type = 1; // 1 = ไฟล
                        $modelfile->name = $file;
                        $modelfile->save(false);
                    }
                }
                if(!empty($uploadimage)){
                    foreach($uploadimage as $file){
                        $file->saveAs(Yii::getAlias('@backend') .'/web/uploads/images/'.$file);
                        $modelfile = new \common\models\OrderFile();
                        $modelfile->order_id = $model->id;
                        $modelfile->file_type = 2; // 2 = รูปภาพ
                        $modelfile->name = $file;
                        $modelfile->save(false);
                    }
                }


                $session = Yii::$app->session;
                $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelfile' => $modelfile,
            'runno'=>$model->getLastNo(1),
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelfile = new Modelfile();
        $orderfile = \common\models\OrderFile::find()->where(['order_id'=>$id,'file_type'=>1])->all();
        $orderimage = \common\models\OrderFile::find()->where(['order_id'=>$id,'file_type'=>2])->all();
        if ($model->load(Yii::$app->request->post()) && $modelfile->load(Yii::$app->request->post())) {

            $uploadfile = UploadedFile::getInstances($modelfile,'file');
            $uploadimage = UploadedFile::getInstances($modelfile,'file_photo');

            $model->status = 1;
            if($model->save()){

                if(!empty($uploadfile)){
                    foreach($uploadfile as $file){
                        $file->saveAs(Yii::getAlias('@backend') .'/web/uploads/files/'.$file);
                        $modelfile = new \common\models\OrderFile();
                        $modelfile->order_id = $model->id;
                        $modelfile->file_type = 1; // 1 = ไฟล
                        $modelfile->name = $file;
                        $modelfile->save(false);
                    }
                }
                if(!empty($uploadimage)){
                    foreach($uploadimage as $file){
                        $file->saveAs(Yii::getAlias('@backend') .'/web/uploads/images/'.$file);
                        $modelfile = new \common\models\OrderFile();
                        $modelfile->order_id = $model->id;
                        $modelfile->file_type = 2; // 2 = รูปภาพ
                        $modelfile->name = $file;
                        $modelfile->save(false);
                    }
                }

                $session = Yii::$app->session;
                $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelfile' => $modelfile,
            'orderfile' => $orderfile,
            'orderimage' => $orderimage,
        ]);
    }

    /**
     * Deletes an existing Order model.
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
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionDeleteimage(){
        //$id = \Yii::$app->request->post("product_id");
        $picid = \Yii::$app->request->post("pic_id");
        if($picid){
            $model = \common\models\OrderFile::find()->where(['id'=>$picid])->one();
            if($model){
                unlink(Yii::getAlias('@backend') .'/web/uploads/images/'.$model->name);
                \common\models\OrderFile::deleteAll(['id'=>$picid]);
            }

            return true;
        }
    }
    public function actionDeletefile(){
        //$id = \Yii::$app->request->post("product_id");
        $picid = \Yii::$app->request->post("file_id");
        if($picid){
            $model = \common\models\OrderFile::find()->where(['id'=>$picid])->one();
            if($model){
                unlink(Yii::getAlias('@backend') .'/web/uploads/files/'.$model->name);
                \common\models\OrderFile::deleteAll(['id'=>$picid]);
            }

            return true;
        }
    }
}
