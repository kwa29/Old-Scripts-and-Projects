<?
  /* ALGORITME DE CALCUL DES SAISONS -------------------- */
 /* Merci à G. SATRE - Institut de Mécanique Céleste     */
/* Adaptation PHP par Graphys : http://holydays.free.fr */

      $YY=$annee;
	  $CODE1=$YY;

      $k=($YY-2000-1);
      for ($n=0;$n<8;$n++)
      {
      $nn=($n%4);
      $dk=($k+0.25E0*$n);
     $T=(0.21451814e0+0.99997862442e0*$dk
        +0.00642125e0*sin(1.580244e0+0.0001621008e0*$dk)
	  +0.00310650e0*sin(4.143931e0+6.2829005032e0*$dk)
	  +0.00190024e0*sin(5.604775e0+6.2829478479e0*$dk)
	  +0.00178801e0*sin(3.987335e0+6.2828291282e0*$dk)
	  +0.00004981e0*sin(1.507976e0+6.2831099520e0*$dk)
	  +0.00006264e0*sin(5.723365e0+6.2830626030e0*$dk)
	  +0.00006262e0*sin(5.702396e0+6.2827383999e0*$dk)
	  +0.00003833e0*sin(7.166906e0+6.2827857489e0*$dk)
	  +0.00003616e0*sin(5.581750e0+6.2829912245e0*$dk)
	  +0.00003597e0*sin(5.591081e0+6.2826670315e0*$dk)
	  +0.00003744e0*sin(4.3918e0 +12.56578830e0*$dk)
	  +0.00001827e0*sin(8.3129e0 +12.56582984e0*$dk)
	  +0.00003482e0*sin(8.1219e0 +12.56572963e0*$dk)
	  -0.00001327e0*sin(-2.1076e0 +0.33756278e0*$dk)
	  -0.00000557e0*sin(5.549e0   +5.7532620e0*$dk)
	  +0.00000537e0*sin(1.255e0   +0.0033930e0*$dk)
	  +0.00000486e0*sin(19.268e0 +77.7121103e0*$dk)
	  -0.00000426e0*sin(7.675e0   +7.8602511e0*$dk)
	  -0.00000385e0*sin(2.911e0   +0.0005412e0*$dk)
	  -0.00000372e0*sin(2.266e0   +3.9301258e0*$dk)
	  -0.00000210e0*sin(4.785e0  +11.5065238e0*$dk)
	  +0.00000190e0*sin(6.158e0   +1.5774000e0*$dk)
	  +0.00000204e0*sin(0.582e0   +0.5296557e0*$dk)
	  -0.00000157e0*sin(1.782e0   +5.8848012e0*$dk)
	  +0.00000137e0*sin(-4.265e0  +0.3980615e0*$dk)
	  -0.00000124e0*sin(3.871e0   +5.2236573e0*$dk)
	  +0.00000119e0*sin(2.145e0   +5.5075293e0*$dk)
	  +0.00000144e0*sin(0.476e0   +0.0261074e0*$dk)
	  +0.00000038e0*sin(6.45e0   +18.848689e0*$dk)
	  +0.00000078e0*sin(2.80e0    +0.775638e0*$dk)
	  -0.00000051e0*sin(3.67e0   +11.790375e0*$dk)
	  +0.00000045e0*sin(-5.79e0   +0.796122e0*$dk)
	  +0.00000024e0*sin(5.61e0    +0.213214e0*$dk)
	  +0.00000043e0*sin(7.39e0   +10.976868e0*$dk)
	  -0.00000038e0*sin(3.10e0    +5.486739e0*$dk)
	  -0.00000033e0*sin(0.64e0    +2.544339e0*$dk)
	  +0.00000033e0*sin(-4.78e0   +5.573024e0*$dk)
	  -0.00000032e0*sin(5.33e0    +6.069644e0*$dk)
	  -0.00000021e0*sin(2.65e0    +0.020781e0*$dk)
	  -0.00000021e0*sin(5.61e0    +2.942400e0*$dk)
	  +0.00000019e0*sin(-0.93e0   +0.000799e0*$dk)
	  -0.00000016e0*sin(3.22e0    +4.694014e0*$dk)
	  +0.00000016e0*sin(-3.59e0   +0.006829e0*$dk)
	  -0.00000016e0*sin(1.96e0    +2.146279e0*$dk)
	  -0.00000016e0*sin(5.92e0   +15.720504e0*$dk)
	     +0.00000115e0*sin(23.671e0 +83.9950108e0*$dk)
            +0.00000115e0*sin(17.845e0 +71.4292098e0*$dk));

	$JJD=(2451545+$T*365.25e0);
	$JJD+=0.0003472222e0;
	$D=($CODE1/100.0);
	$TETUJ = ((32.23e0*($D-18.30e0)*($D-18.30e0)-15)/86400.e0);
	$JJD-=$TETUJ;
	$dateJJD=$JJD;
   if($JJD<2299160.5e0){
     $Z1=$dateJJD+0.5;
     $Z=floor($Z1);
     $A=$Z;
     $B=$A+1524;
     $C=floor(($B-122.1)/365.25);
     $D=floor(365.25*$C);
     $E=floor(($B-$D)/30.6001);
      $dateJOUR=floor($B-$D-floor(30.6001*$E));
     if($E<13.5){
	 	$dateMOIS = floor($E-1);
		}else{
		$dateMOIS = floor($E-13);
		}
     if($dateMOIS>=3){
	 $dateAN = floor($C-4716);
	 }else{
	 $dateAN = floor($C-4715);
	 }
   }else{
  $Z1=$dateJJD+0.5;
  $Z=floor($Z1);
     if($Z<2299161){
	 $A=$Z;
	 }else{
	 $ALPHA=floor(($Z-1867216.25)/36524.25);
	 $A=$Z+1+$ALPHA-floor($ALPHA/4);
	 }
     $B=$A+1524;
     $C=floor(($B-122.1)/365.25);
     $D=floor(365.25*$C);
     $E=floor(($B-$D)/30.6001);
     $dateJOUR=floor($B-$D-floor(30.6001*$E));
     if($E<13.5){
	 $dateMOIS = floor($E-1);
	 }else{
	 $dateMOIS = floor($E-13);
	 }
     if($dateMOIS>=3){
	 $dateAN = floor($C-4716);
	 }else{
	 $dateAN = floor($C-4715);
	 }
   }
   if ($dateAN==$CODE1){
  $FDJ=($dateJJD+0.5E0)-Math.floor($dateJJD + 0.5E0);
  $HH=Math.floor($FDJ*24);
  $FDJ-=$HH/24.0;
  $MM=Math.floor($FDJ*1440);
$saisons=$saisons.$dateJOUR;
   }
   }
