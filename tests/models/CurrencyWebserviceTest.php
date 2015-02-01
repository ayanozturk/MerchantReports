<?php
require_once('/models/CurrencyWebservice.php');

class CurrencyWebserviceTest extends PHPUnit_Framework_TestCase
{

    public function testConvertDataTypes()
    {
        $converter = new CurrencyWebservice();
        $result = $converter->getExchangeRate('GBP');
        $this->assertInternalType("float", $result);

        $result = $converter->getExchangeRate('EUR');
        $this->assertInternalType("float", $result);

        $result = $converter->getExchangeRate('USD');
        $this->assertInternalType("float", $result);

        $result = $converter->getExchangeRate('TRL');
        $this->assertInternalType("float", $result);
    }

}
