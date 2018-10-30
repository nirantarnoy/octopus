<?php

namespace backend\helpers;

class CustomerType
{
    const TYPE_1 = 1;
    const TYPE_2 = 2;

    private static $data = [
        1 => 'บุคคลทั่วไป',
        2 => 'ห้าง/ร้าน'
    ];

    private static $dataobj = [
        ['id'=>1,'name' => 'บุคคลทั่วไป'],
        ['id'=>2,'name' => 'ห้าง/ร้าน'],
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
