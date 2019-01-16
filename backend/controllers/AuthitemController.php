<?php

namespace backend\controllers;

use Yii;
use backend\models\Authitem;
use backend\models\AuthitemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AuthitemController implements the CRUD actions for Authitem model.
 */
class AuthitemController extends Controller
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
//            'access'=>[
//                'class'=>AccessControl::className(),
//                'rules'=>[
//                    [
//                        'allow'=>true,
//                        'actions'=>['index','create','update','view','resetpassword','managerule'],
//                        'roles'=>['@'],
//                    ],
//                    [
//                        'allow'=>true,
//                        'actions'=>['delete'],
//                        'roles'=>['System Administrator'],
//                    ]
//
//                ]
//            ]
        ];
    }

    /**
     * Lists all Authitem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new AuthitemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['type'=>1])->orFilterWhere(['LIKE','description','สิทธิ์']);
        $dataProvider->setSort(['defaultOrder'=>['type'=>SORT_ASC]]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Authitem model.
     * @param string $id
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
     * Creates a new Authitem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Authitem();

        if ($model->load(Yii::$app->request->post())) {
            $auth = Yii::$app->authManager;
            //$auth->removeAll();

            $newrole = $auth->createRole($model->name);
            $newrole->description = $model->description;
            $newrole->type = $model->type;
            $auth->add($newrole);

            if(count($model->child_list)>0){
                for($i=0;$i<=count($model->child_list)-1;$i++){
                    $item = $auth->getRole($model->child_list[$i]);
                    $item2 = $auth->getPermission($model->child_list[$i]);
                    $auth->addChild($newrole,count($item)>0?$item:$item2);
                }
            }

                $session = Yii::$app->session;
                $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                return $this->redirect(['index']);

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Authitem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelchild = \backend\models\Auhtitemchild::find()->where(['parent'=>$model->name])->all();

        if ($model->load(Yii::$app->request->post())) {

            $childlist = $model->child_list;
           // echo $model->name;return;

          //  print_r($childlist);return;

            $auth = Yii::$app->authManager;
            $olditem = $model->type == 1?$auth->getRole($model->name):$auth->getPermission($model->name);
            $olditem->description = $model->description;
            $olditem->type = $model->type;

            $auth->update($model->name,$olditem);

            if(sizeof($childlist)>0){
               $auth->removeChildren($olditem);
              // print_r($olditem);return;
               for($i=0;$i<=count($childlist)-1;$i++){
                   //echo $childlist[$i];return;
                   $childitem = $auth->getRole($childlist[$i]);
                   $childitem2 = $auth->getPermission($childlist[$i]);
                   $auth->addChild($olditem,count($childitem)>0?$childitem:$childitem2);
               }

            }


            $session = Yii::$app->session;
            $session->setFlash('msg','บันทึกรายการเรียบร้อย');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'modelchild'=> $modelchild,
        ]);
    }

    /**
     * Deletes an existing Authitem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('deleteRecord', ['user_id' => Yii::$app->user->id])) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }else{

        }

    }

    /**
     * Finds the Authitem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Authitem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Authitem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionManagerule(){

        $auth = Yii::$app->authManager;
        $auth->removeAll();

       // $rule = new \common\rbac\DeleteRecordRule(); // rule ที่สร้างไว้
      //  $auth->add($rule);

        // site module

//        $site_index = $auth->createPermission('site/index');
//        $auth->add($site_index);
//        $site_logout = $auth->createPermission('site/logout');
//        $auth->add($site_logout);
//        $site_login = $auth->createPermission('site/login');
//        $auth->add($site_login);
//
//        $site_permission = $auth->createPermission('sitemodule');
//        $site_permission->description = "หน้าหลัก";
//        $auth->add($site_permission);
//        $auth->addChild($site_permission,$site_index);
//        $auth->addChild($site_permission,$site_logout);

//        $suplier = $auth->createRole('Suplier');
//        $suplier->description = "Suplier";
//        $auth->add($suplier);
//        $auth->addChild($suplier,$site_permission);


        // user_module
        $user_index = $auth->createPermission('user/index');
        $auth->add($user_index);
        $user_update = $auth->createPermission('user/update');
        $auth->add($user_update);
        $user_delete = $auth->createPermission('user/delete');
        $auth->add($user_delete);
        $user_view = $auth->createPermission('user/view');
        $auth->add($user_view);
        $user_create = $auth->createPermission('user/create');
        $auth->add($user_create);

        $user_permission = $auth->createPermission('usermodule');
        $user_permission->description = "สิทธิ์ใช้งานโมดูล user";
        $auth->add($user_permission);

        $auth->addChild($user_permission,$user_index);
        $auth->addChild($user_permission,$user_view);
        $auth->addChild($user_permission,$user_update);
        $auth->addChild($user_permission,$user_delete);
        $auth->addChild($user_permission,$user_create);

        $manage_user = $auth->createRole('Manage user');
        $manage_user->description = "Manage user";
        $auth->add($manage_user);
        $auth->addChild($manage_user,$user_permission);

        // user_group_module
        $usergroup_index = $auth->createPermission('usergroup/index');
        $auth->add($usergroup_index);
        $usergroup_update = $auth->createPermission('usergroup/update');
        $auth->add($usergroup_update);
        $usergroup_delete = $auth->createPermission('usergroup/delete');
        $auth->add($usergroup_delete);
        $usergroup_view = $auth->createPermission('usergroup/view');
        $auth->add($usergroup_view);
        $usergroup_create = $auth->createPermission('usergroup/create');
        $auth->add($usergroup_create);

        $usergroup_permission = $auth->createPermission('usergroupmodule');
        $usergroup_permission->description = "สิทธิ์ใช้งานโมดูล usergroup";
        $auth->add($usergroup_permission);

        $auth->addChild($usergroup_permission,$usergroup_index);
        $auth->addChild($usergroup_permission,$usergroup_view);
        $auth->addChild($usergroup_permission,$usergroup_update);
        $auth->addChild($usergroup_permission,$usergroup_delete);
        $auth->addChild($usergroup_permission,$usergroup_create);

        $manage_usergroup = $auth->createRole('Manage usergroup');
        $manage_usergroup->description = "Manage usergroup";
        $auth->add($manage_usergroup);
        $auth->addChild($manage_usergroup,$usergroup_permission);

        // product module
        $order_index = $auth->createPermission('order/index');
        $auth->add($order_index);
        $order_update = $auth->createPermission('order/update');
        $auth->add($order_update);
        $order_delete = $auth->createPermission('order/delete');
        $auth->add($order_delete);
        $order_view = $auth->createPermission('order/view');
        $auth->add($order_view);
        $order_create = $auth->createPermission('order/create');
        $auth->add($order_create);
        $order_print = $auth->createPermission('order/print');
        $auth->add($order_print);
        $order_showstatus = $auth->createPermission('order/showstatus');
        $auth->add($order_showstatus);
        $order_getno = $auth->createPermission('order/getrunno');
        $auth->add($order_getno);
        $order_updatestatus = $auth->createPermission('order/updatestatus');
        $auth->add($order_updatestatus);
        $order_findtype = $auth->createPermission('order/findtype');
        $auth->add($order_findtype);
        $order_delpic = $auth->createPermission('order/deletepic');
        $auth->add($order_delpic);
        $order_delfile = $auth->createPermission('order/deletefile');
        $auth->add($order_delfile);
        $order_download = $auth->createPermission('order/download');
        $auth->add($order_download);


        $order_permission = $auth->createPermission('ordermodule');
        $order_permission->description = "สิทธิ์ใช้งานโมดูล Order";
        $auth->add($order_permission);

        $auth->addChild($order_permission,$order_index);
        $auth->addChild($order_permission,$order_view);
        $auth->addChild($order_permission,$order_update);
        $auth->addChild($order_permission,$order_delete);
        $auth->addChild($order_permission,$order_create);
        $auth->addChild($order_permission,$order_print);
        $auth->addChild($order_permission,$order_showstatus);
        $auth->addChild($order_permission,$order_getno);
        $auth->addChild($order_permission,$order_updatestatus);
        $auth->addChild($order_permission,$order_findtype);
        $auth->addChild($order_permission,$order_delpic);
        $auth->addChild($order_permission,$order_delfile);
        $auth->addChild($order_permission,$order_download);


        $manage_order = $auth->createRole('Manage order');
        $manage_order->description = "Manage Order";
        $auth->add($manage_order);
        $auth->addChild($manage_order,$order_permission);

        // message

        $message_index = $auth->createPermission('message/index');
        $auth->add($message_index);
        $message_update = $auth->createPermission('message/update');
        $auth->add($message_update);
        $message_delete = $auth->createPermission('message/delete');
        $auth->add($message_delete);
        $message_view = $auth->createPermission('message/view');
        $auth->add($message_view);
        $message_create = $auth->createPermission('message/create');
        $auth->add($message_create);


        $message_permission = $auth->createPermission('messagemodule');
        $message_permission->description = "สิทธิ์ใช้งานโมดูล message";
        $auth->add($message_permission);

        $auth->addChild($message_permission,$message_index);
        $auth->addChild($message_permission,$message_view);
        $auth->addChild($message_permission,$message_update);
        $auth->addChild($message_permission,$message_delete);
        $auth->addChild($message_permission,$message_create);


        $manage_message = $auth->createRole('Manage message');
        $manage_message->description = "Manage message";
        $auth->add($manage_message);
        $auth->addChild($manage_message,$message_permission);

        // delivery

        $delivertype_index = $auth->createPermission('delivertype/index');
        $auth->add($delivertype_index);
        $delivertype_update = $auth->createPermission('delivertype/update');
        $auth->add($delivertype_update);
        $delivertype_delete = $auth->createPermission('delivertype/delete');
        $auth->add($delivertype_delete);
        $delivertype_view = $auth->createPermission('delivertype/view');
        $auth->add($delivertype_view);
        $delivertype_create = $auth->createPermission('delivertype/create');
        $auth->add($delivertype_create);


        $delivertype_permission = $auth->createPermission('delivertypemodule');
        $delivertype_permission->description = "สิทธิ์ใช้งานโมดูล delivertype";
        $auth->add($delivertype_permission);

        $auth->addChild($delivertype_permission,$delivertype_index);
        $auth->addChild($delivertype_permission,$delivertype_view);
        $auth->addChild($delivertype_permission,$delivertype_update);
        $auth->addChild($delivertype_permission,$delivertype_delete);
        $auth->addChild($delivertype_permission,$delivertype_create);


        $manage_delivertype = $auth->createRole('Manage delivertype');
        $manage_delivertype->description = "Manage delivertype";
        $auth->add($manage_delivertype);
        $auth->addChild($manage_delivertype,$delivertype_permission);




        $admin_role = $auth->createRole('System Administrator');
        $admin_role->description = "ผู้ดูแลระบบ";
        $auth->add($admin_role);

        $auth->addChild($admin_role,$manage_user);
        $auth->addChild($admin_role,$manage_usergroup);
        //$auth->addChild($admin_role,$manage_order);



        $user_role = $auth->createRole('System User');
        $user_role->description = "ผู้ใช้งานทั่วไป";
        $auth->add($user_role);


        $auth->addChild($user_role,$manage_order);
        $auth->addChild($user_role,$manage_message);
        $auth->addChild($user_role,$manage_delivertype);

        $auth->addChild($admin_role,$user_role);




        $auth->assign($admin_role,2);
       // $auth->assign($user_role,2);






    }
}
/*
 *
 public function init()
    {
      $auth = Yii::$app->authManager;
      $auth->removeAll();
      Console::output('Removing All! RBAC.....');

      $createPost = $auth->createPermission('createBlog');
      $createPost->description = 'สร้าง blog';
      $auth->add($createPost);

      $updatePost = $auth->createPermission('updateBlog');
      $updatePost->description = 'แก้ไข blog';
      $auth->add($updatePost);

      // เพิ่ม permission loginToBackend <<<------------------------
      $loginToBackend = $auth->createPermission('loginToBackend');
      $loginToBackend->description = 'ล็อกอินเข้าใช้งานส่วน backend';
      $auth->add($loginToBackend);

      $manageUser = $auth->createRole('ManageUser');
      $manageUser->description = 'จัดการข้อมูลผู้ใช้งาน';
      $auth->add($manageUser);

      $author = $auth->createRole('Author');
      $author->description = 'การเขียนบทความ';
      $auth->add($author);

      $management = $auth->createRole('Management');
      $management->description = 'จัดการข้อมูลผู้ใช้งานและบทความ';
      $auth->add($management);

      $admin = $auth->createRole('Admin');
      $admin->description = 'สำหรับการดูแลระบบ';
      $auth->add($admin);

      $rule = new \common\rbac\AuthorRule;
      $auth->add($rule);

      $updateOwnPost = $auth->createPermission('updateOwnPost');
      $updateOwnPost->description = 'แก้ไขบทความตัวเอง';
      $updateOwnPost->ruleName = $rule->name;
      $auth->add($updateOwnPost);

      $auth->addChild($author,$createPost);
      $auth->addChild($updateOwnPost, $updatePost);
      $auth->addChild($author, $updateOwnPost);

      // addChild role ManageUser <<<------------------------
      $auth->addChild($manageUser, $loginToBackend);

      $auth->addChild($management, $manageUser);
      $auth->addChild($management, $author);

      $auth->addChild($admin, $management);

      $auth->assign($admin, 1);
      $auth->assign($management, 2);
      $auth->assign($author, 3);
      $auth->assign($author, 4);

      Console::output('Success! RBAC roles has been added.');
    } */
