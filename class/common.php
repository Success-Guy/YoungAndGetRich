<?php
function getUrl($value)
{

    $obj = json_decode($value);
    if ($obj->status) {
        return $obj->data->authorization_url;
    } else {
        echo $obj->status . " " . $obj->message;
        // header("Location:javascript://history.go(-1)");
    }
}

function writeFile($value)
{

    $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
    $txt1 = "==============<br>";
    fwrite($myfile, $txt1);

    fwrite($myfile, $value);
    $txt2 = "\n<br>";
    fwrite($myfile, $txt2);

    fclose($myfile);
}
function readf()
{
    $myfile = fopen("newfile.txt", "r") or die("Unable to open file!");
    echo fread($myfile, filesize("newfile.txt"));
    fclose($myfile);
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function recordData($email, $name)
{
    include_once "env.php";

    $servername = getenv("DB_SERVER");
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    $dbname = getenv('DB_NAME');

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO logs (name, email)
    VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        return "New record created successfully";
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
