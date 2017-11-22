<?php
// Connection a la base de donnée Mysql
$nomhote="localhost";      // nom de l'hôte
$identifiant="root";       // votre nom d'utilisateur
$motdepasse="2#tB(5K";  // votre mot de passe 

// Fonction de redirection HTTP
function redirect_url($url) 
{
echo "<script language=JavaScript>";
echo "document.location.href='".$url."';";
echo "</script>";
}

// Transformation de la date au format MySQL pour insertion
function transformmysql_date($date_origine)
{
$tmpdate = explode( "/", $date_origine);
// on surf le tableau dans l'ordre inverse en admetant que l'année est toujours à la fin
for($i=(count($tmpdate)-1);$i>=0;$i--)
	{
// si la valeur est d'un seul chiffre ça rajoute un 0 devant (utile pour les mois ou les jours d'un chiffre)
    if(strlen($tmpdate[$i])<2)
    @$tmpdate[$i] = "0".$tmpdate[$i];
    @$tmp_final_date .= $tmpdate[$i];
    if($i>0)
    @$tmp_final_date .= "-";
	}
return @$tmp_final_date;
}

// Transformation de la date MySQL pour affichage en jj/mm/aa
function transforme_date($date_origine)
{
// exploser la date dans un tableau en fonction du motif '-'
@$tmpdate = explode( "-", $date_origine);
// Marche bien meme tres bien ce petit code
for($i=(count($tmpdate)-1);$i>=0;$i--)
	{
	$tmpdate[0]=str_replace("20", "", $tmpdate[0]);
	$tmp_final_date .= $tmpdate[$i];
	//$tmp_final_date .= substr($tmpdate[0],2,4);
	// si on passe un rang on place les séparateurs '/'
    if($i>0)
    $tmp_final_date .= "/";
	}
return @$tmp_final_date;
}

// Transformation de la date MySQL pour affichage
function transformfrench_date($date_origine)
{
// exploser la date dans un tableau en fonction du motif '-'
@$tmpdate = explode( "-", $date_origine);
// on surffe le tableau dans l'ordre inverse car l'année est toujours au début et le jour à la fin
for($i=(count($tmpdate)-1);$i>=0;$i--)
	{
	@$tmp_final_date .= $tmpdate[$i];
	// si on passe un rang on place les séparateurs '/'
    if($i>0)
    $tmp_final_date .= "/";
	}
return @$tmp_final_date;
}

// Fonction sur les dates pour le fichier texte Statistique
function affichedate()
{
$date = date("d/m/Y");	// Date actuelle
$heure = date("H:i");	// Heure courante
$total = "Le ".$date." à ".$heure;
return $total;
}

// Encryptage de l'Url des variables
function crypte($co)   
{
$co = unserialize(urldecode(stripslashes($co)));
return $co;
}

// Suppression des espaces dans une chaine de caractere
function espace($tex)
{
  return(str_replace(" ","",$tex));
}

// Suppression de la ponctuaction
function point($tex)
{
  $v=substr_replace($tex,'',-3);
  return(substr_replace($v,'.',-2,0));
}

// Calcul d'une somme
function somme() 
{   
global $a, $b;    $b = $a + $b;
return $b;
}

// Retourne une date au format 01/01/01
function dd($date) 
{
   return date("d/m/Y H:i:s",$date);
}

// Transformation du format timestamp de MySQL en kelkechose de compréhensible
function mysql_mktime($timestamp)
{ 
 $hour = substr($timestamp, 8, 2); 
 $minute = substr($timestamp, 10, 2); 
 $second = substr($timestamp, 12, 2); 
 $month = substr($timestamp, 4, 2); 
 $day = substr($timestamp, 6, 2); 
 $year = substr($timestamp, 0, 4); 
 return mktime($hour, $minute, $second, $month, $day, $year);   
}

// Calcul d'un pourcentage avec arrondissement a la 2 virgule
function pourcentage($nombre, $pourcent)
{
	$nombre = str_replace(",",".",$nombre);
	$pourcent = str_replace(",",".",$pourcent);
	
	$nbr = ($nombre * $pourcent) / 100;
	$nbr = $nombre - $nbr;
	$nbr = number_format($nbr,2,',','');
	return $nbr;
}
// Calcul d'un pourcentage pour la tva avec arrondissement a la 2 virgule
function pourcentage_statistique($nombre, $pourcent)
{
	$nombre = str_replace(",",".",$nombre);
	$pourcent = str_replace(",",".",$pourcent);
	
	$nbr = ($nombre - $pourcent) / 100;
	$nbr = number_format($nbr,2,',','');
	return $nbr;
}

