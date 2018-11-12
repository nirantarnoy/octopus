<?php
use kartik\daterange\DateRangePicker;
use yii\helpers\Url;

$dateval = date('d-m-Y').' ถึง '.date('d-m-Y');
if($from_date !='' && $to_date != ''){
    $dateval = $from_date.' ถึง '.$to_date;
}

$this->title = 'ภาพรวมระบบ';

?>
<div class="order-form">
    <div class="x_panel">
        <div class="x_title">
            <h3><i class="fa fa-dashboard"></i> <?=$this->title?> <small></small></h3>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
<div class="row">
    <div class="col-lg-6">
        <p class="panel-subtitle">เลือกช่วงข้อมูลที่ต้องการดูรายละเอียด</p>
        <div class="row">
            <div class="col-lg-5">
                <form id="form_date" action="<?=Url::to(['site/index'],true)?>">
                    <?php
                    echo DateRangePicker::widget([
                        'name'=>'date_select',
                        'value' => $dateval,
                        'options' => ['class'=>'date_select'],
                        'presetDropdown' => true,
                        'hideInput' => true,
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'locale'=>['format'=>'d-m-Y','separator'=>' ถึง ']
                        ]
                    ]);
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
<br />
<div class="">
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-arrow-circle-o-down"></i></div>
                <div class="count"><?=number_format(count($order_all),0)?></div>
                <h3>จำนวนใบสั่งผลิต</h3>
                <p>ใบสั่งผลิตทั้งหมด.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-arrow-circle-o-up"></i></div>
                <div class="count"><?=number_format(count($order_process),0)?></div>
                <h3>อยู่ระหว่างผลิต</h3>
                <p>งานที่กำลังดำเนินการผลิต.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-clock-o"></i></div>
                <div class="count"><?=number_format(count($order_will_complete),0)?></div>
                <h3>ออร์เดอร์ใกล้เสร็จ</h3>
                <p>ออเดอร์ใกล้ผลิตเสร็จแล้ว.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-crosshairs"></i></div>
                <div class="count"><?=number_format(count($order_late),0)?></div>
                <h3>งานส่งมอบล่าช้า</h3>
                <p>งานผลิตไม่ทันตามกำหนด.</p>
            </div>
        </div>
    </div>

</div>
        </div>
    </div>
</div>
