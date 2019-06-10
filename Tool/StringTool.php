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

    /**
     * 隐藏的字符在微信小程序渲染报错
     *
     * @param $val
     * @return string|string[]|null
     */
    public static function filterZp($val)
    {
        $val = preg_replace('/[\p{Zp}\p{Zl}]+/u', "", $val);
        return $val;
    }

    /**
     * 替换字符串的特殊字符
     *
     * @param $string
     * @return string|string[]|null
     */
    public static function jsonReplace($string)
    {
        $data = preg_replace(
            '/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]' .
            '|[\x00-\x7F][\x80-\xBF]+' .
            '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*' .
            '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})' .
            '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',
            '',
            $string
        );
        $data = preg_replace('/\xE0[\x80-\x9F][\x80-\xBF]' .
            '|\xED[\xA0-\xBF][\x80-\xBF]/S', '', $data);
        return $data;
    }

}