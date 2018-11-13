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
            [
                'attribute' => 'order_admin',
                'value'=>function($data){
                   return \backend\models\User::findName($data->order_admin);
                }
            ],
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
                    return "<div class='label label-warning'>".\backend\helpers\Orderstatus::getTypeById($data->order_status,$data->order_type)."</div>";

                },
                'filter'=>ArrayHelper::map(\backend\helpers\Orderstatus::asArrayObject(1), 'id', 'name'),
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
                'template'=>'<div class="btn-group btn-group-lg text-center" role="group"> {view} {print} {updatestatus} {update} {delete} </div>',
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
                            'data-url' => $url,
                            'onclick'=>'
                                showprint($(this));
                            '
                        ];
                        return Html::a(
                            '<span class="glyphicon glyphicon-print btn btn-xs btn-default"></span>', 'javascript:void(0)', $options);
                    },
                    'update' => function($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'id'=>'modaledit',
                        ]);
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil btn btn-xs btn-default"></span>', $url, [
                            'id' => 'activity-view-link',
                            //'data-toggle' => 'modal',
                            // 'data-target' => '#modal',
                            'data-id' => $index,
                            'data-pjax' => '0',
                            // 'style'=>['float'=>'rigth'],
                        ]);
                    },
                    'updatestatus' => function($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Update Status'),
                            'aria-label' => Yii::t('yii', 'Update Status'),
                            'data-pjax' => '0',
                            'id'=>'update_order_status',
                        ]);
                        return Html::a(
                            '<span class="glyphicon glyphicon-cog btn btn-xs btn-default"></span>', 'javascript:void(0)', [
                            'id' => 'activity-view-link',
                            //'data-toggle' => 'modal',
                            // 'data-target' => '#modal',
                            'data-id' => $index,
                            'data-pjax' => '0',
                            'onclick'=>'
                                showstatus($(this));
                            '
                            // 'style'=>['float'=>'rigth'],
                        ]);
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
<div id="printModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-print"></i> พิมพ์ใบเสร็จ <small id="items"> </small></h4>
            </div>
            <div class="modal-body">
                <form id="form-modal-bill" action="<?=Url::to(['order/print'],true)?>" method="post" target="_blank">
                    <br>
                    <input type="hidden" name="id" value="" class="order_line_id">
                    <div class="row">
                        <div class="col-lg-12">
                            ขนาดกระดาษที่ต้องการ
                            <select name="paper_size" id="paper-size">
                                <option value="1">A4</option>
                                <option value="2">A5</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-print-bill">พิมพ์</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>

    </div>
</div>
<div id="statusModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-primary"><i class="fa fa-bolt"></i> เปลี่ยนสถานะใบสั่งผลิต <small id="items"> </small></h4>
            </div>
            <div class="modal-body">
                <form id="form-status" action="<?=Url::to(['order/updatestatus'],true)?>" method="post" >
                    <br>
                    <input type="hidden" name="id" value="" class="order_line_id">
                    <div class="row">
                        <div class="col-lg-12">
                            สถานะ
                            <select name="status1" id="order-status1" class="form-control" style="display: none;">

                                <?php
                                $status = \backend\helpers\Orderstatus::asArrayObject(1);
                                for($i=0;$i<=count($status)-1;$i++): ?>
                                <option value="<?=$status[$i]['id']?>"><?=$status[$i]['name']?></option>
                                <?php endfor;?>
                            </select>
                            <select name="status2" id="order-status2" class="form-control" style="display: none;">

                                <?php
                                $status = \backend\helpers\Orderstatus::asArrayObject(2);
                                for($i=0;$i<=count($status)-1;$i++): ?>
                                    <option value="<?=$status[$i]['id']?>"><?=$status[$i]['name']?></option>
                                <?php endfor;?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-change-status">ตกลง</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
        </div>

    </div>
</div>
<?php
$this->registerJsFile( '@web/js/sweetalert.min.js',['depends' => [\yii\web\JqueryAsset::className()]],static::POS_END);
$this->registerCssFile( '@web/css/sweetalert.css');
//$url_to_delete =  Url::to(['product/bulkdelete'],true);
$url_to_find_type = Url::to(['order/findtype'],true);
$this->registerJs('
    $(function(){
        $("#perpage").change(function(){
            $("#form-perpage").submit();
        });
         $(".btn-print-bill").click(function(){
            $("#form-modal-bill").submit();
            $("#printModal").modal("hide");
      
        });
        $(".btn-change-status").click(function(){
            $("#form-status").submit();
            $("#statusModal").modal("hide");
      
        });
    });
   function showprint(e){
     var ids = e.parents("tr").data("key");
     $("#printModal").modal("show").find(".order_line_id").val(ids);
   }
   function showstatus(e){
     var ids = e.parents("tr").data("key");
     $("#statusModal").modal("show").find(".order_line_id").val(ids);
     
     $.ajax({
         type: "post",
         dataType: "html",
         url:"'.$url_to_find_type.'",
         data: {"id": ids},
         success: function(data){
            if(data == 1){
              $("#order-status1").show();
              $("#order-status2").hide();
            }else{
              $("#order-status2").show();
              $("#order-status1").hide();
            }
         }
         
     });
     
   }
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
