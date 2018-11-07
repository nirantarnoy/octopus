<?php
/**
 * Created by PhpStorm.
 * User: niran.w
 * Date: 06/11/2018
 * Time: 09:33:20
 */
?>
<table class="table">
    <tr>
        <td><h3>ประเภทงาน : <small><?=\backend\helpers\OrderType::getTypeById($model->order_type)?></small></h3></td>
        <td></td>
    </tr>
    <tr>
        <td><h3>เลขที่ JOB : <small><?=$model->order_no?></small></h3></td>
        <td></td>
    </tr>
    <tr>
        <td><h3>ชื่อผู้ติดต่อ : <small><?=$model->contact_name?></small></h3></td>
        <td></td>
    </tr>
    <tr>
        <td><h3>เบอร์โทรติดต่อ : <small><?=$model->order_no?></small></h3></td>
        <td></td>
    </tr>
    <tr>
        <td><h3>วิธีจัดส่ง : <small><?=\backend\models\Delivertype::findName($model->delivery_type)?></small></h3></td>
        <td></td>
    </tr>
    <tr>
        <td><h3>วิธีชำระ : <small><?=$model->payment_type?></small></h3></td>
        <td></td>
    </tr>
    <tr>
        <td><h3>ผู้ดูแล : <small><?=$model->order_admin?></small></h3></td>
        <td></td>
    </tr>
</table>

