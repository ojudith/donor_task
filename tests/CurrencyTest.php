<?php
use PHPUnit\Framework\TestCase;

require_once "includes/currency_converter.php";

class CurrencyTest extends TestCase
{

    /**
     *  Donors test to check insert and retrieve to the database
     */
    public function test_euro_conversion()
    {
        $payment_method = "euro";
        $amount = 30;
        $euro_rate = 4.55;
        $expected = $amount * $euro_rate;
        $converted_amount = CurrencyConverter::convert_to_dollar($payment_method,$amount,null, $euro_rate);
        $this->assertEquals($expected,$converted_amount);
    }

    public function test_btc_conversion()
    {
        $payment_method = "bitcoin";
        $amount = 0.00230232;
        $btc_rate = 60701.90;
        $expected = $amount * $btc_rate;
        $converted_amount = CurrencyConverter::convert_to_dollar($payment_method,$amount,$btc_rate, null);
        $this->assertEquals($expected,$converted_amount);
    }

    public function test_btc_reconversion()
    {
        $payment_method = "bitcoin";
        $amount = 0.00230232;
        $btc_rate = 60701.90;
        $expected = sprintf('%.8f', floatval($amount / $btc_rate));
        $converted_amount = CurrencyConverter::convert_from_dollar($payment_method,$amount,$btc_rate, null);
        $this->assertEquals($expected,$converted_amount);
    }

    public function test_euro_reconversion()
    {
        $payment_method = "euro";
        $amount = 30;
        $euro_rate = 4.55;
        $expected = number_format($amount / $euro_rate);
        $converted_amount = CurrencyConverter::convert_from_dollar($payment_method,$amount,null, $euro_rate);
        $this->assertEquals($expected,$converted_amount);
    }

}