// Calcul un pourcentage. Retourne un nombre arrondi à $decimales chiffres après la virgule.
function pourcent($nombre, $total, $decimales)
{
if($total <= 0) return 0;
else return round($nombre*100/$total, $decimales);
}

// Calcul d'une somme pour une requete
function somme_requete($a, $b) 
{   
$b = $b + $a;
return $b;
}

/*
 LISTE DES FONCTIONS

NbAttaques($logfile) <-- Inspirée d'un script de ??? (euh, Tranbert, c'est à toi, ça ?)
Renvoie le nombre d'attaques Nimda (et CodeRed) subies par le serveur

TailleOctets($ko, $decimales = 2)
Renvoie une taille en Ko, Mo, Go... à partir d'une taille en Ko. La valeur $décimalesn'est pas obligatoire, elle sera mise à 2 par défaut.
Ex : echo TailleOctets(2653); --> 2.59 Mo

Uptime() <-- Inspirée de phpSysInfo
Renvoie l'uptime du serveur.

BestUptime() <-- Inspirée d'un script de Delf
Renvoie le meilleur uptime du serveur stocké dans /var/log/bup.log gràce à bupd. Il s'agit d'un script écrit par Delf. 

Memoire($free_color=0, $used_color=0) <-- Inspirée de phpSysInfo
Renvoie les informations concernant la mémoire du serveur (utilisation, restante, etc...)
On peut lui passer en paramètre deux couleurs : une pour la mémoire libre, l'autre pour la mémoire utilisée.

LoadAverage() <-- Inspirée de phpSysInfo
Renvoie le load-average du serveur.

kernel() <-- Inspirée de phpSysInfo
Renvoie la version du noyau.

Version()
Renvoie la version d'SME.

Service($port,$who) <-- Inspirée d'un script de Delf
Renvoie un booléen indiquant si un port est ouvert.

Services($who,$up_color,$down_color) <-- Inspirée d'un script de Delf
Teste une liste de services sur la machine '$who' et affiche leur statut dans un tableau en utilisant les couleurs passées en paramètre.

FileSystems() <-- Inspirée de phpSysInfo
Renvoie l'état des systèmes de fichiers montés.

Transferts() <-- Inspirée d'un script de Delf
Renvoie la quantité de données transférées sur chaque interface	réseau.
Cet affichage est faux car les valeurs repassent à 0 après 4Go de transfert. Delf travaille à un script contournant ce problème.

Processeur() <-- Inspirée de phpSysInfo
Renvoie les infos sur le(s) processeur(s) (ne fonctionne qu'avec des x86). Les systèmes multi-processeurs sont reconnus.

CartesPCI() <-- Inspirée de phpSysInfo
Renvoie les infos sur les cartes PCI du système

PeriphIDE() <-- Inspirée de phpSysInfo
Renvoie la liste des périphériques IDE du système

TailleRep($rep, $decimales = 2) <-- Inspirée d'un script de Delf
Renvoie la taille d'un répertoire et de ses sous répertoires.
Exemple : TailleRep("/home/e-smith/files/primary/files") renverra la taille du FTP avec 2 décimales.

start_time() et print_time($start_time) <-- Delf
Ces deux fonctions permettent d'afficher le temps qu'a mis le serveur à générer la page.
Je vous recommande de recopier la fonction start_time() au tout début de votre page (pas d'include) 
afin d'avoir un résultat le plus juste possible. 
Elle renvoie une valeur que vous n'aurez qu'à repasser à print_time() à la fin de votre page afin que celle ci affiche le temps passé à 
générer la page.

*/

function NbAttaques($file)
{
// Fichier utilisé sous SME : /var/log/httpd/access_log
	$fh = fopen ("$file","r") or die ("Impossible d'accéder au fichier log!");
	
	$cpt1 = 0;
	$cpt2 = 0;
	$cpt3 = 0;
	
	while (!feof ($fh))
	{
		$line = fgets ($fh, 4096);
		if (ereg ("c\+dir",$line)) $cpt1++; //NIMDA
		if (ereg ("default.ida\?NNN",$line)) $cpt2++; //CodeRed
		if (ereg ("default.ida\?XXX",$line)) $cpt3++; //CodeRed2
	}
	fclose ($fh);
	
	$ch = "Nimda : " . $cpt1 . "<br>\nCodeRed : " . $cpt2 . "<br>\nCodeRed II : " . $cpt3 . "<br>\n";
	
	return $ch;
}
	
