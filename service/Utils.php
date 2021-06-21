<?php

/**
 * Class Utils
 */
class Utils
{
    /**
     * @param $amount
     * @return string
     */
    public static function numberFormatMoney($amount) {
        return number_format($amount, 2, ',', ' ');
    }

    /**
     * @param $number
     * @return string
     */
    public static function numberFormatPercent($number) {
        return number_format($number, 2, '.', ' ');
    }
}