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
/*
if (getenv('HTTP_X_FORWARDED_FOR'))
 { 
$pipaddress =getenv('HTTP_X_FORWARDED_FOR');
 $ipaddress = getenv('REMOTE_ADDR');
 echo "Proxy IP address : ".$pipaddress. "(via $ipaddress)" ;
}
 else 
{*/
 $ipaddress = getenv('REMOTE_ADDR'); 
$ipadd = "IP : ".$ipaddress.":".php_uname('n')."\n";

if(!isset($_SESSION['hasVisited'])){
  $_SESSION['hasVisited']="yes";
  $counterVal++;
  $f = fopen($counter_name, "w");
 $f1=fopen("ipaddress.txt","a");
  fwrite($f, $counterVal);
  fwrite($f1,$ipadd);
  fclose($f); 
fclose($f1); 
}

?>
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
		<div>
		<?php echo "You are visitor number $counterVal to this site"; ?>
		</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-59520459-1', 'auto');
  ga('send', 'pageview');

</script>   
 </body>
</html>