function TailleOctets($ko, $decimales = 2)
{
  if ($ko > 1048576)
  {
  	$result  = sprintf('%.' . $decimales . 'f', $ko / 1048576);
		$result .= " Go";
	}	
	elseif ($ko > 1024)
	{
		$result  = sprintf('%.' . $decimales . 'f', $ko / 1024);
		$result .= " Mo";
  }
  else
  {
  	$result  = sprintf('%.' . $decimales . 'f', $ko);
   $result .= "Ko";
  }
  return $result;
}

function Uptime()
{
	if (!$fd = fopen('/proc/uptime', 'r')) return "N.A.";

	$ar_buf = split(' ', fgets($fd, 4096));
	fclose($fd);
	$sys_ticks = trim($ar_buf[0]);
	$min   = $sys_ticks / 60;
	$hours = $min / 60;
	$days  = floor($hours / 24);
	$hours = floor($hours - ($days * 24));
	$min   = floor($min - ($days * 1440) - ($hours * 60));
	if ($days != 0) $uptime .= "$days jour(s) ";
	if ($hours != 0) 	$uptime .= "$hours heure(s) ";
	if ($min != 0) $uptime .= "$min minute(s)";
	
	return $uptime;
}

function BestUptime()
{
	if (!$file = @fopen("/var/log/bupd.log", "r")) 	return "N.A.";
	while (!feof($file)) $upt_s .= trim(fgets($file, 16));
	fclose($file);
	$nb_days = 0;
	$nb_hours = 0;
	$nb_minutes = 0;
	if ($upt_s >= 86400.)
	{
		$tmp = $upt_s % 86400;
		$nb_days = ($upt_s - $tmp) / 86400;
		$upt_s = $upt_s % 86400;
	}
	if ($upt_s >= 3600.) 
	{
		$tmp = $upt_s % 3600;
		$nb_hours = ($upt_s - $tmp) / 3600;
		$upt_s = $upt_s % 3600;
	}
	if ($upt_s >= 60.) 
	{
		$tmp = $upt_s % 60;
		$nb_minutes = ($upt_s - $tmp) / 60;
	}
	if ($nb_days > 0) $ch = "$nb_days jour(s) ";
	if ($nb_hours > 0) $ch .= "$nb_hours heure(s) ";
	if ($nb_minutes > 0) $ch .= "$nb_minutes minute(s)";
	return $ch;
}

function Memoire($free_color=0, $used_color=0)
{
	if ($fd = fopen('/proc/meminfo', 'r'))
	{
		while ($buf = fgets($fd, 4096)) 
		{
			if (preg_match('/Mem:\s+(.*)$/', $buf, $ar_buf))
			{
				$ar_buf = preg_split('/\s+/', $ar_buf[1], 6);
				$results['ram'] = array();
				$results['ram']['total']   = $ar_buf[0] / 1024;
				$results['ram']['used']    = $ar_buf[1] / 1024;
				$results['ram']['free']    = $ar_buf[2] / 1024;
				$results['ram']['shared']  = $ar_buf[3] / 1024;
				$results['ram']['buffers'] = $ar_buf[4] / 1024;
				$results['ram']['cached']  = $ar_buf[5] / 1024;
				$results['ram']['t_used']  = $results['ram']['used'] - $results['ram']['cached'] - $results['ram']['buffers'];
				$results['ram']['t_free']  = $results['ram']['total'] - $results['ram']	['t_used'];
				$results['ram']['percent'] = round(($results['ram']['t_used'] * 100) / $results['ram']['total'], 2);
			}
		}
		fclose($fd);
	}
	else
	{
		$results['ram'] = array();
		$results['swap'] = array();
		$results['devswap'] = array();
	}
	
	$libre = round(($results['ram']['t_free'] / 1024), 2);
	$utilisee = round(($results['ram']['t_used'] / 1024), 2);
	$percent = $results['ram']['percent'];
		
	$retour = "Libre : ";
	if($free_color) $retour .= "<font color=\"$free_color\">" . $libre . "</font> Mo - ";
	else $retour .= $libre . " Mo - ";
			
	$retour .= "Utilisée : ";
	if($used_color) $retour .= "<font color=\"$used_color\">" . $utilisee . "</font> Mo - ";
	else $retour .= $utilisee . " Mo - ";
		
	$retour .= "($percent% utilisés)";
	
	return $retour;
}

