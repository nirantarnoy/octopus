<?php

?>

<div class="">
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-arrow-circle-o-down"></i></div>
                <div class="count">19</div>
                <h3>สินค้าค่้างรับ</h3>
                <p>ค้างรับสินค้าจากใบสั่งซื้อ.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-arrow-circle-o-up"></i></div>
                <div class="count">3</div>
                <h3>สินค้าค้างส่ง</h3>
                <p>ค้างส่งสินค้าในใบออร์เดอร์.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-clock-o"></i></div>
                <div class="count">43</div>
                <h3>ออร์เดอร์ถึง Due</h3>
                <p>ออเดอร์ถึงเวลาเรียกเก็บเงิน.</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-crosshairs"></i></div>
                <div class="count">5</div>
                <h3>สินค้าใกล้หมดอายุ</h3>
                <p>รายการสินค้าใกล้หมดอายุ หรือ หมดอายุ.</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>สรุปภาพรวมการทำรายการ <small>ประจำวัน</small></h2>
                    <div class="filter">
                        <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <div class="demo-container" style="height:280px">
                            <div id="chart_plot_02" class="demo-placeholder"></div>
                        </div>
                        <div class="tiles">
                            <div class="col-md-4 tile">
                                <span>ยอดสั่งซื้อรวม</span>
                                <h2>231,809</h2>
                                <span class="sparkline11 graph" style="height: 160px;">
                               <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                            </div>
                            <div class="col-md-4 tile">
                                <span>ยอดขายรวม</span>
                                <h2>231,809</h2>
                                <span class="sparkline22 graph" style="height: 160px;">
                                <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                            </div>
                            <div class="col-md-4 tile">
                                <span>Total Sessions</span>
                                <h2>231,809</h2>
                                <span class="sparkline11 graph" style="height: 160px;">
                                 <canvas width="200" height="60" style="display: inline-block; vertical-align: top; width: 94px; height: 30px;"></canvas>
                          </span>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div>
                            <div class="x_title">
                                <h2>สินค้าขายดี</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
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
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>







</div>