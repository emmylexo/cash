<script>
// Set the date we're counting down to
<?php
    $datetime = new DateTime($dbTimer);
    $timerT = $datetime->format('M d, Y  H:i:s');
?>
var countDownDate = new Date("<?php echo $timerT; ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="paymentTimer"
    document.getElementById("paymentTimer").innerHTML = days + '<span style="font-size:16px;color:#999;">d </span>' + hours + '<span style="font-size:14px;color:#999;">h </span>'
    + minutes + '<span style="font-size:14px;color:#999;">m </span>' + seconds + '<span style="font-size:14px;color:#999;">s</span> ';

     // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("paymentTimer").innerHTML = "#LATE#";
    }
}, 1000);
</script>