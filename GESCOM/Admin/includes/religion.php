<?
  /* GESTION DES FETES RELIGIEUSES ***********************************/
 /* Merci � la communaut� des d�veloppeurs PHP - http://www.php.net */

function paquescalc($annee) {

         $G = $annee % 19;
        $C = (int)($annee / 100);
         $H = (int)($C - ($C / 4) - ((8*$C+13) / 25) + 19*$G + 15) % 30;
         $I = (int)$H - (int)($H / 28)*(1 - (int)($H / 28)*(int)(29 / ($H + 1))*((int)(21 - $G) / 11));
        $J = ($Year + (int)($annee/4) + $I + 2 - $C + (int)($C/4)) % 7;
         $L = $I - $J;
         $m = 3 + (int)(($L + 40) / 44);
         $d = $L + 28 - 31 * ((int)($m / 4));
         $y = $annee;
         $E = mktime(0,0,0, $m, $d, $y);
        return $E;
   }
$paques=paquescalc($annee);
//------------------ FETES MOBILES ----------------------
// Epiphanie
for($i=2;$i<=8;$i++){
$epiphanitest=mktime(0,0,0, 1, $i, $annee);
$testjour=date("w", $epiphanitest);
if($testjour=="0"){break;}
}
$jourepiphanie=date("d", $epiphanitest);
$moisepiphanie=date("m", $epiphanitest);
// Mardi gras
$heuremardigras=date("H", $paques-4060800);
if($heuremardigras==23){$x_mg=4057200;}else{$x_mg=4060800;}
$jourmardigras=date("d", $paques-$x_mg);
$moismardigras=date("m", $paques-$x_mg);
// Cendres
$heurecendres=date("H", $paques-3974400);
if($heurecendres==23){$x_cn=3970800;}else{$x_cn=3974400;}
$jourcendres=date("d", $paques-$x_cn);
$moiscendres=date("m", $paques-$x_cn);
// Car�me
$heurecareme=date("H", $paques-3628800);
if($heurecareme==23){$x_ca=3625200;}else{$x_ca=3628800;}
$jourcareme=date("d", $paques-$x_ca);
$moiscareme=date("m", $paques-$x_ca);
// Mi-Car�me
$heuremicareme=date("H", $paques-2073600);
if($heuremicareme==23){$x_mi=2070000;}else{$x_mi=2073600;}
$jourmicareme=date("d", $paques-$x_mi);
$moismicareme=date("m", $paques-$x_mi);
// Rameaux
$jourrameaux=date("d", $paques-604800);
$moisrameaux=date("m", $paques-604800);
// Vendredi Saint
$jourvendsaint=date("d", $paques-172800);
$moisvendsaint=date("m", $paques-172800);
// P�ques
$jourpaques=date("d", $paques);
$moispaques=date("m", $paques);
// Ascension
$jourascension=date("d", $paques+3369600);
$moisascension=date("m", $paques+3369600);
// Pentec�te
$jourpentecote=date("d", $paques+4233600);
$moispentecote=date("m", $paques+4233600);
// Trinit�
$jourtrinite=date("d", $paques+4838400);
$moistrinite=date("m", $paques+4838400);
// F�te Dieu
$jourfetedieu=date("d", $paques+5443200);
$moisfetedieu=date("m", $paques+5443200);
// Sacr� Coeur
$joursacrecoeur=date("d", $paques+5875200);
$moissacrecoeur=date("m", $paques+5875200);
// Avent
$noel=mktime(0,0,0, 12, 25, $annee);
$joursemnoel=date("w", $noel);
$dimcalc=25;
if($joursemnoel!="0"){
	for($i=-$joursemnoel;$i<0;$i++){
	$dimcalc=$dimcalc-1;
	}
}else{$dimcalc=$dimcalc-7;}
$aventcalc=mktime(0,0,0, 12, $dimcalc, $annee);
$avent=$aventcalc-1814400;
$jouravent=date("d", $avent);
$moisavent=date("m", $avent);
// F�te du christ roi
$christroi=$avent-604800;
$jourchristroi=date("d", $christroi);
$moischristroi=date("m", $christroi);
// F�te de la Sainte Famille
if($joursemnoel!="0"){
for($x=25;$x<=31;$x++){
$familletest=mktime(0,0,0, 12, $x, $annee);
$testjourfam=date("w", $familletest);
if($testjourfam=="0"){break;}
}
$jourstefamille=date("d", $familletest);
$moisstefamille=date("m", $familletest);
}
//------------------ FETES FIXES -----------------
// F�te de Marie, m�re de Dieu
$jourmariemere="01"; $moismariemere="01";
// F�te de la Presentation du Christ
$jourpresenta="02"; $moispresenta="02";
// F�te de Notre Dame de Lourdes
$jourlourdes="11"; $moislourdes="02";
// F�te de l'Annonciation
$jourannoncia="25"; $moisannoncia="03";
// F�te de la Visitation
$jourvisita="31"; $moisvisita="05";
// F�te de Notre Dame du Mont Carmel
$journdcarmel="16"; $moisndcarmel="07";
// F�te de l'Assomption de la Vierge
$jourassompt="15"; $moisassompt="08";
// F�te de la Nativit� de la Vierge
$journativit="08"; $moisnativit="09";
// F�te de Notre Dame des Douleurs
$journdouleur="15"; $moisndouleur="09";
// F�te des Archanges Michel-Gabriel-Rapha�l
$jourarchan="29"; $moisarchan="09";
// F�te des Anges Gardiens
$jourgardiens="02"; $moisgardiens="10";
// F�te de Notre Dame du Rosaire
$journdrosaire="07"; $moisndrosaire="10";
// F�te de la Pr�sentation de Marie
$jourpres="21"; $moispres="11";
// F�te de l'Immacul�e Conception
$jourimaconcept="08"; $moisimaconcept="12";
// F�te de la Naissance du Christ
$jourdenoel="25"; $moisdenoel="12";

