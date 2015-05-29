<?php
date_default_timezone_set('Europe/London');
header('Content-Type: text/html; charset=UTF-8');

require_once __DIR__ . '/../models/TransactionTable.php';
require_once __DIR__ . '/../models/Transaction.php';

// If there is no argument, use customer ID 1 by default
if (isset($argv[1]) && is_numeric($argv[1])) {
    $customerId = $argv[1];
} else {
    $customerId = 1;
}

$transactionTable = new TransactionTable();
$transactions = $transactionTable->fetchAllTransactions($customerId);

if (count($transactions) > 0) {
    /* @var $transaction Transaction */
    foreach ($transactions as $transaction) {
        echo $transaction->getMerchantId() . "; ";
        echo $transaction->getDate()->format('Y-m-d') . "; ";
        echo 'GBP';
        echo $transaction->getValue(true) . "; ";

        echo "\n";
    }
} else {
    echo "Merchant doesn't have any transactions";
    echo "\n";
}
