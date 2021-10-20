<?php
include_once 'env.php';

function verify($field)
{
    $live_token = getenv("LIVE_TOKEN");

    $url = "https://api.paystack.co/transaction/verify/" . $field;

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $live_token",
            "Cache-Control: no-cache",
        )
    ));

    $response = curl_exec($ch);
    $err = curl_error($ch);
    curl_close($ch);

    if ($err) {
        return $err;
    } else {
        return $response;
    }
}

function initialise($field)
{
    $test_token = getenv("TEST_TOKEN");
    $live_token = putenv("LIVE_TOKEN");

    $url = "https://api.paystack.co/transaction/initialize";

    $data = http_build_query($field);

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $live_token",
            "Cache-Control: no-cache",
        )
    ));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

/**
 *  this function is not used in this project,
 *  but left for reference purposes.
 */
function verifyAccount(string $account_num, string $bank_code)
{
    $token1 = getenv("TEST_TOKEN");
    $url = "https://api.paystack.co/bank/resolve?account_number=$account_num&bank_code=$bank_code";
    $cu = curl_init();
    curl_setopt_array($cu, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => TRUE,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token1",
            "Cache-Control: no-cache",
        )
    ));

    $ret = curl_exec($cu);
    $err = curl_error($cu);
    curl_close($cu);
    return ($err) ? $err : $ret;
}