// ---------- AFFICHAGE SI CORRESPONDANCE ---
if($lejour==$jourmariemere AND $lemois==$moismariemere){ $resultat="F�te de Marie, m�re du Christ";}
if($lejour==$jourpresenta AND $lemois==$moispresenta){ $resultat="Pr�sentation du Christ au Temple";}
if($lejour==$jourlourdes AND $lemois==$moislourdes){ $resultat="F�te de ND de Lourdes - St S�verin";}
if($lejour==$jourannoncia AND $lemois==$moisannoncia){ $resultat="F�te de l'Annonciation";}
if($lejour==$jourvisita AND $lemois==$moisvisita){ $resultat="F�te de la visitation de la Vierge";}
if($lejour==$jourassompt AND $lemois==$moisassompt){ $resultat="F�te de l'Assomption de la Vierge";}
if($lejour==$journdcarmel AND $lemois==$moisndcarmel){ $resultat="F�te de ND du Mont Carmel";}
if($lejour==$journativit AND $lemois==$moisnativit){ $resultat="F�te de la Nativit� de la Vierge";}
if($lejour==$jourarchan AND $lemois==$moisarchan){ $resultat="F�te des Archanges Michel-Gabriel-Rapha�l";}
if($lejour==$journdouleur AND $lemois==$moisndouleur){ $resultat="F�te de ND des Douleurs";}
if($lejour==$jourgardiens AND $lemois==$moisgardiens){ $resultat="F�te des Anges Gardiens";}
if($lejour==$journdrosaire AND $lemois==$moisndrosaire){ $resultat="F�te de ND du Rosaire";}
if($lejour==$jourpres AND $lemois==$moispres){ $resultat="F�te de la Pr�sentation de la Vierge";}
if($lejour==$jourimaconcept AND $lemois==$moisimaconcept){ $resultat="F�te de l'Immacul�e Conception";}
if($lejour==$jourdenoel AND $lemois==$moisdenoel){ $resultat="F�te de la naissance du Christ";}
if($lejour==$jourchristroi AND $lemois==$moischristroi){ $resultat="F�te du Christ Roi";}
if($lejour==$jourstefamille AND $lemois==$moisstefamille){ $resultat="F�te de la Sainte Famille";}

if($lejour==$jourepiphanie AND $lemois==$moisepiphanie){ $resultat="F�te de l'Epiphanie";}
if($lejour==$jourmardigras AND $lemois==$moismardigras){ $resultat="F�te du Mardi gras";}
if($lejour==$jourcendres AND $lemois==$moiscendres){ $resultat="Journ�e des Cendres";}
if($lejour==$jourcareme AND $lemois==$moiscareme){ $resultat="Premier jour du Car�me";}
if($lejour==$jourmicareme AND $lemois==$moismicareme){ $resultat="F�te de la Mi-Car�me";}
if($lejour==$jourrameaux AND $lemois==$moisrameaux){ $resultat="F�te des Rameaux";}
if($lejour==$jourvendsaint AND $lemois==$moisvendsaint){ $resultat="Jour du Vendredi Saint";}
if($lejour==$jourpaques AND $lemois==$moispaques){ $resultat="F�te de la R�surrection du Christ";}
if($lejour==$jourascension AND $lemois==$moisascension){ $resultat="F�te de l'Ascension";}
if($lejour==$jourpentecote AND $lemois==$moispentecote){ $resultat="F�te de la Pentec�te";}
if($lejour==$jourfetedieu AND $lemois==$moisfetedieu){ $resultat="Jour de la F�te Dieu";}
if($lejour==$jourtrinite AND $lemois==$moistrinite){ $resultat="F�te de la Sainte Trinit�";}
if($lejour==$joursacrecoeur AND $lemois==$moissacrecoeur){ $resultat="F�te du Sacr� Coeur";}
if($lejour==$jouravent AND $lemois==$moisavent){ $resultat="Premier jour de l'Avent";}

?>