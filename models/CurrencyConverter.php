<?php
require_once ('CurrencyWebservice.php');

class CurrencyConverter
{

    protected $enabledCurrencies = array('GBP', 'EUR', 'USD');

    /**
     * Convert currency to GBP
     * @param string $currency Currency
     * @param $amount
     * @return float
     * @throws Exception
     */
    public function convert($currency, $amount)
    {
        if (!is_string($currency)) {
            throw new \InvalidArgumentException('Currency must be string');
        }

        if (!in_array($currency, $this->enabledCurrencies)) {
            throw new \Exception('Currency is not supported');
        }

        $webservice = new CurrencyWebservice();
        $rating = $webservice->getExchangeRate($currency);

        return (float) $amount * $rating;
    }

    /**
     * Get Enabled Currencies
     * @return array
     */
    public function getEnabledCurrencies()
    {
        if (!is_array($this->enabledCurrencies)) {
            throw new \InvalidArgumentException('Enabled currencies must be an array');
        }

        return $this->enabledCurrencies;
    }

    /**
     * Set Enabled Currencies
     * @param array $enabledCurrencies
     * @return $this
     */
    public function setEnabledCurrencies(array $enabledCurrencies)
    {
        $this->enabledCurrencies = $enabledCurrencies;
        return $this;
    }

}
