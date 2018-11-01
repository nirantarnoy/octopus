<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use lavrentiev\widgets\toastr\Notification;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ใบสั่งผลิต');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $session = Yii::$app->session;
if ($session->getFlash('msg')): ?>
    <!-- <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php //echo $session->getFlash('msg'); ?>
      </div> -->
    <?php echo Notification::widget([
        'type' => 'success',
        'title' => 'แจ้งผลการทำงาน',
        'message' => $session->getFlash('msg'),
        //  'message' => 'Hello',
        'options' => [
            "closeButton" => false,
            "debug" => false,
            "newestOnTop" => false,
            "progressBar" => false,
            "positionClass" => "toast-top-center",
            "preventDuplicates" => false,
            "onclick" => null,
            "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "6000",
            "extendedTimeOut" => "1000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut"
        ]
    ]); ?>
<?php endif; ?>
<div class="order-index">
    <div class="x_panel">
        <div class="x_title">
            <div class="row">
                <div class="col-lg-9">
                    <h3><i class="fa fa-shopping-cart"></i> <?=$this->title?> <small></small></h3>
                </div>
                <div class="col-lg-3">
                    <div class="pull-right">

                        <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> สร้างใบสั่งผลิต'), ['create'], ['class' => 'btn btn-success']) ?>

                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <div class="row">
                <div class="col-lg-9">
                    <div class="form-inline">
                        <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="pull-right">
                        <form id="form-perpage" class="form-inline" action="<?=Url::to(['delivertype/index'],true)?>" method="post">
                            <div class="form-group">
                                <label>แสดง </label>
                                <select class="form-control" name="perpage" id="perpage">
                                    <option value="20" <?=$perpage=='20'?'selected':''?>>20</option>
                                    <option value="50" <?=$perpage=='50'?'selected':''?> >50</option>
                                    <option value="100" <?=$perpage=='100'?'selected':''?>>100</option>
                                </select>
                                <label> รายการ</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyCell'=>'-',
        'layout'=>'{items}{summary}{pager}',
        'summary' => "แสดง {begin} - {end} ของทั้งหมด {totalCount} รายการ",
        'showOnEmpty'=>true,
        'tableOptions' => ['class' => 'table table-hover'],
        'emptyText' => '<br/><div style="color: red;align: center;"> <b>ไม่พบรายการไดๆ</b></div>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'order_no',
            [
                'attribute' => 'order_type',
                'value'=>function($data){
                   return \backend\helpers\OrderType::getTypeById($data->order_type);
                },
                'filter'=>ArrayHelper::map(\backend\helpers\OrderType::asArrayObject(), 'id', 'name'),
            ],
            'order_admin',

            'customer_name',
            [
               'attribute' => 'created_at',
               'value' => function($data){
                  return date('d-m-Y',$data->created_at);
               }
            ],
            [
                'attribute' => 'order_status',
                'value'=>function($data){
                    return $data->order_status;
                },
                'filter'=>ArrayHelper::map(\backend\helpers\PaymentStatus::asArrayObject(), 'id', 'name'),
            ],
            //'customer_type',
            //'contact_name',
            //'contact_info',
            //'payment_type',
            //'delivery_type',
            //'delivery_name',
            //'order_status',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'options'=>['style'=>'width:120px;'],
                    'buttonOptions'=>['class'=>'btn btn-default'],
                    'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view} {update} {delete} </div>',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
