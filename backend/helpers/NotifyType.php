<?php

namespace backend\helpers;

class NotifyType
{
    const ROLE = 1;
    const RULE = 2;
    private static $data = [
        1 => 'เตือนออเดอร์ใกล้กำหนดส่งล่วงหน้า 24 ชม.',
        2 => 'เตือนหลัง 48 ชม. หลังจัดส่งแต่ออเดอร์ยังไม่สำเร็จ',
        3 => 'จัดส่งแล้ว'
    ];

    private static $dataobj = [
        ['id'=>1,'name' => 'เตือนออเดอร์ใกล้กำหนดส่งล่วงหน้า 24 ชม.'],
        ['id'=>2,'name' => 'เตือนหลัง 48 ชม. หลังจัดส่งแต่ออเดอร์ยังไม่สำเร็จ'],
        ['id'=>3,'name' => 'จัดส่งแล้ว'],
    ];
    public static function asArray()
    {
        return self::$data;
    }
    public static function asArrayObject()
    {
        return self::$dataobj;
    }
    public static function getTypeById($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
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
