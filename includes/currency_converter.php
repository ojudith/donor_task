<?php

class CurrencyConverter{

    static function convert_to_dollar($payment_method,$amount,$btc_rate,$euro_rate){
        switch($payment_method){
            case 'euro':
                return $amount * $euro_rate;
                break;
            case 'bitcoin':
                return $amount * $btc_rate;
                break;
            default:
                return $amount;
        }
    }

    static function convert_from_dollar($payment_method,$amount,$btc_rate,$euro_rate){
        switch($payment_method){
            case 'euro':
                return number_format($amount / $euro_rate);
                break;
            case 'bitcoin':
                return  sprintf('%.8f', floatval($amount / $btc_rate));
                break;
            default:
                return $amount;
        }
    }

}
