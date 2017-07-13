<?php

require "application/libraries/tools.php";

//return;
$msg = "Hey %s, I noticed a property at %s, is it yours?  I'm a local buyer here in the area and would be interested in purchasing it, of course if the timing is right.  Please let me know and have a great rest of your day! \n\nThanks,\nMax";

//$msg = "Hi %s, I noticed you were the representative for %s in %s.   I’m a local investor and have been buying in that neighborhood for years.  I was wondering, is the house for sale?  \n\nSincerely,\nAdam";

//Connect to the database.
$con=mysqli_connect("mysql.probateproject.com","dreamadam","qscBFE3!2#4","adamdb");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//$sql="SELECT No,Name,PhoneNum, Address, City, State FROM tb_phone where PhoneNum is not null";
  $sql="SELECT * FROM tb_phone where Phone1 is not null or Phone2 is not null or Phone3 is not null or Phone4 is not null or Phone5 is not null";

if ($result=mysqli_query($con,$sql))
  {
  // Fetch one and one row
  $rep_arr=array("+","(",")","-","_"," ");
  $respond = "";    
  while ($row=mysqli_fetch_row($result))
    {
       $usrname = $row[1];
       $usr_index = strpos($usrname, " ");
       if($usr_index!=false)  $usrname = ucfirst(strtolower(substr($usrname, 0, $usr_index)));
       else $usrname = ucfirst(strtolower($usrname));

       $addr=ucfirst(strtolower($row[2]));
       $pieces = explode(" ", $addr);
       $counts = sizeof($pieces);
       for($i=0;$i<$counts; $i++){
           $pieces[$i]=ucfirst(strtolower($pieces[$i]));
       }
       $addr=implode(" ",$pieces);

       $cityname=ucfirst(strtolower($row[3]));
       $pieces = explode(" ", $cityname);
       $counts = sizeof($pieces);
       for($i=0;$i<$counts; $i++){
           $pieces[$i]=ucfirst(strtolower($pieces[$i]));
       }
       $cityname=implode(" ",$pieces);
       //Set the owner of representive.
       $type = $row[6];

     //  $snd_msg = sprintf($msg, $usrname,$type, $addr );
         $snd_msg = sprintf($msg, $usrname, $addr );
       //echo $snd_msg;

       for($p_ind=0;$p_ind<5; $p_ind++){
         $phonenum = str_replace($rep_arr, "", $row[7+$p_ind]);
         if($phonenum == "") continue;
         $phonenum = "+1".$phonenum;
         $respond = $respond."\nNumber:".$phonenum."Result:".send_Sms($phonenum, $snd_msg)."\n";      
         // $respond = $respond."\nNumber:".$phonenum."Result:Success\n";      
       }

       //$respond = $respond."phonenum".$phonenum."\r\nmsg".$snd_msg."\r\n";
    }
  // Free result set
  mysqli_free_result($result);
}

mysqli_close($con);

echo $respond;

?>
