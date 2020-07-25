<script>
    // Set the date we're counting down to
    <?php
    $timerD = $genInfo->runQuery("SELECT * FROM orders WHERE payer_id = $userLoginID");
    $timerD->execute();
    $timerD = $timerD->fetch(PDO::FETCH_ASSOC);
    $dbTimer = $timerD['period_timer'];
    $datetime = new DateTime($dbTimer);
    $timerT = $datetime->format('M d, Y  H:i:s');
    ?>
    var countDownDate = new Date("<?php echo $timerT; ?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function () {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Output the result in an element with id="demo"
        document.getElementById("paymentTimer").innerHTML = hours + "h "
            + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("paymentTimer").innerHTML = "#LATE#";
        } else if (distance < 14400000) {
            document.getElementById("paymentTimer").style.color = 'red';
        } else if (distance > 14400000) {
            document.getElementById("paymentTimer").style.color = 'blue';
        }
            // console.log(distance);
    }, 1000);

</script>