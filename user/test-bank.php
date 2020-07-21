<?php

echo $_POST['account-number'];
echo $_GET['account-number'];

if (isset($_GET["account-number"])) {
  echo "hi";
}