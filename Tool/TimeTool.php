<?php


namespace Tool;


class TimeTool
{

    /**
     * 当前时间
     *
     * @return int
     */
    public static function now()
    {
        return time();
    }

    /**
     * 毫秒数
     *
     * @param bool $isFloat
     * @return mixed
     */
    public static function micro($isFloat = true)
    {
        return microtime($isFloat);
    }

    /**
     * 时间格式化
     *
     * @param int $time
     * @param string $format
     * @param int $now
     * @return false|string
     */
    public static function format($time = 0, $format = 'Y-m-d H:i:s', $now = 0)
    {
        if (is_numeric($time)) {
            $time || $time = self::now();
        } else {
            if (is_numeric($now)) {
                $now || $now = self::now();
            } else {
                $now = self::totime($now);
            }
            $time = self::totime($time, $now);
        }
        return date($format, $time);
    }

    /**
     * 获取大写的星期
     *
     * @param int $time
     * @param string $pre
     * @return string
     */
    public static function week($time = 0, $pre = "周")
    {
        if ($time == 0) {
            $time = self::now();
        }
        $ga = date("w", $time);
        switch ($ga) {
            case 1:
                $return = "一";
                break;
            case 2:
                $return = "二";
                break;
            case 3:
                $return = "三";
                break;
            case 4:
                $return = "四";
                break;
            case 5:
                $return = "五";
                break;
            case 6:
                $return = "六";
                break;
            case 0:
                $return = "日";
                break;
            default:
                return "";
        };
        return $pre . $return;
    }

    /**
     * 字符串转化为时间
     *
     * @param $time
     * @param int $now
     * @return false|int
     */
    public static function totime($time, $now = 0)
    {
        if (is_numeric($time)) {
            return (int)$time;
        }
        if (is_numeric($now)) {
            $now || $now = self::now();
        } else {
            $now = strtotime($now, self::now());
        }
        return strtotime($time, $now);
    }

    /**
     * 每天的开始时间
     *
     * @param int $time
     * @return false|int
     */
    public static function dayStartTime($time = 0)
    {
        if (!$time) {
            $time = self::now();
        }
        return self::totime(self::format($time, 'Y-m-d') . ' 0:0:0');
    }

    /**
     * 时间的结束时间
     *
     * @param int $time
     * @return false|int
     */
    public static function dayEndTime($time = 0)
    {
        if (!$time) {
            $time = self::now();
        }
        return self::totime(self::format($time, 'Y-m-d') . ' 23:59:59');
    }

    /**
     * 获得当前时间的毫秒数
     *
     * @return float
     */
    public static function getMicrotime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
}