<?php

namespace backend\controllers;

use Yii;
use backend\models\Delivertype;
use backend\models\DelivertypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * DelivertypeController implements the CRUD actions for Delivertype model.
 */
class DelivertypeController extends Controller
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
            'access'=>[
                'class'=>AccessControl::className(),
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
                },
                'rules'=>[
//                    [
//                        'allow'=>true,
//                        'actions'=>['index','create','update','delete','view'],
//                        'roles'=>['@'],
//                    ]
                    [
                        'allow'=>true,
                        'roles'=>['@'],
                        'matchCallback'=>function($rule,$action){
                            $currentRoute = Yii::$app->controller->getRoute();
                            if(Yii::$app->user->can($currentRoute)){
                                return true;
                            }
                        }
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all Delivertype models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new DelivertypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Delivertype model.
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
     * Creates a new Delivertype model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Delivertype();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $session = Yii::$app->session;
            $session->setFlash('msg','บันทึกรายการเรียบร้อย');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Delivertype model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->status = 1;
            if($model->save()){
                $session = Yii::$app->session;
                $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Delivertype model.
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
     * Finds the Delivertype model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Delivertype the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Delivertype::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
