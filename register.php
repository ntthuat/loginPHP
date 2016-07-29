<?php
echo "<h1>Register</h1>";

$submit = $_POST['submit'];

//form data
$fullname = strip_tags($_POST['fullname']); //strip_tags dung de bo qua cac tag cua html, xml, php (vi du nhu <b>world</b> thi van in ra chu world khong in dam)
$username = strtolower(strip_tags($_POST['username']));
$password = strip_tags($_POST['password']);
$repeatpassword = strip_tags($_POST['repeatpassword']);
$date = date("Y-m-d");

if($submit){

//opne database
$connect = mysqli_connect("127.0.0.1", "root", "", "phplogin");
$sql = "select username from users where username = '$username'";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) != 0) {
    die("Username already taken!");
}

//check for existance
if($fullname&&$username&&$password&&$repeatpassword){
	
	if($password==$repeatpassword){
		//check char length of username and fullname
		if(strlen($username)>25||strlen($fullname)>25){
			echo "Length of username or fullname is too long!";
		} else{
			//check password length
			if(strlen($password)>25||strlen($password)<6){
				echo "Password must be between 6 and 25 characters";
			} else {
				//register the user!
				//encrypt password
				$password = md5($password);
				$repeatpassword = md5($repeatpassword);
				
				$sql = "insert into users values ('','$fullname','$username','$password','$date')";
				if (mysqli_query($connect, $sql)) {
					die("You have been registered! <a href='index.php'>Return to login page</a>");
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($connect);
				}

			}
		}
	} else{
		echo "Your passwords do not match!";
	}
	
} else{
	echo "Please fill in <b>all</all> fields!";
}
mysqli_close($connect);		
}
?>

<html>

<form action='register.php' method='POST'>
	<table>
		<tr>
			<td>Your full name:</td>
			<td><input type='text' name='fullname' value='<?php echo $fullname; ?>'></td>
		</tr>
		<tr>
			<td>Choose a username:</td>
			<td><input type='text' name='username' value='<?php echo $username; ?>'></td>
		</tr>
		<tr>
			<td>Choose a password:</td>
			<td><input type='password' name='password'></td>
		</tr>
		<tr>
			<td>Repeat your password:</td>
			<td><input type='password' name='repeatpassword'></td>
		</tr>
	</table>
	
	<input type='submit' name='submit' value='Register'>
</form>

</html>