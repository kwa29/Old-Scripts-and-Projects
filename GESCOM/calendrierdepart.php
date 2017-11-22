<? include("Admin/sessions.php") ?>
<?
if (@$type == 'modif')
{
// Annee
$annee = "$datechoisi[2]$datechoisi[3]";
// Mois
$mois = "$datechoisi[4]$datechoisi[5]";
// Jour
$jour = "$datechoisi[6]$datechoisi[7]";
// Fenetre popup children avec fermeture + rechargement de la page mere
echo "<html><head>";
echo "<script language='JavaScript1.2'>
 	  opener.document.form1.datedp.value=\"$jour/$mois/$annee\"; 
	  window.location; self.close();	 
	  </script>";
echo "</head></html>";
}
?>
<html>
<head>
<title>Gestion Commerciale SOFIBRA</title>
<link rel="stylesheet" href="sofibra.css" type="text/css">
</head>
<body link="#CE3A05" alink="#CE3A05" vlink="#CE3A05">
<?php
// Affichage d'un calendrier
//require_once 'calendrier.php'; 
echo "<center>";
echo calendar();
echo "</center>";  
/***************************************************************************
             ____  _   _ ____  _              _     _  _   _   _
            |  _ \| | | |  _ \| |_ ___   ___ | |___| || | | | | |
            | |_) | |_| | |_) | __/ _ \ / _ \| / __| || |_| | | |
            |  __/|  _  |  __/| || (_) | (_) | \__ \__   _| |_| |
            |_|   |_| |_|_|    \__\___/ \___/|_|___/  |_|  \___/
            
Description des parametres : 
Ce script est entièrement configurable. Pour ce faire, deux méthodes vous sont proposées : 

- modifier les variables dans calendrier.php 
- créer un tableau $params[] avec les paramètres désirés 

Voici la liste des paramètres associés. Nous utiliserons ici la seconde méthode : 

- $params['calendar_id'] :  Par défaut à 1, incrémenter cette valeur pour utiliser plusieurs calendriers sur la même page.  
- $params['calendar_columns'] :  Par défaut à 7, modifier ce nombre pour diminuer / augmenter le nombres de colonnes. 
- $params['show_day'] :  Par défaut à 1, permet d'afficher les jours (L M M J V S D) 
- $params['show_month'] :  Par défaut à 1, permet d'afficher le nom du mois et l'année en haut 
- $params['nav_link'] :  Par défaut à 1, affiche les liens pour les jours et mois précédents / suivants 
- $params['link_after_date'] :  Par défaut à 0, si activé, affiche les liens de la navigation (cf ci-dessus) pour les dates supérieures au jour en cours 
- $params['link_on_day'] :  Lien à attribuer sur les jours du calendrier. A chaque lien est rajouté la date en argument. Prévoir de mettre '?argument=' en fin de lien 
- $params['font_face'] :  Police a utiliser (par défaut : 'Verdana, Arial, Helvetica') 
- $params['font_size'] :  Taille de la police moyenne en pixels (10 par défaut) 
- $params['bg_color'] :  Couleur du fond des cases des jours (blanc - #FFFFFF par défaut) 
- $params['today_bg_color'] :  Couleur de fond de la case du jour en cours 
- $params['font_today_color'] :  Couleur de la police pour le jour en cours 
- $params['font_color'] :  Couleur de la police 
- $params['font_nav_bg_color'] :  Couleur de fond pour la barre des jours (L M M J V S D) 
- $params['font_nav_color'] :  Couleur de la police pour la barre des jours (L M M J V S D) 
- $params['font_header_color'] :  Couleur de la police pour le nom du mois 
- $params['border_color'] :  Couleur pour les séparation des cases et des bordures 
- $params['use_img'] :  Utilise des fichiers gif à côté du nom du mois et pour la barre de navigation en bas. Si défini à '0', affiche les liens textes. 

***************************************************************************/
function calendar($date = '') {
	Global $link_on_day, $PHP_SELF, $params;
	Global $HTTP_POST_VARS, $HTTP_GET_VARS;
	### Default Params	
	$param_d['calendar_id']			= 1; // Calendar ID
	$param_d['calendar_columns'] 	= 5; // Nb of columns
	$param_d['show_day'] 			= 1; // Show the day bar
	$param_d['show_month']			= 1; // Show the month bar
	$param_d['nav_link']			= 1; // Add a nav bar below
	$param_d['link_after_date']		= 1; // Enable link on days after the current day
	$param_d['link_on_day']			= 'calendrierdepart.php?type=modif&datechoisi='; // Link to put on each day
	$param_d['font_face']			= 'Verdana, Arial, Helvetica'; // Default font to use
	$param_d['font_size']			= 10; // Font size in px
	
	$param_d['bg_color']			= '#EEBF00'; 
	$param_d['today_bg_color']		= '#CE3A05';
	$param_d['font_today_color']	= '#990000';
	$param_d['font_color']			= '#000000';
	$param_d['font_nav_bg_color']	= '#EEBF00';
	
	$param_d['font_nav_color']		= '#FFFFFF';
	$param_d['font_header_color']	= '#FFFFFF';
	$param_d['border_color']		= '#3f6551';
	$param_d['use_img']				= 1; // Use gif for nav bar on the bottom	
	### /Params	
	$monthes_name = array('',
						'Janvier', 
						'Février',
						'Mars', 
						'Avril',
						'Mai', 
	 					'Juin',	
	 					'Juillet',
	 					'Août', 
	 					'Septembre',
	  					'Octobre',
	  					'Novembre', 
	  					'Décembre');
	while (list($key, $val) = each($param_d)) {
		if (isset($params[$key]))
		{
		$param[$key] = $params[$key];
		}
		else {
			$param[$key] = $param_d[$key];
			 }
	}
	$param['calendar_columns'] = ($param['show_day']) ? 7 : $param['calendar_columns'];
	
	$date = priv_reg_glob_calendar('date');
	if ($date == '') 
	{
	$timestamp = time();
	}
	else {
		$month 		= substr($date, 4 ,2);
		$day 		= substr($date, 6, 2);
		$year		= substr($date, 0 ,4);
		$timestamp 	= mktime(0, 0, 0, $month, $day, $year);
		}
	
	$current_day 		= date("d", $timestamp);
	$current_month 		= date('n', $timestamp);
	$current_month_2	= date('m', $timestamp);
	$current_year 		= date('Y', $timestamp);
	$first_day_pos 		= date("w", mktime(0, 0, 0, $current_month, 1, $current_year));
	$first_day_pos 		= ($first_day_pos == 0) ? 7 : $first_day_pos;
	$current_month_name = $monthes_name[$current_month];
	$nb_days_month 		= date("t", $timestamp);
	
	$current_timestamp 	= mktime(23,59,59,date("m"), date("d"), date("Y"));
	
	$output = '<style type="text/css">
				<!--
				.calendarNav'.$param['calendar_id'].' 	{  font-family: '.$param['font_face'].'; font-size: '.($param['font_size']-1).'px; font-style: normal; background-color: '.$param['border_color'].'}
				.calendarTop'.$param['calendar_id'].' 	{  font-family: '.$param['font_face'].'; font-size: '.($param['font_size']+1).'px; font-style: normal; color: '.$param['font_header_color'].'; font-weight: bold;  background-color: '.$param['border_color'].'}
				.calendarToday'.$param['calendar_id'].' {  font-family: '.$param['font_face'].'; font-size: '.$param['font_size'].'px; font-weight: bold; color: '.$param['font_today_color'].'; background-color: '.$param_d['today_bg_color'].';}
				.calendarDays'.$param['calendar_id'].' 	{  font-family: '.$param['font_face'].'; font-size: '.$param['font_size'].'px; font-style: normal; color: '.$param['font_color'].'; background-color: '.$param['bg_color'].'; text-align: center}
				.calendarHeader'.$param['calendar_id'].'{  font-family: '.$param['font_face'].'; font-size: '.($param['font_size']-1).'px; background-color: '.$param['font_nav_bg_color'].'; color: '.$param['font_nav_color'].';}
				.calendarTable'.$param['calendar_id'].' {  background-color: '.$param['border_color'].'; border: 1px '.$param['border_color'].' solid}
				-->
				</style>';
	$output .= '<TABLE border="0" width="180" class="calendarTable'.$param['calendar_id'].'" cellpadding="2" cellspacing="1">'."\n";
	
	### Displaying the current month/year
	if ($param['show_month'] == 1) {
		$output .= '<TR>'."\n";
		$output .= '	<TD colspan="'.$param['calendar_columns'].'" align="center" class="calendarTop'.$param['calendar_id'].'">'."\n";
		### Insert an img at will
		if ($param['use_img'] ) {
			$output .= '<IMG src="images/mois.gif">';
		}
		$output .= '		'.$current_month_name.' '.$current_year."\n";
		$output .= '	</TD>'."\n";
		$output .= '</TR>'."\n";
	}
	
	### Building the table row with the days
	if ($param['show_day'] == 1) {
		$output .= '<TR align="center">'."\n";
		$output .= '	<TD class="calendarHeader'.$param['calendar_id'].'"><B>L</B></TD>'."\n";
		$output .= '	<TD class="calendarHeader'.$param['calendar_id'].'"><B>M</B></TD>'."\n";
		$output .= '	<TD class="calendarHeader'.$param['calendar_id'].'"><B>M</B></TD>'."\n";
		$output .= '	<TD class="calendarHeader'.$param['calendar_id'].'"><B>J</B></TD>'."\n";
		$output .= '	<TD class="calendarHeader'.$param['calendar_id'].'"><B>V</B></TD>'."\n";
		$output .= '	<TD class="calendarHeader'.$param['calendar_id'].'"><B>S</B></TD>'."\n";
		$output .= '	<TD class="calendarHeader'.$param['calendar_id'].'"><B>D</B></TD>'."\n";
		$output .= '</TR>'."\n";	
	}
	else {
		$first_day_pos = 1;	
	}
	
	$output .= '<TR align="center">';
	$int_counter = 0;
	for ($i = 1; $i < $first_day_pos; $i++) {
		$output .= '<TD class="calendarDays'.$param['calendar_id'].'">&nbsp;</TD>'."\n";
		$int_counter++;
	}
	### Building the table
	for ($i = 1; $i <= $nb_days_month; $i++) {
		$i_2 = ($i < 10) ? '0'.$i : $i;		
		
		### Row start
		if ((($i + $first_day_pos-1) % $param['calendar_columns']) == 1 && $i != 1) {
			$output .= '<TR align="center">'."\n";
			$int_counter = 0;
		}
		
		if ($i == $current_day) {
			$output .= '<TD class="calendarToday'.$param['calendar_id'].'" align="center">'.$i.'</TD>'."\n";
		}
		elseif ($param['link_on_day'] != '') {
			$loop_timestamp = mktime(0,0,0, $current_month, $i, $current_year);
			
			if ( ($param['link_after_date'] == 0) && ($current_timestamp < $loop_timestamp)) {
				$output .= '<TD class="calendarDays'.$param['calendar_id'].'">'.$i.'</TD>'."\n";
			}
			else {
				$output .= '<TD class="calendarDays'.$param['calendar_id'].'"><A href="'.$param['link_on_day'].$current_year.$current_month_2.$i_2.'">'.$i.'</A></TD>'."\n";
			}
		}
		else {
			$output .= '<TD class="calendarDays'.$param['calendar_id'].'">'.$i.'</TD>'."\n";
		}	
		$int_counter++;
		
		### Row end
		if ( (($i+$first_day_pos-1) % $param['calendar_columns']) == 0 ) {
			$output .= '</TR>'."\n";	
		}
	}
	$cell_missing = $param['calendar_columns'] - $int_counter;
	
	for ($i = 0; $i < $cell_missing; $i++) {
		$output .= '<TD class="calendarDays'.$param['calendar_id'].'">&nbsp;</TD>'."\n";
	}
	$output .= '</TR>'."\n";
	### Display the nav links on the bottom of the table
	if ($param['nav_link'] == 1) {
		$previous_month = date("Ymd", 	
								mktime( 12, 
										0, 
										0, 
										($current_month - 1),
										$current_day,
										$current_year
									   )
								);
								
		$previous_day 	= date("Ymd", 	
								mktime( 12, 
										0, 
										0, 
										$current_month,
										$current_day - 1,
										$current_year
									   )
								);
		$next_day 		= date("Ymd", 	
								mktime( 1, 
										12, 
										0, 
										$current_month,
										$current_day + 1,
										$current_year
									   )
								);
		$next_month		= date("Ymd", 	
								mktime( 1, 
										12, 
										0, 
										$current_month + 1,
										$current_day,
										$current_year
									   )
								);
		

		if ($param['use_img']) {
			$g 	= '<IMG src="images/g.gif" border="0" alt="Jour précédent">';
			$gg = '<IMG src="images/gg.gif" border="0" alt="Mois précédent">';
			$d 	= '<IMG src="images/d.gif" border="0" alt="Jour suivant">';
			$dd = '<IMG src="images/dd.gif" border="0" alt="Mois suivant">';
		}
		else {
			$g 	= '&lt;';
			$gg = '&lt;&lt;';
			$d = '&gt;';
			$dd = '&gt;&gt;';
		}

		if ( ($param['link_after_date'] == 0) 
				&& ($current_timestamp < mktime(0,0,0, $current_month, $current_day+1, $current_year))
			) {
			$next_day_link = '&nbsp;';
		}
		else {
			$next_day_link 		= '<A href="'.$PHP_SELF.'?date='.$next_day.'">'.$d.'</A>'."\n";
		}
		
		if ( ($param['link_after_date'] == 0) 
				&& ($current_timestamp < mktime(0,0,0, $current_month+1, $current_day, $current_year))
			) {
			$next_month_link = '&nbsp;';		
		}
		else {
			$next_month_link 	= '<A href="'.$PHP_SELF.'?date='.$next_month.'">'.$dd.'</A>'."\n";
		}
		
		
		$output .= '<TR>'."\n";
		$output .= '	<TD colspan="'.$param['calendar_columns'].'" class="calendarDays'.$param['calendar_id'].'">'."\n";
		$output .= '		<TABLE width="100%" border="0" >';
		$output .= '		<TR>'."\n";
		$output .= '			<TD width="25%" align="left" class="calendarDays'.$param['calendar_id'].'">'."\n";
		$output .= '				<B><A href="'.$PHP_SELF.'?date='.$previous_month.'">'.$gg.'</A></B>'."\n";
		$output .= '			</TD>'."\n";
		$output .= '			<TD width="25%" align="center" class="calendarDays'.$param['calendar_id'].'">'."\n";
		$output .= '				<A href="'.$PHP_SELF.'?date='.$previous_day.'">'.$g.'</A>'."\n";
		$output .= '			</TD>'."\n";
		$output .= '			<TD width="25%" align="center" class="calendarDays'.$param['calendar_id'].'">'."\n";
		$output .= 					$next_day_link;
		$output .= '			</TD>'."\n";
		$output .= '			<TD width="25%" align="right" class="calendarDays'.$param['calendar_id'].'">'."\n";
		$output .= 					$next_month_link;
		$output .= '			</TD>'."\n";
		$output .= '		</TR>';
		$output .= '		</TABLE>';
		$output .= '	</TD>'."\n";
		$output .= '</TR>'."\n";
		
	}
	$output .= '</TABLE>'."\n";
	return $output;
}

function priv_reg_glob_calendar($var) {
	Global $HTTP_GET_VARS, $HTTP_POST_VARS;
	
	if (isset($HTTP_GET_VARS[$var])) {
		return $HTTP_GET_VARS[$var];
	}
	elseif (isset($HTTP_POST_VARS[$var])) {
		return $HTTP_POST_VARS[$var];
	}
	else {
		return '';
	}	
}
?>
</body>
</html>
<?
// Petit script pour le calcul des statistiques du site 
$nom_page="calendrierdepart.php";
require "Admin/stats/visiteur.php";  
?>