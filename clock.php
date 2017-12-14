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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
function startClock() {
// Set the date we're counting down to
var countDownDate = new Date(Date.parse(new Date()) + 3 * 60 * 1000);
//var countDownDate = new Date(Date.parse(new Date()) + 3 * 1000);

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="clock"
    document.getElementById("address").innerHTML = "bit.ly/pyobecnosc";
	document.getElementById("clock").innerHTML = minutes + ":" + seconds;
    
    // Countdown is over 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("clock").innerHTML = "EXPIRED";
		jQuery.ajax({
			type: "POST",
			url: 'stopclock.php',
			dataType: 'json',
			data: {functionname: 'add', arguments: [1, 2]},

			success: function (obj, textstatus) {
						if( !('error' in obj) ) {
							yourVariable = obj.result;
						}
						else {
							console.log(obj.error);
						}
					}
		});
    }
}, 1000);
}
</script>
</head>

<body>
<div class="container">
<div class="row">
	<div class="col"><img src="./pylady_geek_red.jpg" width="280" height="153" alt="logo" /></div>
  <div class="col"><h1>PyLadies Poznań</h1><div>Lista obecności</div></div>
</div>
</div>
<div class="container">
<h1 id="address" class="display-1 text-center"></h1>
<div id="clock" class="display-2 text-center"></div>
<div class="display-5 text-center">Hasło dnia</div>
<div class="text-center"><input type="text" class="form-control form-control-lg text-center" />
<input type="button" onClick="javascript:startClock()" value="Start" />
</div>
</body>
</html>