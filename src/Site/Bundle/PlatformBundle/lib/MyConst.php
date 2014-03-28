<?php

namespace Site\Bundle\PlatformBundle\lib;


class MyConst
{

    const SPORTS_BASKETBALL = 'basketball';
    const SPORTS_FOOTBALL = 'football';
    const SPORTS_BADMINTON = 'badminton';
    const SPORTS_TENNIS = 'tennis';
    const SPORTS_PINGPANG = 'pingpang';
    const SPORTS_OTHER = 'other';


    // 运动项目
    public static $sportsZhArr = array(
        self::SPORTS_BASKETBALL => '篮球',
        self::SPORTS_FOOTBALL => '足球',
        self::SPORTS_BADMINTON => '羽毛球',
        self::SPORTS_TENNIS => '网球',
        self::SPORTS_PINGPANG => '乒乓球',
        self::SPORTS_OTHER => '其他',
    );

    /* const start */
    const COMPANY_TYPE_COUNTRY = 'country';
    const COMPANY_TYPE_LOCAL = 'local';
    const COMPANY_TYPE_INTERNATIONAL = 'international';
    const COMPANY_TYPE_OTHER = 'other';


    public static $companyTypeZhArr = array(
        self::COMPANY_TYPE_COUNTRY => '国家部门 | 协会',
        self::COMPANY_TYPE_LOCAL => '地方部门 | 协会',
        self::COMPANY_TYPE_INTERNATIONAL => '国际组织 | 经纪人',
        self::COMPANY_TYPE_OTHER => '其他',

    );
    /* const end */


    /*const */
    const DEPARTMENT_EVENTS = 'EVENTS';
    const DEPARTMENT_TECHNOLOGY = 'TECHNOLOGY';
    const DEPARTMENT_MARKET = 'MARKET';
    const DEPARTMENT_OTHER = 'OTHER';

    //
    public static $departmentZhArr = array(
        self::DEPARTMENT_EVENTS => '赛事中心',
        self::DEPARTMENT_TECHNOLOGY => '技术中心',
        self::DEPARTMENT_MARKET => '营销中心',
        self::DEPARTMENT_OTHER => '其他',

    );

    public static $officeLocationZhArr = array(
        'shanghai' => '上海',
        'beijing' => '北京',
        'shenzhen' => '深圳',
    );
} 