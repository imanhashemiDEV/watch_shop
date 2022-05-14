<?php
/**
 * Created by PhpStorm.
 * User: saeed
 * Date: 3/26/18
 * Time: 4:30 PM
 */

namespace App\Helpers;


class ConverterNum
{


    public static function convert($string)
    {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];
        $num = range(0, 9);
        $convertedPersianNums = str_replace($num, $persian, $string);
        $englishNumbersOnly = str_replace($num, $arabic, $convertedPersianNums);

        return $englishNumbersOnly;
    }

    public static function trans_number($num)
    {
        $persian_num_array = [
            '0' => '۰',
            '1' => '۱',
            '2' => '۲',
            '3' => '۳',
            '4' => '۴',
            '5' => '۵',
            '6' => '۶',
            '7' => '۷',
            '8' => '۸',
            '9' => '۹',
        ];
        return strtr($num, $persian_num_array);
    }


    public static function persian2LatinDigit($string)
    {
        $persian_digits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic_digits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $english_digits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $string = str_replace($persian_digits, $english_digits, $string);
        $string = str_replace($arabic_digits, $english_digits, $string);

        return $string;
    }


}
