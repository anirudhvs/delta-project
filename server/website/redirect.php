<?php

  $user_agent = $_SERVER['HTTP_USER_AGENT'];

  function getOS() { 
  
      global $user_agent;
  
      $os_platform  = "Unknown OS Platform";
  
      $os_array     = array(
                            '/windows/i'            =>  'Windows',
                            '/win98/i'              =>  'Windows',
                            '/win95/i'              =>  'Windows',
                            '/win16/i'              =>  'Windows',
                            '/macintosh|mac os x/i' =>  'Mac',
                            '/mac_powerpc/i'        =>  'Mac',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Linux',
                            '/android/i'            =>  'Android',
                            '/webos/i'              =>  'Mobile',
                            '/iphone/i'             =>  'iPhone',
                      );
  
      foreach ($os_array as $regex => $value)
          if (preg_match($regex, $user_agent))
              $os_platform = $value;
  
      return $os_platform;
  }
  
  function getBrowser() {
  
      global $user_agent;
  
      $browser        = "Unknown Browser";
  
      $browser_array = array(
                              '/msie/i'      => 'Internet Explorer',
                              '/firefox/i'   => 'Firefox',
                              '/safari/i'    => 'Safari',
                              '/chrome/i'    => 'Chrome',
                              '/edge/i'      => 'Edge',
                              '/opera/i'     => 'Opera',
                              '/mobile/i'    => 'Handheld Browser'
                       );
  
      foreach ($browser_array as $regex => $value)
          if (preg_match($regex, $user_agent))
              $browser = $value;
  
      return $browser;
  }
  
  
  $user_os        = getOS();
  $user_browser   = getBrowser();
  
  
  require("databaseConnection.php");
  $urlId=mysqli_real_escape_string($conn,$_POST['url_id']);
  $user_os= mysqli_real_escape_string($conn,$user_os);
  $user_browser= mysqli_real_escape_string($conn,$user_browser);

  $sql="INSERT INTO `analytics` (`url_id`, `platform`,`browser`,`time_visited`) VALUES ('$urlId', '$user_os', '$user_browser' , current_timestamp());"  ;

  if(mysqli_query($conn,$sql)){
    $url=$_POST['url'];
    header("Location:$url");

  } else{
    echo "Failed";
  }

?>