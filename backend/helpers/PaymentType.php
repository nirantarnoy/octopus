<?php

namespace backend\helpers;

class PaymentType
{
    const TYPE_1 = 1;
    const TYPE_2 = 2;
    const TYPE_3 = 3;
    const TYPE_4 = 4;

    private static $data = [
        1 => 'จ่ายเงินปลายทาง',
        2 => 'จ่ายหน้างาน'
    ];

    private static $dataobj = [
        ['id'=>1,'name' => 'จ่ายเงินปลายทาง'],
        ['id'=>2,'name' => 'จ่ายหน้างาน'],
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
