<?
mysql_connect("molene", "root", "2#tB(5K");
mysql_select_db("opera");

function head_html()
{
   echo ("<html>");
}


function foot_html()
{
    echo ("</html>");
}

function getHotel($hotel)
{
$query="";
if ( $hotel == 'ALL' ) { return array ( 'ALL','Groupe Oceania Hotels',''); }
if ( $hotel == '' ) 
	{
	list($ad1,$ad2,$ad3,$ad4) = split('[/.-]', getenv("REMOTE_ADDR"));
	$query="SELECT * FROM hotel where ad_ip like '$ad1.$ad2.$ad3'";
	}
else
	{	
	$query = "SELECT * FROM hotel where property like '$hotel'";
	}

$result = mysql_query($query);
if (!$result) 
	{
   		echo 'Impossible d\'exécuter la requête : ' . mysql_error();
  	 	exit;
	}
$row = mysql_fetch_row($result);
return array ($row[0],$row[4],$row[1]);
 // 42
}


function getFDayInfo($date)
{
$result = mysql_query("SELECT '$date' + INTERVAL -1 YEAR, '$date' + INTERVAL +1 DAY, '$date' + INTERVAL +1 DAY");
if (!$result)
        {
                echo 'Impossible d\'exécuter la requête : ' . mysql_error();
                exit;
        }

list($year,$month,$day)=split('[/.-]', $date);
$row = mysql_fetch_row($result);
list($year1,$month1,$day1)=split('[/.-]', $row[0]);
return array ("$year1-$month1",$row[1],"$year-$month" ,$row[2]);
 // 42
}



function getDayExist($day)
{

list($ad1,$ad2,$ad3,$ad4) = split('[/.-]', getenv("REMOTE_ADDR"));
$query="SELECT count(*) FROM tabbord t where t.bdate = '$day' and t.ad_ip like '$ad1.$ad2.$ad3.%'";
//echo $query;
$result = mysql_query($query);
if (!$result) 
	{
   		echo 'Impossible d\'exécuter la requête : ' . mysql_error();
  	 	exit;
	}
$row = mysql_fetch_row($result);
return ($row[0]);
 // 42
}

function getLstFlash($flash_day)
{
$month=strftime('%m');
$month++;
$month--;
$year=strftime('%Y');
if ( $month == '01' )
	{
	$oldmonth=12;
	$oldyear=$year;
	$oldyear--;	
	}
else
	{
	$oldmonth=$month;
	$oldmonth--;
	$oldyear=$year;
	}	

if ( $oldmonth <10 ) { $oldmonth = '0'.$oldmonth; } 
if ( $month <10 ) { $month = '0'.$month; } 
$day=strftime('%d');
#if ( $day == '01' )
#	{
	$lastday = mktime(0, 0, 0, $oldmonth+1, 0, $year);
#	}
#else
#	{
#	$lastday = mktime(0, 0, 0, $oldmonth, 0, $year);
#	}
$tjo=$lastday;
$cpt =1 ;
$flashday=0;
while ( $cpt <= strftime('%d', $lastday) )
	{
		if ( $cpt <10 ) { $val = '0'.$cpt; } else { $val = $cpt; }
		if ( $flash_day != null )
			{
			if ( "$year-$month-$val" == "$flash_day"  ) 
					{ 
					$flashday=$flash_day;
					echo "<option value=\"$oldyear-$oldmonth-$val\" SELECTED>$val/$oldmonth/$oldyear</option>"; 
					}
			else
				{		
				echo "<option value=\"$oldyear-$oldmonth-$val\">$val/$oldmonth/$oldyear</option>";
				}
			}	
		else
			{	
			if ( $cpt == strftime('%d', $lastday) )
				{
				echo "<option value=\"$oldyear-$oldmonth-$val\" SELECTED>$val/$oldmonth/$oldyear</option>";
				}
			else
				{
				echo "<option value=\"$oldyear-$oldmonth-$val\">$val/$oldmonth/$oldyear</option>";
				}
			}
		$cpt++;
	}

$cpt =1 ;
while ( $cpt < $day )
	{
		if ( $cpt <10 ) { $val = '0'.$cpt; } else { $val = $cpt; }
		$j=$day-1;
		if ( $flash_day != null )
			{
			if ( "$year-$month-$val" == "$flash_day"  ) 
					{ 
					$flashday=$flash_day;
					echo "<option value=\"$year-$month-$val\" SELECTED>$val/$month/$year</option>"; 
					}
			else { echo "<option value=\"$year-$month-$val\">$val/$month/$year</option>"; }
			}	
		else
			{	
			if ( $cpt == $j  ) 
					{ 
					$flashday="$year-$month-$val";
					echo "<option value=\"$year-$month-$val\" SELECTED>$val/$month/$year</option>"; 
					}
			else { echo "<option value=\"$year-$month-$val\">$val/$month/$year</option>"; }
			}
		$cpt++;
	}
return($flashday);

}

function setToNull ($value)
{
if ( $value == '' )
	 {
	 return (0);
	 }
else
	 {	
	 $value = ereg_replace(',','.',$value);
	 return ($value);
	 } 
}		


function convDate ($value)
{
list($j,$m,$y) = split('/', $value);
return ("$y-$m-$j");
}	


function traceMsg ($trace)
{

if (!$handle = fopen('/tmp/trace.sql', 'a')) {
         echo "Impossible d'ouvrir le fichier ($filename)";
    }
if (fwrite($handle,time()." : ".getenv("REMOTE_ADDR")." : $trace\r\n") === FALSE) {
      echo "Impossible d'écrire dans le fichier ($filename)";
 }
fclose($handle);
}

function tdcolor ($val,$trunc,$limitb,$limith,$color)
{
if ( $limitb != $limith )
	{
	if ( $val > $limith  )
		{
		$text ="<span style='color:green ; font-weight:bold'>";
		}
	else if ( $val < $limitb )
	 	{
	        $text ="<span style='color:red ; font-weight:bold'>";
	        }
	else
	 	{
        	$text ="<span>";
	        }
	}
else
	{
	$text ="<span>";
	}

//echo "<td bgcolor='$color' align='right' height='16' width='55'>".$text.roundM($val,$trunc)."</span></td>";
echo "<td bgcolor='$color' align='right' height='16' width='80'>".$text.number_format($val,$trunc,'.',' ')."</span></td>";
}
function roundM($val,$rnd)
{
$val=round($val,$rnd);
return $val;
}

function last_mod ()
{
	echo "<span class=\"Style14\"><b>";
     	echo "* Modification apportees<br>";
     	echo "30/09/08 : CA 2007 EOB<br>";
     	echo "26/11/08 : CA 2007 UNT<br>";
     	echo "22/01/09 : CA 2008 UNT<br>";
     	echo "22/01/09 : BUDGET 2009<br>";
	echo "</span></b>";
}


?>  
