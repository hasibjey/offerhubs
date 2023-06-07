<?php

namespace App\Helpers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Company;

class Cart extends Controller
{
    public static function ADD($id, $name, $quantity, $price, $image, $slug)
    {
        $data['pro_id'] = $id;
        $data['name'] = $name;
        $data['slug'] = $slug;
        $data['quantity'] = $quantity;
        $data['price'] = $price;
        $subPrice = $price * $quantity;
        $data['subPrice'] = $subPrice;
        $data['image'] = $image;

        // calculate subtotal
        if (!session()->has('cart.subTotal')) {
            session()->put('cart.subTotal', $subPrice);
        } else {
            $subTotal = session()->get('cart.subTotal');
            $total = $subTotal + $subPrice;
            session()->put('cart.subTotal', $total);
        }

        // get discount
        $discount = 0;
        if(session()->has('cart.discount'))
        {
            $discount = session()->get('cart.discount');
        }

        // set tax
        $tax = Company::first()->tax;
        if(!session()->has('cart.tax'))
        {
            if($tax != 0)
            {
                session()->put('cart.tax', $tax);
            }
        }
        else
            session()->put('cart.tax', 0);

        // set discount
        if (!session()->has('cart.discount'))
        {
            session()->put('cart.discount', 0);
        }

        //total price
        session()->put('cart.total', session()->get('cart.subTotal'));


        session()->push('cart.items', $data);
    }

    // get sub total amount
    public static function SUBTOTAL()
    {
        return session()->get('cart.subTotal');
    }
    // SET sub total amount
    public static function SET_SUBTOTAL($total)
    {
        session()->put('cart.subTotal', $total);
    }

    // get total amount
    public static function TOTAL()
    {
        return session()->get('cart.total');
    }
    // set total amount
    public static function SET_TOTAL($total)
    {
        session()->put('cart.total', $total);
    }

    // get discount amount
    public static function GET_DISCOUNT()
    {
        $discount = 0;
        if(session()->has('cart')) {
            if (session()->has('cart.coupon_amount')) {
                if (session()->get('cart.coupon_type') == 'flat') {
                    $discount = $discount + session()->get('cart.coupon_amount');
                } else {
                    $amount = (session()->get('cart.subTotal') * session()->get('cart.coupon_amount')) / 100;
                    $discount = $discount + $amount;
                }
            }
            session()->put('cart.discount', $discount);
        }
        return session()->get('cart.discount');
    }

    // set discount amount
    public static function SET_DISCOUNT($discount)
    {
        if (session()->has('cart.coupon_amount')) {
            if (session()->get('cart.coupon_type') == 'flat') {
                $discount = $discount + session()->get('cart.coupon_amount');
            } else {
                $amount = (session()->get('cart.subTotal') * session()->get('cart.coupon_amount')) / 100;
                $discount = $discount + $amount;
            }
        }
        session()->put('cart.discount', $discount);
    }

    // count cart item
    public static function COUNT()
    {
        if (session()->has('cart.items'))
            return count(session()->get('cart.items'));
        else
            return 0;
    }

    // count cart item
    public static function QUANTITY()
    {
        $qty = 0;
        if (session()->has('cart.items'))
        {
            foreach(session()->get('cart.items') as $key => $items)
            {
                $qty = intval($items['quantity']) + $qty;
            }
            return $qty;
        }
        else
            return $qty;
    }

    // get all cart items
    public static function ITEMS()
    {
        return session()->get('cart.items');
    }

    // set tax calculation
    public static function SET_TAX($amount)
    {
        return session()->put('cart.tax', $amount);
    }
    // get tax calculation
    public static function GET_TAX()
    {
        return session()->get('cart.tax');
    }

    // set shipping cost
    public static function SET_SHIPPING($cost)
    {
        session()->put('cart.shipping_cost', $cost);
    }

    // get shipping cost
    public static function GET_SHIPPING()
    {
        return session()->get('cart.shipping_cost');
    }
}
