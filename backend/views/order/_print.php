<?php
/**
 * Created by PhpStorm.
 * User: niran.w
 * Date: 06/11/2018
 * Time: 09:33:20
 */

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
<table class="table">
    <tr>
        <td><h4 style="font-family: Garuda">ประเภทงาน : <small><?=\backend\helpers\OrderType::getTypeById($model->order_type)?></small></h4></td>
        <td></td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda">เลขที่ JOB : <small><?=$model->order_no?></small></h4></td>
        <td></td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda">ชื่อผู้ติดต่อ : <small><?=$model->contact_name?></small></h4></td>
        <td></td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda">เบอร์โทรติดต่อ : <small><?=$model->order_no?></small></h4></td>
        <td></td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda">วิธีจัดส่ง : <small><?=\backend\models\Delivertype::findName($model->delivery_type)?></small></h4></td>
        <td></td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda">วิธีชำระ : <small><?=$model->payment_type?></small></h4></td>
        <td></td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda">ผู้ดูแล : <small><?=\backend\models\User::findName($model->order_admin)?></small></h4></td>
        <td></td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda;">สถานะ : <small style="background-color: #bf800c;padding-left: 15px;"><?=\backend\helpers\Orderstatus::getTypeById($model->order_status,$model->order_type)?></small></h4></td>
        <td></td>
    </tr>
</table>
</body>
</html>

