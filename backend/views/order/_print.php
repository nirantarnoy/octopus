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
<table width="100%" class="table table_bordered">
    <tr>
        <td style="width: 30%"><h4 style="font-family: Garuda">ประเภทงาน </h4></td>
        <td>
            <small><?=\backend\helpers\OrderType::getTypeById($model->order_type)?></small>
        </td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda">เลขที่ JOB  </h4></td>
        <td>
            <small><?=$model->order_no?></small>
        </td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda">ชื่อผู้ติดต่อ </h4></td>
        <td> <small><?=$model->contact_name?></small></td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda">เบอร์โทรติดต่อ </h4></td>
        <td> <small><?=$model->order_no?></small></td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda">วิธีจัดส่ง  </h4></td>
        <td><small><?=\backend\models\Delivertype::findName($model->delivery_type)?></small></td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda">วิธีชำระ </h4></td>
        <td> <small><?=$model->payment_type?></small></td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda">ผู้ดูแล </h4></td>
        <td><small><?=\backend\models\User::findName($model->order_admin)?></small></td>
    </tr>
    <tr>
        <td><h4 style="font-family: Garuda;">สถานะ </h4></td>
        <td><small style="background-color: #bf800c;padding-left: 15px;"><?=\backend\helpers\Orderstatus::getTypeById($model->order_status,$model->order_type)?></small></td>
    </tr>
</table>

<?php foreach ($modelpic as $value):?>
    <img src="<?= \yii\helpers\Url::to('@web/uploads/images/'.$value->name, true) ?>" width="100%" alt="logo" />
<?php endforeach;?>

</body>
</html>

