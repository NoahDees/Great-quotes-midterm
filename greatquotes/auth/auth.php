<?php

// add parameters
function signup(){
	// use the following guidelines to create the function in auth.php
	// instead of using "die", return a message that can be printed in the HTML page
	if(count($_POST)>0){
		// check if the fields are empty
		if(!isset($_POST['email'])){
			return('please enter your email');
		}
		if(!isset($_POST['password'])){
			return('please enter your email');
		}
	
		// check if the email is valid
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			return('Your email is invalid');
		}
	
		// check if password length is between 8 and 16 characters
		if(strlen($_POST['password'])<=8){
			return('Please enter a password >=8 characters');
		}
		if(strlen($_POST['password'])>=16){
			return('Please enter a password 16<= characters');
		}
		// check if the password contains at least 2 special characters
		$pattern = '/[^A-Za-z0-9]/';
		if(preg_match_all($pattern,($_POST['password']))<=2){
			return('Please enter a password >=2 special characters');
		}
		// check if the file containing banned users exists
		if(file_exists('../data/banned.csv.php')){
		// check if the email has not been banned
			$arr1 = readcsv('../data/banned.csv.php');
			foreach($arr1 as $row){
				if($row == $_POST['email']){
					return('Your email has been banned');
				}
			}
		}
		// check if the file containing users exists
		if(file_exists('../data/users.csv.php')){
		// check if the email is in the database already
			$arr2 = readcsv('../data/users.csv.php');
			foreach($arr2 as $row){
				if($row[0] == $_POST['email']){
					return('That email has already been used for our service.');
				}
			}
		}
		// encrypt password
		$encrypted_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		// save the user in the database
		addcsv('../data/users.csv.php',$arr = array($_POST['email'],$encrypted_password));
		// show them a success message and redirect them to the sign in page
		echo "Users successfully added!";
		header("Location: signin.php");
	}
}

// add parameters
function signin(){
	if(count($_POST)>0){
		// 1. check if email and password have been submitted
		// 2. check if the email is well formatted
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			return('Your email is invalid');
		}
		// 3. check if the password is well formatted
		// 4. check if the file containing banned users exists
		if(file_exists('../data/banned.csv.php')){
		// 5. check if the email has not been banned
			$arr4 = readcsv('../data/banned.csv.php');
			foreach($arr4 as $row){
				if($row == $_POST['email']){
					return('Your email has been banned');
				}
			}
		}
		// 6. check if the file containing users exists
		if(file_exists('../data/users.csv.php')){
		// 7. check if the email is registered
			$f = fopen('../data/users.csv.php',"r");
			fgetcsv($f);
			while ($record = fgetcsv($f)){
				$arr5[] = $record;
			}
			fclose($f);
			foreach($arr5 as $row){
				if(!$row[0] == $_POST['email']){
					return('We don\'t have that email in our database');
				}
			}
		}
		// 8. check if the password is correct
		foreach($arr5 as $row){
			if(password_verify($_POST['password'],$row[1])){
				is_logged();
				return "Logged in";
			}
			else{
				continue;
				return "Wrong Password";
			}
		}
		// 9. store session information
		$_SESSION["username"] = $_POST['email'];
		$_SESSION["password"] = $_POST['password'];
		//echo 'check email+password';
		// 10. redirect the user to the members_page.php page
		header('Location: ../memebers_page.php');
	}
}

function signout(){
	// use the following guidelines to create the function in auth.php
	$_SESSION['logged']=false;
	session_destroy();
	// redirect the user to the public page.
	header("Location: ../public_page.php");
}

function is_logged(){
	if(true){
		$_SESSION['logged']=true;
	}
	else{
		$_SESSION['logged']=false;
	}
}