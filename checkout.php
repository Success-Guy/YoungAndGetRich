<?php

require_once('class/paystack.php');
require_once('class/common.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);

    // log successful buyer info to database
    recordData($email, $name);

    $rand = random_int(100, 10000000);

    $data = [
        'email' => $email,
        'firstname' => "Abiodun",
        'lastname' => "Sam",
        'amount' => "100000",
        'reference' => "Book" . $rand,
        // 'callback_url'=>"http://test.co/book/verify.php",
        'callback_url' => "https://www.youngandgetrich.com/verify.php",
        'metadata' => [
            "customer" =>
            [
                "name" => $name,
                "email" => $email,
            ],
        ]
    ];

    $result = initialise($data);
    $link = getUrl($result);
    header("location:$link");
} else {
    header("location:http://" . $_SERVER['SERVER_NAME']);
}
