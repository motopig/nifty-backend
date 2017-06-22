<?php

if ( ! function_exists('this_month')) {

    /**
     * 返回本月开始和结束时间戳
     */
    function this_month()
    {
        //本月时间点
        $beginThismonth = mktime(0,0,0,date('m'),1,date('Y'));
        $endThismonth   = mktime(23,59,59,date('m'),date('t'),date('Y'));
        return  ['begin' => $beginThismonth, 'end' => $endThismonth];
    }
}


if ( ! function_exists('this_week')) {

    /**
     * 返回本周开始和结束时间戳
     */
    function this_week()
    {
        $weekDay = date('w')==0 ? 7:date('w');
        //本周时间点
        $beginThisweek  = mktime(0,0,0,date('m'),date('d')-$weekDay+1,date('Y'));
        $endThisweek    = mktime(23,59,59,date('m'),date('d')-$weekDay+7,date('Y'));
        return  ['begin' => $beginThisweek, 'end' => $endThisweek];
    }
}


if ( ! function_exists('this_day')) {

    /**
     * 返回本日开始和结束时间戳
     */
    function this_day()
    {
        //今日时间点
        $beginToday     = mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday       = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        return  ['begin' => $beginToday, 'end' => $endToday];
    }
}


if ( ! function_exists('yester_day')) {

    /**
     * 返回昨日开始和结束时间戳
     */
    function yester_day()
    {
        //昨日时间点
        $beginToday     = mktime(0,0,0,date('m'),date('d')-1,date('Y'));
        $endToday       = mktime(0,0,0,date('m'),date('d'),date('Y'))-1;
        return  ['begin' => $beginToday, 'end' => $endToday];
    }
}


if ( ! function_exists('specify_month')) {

    /**
     * 返回指定月份的开始和结束时间
     * @param $month
     * @param $year
     * @return array
     */
    function specify_month($month, $year)
    {

        //本月时间点
        $beginThismonth = mktime(0, 0, 0, $month, 1, $year);
        $endThismonth = mktime(0, 0, 0, $month+1, 1, $year)-1;
        return  ['begin' => $beginThismonth, 'end' => $endThismonth];
    }
}
