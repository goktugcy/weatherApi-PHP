<?php
$ip = @$_SERVER['REMOTE_ADDR']; //ip adresinden yer tespiti
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
$sehir = $query["city"];
$status="";
$msg="";

    $url="http://api.openweathermap.org/data/2.5/weather?q=$sehir&appid=d0b0c655a09a8076bd40218cb46175e0";
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $result=curl_exec($ch);
    curl_close($ch);
    $result=json_decode($result,true);
    if($result['cod']==200){
        $status="yes";
    }else{
        $msg=$result['message'];
    }

?>

<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <title>Weather App | <?php echo $result['name']?></title>
  <script src="https://unpkg.com/feather-icons"></script>
  <link rel="stylesheet" href="./style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="container">
    <div class="weather-side">
  <div class="weather-gradient">
	</div>
      <div class="date-container">
        <h2 class="date-dayname"><?php echo date('l')?> </h2><span class="date-day">
          <?php echo date('d M',$result['dt'])?> </span><i class="location-icon"
          data-feather="map-pin"></i><span class="location"><?php echo $result['name']?></span>
      </div>
	

      <div class="weather-container"> 
	
        <h1 class="weather-temp">
 <img src="http://openweathermap.org/img/wn/<?php echo $result['weather'][0]['icon']?>@4x.png" />
<?php echo round($result['main']['temp']-273.15)?>°C
</h1>
        <h3 class="weather-desc"><?php echo $result['weather'][0]['main']?></h3>
	<h3> <div class="wind"> <span class="title">WIND</span><span class="value"><?php echo $result['wind']['speed']?> km/h</span>
</h3>
      </div>

    </div>


      </div>
     
    </div>
  </div>
  <!-- partial -->
  <script src="./script.js"></script>

</body>

</html>
