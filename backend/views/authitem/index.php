<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use lavrentiev\widgets\toastr\Notification;
use backend\assets\ICheckAsset;

ICheckAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthitemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'สิทธิ์ใช้งาน');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
    '@web/js/stockbalancejs.js?V=001',
    ['depends' => [\yii\web\JqueryAsset::className()]],
    static::POS_END
);


?>
<div class="authitem-index">

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
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="panel panel-headline">
        <div class="panel-heading">
            <div class="btn-group">
                <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> สร้าง Authitem'), ['create'], ['class' => 'btn btn-success']) ?>
            </div>

            <h4 class="pull-right"><?=$this->title?> <i class="fa fa-institution"></i><small></small></h4>
            <!-- <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Settings 1</a>
                  </li>
                  <li><a href="#">Settings 2</a>
                  </li>
                </ul>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul> -->
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-9">
                    <div class="form-inline">
                        <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="pull-right">
                        <form id="form-perpage" class="form-inline" action="<?=Url::to(['authitem/index'],true)?>" method="post">
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
            <div class="table-responsive">
                <div class="table-grid">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    // 'filterModel' => $searchModel,
                    'emptyCell'=>'-',
                    'layout'=>'{items}{summary}{pager}',
                    'summary' => "แสดง {begin} - {end} ของทั้งหมด {totalCount} รายการ",
                    'showOnEmpty'=>false,
                    'tableOptions' => ['class' => 'table table-hover'],
                    'emptyText' => '<br/><div style="color: red;align: center;"> <b>ไม่พบรายการไดๆ</b></div>',
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn','contentOptions' => ['style' => 'vertical-align: middle']],
                      //  ['class' => 'yii\grid\CheckboxColumn','headerOptions' => ['style' => 'text-align: center'],'contentOptions' => ['style' => 'vertical-align: middle;text-align: center;']],
                        // 'id',
                        [
                            'attribute'=>'name',
                            'contentOptions' => ['style' => 'vertical-align: middle'],
                        ],
                        [
                            'attribute'=>'description',
                            'contentOptions' => ['style' => 'vertical-align: middle'],
                        ],
                        [
                            'attribute'=>'rule_name',
                            'contentOptions' => ['style' => 'vertical-align: middle'],
                        ],
                        [
                            'attribute'=>'type',
                            'format' => 'html',
                            'contentOptions' => ['style' => 'vertical-align: middle'],
                            'value' => function($data){
                              if($data->type ==1){
                                  return "<i class='fa fa-lock text-primary'></i>"." role";
                              }else{
                                  return "<i class='fa fa-bolt text-warning'></i>"." permission";
                              }
                            }
                        ],

                        [

                            'header' => '',
                            'headerOptions' => ['style' => 'text-align:center;','class' => 'activity-view-link',],
                            'class' => 'yii\grid\ActionColumn',
                            'contentOptions' => ['style' => 'text-align: right'],
                            'template' => '{view}{update}{delete}{child}{priv}',
                            'buttons' => [
                                'view' => function($url, $data, $index) {
                                    $options = [
                                        'title' => Yii::t('yii', 'View'),
                                        'aria-label' => Yii::t('yii', 'View'),
                                        'data-pjax' => '0',
                                    ];
                                    return Html::a(
                                        '<span class="fa fa-eye btn btn-xs btn-default"></span>', $url, $options);
                                },
                                'update' => function($url, $data, $index) {
                                    $options = array_merge([
                                        'title' => Yii::t('yii', 'Update'),
                                        'aria-label' => Yii::t('yii', 'Update'),
                                        'data-pjax' => '0',
                                        'id'=>'modaledit',
                                    ]);
                                    return  Html::a(
                                        '<span class="fa fa-pencil btn btn-xs btn-default"></span>', $url, [
                                        'id' => 'activity-view-link',
                                        //'data-toggle' => 'modal',
                                        // 'data-target' => '#modal',
                                        'data-id' => $index,
                                        'data-pjax' => '0',
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
                                    return Html::a('<span class="fa fa-trash btn btn-xs btn-default"></span>', 'javascript:void(0)', $options);
                                },

                            ]
                        ],
],
                ]); ?>
                </div>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
<?php

$this->registerJsFile( '@web/js/sweetalert.min.js',['depends' => [\yii\web\JqueryAsset::className()]],static::POS_END);
$this->registerCssFile( '@web/css/sweetalert.css');

$url_to_delete =  Url::to(['product/bulkdelete'],true);
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