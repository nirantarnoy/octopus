<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Delivertype */

$this->title = Yii::t('app', 'แก้ไขประเภทจัดส่ง: ' . $model->name, [
    'nameAttribute' => '' . $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ประเภทการจัดส่ง'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'แก้ไข');
?>
<div class="delivertype-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
