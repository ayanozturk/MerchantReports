<?php
require_once('/models/CurrencyConverter.php');

class CurrencyConverterTest extends PHPUnit_Framework_TestCase
{

    public function testConvertDataType()
    {
        $converter = new CurrencyConverter();
        $result = $converter->convert('GBP', 1);

        $this->assertInternalType("float", $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testNonStringCurrency()
    {
        $converter = new CurrencyConverter();
        $converter->convert(array('GBP'), 1);
    }

    /**
     * @expectedException Exception
     */
    public function testNonSupportedCurrency()
    {
        $converter = new CurrencyConverter();
        $converter->convert('TRL', 1);
    }

    public function testEnabledCurrencies()
    {
        $converter = new CurrencyConverter();
        $currencies = $converter->getEnabledCurrencies();

        $this->assertInternalType("array", $currencies);
    }

}

