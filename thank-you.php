<?php

session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/millennium-marketing-solutions/inc/akismet.class.php';

// PREVENT DIRECT ACCESS TO THANK YOU PAGE
if ( !isset( $_POST['first-name']) || !isset( $_POST['last-name']) || !isset( $_POST['company']) || !isset( $_POST['job-title']) || !isset( $_POST['email']) ) {
	echo 'This page cannot be accessed directly.';
	exit();
}

if ( empty( $_POST['first-name']) || empty( $_POST['last-name']) || empty( $_POST['company']) || empty( $_POST['job-title']) || empty( $_POST['email'])  ) {
	echo 'You neglected to fill out required form fields.';
	exit();
}
	
// HIDDEN HONEYPOT
$spa = $_POST["spam"];
	
if (!empty($spa) && !($spa == "4" || $spa == "four")) {
	echo "We're sorry, but you appear to be a spambot";
    exit ();
}
	
if($_SERVER['REQUEST_METHOD']=="POST") {
	$WordPressAPIKey = 'c32918c5e5bc';
	$MyBlogURL = 'http://www.mm4solutions.com/';
	
	$recipients=$_POST["recipients"];
	$to = str_replace("_AT_","@",$recipients);
	//$to='chris@mm4solutions.com';
	
	$first_name=strip_tags($_POST["first-name"]);
	$last_name=strip_tags($_POST["last-name"]);
	$company=strip_tags($_POST["company"]);
	$title=strip_tags($_POST["job-title"]);
	$email=strip_tags($_POST["email"]);
	$how_hear=strip_tags($_POST["how-hear"]);
	$just_attend=strip_tags($_POST["just-attend"]);
	$expo_seminars=strip_tags($_POST["expo-and-seminars"]);
	$seminar1=strip_tags($_POST["its-academic"]);
	$seminar2=strip_tags($_POST["outside-the-box"]);
	$seminar3=strip_tags($_POST["professional-photos"]);
	$seminar4=strip_tags($_POST["website-essentials"]);
	$comments=strip_tags($_POST["comments"]);
	
	$comment = array(
		'author' => $first_name . $last_name,
		'email' => $email,
		'website' => $MyBlogURL,
		'body' => $comments
	);
	 
	$akismet = new Akismet($MyBlogURL, $WordPressAPIKey, $comment);
	
	$from="admin@mm4solutions.com";
	$subject= "I would like to register for the September 14th Marketing Expo and Educational Event";
	$message='"' . $first_name . '","' . $last_name . '","' . $company . '","' . $title . '","' . $email . '","' . $how_hear . '","' . $just_attend . '","' . $expo_seminars . '","' . $seminar1 . '","' . $seminar2 . '","' . $seminar3 . '","' . $seminar4 . '"';
	$header='From: '.$from."\r\n".'Reply-To: '.$from."\r\n".'MIME-Version: 1.0'."\r\n".'Content-type: text/html; charser=iso-8859-1'."\r\n".'X-Mailer: PHP/'.phpversion();
	
	if ($akismet->isSpam()) {
		//-- THIS IS SPAM, YO!!!!!
		echo "We're sorry, but you appear to be a spambot";
		exit();
	} else {
		@mail($to,$subject,$message,$header);
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Thank You For Registering</title>
	</head>
	<body>
		<p>Thank you!!!!!</p>
	</body>
</html>