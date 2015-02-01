<?php

/**
 * Dummy web service returning random exchange rates
 */
class CurrencyWebservice
{

    /**
     * Get Exchange Rate
     * @param string $currency
     * @return float
     */
    public function getExchangeRate($currency)
    {

        switch ($currency) {
            case 'USD':
                $rate = 1.50;
                break;
            case 'EUR';
                $rate = 1.35;
                break;
            case 'GBP';
                $rate = 1.00;
                break;
            default:
                $rate = 1.00;
                break;
        }

        return $rate;
    }
}
