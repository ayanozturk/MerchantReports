<?php
require_once ('Transaction.php');

/**
 * Class TransactionTable
 */
class TransactionTable
{

    /**
     * Fetch All Transactions
     * @param int $customerId Customer Id
     * @return array
     * @throws Exception
     */
    public function fetchAllTransactions($customerId = null)
    {
        $resultSet = array();
        $dataFile = __DIR__ . '/../data.csv';
        if (!file_exists($dataFile)) {
            throw new Exception('Data file not found');
        }

        $file = fopen($dataFile, 'r');

        while (($line = fgetcsv($file)) !== FALSE) {

            $data = explode(';', $line[0]);

            if ($customerId && $data[0] != $customerId) {
                continue;
            }

            if (isset($data[0]) && is_numeric($data[0])) {
                $amount = str_replace('"', '', $data[2]);
                $currency = $this->substr_unicode($amount, 0, 1);
                $value = $this->substr_unicode($amount, 1);

                switch ($currency) {
                    case '€':
                        $currency = 'EUR';
                        break;
                    case '$':
                        $currency = 'USD';
                        break;
                    case '£':
                        $currency = 'GBP';
                        break;
                    default:
                        $currency = 'GBP';
                        break;
                }

                $transactionData = array(
                    'merchantId' => $data[0],
                    'date' => str_replace('"', "", $data[1]),
                    'currency' => $currency,
                    'value' => $value
                );

                $transaction = new Transaction();
                $transaction->exchangeArray($transactionData);
                $resultSet[] = $transaction;
            }
        }
        fclose($file);
        return $resultSet;
    }

    /**
     * @param $str
     * @param $s
     * @param null $l
     * @return string
     */
    protected function substr_unicode($str, $s, $l = null) {
        return join("", array_slice(
            preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY), $s, $l)
        );
    }

}
