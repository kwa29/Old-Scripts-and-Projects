<?
  /* GESTION DES FETES RELIGIEUSES ***********************************/
 /* Merci à la communauté des développeurs PHP - http://www.php.net */

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
// Carème
$heurecareme=date("H", $paques-3628800);
if($heurecareme==23){$x_ca=3625200;}else{$x_ca=3628800;}
$jourcareme=date("d", $paques-$x_ca);
$moiscareme=date("m", $paques-$x_ca);
// Mi-Carème
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
// Pâques
$jourpaques=date("d", $paques);
$moispaques=date("m", $paques);
// Ascension
$jourascension=date("d", $paques+3369600);
$moisascension=date("m", $paques+3369600);
// Pentecôte
$jourpentecote=date("d", $paques+4233600);
$moispentecote=date("m", $paques+4233600);
// Trinité
$jourtrinite=date("d", $paques+4838400);
$moistrinite=date("m", $paques+4838400);
// Fête Dieu
$jourfetedieu=date("d", $paques+5443200);
$moisfetedieu=date("m", $paques+5443200);
// Sacré Coeur
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
// Fête du christ roi
$christroi=$avent-604800;
$jourchristroi=date("d", $christroi);
$moischristroi=date("m", $christroi);
// Fête de la Sainte Famille
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
// Fête de Marie, mère de Dieu
$jourmariemere="01"; $moismariemere="01";
// Fête de la Presentation du Christ
$jourpresenta="02"; $moispresenta="02";
// Fête de Notre Dame de Lourdes
$jourlourdes="11"; $moislourdes="02";
// Fête de l'Annonciation
$jourannoncia="25"; $moisannoncia="03";
// Fête de la Visitation
$jourvisita="31"; $moisvisita="05";
// Fête de Notre Dame du Mont Carmel
$journdcarmel="16"; $moisndcarmel="07";
// Fête de l'Assomption de la Vierge
$jourassompt="15"; $moisassompt="08";
// Fête de la Nativité de la Vierge
$journativit="08"; $moisnativit="09";
// Fête de Notre Dame des Douleurs
$journdouleur="15"; $moisndouleur="09";
// Fête des Archanges Michel-Gabriel-Raphaël
$jourarchan="29"; $moisarchan="09";
// Fête des Anges Gardiens
$jourgardiens="02"; $moisgardiens="10";
// Fête de Notre Dame du Rosaire
$journdrosaire="07"; $moisndrosaire="10";
// Fête de la Présentation de Marie
$jourpres="21"; $moispres="11";
// Fête de l'Immaculée Conception
$jourimaconcept="08"; $moisimaconcept="12";
// Fête de la Naissance du Christ
$jourdenoel="25"; $moisdenoel="12";

// ---------- AFFICHAGE SI CORRESPONDANCE ---
if($lejour==$jourmariemere AND $lemois==$moismariemere){ $resultat="Fête de Marie, mère du Christ";}
if($lejour==$jourpresenta AND $lemois==$moispresenta){ $resultat="Présentation du Christ au Temple";}
if($lejour==$jourlourdes AND $lemois==$moislourdes){ $resultat="Fête de ND de Lourdes - St Séverin";}
if($lejour==$jourannoncia AND $lemois==$moisannoncia){ $resultat="Fête de l'Annonciation";}
if($lejour==$jourvisita AND $lemois==$moisvisita){ $resultat="Fête de la visitation de la Vierge";}
if($lejour==$jourassompt AND $lemois==$moisassompt){ $resultat="Fête de l'Assomption de la Vierge";}
if($lejour==$journdcarmel AND $lemois==$moisndcarmel){ $resultat="Fête de ND du Mont Carmel";}
if($lejour==$journativit AND $lemois==$moisnativit){ $resultat="Fête de la Nativité de la Vierge";}
if($lejour==$jourarchan AND $lemois==$moisarchan){ $resultat="Fête des Archanges Michel-Gabriel-Raphaël";}
if($lejour==$journdouleur AND $lemois==$moisndouleur){ $resultat="Fête de ND des Douleurs";}
if($lejour==$jourgardiens AND $lemois==$moisgardiens){ $resultat="Fête des Anges Gardiens";}
if($lejour==$journdrosaire AND $lemois==$moisndrosaire){ $resultat="Fête de ND du Rosaire";}
if($lejour==$jourpres AND $lemois==$moispres){ $resultat="Fête de la Présentation de la Vierge";}
if($lejour==$jourimaconcept AND $lemois==$moisimaconcept){ $resultat="Fête de l'Immaculée Conception";}
if($lejour==$jourdenoel AND $lemois==$moisdenoel){ $resultat="Fête de la naissance du Christ";}
if($lejour==$jourchristroi AND $lemois==$moischristroi){ $resultat="Fête du Christ Roi";}
if($lejour==$jourstefamille AND $lemois==$moisstefamille){ $resultat="Fête de la Sainte Famille";}

if($lejour==$jourepiphanie AND $lemois==$moisepiphanie){ $resultat="Fête de l'Epiphanie";}
if($lejour==$jourmardigras AND $lemois==$moismardigras){ $resultat="Fête du Mardi gras";}
if($lejour==$jourcendres AND $lemois==$moiscendres){ $resultat="Journée des Cendres";}
if($lejour==$jourcareme AND $lemois==$moiscareme){ $resultat="Premier jour du Carème";}
if($lejour==$jourmicareme AND $lemois==$moismicareme){ $resultat="Fête de la Mi-Carème";}
if($lejour==$jourrameaux AND $lemois==$moisrameaux){ $resultat="Fête des Rameaux";}
if($lejour==$jourvendsaint AND $lemois==$moisvendsaint){ $resultat="Jour du Vendredi Saint";}
if($lejour==$jourpaques AND $lemois==$moispaques){ $resultat="Fête de la Résurrection du Christ";}
if($lejour==$jourascension AND $lemois==$moisascension){ $resultat="Fête de l'Ascension";}
if($lejour==$jourpentecote AND $lemois==$moispentecote){ $resultat="Fête de la Pentecôte";}
if($lejour==$jourfetedieu AND $lemois==$moisfetedieu){ $resultat="Jour de la Fête Dieu";}
if($lejour==$jourtrinite AND $lemois==$moistrinite){ $resultat="Fête de la Sainte Trinité";}
if($lejour==$joursacrecoeur AND $lemois==$moissacrecoeur){ $resultat="Fête du Sacré Coeur";}
if($lejour==$jouravent AND $lemois==$moisavent){ $resultat="Premier jour de l'Avent";}

?>