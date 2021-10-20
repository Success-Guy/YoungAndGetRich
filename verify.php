<?php
session_start();
require_once('class/paystack.php');
require_once('header.php');
?>
<section style="margin-top: 90px;text-align: center;" >
<?php
if (isset($_GET['reference'])) {
    # code...
    $ref = rawurlencode($_GET['reference']);
    $result = verify($ref);
    // echo "$result";
    $result = json_decode($result);

    echo "Status: ".$result->data->status."<br>";
    $amt = $result->data->amount/100;
    echo "Amount: &#8358<span>" .$amt."</span><br>";
    echo "Name: ".$result->data->metadata->customer->name."<br>";
    echo "Email: ".$result->data->metadata->customer->email."<br>";
    $_SESSION['email'] = $result->data->metadata->customer->email;
    $_SESSION['name'] = $result->data->metadata->customer->name;
    echo '<a href="download.php?file=true"><button class="btn">Download The Book</button></a>';
}else{
    // header("location:http://". $_SERVER['SERVER_NAME']."/book");
    header("location:/");
}
?>


</section>
<?php
require_once('footer.php');
?>