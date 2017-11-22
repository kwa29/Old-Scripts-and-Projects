<? php
function affiche_menu()
    {
        // tableaux contenant les liens d'accèet le texte àfficher
	$tab_menu_lien = array( "accueil.hotel.php", "compta.php", "banque.php", "informatique.php", "technique.php", "divers.php" );
	$tab_menu_texte = array( "Generale", "Compta", "Bancaire", "Informatique", "Technique", "Divers" );
	
	// informations sur la page
	$info = pathinfo($_SERVER['PHP_SELF']);

	$menu_hotel = "\n<div id=\"menu\">\n    <ul id=\"onglets\">\n";

        

	// boucle qui parcours les deux tableaux
	foreach($tab_menu_lien as $cle=>$lien)
	{
	    $menu_hotel .= "    <li";
		
	    // si le nom du fichier correspond àelui pointéar l'indice, alors on l'active
	    if( $info['basename'] == $lien )
	        $menu .= " class=\"active\"";
		
	    $menu_hotel .= "><a href=\"" . $lien . "\">" . $tab_menu_texte[$cle] . "</a></li>\n";
	}
	
	$menu_hotel .= "</ul>\n</div>";
	
        // on renvoie le code xHTML
echo $info['basename']
	return $menu_hotel;	
    }
?>

