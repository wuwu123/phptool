<?php


namespace Tool;


class StringTool
{
    /**
     * 获取字符串长度
     *
     * @param $value
     * @return int
     */
    public static function length($value)
    {
        return mb_strlen($value);
    }


    /**
     * 获取字符串长度，多余补充
     *
     * @param $value
     * @param int $limit
     * @param string $end
     * @return string
     */
    public static function limit($value, $limit = 100, $end = '...')
    {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }
        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
    }

    /**
     * 将字符串下划线的转化为驼峰
     *
     * @param $uncamelized_words
     * @param string $separator
     * @return string
     */
    public static function toCamelCase($uncamelized_words, $separator = '_')
    {
        $uncamelized_words = $separator . str_replace($separator, ' ', strtolower($uncamelized_words));
        return ltrim(str_replace(' ', '', ucwords($uncamelized_words)), $separator);
    }

    /**
     * 字符串转码
     *
     * @param $code
     * @param string $encode
     * @return false|string
     */
    public static function strToCode($code, $encode = 'UTF-8')
    {
        $nowEncode = mb_detect_encoding($code, ['ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5']);
        $code = iconv($nowEncode, $encode, $code);
        return $code;
    }

}