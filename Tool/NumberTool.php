<?php


namespace Tool;


class NumberTool
{
    /**
     * 价格格式化
     *
     * @param $num
     * @param int $precision
     * @return float|int
     */
    public static function priceFormat($num, $precision = 2)
    {
        $pow = pow(10, $precision);
        if ((floor($num * $pow * 10) % 5 == 0) && (floor($num * $pow * 10) == $num * $pow * 10) && (floor($num * $pow) % 2 == 0)) {//舍去位为5 && 舍去位后无数字 && 舍去位前一位是偶数    =》 不进一
            return floor($num * $pow) / $pow;
        } else {//四舍五入
            return round($num, $precision);
        }
    }
}