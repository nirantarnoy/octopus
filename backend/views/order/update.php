<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = Yii::t('app', 'แก้ไขใบสั่งผลิต: ' . $model->order_no, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ใบสั่งผลิต'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->order_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'แก้ไข');
?>
<div class="order-update">
    <?= $this->render('_form', [
        'model' => $model,
        'modelfile' => $modelfile,
        'modelpic' => $modelpic,
    ]) ?>

</div>
