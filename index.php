<?php

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

//showForm
function showForm() {
	echo '
	<div class="container">
  <div class="alert alert-info" role="alert">
  Aby potwierdzić swoją obecność na dzisiejszych zajęciach, uzupełnij poniższy formularz
</div>
<form action="sendform.php" method="post">
  <div class="form-group">
    <label for="inputEmail">E-mail</label>
    <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="Ten sam, który używany był przy rejestracji na zajęcia" value="'.$_COOKIE['pyEmail'].'" />
  </div>
  <div class="form-group">
    <label for="inputName">Imię</label>
    <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Imię" value="'.$_COOKIE['pyName'].'" />
  </div>
  <div class="form-group">
    <label for="inputCode">Kod obecności</label>
    <input type="text" class="form-control" id="inputCode" name="inputCode" placeholder="Kod podany przez prowadzącego" />
  </div>
  <button type="submit" id="wyslij" class="btn btn-primary">Wyślij</button>
  <input type="hidden" name="inputIp" value="'.getClientIp().'" />
</form>
</div>
';
}

//showThankyou
function showThankYou() {
	echo '
	<div class="container">
  <div class="alert alert-info" role="alert">
  Twoja obecność na dzisiejszych zajęciach została zapisana :-)
</div>
';
}

//showWrongDate
function showWrongDate() {
	echo '
	<div class="container">
  <div class="alert alert-info" role="alert">
  Teraz nie ma zajęć :-)
</div>
';
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
?>

<!doctype html>
<html lang="pl">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<title>PyTrening - lista obecności</title>
<meta name="robots" content="noindex, nofollow" />
<meta http-equiv="Cache-Control" content="no-store" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
</head>

<body>
<div class="container">
<div class="row">
	<div class="col"><img src="./pylady_geek_red.jpg" width="280" height="153" alt="logo" /></div>
  <div class="col"><h1>PyLadies Poznań</h1><div>Lista obecności</div></div>
</div>
</div>

<?php 
if (checkDateTime() && empty($_COOKIE['pyObecnosc1'])) {
	showForm();
}
elseif (!checkDateTime() && empty($_COOKIE['pyObecnosc1'])) {
	showWrongDate();
}
else showThankYou();
 ?>

</body>
</html>