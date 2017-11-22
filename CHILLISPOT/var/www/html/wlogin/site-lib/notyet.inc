<?php

include(INC_DIR . "top.inc");

echo "<p class=\"body_text\">" . HOTSPOT_NAME . " Login</p>\n";

// Choix du formulaire
if ($ok == 'Valider')
{
include(INC_DIR . "login_form.inc");
}
elseif ($ok == 'Ok')
    {
    include(INC_DIR . "login_choix.inc");
    }
    else
	{
	include(INC_DIR . "login_type.inc");
	}

include(INC_DIR . "tail.inc");

?>
