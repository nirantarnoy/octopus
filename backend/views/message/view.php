<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Message */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php //echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>
<div class="panel panel-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
           // 'message_type',
            'title',
            [
                    'attribute'=>'detail_ext',
                    'format'=>'raw',
                    'value'=> function($data){
                       $arr = explode(':',$data->detail_ext);
                       $ti = '';
                       $body_text = '';
                       if(count($arr)){
                           for($i=0;$i<=count($arr)-1;$i++){
                               if($i==0){
                                   $ti = $arr[$i];
                               }else{
                                   $body_text.=$body_text."<div class='label label-warning'>".$arr[$i]."</div>"." ";
                               }
                           }
                       }
                        return $ti."<br />".$body_text;
                    }

            ],
//            [
//                'attribute'=>'status',
//                'contentOptions' => ['style' => 'vertical-align: middle'],
//                'format' => 'html',
//                'value'=>function($data){
//                    return $data->status === 1 ? '<div class="label label-success">Active</div>':'<div class="label label-default">Inactive</div>';
//                }
//            ],
//            'created_at',
//            'updated_at',
//            'created_by',
//            'updated_by',
        ],
    ]) ?>

</div>
</div>