$printemps="$saisons[0]$saisons[1]";
$ete="$saisons[2]$saisons[3]";
$automne="$saisons[4]$saisons[5]";
$hiver="$saisons[6]$saisons[7]";

// ---------- AFFICHAGE SI PREMIER JOUR DE LA SAISON ---


if($lejour==$printemps AND $lemois=="03"){ $resultat="Printemps - $resultat";}
if($lejour==$ete AND $lemois=="06"){ $resultat="Eté - $resultat";}
if($lejour==$automne AND $lemois=="09"){ $resultat="Automne - $resultat";}
if($lejour==$hiver AND $lemois=="12"){ $resultat="Hiver - $resultat";}

// ---------- AFFICHAGE DE LA SAISON -------------------

/* (supprimez les // qui se trouvent devant les 4 lignes ci-dessous
     pour afficher l'icône des saisons en permanence...) */


// if(($lejour>=$printemps AND $lemois==3) OR ($lemois>3 AND $lemois<6) OR ($lejour<$ete AND $lemois==6)){ $altimg="C'est le Printemps en ce moment :-)"; $icone="printemps.gif";}
// if(($lejour>=$ete AND $lemois==6) OR ($lemois>6 AND $lemois<9) OR ($lejour<$automne AND $lemois==9)){ $altimg="C'est l'Eté en ce moment :-)"; $icone="ete.gif";}
// if(($lejour>=$automne AND $lemois==9) OR ($lemois>9 AND $lemois<12) OR ($lejour<$hiver AND $lemois==12)){ $altimg="C'est l'Automne en ce moment :-)"; $icone="automne.gif";}
// if(($lejour>=$hiver AND $lemois==12) OR ($lemois>0 AND $lemois<3) OR ($lejour<$printemps AND $lemois==3)){ $altimg="C'est l'Hiver en ce moment :-)"; $icone="hiver.gif";}


?>