<?php
require_once ('CurrencyConverter.php');

/**
 * Class Transaction
 */
class Transaction
{
    protected $merchantId;
    protected $date;
    protected $currency;
    protected $value;

    /**
     * Get Merchant Id
     * @return int
     */
    public function getMerchantId()
    {
        if (!is_integer($this->merchantId)) {
            throw new \InvalidArgumentException('Merchant Id must be an integer');
        }

        return $this->merchantId;
    }

    /**
     * Set Merchant Id
     * @param int $merchantId
     * @return $this
     */
    public function setMerchantId($merchantId)
    {
        $merchantId = (int)$merchantId;

        if ($merchantId < 1) {
            throw new \InvalidArgumentException('Merchant Id must be an integer');
        }

        $this->merchantId = $merchantId;
        return $this;
    }

    /**
     * Get Transaction Date
     * @return mixed
     */
    public function getDate()
    {
        if (!($this->date instanceof \DateTime)) {
            throw new \InvalidArgumentException('Transaction Date must be instance of DateTime');
        }

        return $this->date;
    }

    /**
     * Set Transaction Date
     * @param mixed $date
     * @return $this
     */
    public function setDate($date)
    {
        if (!(is_string($date))) {
            throw new \InvalidArgumentException('Transaction Date must be a string');
        }

        $date = str_replace('/', '-', $date);
        $dateTime = new \DateTime($date);

        $this->date = $dateTime;
        return $this;
    }

    /**
     * Get Transaction Value
     * @param bool $inGbp
     * @return int
     */
    public function getValue($inGbp = false)
    {
        $value = $this->value;

        if ($inGbp) {
            $converter = new CurrencyConverter();
            $value = $converter->convert($this->currency, $this->value);
        }

        return $value;
    }

    /**
     * Set Transaction Value
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Value must be numeric');
        }

        $this->value = $value;
        return $this;
    }

    /**
     * Get Transaction Currency
     * @return mixed
     */
    public function getCurrency()
    {
        if (!is_string($this->currency)) {
            throw new \InvalidArgumentException('Currency must be a string');
        }

        return $this->currency;
    }

    /**
     * Set Transaction Currency
     * @param mixed $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        if (!is_string($currency)) {
            throw new \InvalidArgumentException('Currency must be a string');
        }

        $this->currency = $currency;
        return $this;
    }

    /**
     * Exchange Array
     * @param array $data
     * @return $this
     */
    public function exchangeArray(array $data)
    {
        $this->setMerchantId($data['merchantId']);
        $this->setDate($data['date']);
        $this->setValue($data['value']);
        $this->setCurrency($data['currency']);

        return $this;
    }

}
