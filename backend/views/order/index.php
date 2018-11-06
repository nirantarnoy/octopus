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
                        <form id="form-perpage" class="form-inline" action="<?=Url::to(['order/index'],true)?>" method="post">
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
                'format' => 'raw',
                'value'=>function($data){
                    return "<div class='label label-warning'>".\backend\helpers\Orderstatus::getTypeById($data->order_status)."</div>";

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

//            [
//                    'class' => 'yii\grid\ActionColumn',
//                    'options'=>['style'=>'width:120px;'],
//                    'buttonOptions'=>['class'=>'btn btn-default'],
//                    'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view} {print} {update} {delete} </div>',
//            ],
            [

                'header' => '',
                'headerOptions' => ['style' => 'text-align:center;','class' => 'activity-view-link',],
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'text-align: right','vertical-align: middle'],
                'template'=>'<div class="btn-group btn-group-lg text-center" role="group"> {view} {print} {update} {delete} </div>',
                'buttons' => [
                    'view' => function($url, $data, $index) {
                        $options = [
                            'title' => Yii::t('yii', 'View'),
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                        ];
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open btn btn-xs btn-default"></span>', $url, $options);
                    },
                    'print' => function($url, $data, $index) {
                        $options = [
                            'title' => Yii::t('yii', 'Print'),
                            'aria-label' => Yii::t('yii', 'Print'),
                            'data-pjax' => '0',
                        ];
                        return Html::a(
                            '<span class="glyphicon glyphicon-print btn btn-xs btn-default"></span>', $url, $options);
                    },
                    'update' => function($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'id'=>'modaledit',
                        ]);
                        return $data->order_status == 1? Html::a(
                            '<span class="glyphicon glyphicon-pencil btn btn-xs btn-default"></span>', $url, [
                            'id' => 'activity-view-link',
                            //'data-toggle' => 'modal',
                            // 'data-target' => '#modal',
                            'data-id' => $index,
                            'data-pjax' => '0',
                            // 'style'=>['float'=>'rigth'],
                        ]):'';
                    },
                    'delete' => function($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            //'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            //'data-method' => 'post',
                            //'data-pjax' => '0',
                            'data-url'=>$url,
                            'onclick'=>'recDelete($(this));'
                        ]);
                        return Html::a('<span class="glyphicon glyphicon-trash btn btn-xs btn-default"></span>', 'javascript:void(0)', $options);
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
<?php
$this->registerJsFile( '@web/js/sweetalert.min.js',['depends' => [\yii\web\JqueryAsset::className()]],static::POS_END);
$this->registerCssFile( '@web/css/sweetalert.css');
//$url_to_delete =  Url::to(['product/bulkdelete'],true);
$this->registerJs('
    $(function(){
        $("#perpage").change(function(){
            $("#form-perpage").submit();
        });
    });

   function recDelete(e){
        //e.preventDefault();
        var url = e.attr("data-url");
        swal({
              title: "ต้องการลบรายการนี้ใช่หรือไม่",
              text: "",
              type: "error",
              showCancelButton: true,
              closeOnConfirm: false,
              showLoaderOnConfirm: true
            }, function () {
              e.attr("href",url); 
              e.trigger("click");        
        });
    }

    ',static::POS_END);
?>
