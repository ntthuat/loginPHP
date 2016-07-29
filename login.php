<?php

session_start();

$username = $_POST['username'];
$password = md5($_POST['password']);

if ($username&&$password){

    $connect = mysqli_connect("127.0.0.1", "root", "", "phplogin");
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $dbusername = $row['username'];
            $dbpassword = $row['password'];
        }

        //Check to see if they match!
        if ($username==$dbusername&&$password==$dbpassword){
            echo "You're in! <a href='member.php'>Click</a> here to enter the member page.";
            $_SESSION['username']=$dbusername;
        } else{
            echo "Incorrect password!";
        }
    } else {
        die("That user doesn't exist!");
    }

    mysqli_close($connect);

} else {
    die("Please enter username and password!");
}

?>