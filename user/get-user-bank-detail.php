<?php
include('../paymentServices/accountName.php');
if(isset($_GET["account-number"]) && isset($_GET["bank-name"])) {
  $account_number = $_GET['account-number'];
  echo gettype($account_number);
  echo $account_number;
  $bank_name = $_GET['bank-name'];
  getUserBank($account_number, $bank_name);
}

