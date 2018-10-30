<?php

namespace backend\helpers;

class OrderType
{
    const TYPE_1 = 1;
    const TYPE_2 = 2;

    private static $data = [
        1 => 'ประเภทงานผลิตจัดส่ง',
        2 => 'ประเภทงานผลิตติดตั้ง'
    ];

    private static $dataobj = [
        ['id'=>1,'name' => 'ประเภทงานผลิตจัดส่ง'],
        ['id'=>2,'name' => 'ประเภทงานผลิตติดตั้ง'],
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