function LoadAverage()
{
	if (!($fd = fopen('/proc/loadavg', 'r'))) return "N.A. - N.A. - N.A.";

	$result = split(' ', fgets($fd, 4096));
	fclose($fd);	
	return "$result[0] - $result[1] - $result[2]";
}

function kernel()
{
	if ($fd = fopen('/proc/version', 'r'))
	{
  	$buf = fgets($fd, 4096);
   fclose($fd);
   if (preg_match('/version (.*?) /', $buf, $ar_buf))
   {
   	$result = $ar_buf[1];
			if (preg_match('/SMP/', $buf)) $result .= ' (SMP)';
   }
   else $result = 'N.A.';
	}
	else $result = 'N.A.';
	return $result;
}

function Version()
{
	$sortie = "Mitel " . exec("rpm -q SMEServer") . " (Linux " . kernel() . ")";
	return $sortie;
}	

function Service($port,$who)
{
	$fp = fsockopen($who, $port, &$errno, &$errstr, 4);
	if (!$fp) return 0;
	fclose($fp);
	return 1;
}
	
function Services($who,$up_color,$down_color)
{
	$nb_colonnes = 4;
	$services = array(21 => "Serveur FTP",
	                  22 => "Serveur SSH",
	                  23 => "Serveur Telnet",
	                  25 => "Serveur SMTP",
	                  53 => "Serveur DNS",
	                  80 => "Serveur HTTP",
	                  110 => "Serveur POP",
	                  119 => "Serveur NNTP",
	                  139 => "Serveur Samba",
	                  143 => "Serveur IMAP",
	                  389 => "Serveur LDAP",
	                  443 => "Serveur HTTPS",
	                  980 => "Server-Manager",
	                  981 => "Server Manager SSL",
	                  3128 => "Serveur SQUID",
	                  3306 => "Serveur MySQL");

	$l = 0;
	echo "<table><tr>\n";
	foreach($services as $service => $nom)
	{
		if((!($l % $nb_colonnes)) && $l) echo "\t</tr><tr>";
		echo "\t<td align = \"center\">";
		if(Service($service, $who)) echo "<font color=\"$up_color\">UP</font>";
		else echo "<font color=\"$down_color\">DOWN</font>";
		echo "</td><td> $nom ($service)</td>\n";
		$l++;
	}
	echo "\t</tr></table>\n";
}

function FileSystems()
{
	$lignes = array();
	$ch = "";
	exec("df -k",$lignes);
	sort($lignes);
	foreach($lignes as $ligne)
	{
		$arg[0] = strtok($ligne, ' ');
		for($i = 1 ; $i != 6 ; $i++) $arg[$i] = strtok(' ');
	
		$filesystem = $arg[0];
		$size = $arg[1];
		$used = $arg[2];
		$avail = $arg[3];
		$use = $arg[4];
		$mount = $arg[5];
	
		if(strstr($filesystem, "/dev"))
		{
			$ch .= $filesystem . " monté sur '" . $mount . "', ";
			$ch .= TailleOctets($used,1) . " utilisés sur " . TailleOctets($size,1) . " (" . $use . ")<br>";
		}
	}	
	return $ch;
}

function Transferts()
{
	exec ("ifconfig eth0 |egrep 'RX bytes' | cut -f2 -d':' | cut -f1 -d' '", $cur_dl_eth0);
	exec ("ifconfig eth0 |egrep 'RX bytes' | cut -f3 -d':' | cut -f1 -d' '", $cur_up_eth0);
	exec ("ifconfig eth1 |egrep 'RX bytes' | cut -f2 -d':' | cut -f1 -d' '", $cur_dl_eth1);
	exec ("ifconfig eth1 |egrep 'RX bytes' | cut -f3 -d':' | cut -f1 -d' '", $cur_up_eth1);
	$cur_dl_eth0[0] = round($cur_dl_eth0[0] / 1073741824, 2);
	$cur_up_eth0[0] = round($cur_up_eth0[0] / 1073741824, 2);
	$cur_dl_eth1[0] = round($cur_dl_eth1[0] / 1073741824, 2);
	$cur_up_eth1[0] = round($cur_up_eth1[0] / 1073741824, 2);
	$ch = "Download: " . $cur_dl_eth0[0] . " Go - " . "Upload: " . $cur_up_eth0[0] . " Go.<br>";
	$ch .= "Download: " . $cur_dl_eth1[0] . " Go - " . "Upload: " . $cur_up_eth1[0] . " Go.";
		
	return $ch;
}

