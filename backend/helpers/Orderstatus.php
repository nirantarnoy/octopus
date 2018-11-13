<?php

namespace backend\helpers;

class Orderstatus
{
    const STATUS_1 = 1;
    const STATUS_2 = 2;

    private static $data = [
        1 => 'รอคอนเฟิร์ม',
        2 => 'คอนเฟิร์ม (ค้างชำระ)',
        3 => 'คอนเฟิร์ม (ชำระบางส่วน)',
        4 => 'คอนเฟิร์ม (ชำระเต็มจำนวน)',
        5 => 'จัดเตรียมงานผลิต',
        6 => 'กำลังผลิต',
        7 => 'ประกอบ',
        8 => 'ตรวจสอบ QC',
        9 => 'กำลังเตรียมจัดส่ง',
        10 => 'จัดส่งเรียบร้อยแล้ว',
        11 => 'ออเดอร์สำเร็จ',
    ];
    private static $data2 = [
        12 => 'รอคอนเฟิร์ม',
        13 => 'คอนเฟิร์ม (ค้างชำระ)',
        14 => 'คอนเฟิร์ม (ชำระบางส่วน)',
        15 => 'คอนเฟิร์ม (ชำระเต็มจำนวน)',
        16 => 'กำลังผลิต',
        17 => 'ตรวจสอบ QC',
        18 => 'นัดหมายเข้าติดตั้ง (วัน/เวลา)',
        19 => 'ดำเนินการติดตั้ง',
        20 => 'ติดตั้งเรียบร้อย',
        21 => 'ออเดอร์สำเร็จ',
    ];

    private static $dataobj = [
        ['id'=>1,'name'=> 'รอคอนเฟิร์ม'],
        ['id'=>2,'name'=> 'คอนเฟิร์ม (ค้างชำระ)'],
        ['id'=>3,'name' => 'คอนเฟิร์ม (ชำระบางส่วน)'],
        ['id'=>4,'name' => 'คอนเฟิร์ม (ชำระเต็มจำนวน)'],
        ['id'=>5,'name' => 'จัดเตรียมงานผลิต'],
        ['id'=>6,'name' => 'กำลังผลิต'],
        ['id'=>7,'name' => 'ประกอบ'],
        ['id'=>8,'name' => 'ตรวจสอบ QC'],
        ['id'=>9,'name' => 'กำลังเตรียมจัดส่ง'],
        ['id'=>10,'name' => 'จัดส่งเรียบร้อยแล้ว'],
        ['id'=>11,'name' => 'ออเดอร์สำเร็จ']
    ];
    private static $dataobj2 = [
        ['id'=>12,'name'=> 'รอคอนเฟิร์ม'],
        ['id'=>13,'name'=> 'คอนเฟิร์ม (ค้างชำระ)'],
        ['id'=>14,'name' => 'คอนเฟิร์ม (ชำระบางส่วน)'],
        ['id'=>15,'name' => 'คอนเฟิร์ม (ชำระเต็มจำนวน)'],
        ['id'=>16,'name' => 'กำลังผลิต'],
        ['id'=>17,'name' => 'ตรวจสอบ QC'],
        ['id'=>18,'name' => 'นัดหมายเข้าติดตั้ง (วัน/เวลา)'],
        ['id'=>19,'name' => 'ดำเนินการติดตั้ง'],
        ['id'=>20,'name' => 'ติดตั้งเรียบร้อย'],
        ['id'=>21,'name' => 'ออเดอร์สำเร็จ'],
    ];
    public static function asArray($type)
    {
        if($type == 1){
            return self::$data;
        }else{
            return self::$data2;
        }

    }
    public static function asArrayObject($type)
    {
        if($type == 1){
            return self::$dataobj;
        }else {
            return self::$dataobj2;
        }
    }
    public static function getTypeById($idx,$type)
    {
        if($type == 1){
            if (isset(self::$data[$idx])) {
                return self::$data[$idx];
            }
        }else{
            if (isset(self::$data2[$idx])) {
                return self::$data2[$idx];
            }
        }


        return 'Unknown Type';
    }
    public static function getTypeByName($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
}
