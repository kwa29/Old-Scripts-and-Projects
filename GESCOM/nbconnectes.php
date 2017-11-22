<?
//---------------------------------------------------------------------------------------------------
// 	VARIABLES PARAMETRABLES
//---------------------------------------------------------------------------------------------------
// laps de temps en secondes oЫ un visiteur est considИrИ comme connectИ
// Time in seconds while a visitor is considered as connected
$laps=300;
// Nom du repertoire contenant les fichiers de stats (ip.txt et record.txt)
// Name of the data directory
$repstats="Admin/Connection_temp";


//----------------------------------------------------------------------------------------------------
//	FONCTIONS
//----------------------------------------------------------------------------------------------------

// Erreur
function erreur($code)
	{
	global $repstats;
	switch($code)
		{
		case 1;
		echo "document.write(\"Erreur de creation du r&eacute;pertoire <b>$repstats</b><br>Error : Impossible to create directory <b>$repstats</b>\");";
		break;

		case 2;
		echo "document.write(\"Erreur de creation des fichiers TXT dans <b>$repstats</b><br>Error : Impossible to create TXT files into <b>$repstats</b>\");";
		break;
		}
	exit;
	}


//---------------------------------------------------------------------------------------------------
//	PROGRAMME
//---------------------------------------------------------------------------------------------------

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

// Temps actuel en secondes
$now=time();

// Creation du repertoire $repstats s'il n'existe pas
if(!is_dir("$repstats")) 
	{
	if(!@mkdir("$repstats",0755)) {erreur(1);}
	}
	
// Mise a jour du fichier du visiteur dans le cas [hide|show]	
if ($action=="show"||$action=="hide")
	{
	// Nom du fichier du visiteur encours
	$fichier="$repstats/$REMOTE_ADDR.txt";
	
	// Mise a jour (date de modification du fichier utilisee) ou creation du fichier du visiteur
	$fp=@fopen("$fichier","w");
	if(!$fp) {erreur(2);}
	fputs($fp,"");
	fclose($fp);		
	
	// Suppresion des fichiers et comptage du nombre de fichiers
	$nb=0;
	$handle=opendir("$repstats");
	while ($tmp = readdir($handle))
		{
		if($tmp!="." && $tmp!=".." && $tmp!="record.txt") 
			{
			if(filemtime("$repstats/$tmp")+$laps<$now) {@unlink("$repstats/$tmp");} 
			else {$nb++;}
			}
		}
	closedir($handle);
	
	// LECTURE DU RECORD POUR VERIFICATION SI SCORE BATTU
	$new_record="";
	if(file_exists("$repstats/record.txt"))
		{
		$fp=@fopen("$repstats/record.txt","r");
		if(!$fp) {erreur(2);}
		while (!feof ($fp))
			{
			list ($cpt_tmp, $date_tmp)=split("\|",fgets($fp, 4096));
			if($cpt_tmp<=$nb) {$new_record="$nb|$now";}
			}
		fclose ($fp);
		}
	else 
		{
		// Creation du fichier record pour la premiere fois
		$fp=@fopen("$repstats/record.txt","w");
		if(!$fp) {erreur(2);}
		fputs($fp,"$nb|$now");
		fclose($fp);	
		}
	
	// Ecriture du fichier record si score battu
	if($new_record!="")
		{
		$fp=@fopen("$repstats/record.txt","w");
		if(!$fp) {erreur(2);}
		fputs($fp,"$new_record");
		fclose($fp);	
		}
	
	// Affichage du nombre de connectes
	if($action=="show") 
	{
	if ($nb == 1){echo "document.write(\"Il y a actuellement $nb connecté sur le site.\");";}
	else {echo "document.write(\"Il y a actuellement $nb connectés sur le site.\");";}
	}
	}

//----------------------------------------------------------------------------------------------------
//	CAS : ON CONSULTE LE MEILLEUR SCORE
//----------------------------------------------------------------------------------------------------

else if($action=="admin")
	{
	// LECTURE DU RECORD
	if(file_exists("$repstats/record.txt"))
		{
		$fp=@fopen("$repstats/record.txt","r");
		if(!$fp) {erreur(2);}
		while (!feof ($fp))
			{
			$buffer = fgets($fp, 4096);
			list ($cpt, $date)=split('\|',$buffer);
			$date=date("d/m/Y Ю H:i",$date);
			echo 	"<HTML>
				    <HEAD>
				      <TITLE>Score Ю battre</TITLE>
				    </HEAD>
				    <BODY>
				       <FONT face=\"Verdana\" size=\"2\">
				       Votre record est : $cpt visiteurs simultanés le $date !
				       </FONT>
				    </BODY>
				 </HTML>";
			}
		fclose ($fp);
		}
	
	// SI LE FICHIER N'EXISTE PAS
	else
		{
		echo 	"<HTML>
			<HEAD>
			<TITLE>Nombre de connectИs</TITLE>
			</HEAD>
			<BODY>
			Le fichier des records n'a pas encore été crée.<br>
			Vous devez appeler le script par la mИthode Javascript.<br>
			</BODY>
			</HTML>";
		}
	}
?>