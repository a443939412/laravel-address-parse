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
        //'driver' => 'file',
        //'model' => 'Zifan\LaravelAddressParser\Models\Area',
        //'table' => 'areas',
        //'path' => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | 省、市级地名的最大字符长度
    |--------------------------------------------------------------------------
    |
    | 默认11：黔西南布依族苗族自治州、克孜勒苏柯尔克孜自治州。
    | Mysql _>
    | SELECT * FROM `areas` where deep in (1, 2) and CHAR_LENGTH(`name`) >= 11;
    | 1) length()： 单位是字节，UTF8编码下一个汉字占三个字节，一个数字或字母占一个字节；GBK
    |    编码下一个汉字占两个字节，一个数字或字母占一个字节。
    | 2) char_length()：单位为字符，不管汉字还是数字或者是字母都算是一个字符。
    */
    'province_city_level_region_max_length' => 11,

    /*
    |--------------------------------------------------------------------------
    | 分词时指定哪些干扰词或字符串需要被过滤
    |--------------------------------------------------------------------------
    |
    | 这些干扰词或字符串将会被替换成空格后继续处理
    */
    'interference_words' => [
        '收货地址', '详细地址', '地址', '收货人', '收件人', '收货', '所在地区',
        '邮编', '电话', '手机号码', '身份证号码', '身份证号', '身份证',
        '：', ':', '；', ';', '，', ',', '。', '.'
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
    | 智能分析失败时记录“地址”，用以改进分析逻辑提升准确度
    |--------------------------------------------------------------------------
    |
    | The setting takes effect only when 'strict' is true, and the 'extra' item
    | is ignored
    |
    */
    /*'failure_log' => [
        'enable' => false (Not supported)
    ]*/

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