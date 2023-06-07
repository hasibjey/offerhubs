<?php

namespace App\Helpers;

use App\Models\Navigation;
use Illuminate\Support\Str;

class Custom
{
    /**
     * make totally unique slug
     *
     * @return void
     */
    public static function SLUG()
    {
        $slug = '_' . Str::random(5);
        return $slug;
    }

    /**
     * this function user for pagination number select field
     *
     * @param [type] $items
     * @param [type] $pagination
     * @return void
     */
    public static function  PAGINATION_COUNTER($items, $pagination)
    {
        return view('admin.layouts.pagination_counter', compact('items', 'pagination'));
    }

    /**
     * find price in unite_price, discount or bulk discount
     */
    public static function PRICE($unite_price, $discount_type, $discount, $bulk_discount_type, $bulk_discount)
    {
        $calculate_discount = null;
        $calculate_bulk_discount = null;
        $price = null;

        if (!empty($discount)) {
            if ($discount_type == 'flat')
                $calculate_discount = $discount;
            else
                $calculate_discount = ($unite_price * $discount) / 100;
        }

        if (!empty($bulk_discount)) {
            if ($bulk_discount_type == 'flat')
                $calculate_bulk_discount = $bulk_discount;
            else
                $calculate_bulk_discount = ($bulk_discount * $discount) / 100;
        }

        if (!empty($bulk_discount_type)) {
            $price = (float)$unite_price - (float)$calculate_bulk_discount;
        } else if (!empty($discount)) {
            $price = (float)$unite_price - (float)$calculate_discount;
        } else {
            $price = $unite_price;
        }

        return $price;
    }

    // user current information
    public static function GET_USER_INFORMATION()
    {
        return $information = @unserialize(file_get_contents('http://ip-api.com/php/'));
    }

    // user ip
    public function GET_USER_IP()
    {
        $ip_address = '';
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED'];
        } else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (isset($_SERVER['HTTP_FORWARDED'])) {
            $ip_address = $_SERVER['HTTP_FORWARDED'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip_address = 'UNKNOWN';
        }

        return $ip_address;
    }

    /**
     * number format
     */
    public static function NUMBER_FORMAT($number)
    {
        return sprintf('TK.%s', number_format($number, 0, ','));
    }

    /**
     * currency add before amount
     */
    public static function CURRENCY($price)
    {
        return $price . " ৳";
    }

    /**
     * calculation discount amount 
     */
    public static function DISCOUNT($price, $discount_type, $discount)
    {
        if($discount_type == 'flat')
            return ($price - $discount);
        else
            return ($price - (($price * $discount) / 100));
    }


}
