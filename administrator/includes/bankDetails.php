<?php

class BankDetail
{
  public $accountName;
  public $accountNumber;
  public $bankName;
  public $phoneNumber;
  public $next;
}

$akarawak = new BankDetail();
$akarawak->accountName = 'Akarawak Emmanuel Bassey';
$akarawak->accountNumber = 2153289819;
$akarawak->bankName = 'UBA';
$akarawak->phoneNumber = '07065793290';
$akarawak->next = true;



$akarawak2 = new BankDetail();
$akarawak2->accountName = 'Akarawak O. Bassey';
$akarawak2->accountNumber = 3089533124;
$akarawak2->bankName = 'First Bank';
$akarawak2->phoneNumber = '09072003781';
$akarawak2->next = false;




