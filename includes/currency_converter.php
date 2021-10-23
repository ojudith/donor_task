<?php

class CurrencyConverter{

    /**
     * converts euro or bitcoin to dollars
     * @param $payment_method [selected payment method]
     * @param $amount [amount of payment]
     * @param $btc_rate [bitcoin rate]
     * @param $euro_rate [euro rate]
     * @return float|int
     */
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

    /**
     * converts from euro or bitcoin back to dollar
     * @param $payment_method [selected payment method]
     * @param $amount [amount of payment]
     * @param $btc_rate [bitcoin rate]
     * @param $euro_rate [euro rate]
     * @return string
     */
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
