<?php
function getUserBank($accountNum, $bankCode) {

  $curl = curl_init();

  curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number=".$accountNum."&bank_code=".$bankCode,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
          "Authorization: Bearer sk_test_161ac4134f11d458e53a5be059ac5778c70427a5",
          "Cache-Control: no-cache",
      ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo $response;
  }
}
?>