function TransfertsNUD($interface,$up_color,$down_color)
{
	$file = "/var/log/nud.log";
	if (!is_file($file)) $ch = "N.A.";
	else {
	$dl_eth0 = exec("cat $file | grep nb_reset_dl_" . $interface . " | cut -f2 -d':'");
	$up_eth0 = exec("cat $file | grep nb_reset_up_" . $interface . " | cut -f2 -d':'");
	$cur_dl_eth0 = exec ("ifconfig " . $interface . " |egrep 'RX bytes' | cut -f2 -d':' | cut -f1 -d' '");
	$cur_up_eth0 = exec ("ifconfig " . $interface . " |egrep 'RX bytes' | cut -f3 -d':' | cut -f1 -d' '");
	$cur_dl_eth0 = round($cur_dl_eth0 / 1073741824, 2);
	$cur_up_eth0 = round($cur_up_eth0 / 1073741824, 2);
	$ch = "$interface : Download: <font color=\"$down_color\">" . ($dl_eth0 * 4 + $cur_dl_eth0) . "</font> Go - " . "Upload: <font 	color=\"$up_color\">" . ($up_eth0 * 4 + $cur_up_eth0) . "</font> Go";
	}
	
	return $ch;
}


function Processeur()
{
	if ($fd = fopen('/proc/cpuinfo', 'r'))
	{
		while ($buf = fgets($fd, 4096))
		{
			list($key, $value) = preg_split('/\s+:\s+/', trim($buf), 2);

			switch ($key)
			{
				case 'model name':
						$modele = $value;
						break;
				case 'cpu MHz':
						$mhz = $value;
						break;
				case 'cache size':
						$cache = $value;
						break;
				case 'bogomips':
						$bogomips += $value;
						break;
				case 'processor':
						$nb_cpus += 1;
						break;
			}
		}
		fclose($fd);
		
		$ch = $nb_cpus . " " . $modele . " (" . $cache . " cache) @ " . $mhz . "Mhz ";
		$ch .= "(" . $bogomips . " bogomips)";
	}
	else $ch = "N.A.";
	
	return $ch;
}

function CartesPCI()
{
	$results = array();
	if($fd = fopen('/proc/pci', 'r'))
	{
		while($buf = fgets($fd, 4096))
		{
			if(preg_match('/Bus/', $buf))
			{
				$device = 1;
				continue;
			}
			if($device)
			{
				list($type, $carte) = split(': ', $buf, 2);

				if(!preg_match('/bridge/i', $type) && !preg_match('/USB/i', $type) && !preg_match('/Capable/i', $type))
				{
					$carte = preg_replace('/\([^\)]+\)\.$/', '', trim($carte));
					$ch .= $type . " : " . $carte . "<br>\n";
				}
				$device = 0;
			}
		}
	}
	return $ch;
}

function PeriphIDE()
{
	$retour ="";

	$handle = opendir('/proc/ide');
		
	while ($file = readdir($handle))
	{
		if (preg_match('/^hd/', $file))
		{
			if ($fd = fopen("/proc/ide/$file/model", 'r'))
			{
				$modele = trim(fgets($fd, 4096));
				fclose($fd);
				
				$ch = $file . " : " . $modele;
				
				if ($fd = fopen("/proc/ide/$file/media", 'r'))
				{
					$type = trim(fgets($fd, 4096));
					fclose($fd);
					
					if ($type == 'disk')
					{
						if ($fd = fopen("/proc/ide/$file/capacity", 'r'))
						{
							$capacite = trim(fgets($fd, 4096));
							fclose($fd);
								
							$ch .= " (Capacité : " . TailleOctets($capacite / 2) . ")";
						}
					}
				}
				$retour = $ch . "<br>\n". $retour;
			}
		}
	}
	return $retour;
}

function TailleRep($rep, $decimales = 2)
{
	if(!is_dir($rep)) return "$rep n'est pas un répertoire.";

	$taille = exec("du $rep | tail -1 | awk '{ print $1}'");
	return TailleOctets($taille, $decimales);
}

function start_time()
{
	$time_grab = explode(' ',microtime() ); 
	$start_time = $time_grab[1].substr($time_grab[0], 1); 
	return $start_time; 
}

function print_time($start_time)
{
	$timeparts = explode(' ',microtime() ); 
	$end_time = $timeparts[1].substr($timeparts[0],1); 
	$timing = number_format($end_time - $start_time, 4); 
	echo $timing.' '.$txt['secondes'].'<BR>'; 
	return;
}
?>
