<?php session_start();
$counter_name = "counter.txt";

if (!file_exists($counter_name)) {
  $f = fopen($counter_name, "w");
  fwrite($f,"0");
  fclose($f);
}

$f = fopen($counter_name,"r");
$counterVal = fread($f, filesize($counter_name));
fclose($f);


if(!isset($_SESSION['hasVisited'])){
  $_SESSION['hasVisited']="yes";
  $counterVal++;
  $f = fopen($counter_name, "w");
  fwrite($f, $counterVal);
  fclose($f); 
}

echo "You are visitor number $counterVal to this site";?>
<html lang="en">
    <head>
        <title>J Live</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style2.css" />
	
    </head>
    <body>
        <div class="container">
            <h1 class="main"><font size=13>AUSM Coders</font></h1>
						<div class="sp-container">
				<div class="sp-content">
					<div class="sp-globe"></div>
					<h2 class="frame-1">If you need any information</h2>
					<h2 class="frame-2">About Jalgaon</h2>
					<h2 class="frame-3">You can find it here</h2>
					<h2 class="frame-4">Now presenting!</h2>
					<h2 class="frame-5"><span>J-Live ...</span><span> We are coming Soon..!</span></h2>
					<br/><a class="sp-circle-link" href="http://recode.in/ausmcoders/">Contact us!</a>
				</div>
			</div>
        </div>
    </body>
</html>