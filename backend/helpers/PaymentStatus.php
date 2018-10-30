<?php

namespace backend\helpers;

class PaymentStatus
{
    const TYPE_1 = 1;
    const TYPE_2 = 2;
    const TYPE_3 = 3;
    const TYPE_4 = 4;
    const TYPE_5 = 5;

    private static $data = [
        1 => 'ชำระแล้ว',
        2 => 'วางบิล',
        3 => 'ค้างชำระ,รอโอน',
    ];

    private static $dataobj = [
        ['id'=>1,'name' => 'ชำระแล้ว'],
        ['id'=>2,'name' => 'วางบิล'],
        ['id'=>3,'name' => 'ค้างชำระ,รอโอน'],
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
