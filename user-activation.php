<?php
    require("includes/config.php");
    require_once(ROOT_PATH . "core/frontEnd-wrapper.php");
    require_once(ROOT_PATH . "core/session.php");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Activate User</title>

    <link rel="shortcut icon" href="images/6bbb860bc90326d162752565df3199fc.png" type="image/x-icon">

    <style>
        img {
            width: 100%;
        }

        .list-group-item {
            border: none;
        }

        .card-title {
            font-size: 22px;
            margin-bottom: 0;
        }
    </style>
</head>
<body class="mt-5">

<?php if (!isset($_GET['user'])) { $genInfo->redirect(BASE_URL . 'user/'); exit(); }?>

<?php

    $userLoginID = $_GET['user'];
    $userTable = $genInfo->runQuery("SELECT * FROM users WHERE login_id = $userLoginID");
    $userTable->execute();
    $userTable = $userTable->fetch(PDO::FETCH_ASSOC);

    $bankInfo = $genInfo->runQuery("SELECT account_number FROM bank_info WHERE login_id = $userLoginID");
    $bankInfo->execute();
    $bankInfo = $bankInfo->fetch(PDO::FETCH_ASSOC);

    $activationOrder = $genInfo->runQuery("SELECT * FROM orders WHERE payer_id = $userLoginID");
    $activationOrder->execute();
    $activationOrder = $activationOrder->fetch(PDO::FETCH_ASSOC);

    if ($_GET['user'] !== $activationOrder['payer_id']) {
        $genInfo->redirect(BASE_URL . 'user/');
        exit();
    }

    $user_account_number = $bankInfo['account_number'];
    $paymentPairs = $genInfo->runQuery("SELECT * FROM payment_pairs WHERE user_account_number = $user_account_number");
    $paymentPairs->execute();
    $paymentPairs = $paymentPairs->fetch(PDO::FETCH_ASSOC);

    if (isset($_GET['approve'])) {
        $stmt = $genInfo->runQuery("UPDATE orders SET ord_status = '1' WHERE payer_id = $userLoginID");
        $stmt->execute();
        $updateUser = $genInfo->runQuery("UPDATE users SET status = 'Active' WHERE login_id = $userLoginID");
        $updateUser->execute();
        $genInfo->redirect(BASE_URL . 'user/');
    }

?>

<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase font-weight-bold">Proof Of Payment [POP]</h5>
                </div>
                <div class="pop-image">
                    <img src="<?php echo str_replace('../', '', $activationOrder['pop']); ?>" alt="POP">
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase font-weight-bold">Payee Details</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Account Name: </strong> <?php echo $paymentPairs['admin_name']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Account Number: </strong> <?php echo $paymentPairs['admin_account_number']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Name of Bank: </strong> <?php echo $paymentPairs['admin_bank_name']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Tel: </strong> <?php echo $paymentPairs['admin_mobile']; ?>
                    </li>
                </ul>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-uppercase font-weight-bold">Payer Details</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Account Name: </strong> <?php echo $paymentPairs['user_name']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Account Number: </strong> <?php echo $paymentPairs['user_account_number']; ?>
                    </li>
                    <li class="list-group-item">
                        <strong>Name of Bank: </strong> <?php echo $paymentPairs['user_bank_name']; ?>
                    </li>
                </ul>
            </div>
            <br>
            <div class="btn-group d-flex">
                <a href="<?php echo BASE_URL . 'user-activation?user=' . $userLoginID . '&approve=true'; ?>" class="btn btn-primary">Approve User</a>
                <a href="<?php echo BASE_URL . 'user/'; ?>" class="btn btn-primary ml-2">Approve User later</a>
            </div>
        </div>
    </div>
</div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>