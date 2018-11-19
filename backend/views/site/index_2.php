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
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer" onclick="findJob($(this),1)">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-list-alt"></i></div>
                <div class="count"><?=number_format(count($order_all),0)?></div>
                <h3>จำนวนใบสั่งผลิต</h3>
                <p>ใบสั่งผลิตทั้งหมด.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-question"></i></div>
                <div class="count"><?=number_format(count($order_process),0)?></div>
                <h3>รอคอนเฟิร์ม</h3>
                <p>รอคอนเฟิร์ม.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-question-circle-o"></i></div>
                <div class="count"><?=number_format(count($order_will_complete),0)?></div>
                <h3>คอนเฟิร์ม (ค้างชำระ)</h3>
                <p>คอนเฟิร์ม (ค้างชำระ).</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-crosshairs"></i></div>
                <div class="count"><?=number_format(count($order_late),0)?></div>
                <h3>คอนเฟิร์ม (ชำระบางส่วน)</h3>
                <p>คอนเฟิร์ม (ชำระบางส่วน).</p>
            </div>
        </div>
    </div>
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer" onclick="findJob($(this),1)">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-circle-o"></i></div>
                <div class="count"><?=number_format(count($order_all),0)?></div>
                <h3>คอนเฟิร์ม (ชำระเต็มจำนวน)</h3>
                <p>คอนเฟิร์ม (ชำระเต็มจำนวน).</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-cogs"></i></div>
                <div class="count"><?=number_format(count($order_process),0)?></div>
                <h3>จัดเตรียมงานผลิต</h3>
                <p>จัดเตรียมงานผลิต.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-clock-o"></i></div>
                <div class="count"><?=number_format(count($order_will_complete),0)?></div>
                <h3>กำลังผลิต</h3>
                <p>กำลังผลิต.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-cubes"></i></div>
                <div class="count"><?=number_format(count($order_late),0)?></div>
                <h3>ประกอบ</h3>
                <p>ประกอบ.</p>
            </div>
        </div>
    </div>
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer" onclick="findJob($(this),1)">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-edit"></i></div>
                <div class="count"><?=number_format(count($order_all),0)?></div>
                <h3>ตรวจสอบ QC</h3>
                <p>ตรวจสอบ QC.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-truck"></i></div>
                <div class="count"><?=number_format(count($order_process),0)?></div>
                <h3>กำลังเตรียมจัดส่ง</h3>
                <p>กำลังเตรียมจัดส่ง.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-arrow-circle-o-right"></i></div>
                <div class="count"><?=number_format(count($order_will_complete),0)?></div>
                <h3>จัดส่งเรียบร้อยแล้ว</h3>
                <p>จัดส่งเรียบร้อยแล้ว.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12" style="cursor: pointer">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-gift"></i></div>
                <div class="count"><?=number_format(count($order_late),0)?></div>
                <h3>ออเดอร์สำเร็จ</h3>
                <p>ออเดอร์สำเร็จ.</p>
            </div>
        </div>
    </div>
    <br>
</div>
        </div>
    </div>
    <div class="x_panel content-result" style="display: none;">
        <div class="x_content">
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-striped table-list">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>เลขที่ใบสั่งผลิต</th>
                            <th>ประเภท</th>
                            <th>กำหนดเสร็จ</th>
                            <th>ลูกค้า</th>
                            <th>รหัสสินค้า</th>
                            <th>ผู้ดูแล</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="detailModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-list-alt text-primary"></i> รายการใบสั่งผลิต</h4>
            </div>
            <div class="modal-body">

                <table class="table table-striped table-hover table-list">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>เลขที่ใบสั่งผลิต</th>
                        <th>ประเภท</th>
                        <th>กำหนดเสร็จ</th>
                        <th>ลูกค้า</th>
                        <th>สถานะ</th>
                        <th>ผู้ดูแล</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div class="modal-error" style="display: none;">
                    <i class="fa fa-exclamation-triangle text-danger"> ไม่พบข้อมูล กรุณาลองใหม่อีกครั้ง</i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal">ปิดหน้าต่าง</button>
<!--                <button type="button" class="btn btn-success btn-ok" data-dismiss="modal">ตกลง</button>-->
            </div>
        </div>
    </div>
</div>
<?php
$url_fine_job = Url::to(['site/findjob'],true);
$js =<<<JS
  $(".date_select").change(function() {
      $("form#form_date").submit();
    });

   function findJob(e,t){
       $("#detailModal").modal("show");
       $(".content-result").show();
       if(t!=''){
           $.ajax({
              'type':'post',
              'dataType': 'json',
              'url': '$url_fine_job',
              'data': {'type': t},
              'success': function(data) {
                 if(data.length > 0){
                     var html = '';
                     for(var i=0;i<=data.length-1;i++){
                          html +="<tr><td style='vertical-align: middle;'>"+
                         (i+1) +"</td>" + "<td style='vertical-align: middle;'>"+
                         data[i]['order_no']+"</td>"+
                          "<td style='vertical-align: middle;'>"+data[i]['order_type']+"<input type='hidden' class='recid' value='"+
                         data[i]['id']+"'/></td>" +
                          "<td style='vertical-align: middle;'>"+data[i]['appoinment_date']+"</td>" +
                          "<td style='vertical-align: middle;'>"+data[i]['customer_name']+"</td>" +
                          "<td style='vertical-align: middle;'>" +data[i]['order_status']+"</td>" +
                         "<td style='vertical-align: middle;'>" +data[i]['username']+"</td></tr>"
                     }
                     $(".table-list >tbody").html(html);
                 }
              }
           });
       }
   }
JS;
$this->registerJs($js,static::POS_END);
?>
