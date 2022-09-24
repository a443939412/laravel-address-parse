<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 校验数据的提供者
    |--------------------------------------------------------------------------
    |
    | Supported Drivers: "file", "database".
    |
    | If the driver is database, 'model' must be specified and 'table' is
    | optional(default `areas`). If it is file, 'path' is optional. When ths path
    | is not specified, the plug-in's own file will be used by default.
    |
    */
    'dataProvider' => [
        'driver' => 'database',
        'model' => 'Zifan\LaravelAddressParser\Models\Area',
        //'table' => 'areas',
        //'path' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | 是否启用关键词分割（如淘宝、京东在复制收货地址时带固定格式）拼多多不带关键字，只是格式固定
    |--------------------------------------------------------------------------
    |
    | Enable keyword segmentation.
    |
    */
    'enable_keywords_split' => false,

    /*
    |--------------------------------------------------------------------------
    | 关键词（enable_keywords_split 设为 true 时才生效）
    |--------------------------------------------------------------------------
    |
    | person: 用于匹配收货人姓名的关键字
    | mobile: 用于匹配收货人联系方式的关键字
    */
    'keywords' => [
        'person' => ['收货人', '收件人', '姓名'],
        'mobile' => ['手机号码', '手机', '联系方式', '电话号码', '电话'],
    ],

    /*
    |--------------------------------------------------------------------------
    | 分词时指定哪些干扰词或字符串需要被过滤
    |--------------------------------------------------------------------------
    |
    | 这些干扰词或字符串将会被替换成空格后继续处理，
    */
    'interference_words' => [
        //'收货地址', '详细地址', '地址', '收货人', '收件人', '收货', '所在地区',
        //'邮编', '电话', '手机号码', '身份证号码', '身份证号', '身份证',
        //'：', ':', '；', ';', '，', ',', '。', '.'
    ],

    /*
    |--------------------------------------------------------------------------
    | Additional fields are extracted
    |--------------------------------------------------------------------------
    |
    | Except for province, city, district and address, additional fields are
    | extracted.
    */
    'extra' => [
        'sub_district' => false,   // 村乡镇/街道（准确度低）
        'idn' => false,            // 身份证号
        'mobile' => false,         // 联系方式（手机号/座机号）
        'postcode' => false,       // 邮编
        'person' => false,         // 姓名（准确度低）
    ],

    /*
    |--------------------------------------------------------------------------
    | 是否对提取结果进行准确度校验
    |--------------------------------------------------------------------------
    |
    | If true, set the verification failure result to null; If false, no
    | processing will be done
    */
    'strict' => true,

    /*
    |--------------------------------------------------------------------------
    | 省级直辖市、自治区、特别行政区
    |--------------------------------------------------------------------------
    |
    | 省（二十三个）：...
    | 直辖市（四个）：北京市、天津市、上海市、重庆市四个直辖市
    | 自治区（五个）：内蒙古自治区、广西壮族自治区、西藏自治区、宁夏回族自治区、新疆维吾尔自治区
    | 特别行政区（两个）：香港、澳门
    */
    /*'province_level_region' => [
        '北京', '天津', '上海', '重庆',
        '内蒙古自治区', '广西壮族自治区', '西藏自治区', '宁夏回族自治区', '新疆维吾尔自治区',
        '香港特别行政区', '澳门特别行政区'
    ],*/
];