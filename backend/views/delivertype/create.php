<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Delivertype */

$this->title = Yii::t('app', 'สร้างประเภทจัดส่ง');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ประเภทการจัดส่ง'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="delivertype-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
