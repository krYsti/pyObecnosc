<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
// settings
$dayOfTraining = 3;
$date1 = '18:30';
$date2 = '20:30';

//do not change
$fromTime = date_format(date_create($date1), 'H:i');
$tillTime = date_format(date_create($date2), 'H:i');
$inputTime = date("H:i");
$dayOfWeek = date('w');
$datetime = date("Y-m-d H:i:s");

//checkDateTime
function checkDateTime() {
	global $dayOfWeek, $fromTime, $tillTime, $inputTime, $dayOfTraining;
	if ($dayOfWeek == $dayOfTraining && $inputTime >= $fromTime && $inputTime <= $tillTime) {
		return true;
	}
	else {
		return false;
	}
}

//showThankyou
function showThankYou() {
	echo '<div class="container"><div class="alert alert-success" role="alert">Twoja obecność na dzisiejszych zajęciach została zapisana :-)</div>';
}

//showWrongDate
function showWrongDate() {
	echo '<div class="container"><div class="alert alert-info" role="alert">Teraz nie ma zajęć :-)</div>';
}

//showExpired
function showExpired() {
	echo '<div class="container"><div class="alert alert-danger" role="alert">Czas rejestracji upłynął :-(</div>';
}
//sent
function sent() {
	global $datetime;
	$dbaddress = "localhost"; //server
	$dbuser = "test"; //db user
	$dbpwd = "test"; // db password
	$dbbase = "test"; //base
	$conn = mysqli_connect($dbaddress, $dbuser, $dbpwd, $dbbase);
	if (!$conn) {
		die("Connection failed");
	}
	$query = "INSERT INTO pyObecnosc (pyEmail, pyImie, pyKod, pyData, pyIP) VALUES ('".htmlspecialchars($_POST['inputEmail'])."', '".htmlspecialchars($_POST['inputName'])."', '".htmlspecialchars(htmlspecialchars($_POST['inputCode']))."', '".$datetime."', '".htmlspecialchars($_POST['inputIp'])."')";
	if (mysqli_query($conn, $query)) {
		setcookie("pyObecnosc1", "1", time()+7200);
		setcookie("pyEmail", htmlspecialchars($_POST['inputEmail']), time()+2678400);
		setcookie("pyName", htmlspecialchars($_POST['inputName']), time()+2678400);
		return true;
	}
    else {
		echo "Coś nie poszło";
		return false;
	}
	mysqli_close($conn);
}

//getIP
function getClientIp() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

if (!file_exists("closed.txt")) {
	sent();
	showThankYou();
}
else showExpired();
 ?>
