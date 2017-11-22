function disparition(type)		// Fermeture du popup et changement de l'objet liste deroulante dans un formulaire
{
if (type == 'civilite')
	{
	window.opener.document.getElementById("calque_civil_h").style.visibility = 'visible'
	window.opener.document.getElementById("calque_civil").style.visibility = 'hidden'	
	alert('Vous venez de modifier le champ ' + type + '. Veuillez taper la nouvelle entrée.');
	window.close();
	}
if (type == 'fonction')
	{
	window.opener.document.getElementById("calque_fonction_h").style.visibility = 'visible'
	window.opener.document.getElementById("calque_fonction").style.visibility = 'hidden'	
	alert('Vous venez de modifier le champ ' + type + '. Veuillez taper la nouvelle entrée.');
	window.close();
	}
if (type == 'service')
	{
	window.opener.document.getElementById("calque_service_h").style.visibility = 'visible'
	window.opener.document.getElementById("calque_service").style.visibility = 'hidden'	
	alert('Vous venez de modifier le champ ' + type + '. Veuillez taper la nouvelle entrée.');
	window.close();
	}
if (type == 'metro')
	{
	window.opener.document.getElementById("calque_metro_h").style.visibility = 'visible'
	window.opener.document.getElementById("calque_metro").style.visibility = 'hidden'	
	alert('Vous venez de modifier le champ ' + type + '. Veuillez taper la nouvelle entrée.');
	window.close();
	}
if (type == 'denomination')
	{
	window.opener.document.getElementById("calque_denom_h").style.visibility = 'visible'
	window.opener.document.getElementById("calque_denom").style.visibility = 'hidden'	
	alert('Vous venez de modifier le champ ' + type + '. Veuillez taper la nouvelle entrée.');
	window.close();
	}
if (type == 'type')
	{
	window.opener.document.getElementById("calque_type_h").style.visibility = 'visible'
	window.opener.document.getElementById("calque_type").style.visibility = 'hidden'	
	alert('Vous venez de modifier le champ ' + type + '. Veuillez taper la nouvelle entrée.');
	window.close();
	}
if (type == 'pays')
	{
	window.opener.document.getElementById("calque_pays_h").style.visibility = 'visible'
	window.opener.document.getElementById("calque_pays").style.visibility = 'hidden'	
	alert('Vous venez de modifier le champ ' + type + '. Veuillez taper la nouvelle entrée.');
	window.close();
	}
if (type == 'contrat')
	{
	window.opener.document.getElementById("calque_typecon_h").style.visibility = 'visible'
	window.opener.document.getElementById("calque_typecon").style.visibility = 'hidden'	
	alert('Vous venez de modifier le champ ' + type + '. Veuillez taper la nouvelle entrée.');
	window.close();
	}
if (type == 'secteur')
	{
	window.opener.document.getElementById("calque_secteur_h").style.visibility = 'visible'
	window.opener.document.getElementById("calque_secteur").style.visibility = 'hidden'	
	alert('Vous venez de modifier le champ ' + type + '. Veuillez taper la nouvelle entrée.');
	window.close();
	}
if (type == 'implantation')
	{
	window.opener.document.getElementById("calque_implant_h").style.visibility = 'visible'
	window.opener.document.getElementById("calque_implant").style.visibility = 'hidden'	
	alert('Vous venez de modifier le champ ' + type + '. Veuillez taper la nouvelle entrée.');
	window.close();
	}
if (type == 'reseau')
	{
	window.opener.document.getElementById("calque_reseau_h").style.visibility = 'visible'
	window.opener.document.getElementById("calque_reseau").style.visibility = 'hidden'	
	alert('Vous venez de modifier le champ ' + type + '. Veuillez taper la nouvelle entrée.');
	window.close();
	}	
}

function ouvrir(page) 			// Ouverture d'un popup pour le suivi
	{
	w=open(page,'displayWindow','width=400,height=150,left=300,top=250,toolbar=no,location=no,directories=no,status=no,scrollbars=no,resizable=no,copyhistory=no,menuBar=no');	
	}
	
function Ouvrir(page) 			// Ouverture d'un popup pour les statistiques
	{
	w=open(page,'displayWindow','width=400,height=220,left=300,top=250,toolbar=no,location=no,directories=no,status=no,scrollbars=no,resizable=no,copyhistory=no,menuBar=no');	
	}
	
function calculette(nbre) // Principe de la calculette caddie pour les checkbox de la selection stat
{
var total=0;
var total1=0;
var total2=0;
var total3=0;
var total4=0;
var total5=0;
var total6=0;
var total7=0;
var total8=0;
var total9=0;
var total10=0;
var total11=0;
var total12=0;
var total13=0;
var somme=0;

if (nbre == 14)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  if (form2.boite2.checked)
  total2=form2.boite2.value;
  if (form2.boite3.checked)
  total3=form2.boite3.value;
  if (form2.boite4.checked)
  total4=form2.boite4.value;
  if (form2.boite5.checked)
  total5=form2.boite5.value;
  if (form2.boite6.checked)
  total6=form2.boite6.value;
  if (form2.boite7.checked)
  total7=form2.boite7.value;
  if (form2.boite8.checked)
  total8=form2.boite8.value;
  if (form2.boite9.checked)
  total9=form2.boite9.value;
  if (form2.boite10.checked)
  total10=form2.boite10.value;
  if (form2.boite11.checked)
  total11=form2.boite11.value;
  if (form2.boite12.checked)
  total12=form2.boite12.value;
  if (form2.boite13.checked)
  total13=form2.boite13.value;
  somme = parseFloat(total)+ parseFloat(total1)+ parseFloat(total2) + parseFloat(total3) + parseFloat(total4) + parseFloat(total5)+ parseFloat(total6)+ parseFloat(total7)+ parseFloat(total8)+ parseFloat(total9)+ parseFloat(total10)+ parseFloat(total11)+ parseFloat(total12)+ parseFloat(total13);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else if (nbre == 13)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  if (form2.boite2.checked)
  total2=form2.boite2.value;
  if (form2.boite3.checked)
  total3=form2.boite3.value;
  if (form2.boite4.checked)
  total4=form2.boite4.value;
  if (form2.boite5.checked)
  total5=form2.boite5.value;
  if (form2.boite6.checked)
  total6=form2.boite6.value;
  if (form2.boite7.checked)
  total7=form2.boite7.value;
  if (form2.boite8.checked)
  total8=form2.boite8.value;
  if (form2.boite9.checked)
  total9=form2.boite9.value;
  if (form2.boite10.checked)
  total10=form2.boite10.value;
  if (form2.boite11.checked)
  total11=form2.boite11.value;
  if (form2.boite12.checked)
  total12=form2.boite12.value;
  somme = parseFloat(total)+ parseFloat(total1)+ parseFloat(total2) + parseFloat(total3) + parseFloat(total4) + parseFloat(total5)+ parseFloat(total6)+ parseFloat(total7)+ parseFloat(total8)+ parseFloat(total9)+ parseFloat(total10)+ parseFloat(total11)+ parseFloat(total12);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else if (nbre == 12)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  if (form2.boite2.checked)
  total2=form2.boite2.value;
  if (form2.boite3.checked)
  total3=form2.boite3.value;
  if (form2.boite4.checked)
  total4=form2.boite4.value;
  if (form2.boite5.checked)
  total5=form2.boite5.value;
  if (form2.boite6.checked)
  total6=form2.boite6.value;
  if (form2.boite7.checked)
  total7=form2.boite7.value;
  if (form2.boite8.checked)
  total8=form2.boite8.value;
  if (form2.boite9.checked)
  total9=form2.boite9.value;
  if (form2.boite10.checked)
  total10=form2.boite10.value;
  if (form2.boite11.checked)
  total11=form2.boite11.value;
  somme = parseFloat(total)+ parseFloat(total1)+ parseFloat(total2) + parseFloat(total3) + parseFloat(total4) + parseFloat(total5)+ parseFloat(total6)+ parseFloat(total7)+ parseFloat(total8)+ parseFloat(total9)+ parseFloat(total10)+ parseFloat(total11);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else if (nbre == 11)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  if (form2.boite2.checked)
  total2=form2.boite2.value;
  if (form2.boite3.checked)
  total3=form2.boite3.value;
  if (form2.boite4.checked)
  total4=form2.boite4.value;
  if (form2.boite5.checked)
  total5=form2.boite5.value;
  if (form2.boite6.checked)
  total6=form2.boite6.value;
  if (form2.boite7.checked)
  total7=form2.boite7.value;
  if (form2.boite8.checked)
  total8=form2.boite8.value;
  if (form2.boite9.checked)
  total9=form2.boite9.value;
  if (form2.boite10.checked)
  total10=form2.boite10.value;
  somme = parseFloat(total)+ parseFloat(total1)+ parseFloat(total2) + parseFloat(total3) + parseFloat(total4) + parseFloat(total5)+ parseFloat(total6)+ parseFloat(total7)+ parseFloat(total8)+ parseFloat(total9)+ parseFloat(total10);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else if (nbre == 10)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  if (form2.boite2.checked)
  total2=form2.boite2.value;
  if (form2.boite3.checked)
  total3=form2.boite3.value;
  if (form2.boite4.checked)
  total4=form2.boite4.value;
  if (form2.boite5.checked)
  total5=form2.boite5.value;
  if (form2.boite6.checked)
  total6=form2.boite6.value;
  if (form2.boite7.checked)
  total7=form2.boite7.value;
  if (form2.boite8.checked)
  total8=form2.boite8.value;
  if (form2.boite9.checked)
  total9=form2.boite9.value;
  somme = parseFloat(total)+ parseFloat(total1)+ parseFloat(total2) + parseFloat(total3) + parseFloat(total4) + parseFloat(total5)+ parseFloat(total6)+ parseFloat(total7)+ parseFloat(total8)+ parseFloat(total9);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else if (nbre == 9)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  if (form2.boite2.checked)
  total2=form2.boite2.value;
  if (form2.boite3.checked)
  total3=form2.boite3.value;
  if (form2.boite4.checked)
  total4=form2.boite4.value;
  if (form2.boite5.checked)
  total5=form2.boite5.value;
  if (form2.boite6.checked)
  total6=form2.boite6.value;
  if (form2.boite7.checked)
  total7=form2.boite7.value;
  if (form2.boite8.checked)
  total8=form2.boite8.value;
  somme = parseFloat(total)+ parseFloat(total1)+ parseFloat(total2) + parseFloat(total3) + parseFloat(total4) + parseFloat(total5)+ parseFloat(total6)+ parseFloat(total7)+ parseFloat(total8);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else if (nbre == 8)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  if (form2.boite2.checked)
  total2=form2.boite2.value;
  if (form2.boite3.checked)
  total3=form2.boite3.value;
  if (form2.boite4.checked)
  total4=form2.boite4.value;
  if (form2.boite5.checked)
  total5=form2.boite5.value;
  if (form2.boite6.checked)
  total6=form2.boite6.value;
  if (form2.boite7.checked)
  total7=form2.boite7.value;
  somme = parseFloat(total)+ parseFloat(total1)+ parseFloat(total2) + parseFloat(total3) + parseFloat(total4) + parseFloat(total5)+ parseFloat(total6)+ parseFloat(total7);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else if (nbre == 7)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  if (form2.boite2.checked)
  total2=form2.boite2.value;
  if (form2.boite3.checked)
  total3=form2.boite3.value;
  if (form2.boite4.checked)
  total4=form2.boite4.value;
  if (form2.boite5.checked)
  total5=form2.boite5.value;
  if (form2.boite6.checked)
  total6=form2.boite6.value;
  somme = parseFloat(total)+ parseFloat(total1)+ parseFloat(total2) + parseFloat(total3) + parseFloat(total4) + parseFloat(total5)+ parseFloat(total6);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else if (nbre == 6)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  if (form2.boite2.checked)
  total2=form2.boite2.value;
  if (form2.boite3.checked)
  total3=form2.boite3.value;
  if (form2.boite4.checked)
  total4=form2.boite4.value;
  if (form2.boite5.checked)
  total5=form2.boite5.value;
  somme = parseFloat(total)+ parseFloat(total1)+ parseFloat(total2) + parseFloat(total3) + parseFloat(total4) + parseFloat(total5);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else if (nbre == 5)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  if (form2.boite2.checked)
  total2=form2.boite2.value;
  if (form2.boite3.checked)
  total3=form2.boite3.value;
  if (form2.boite4.checked)
  total4=form2.boite4.value;
  somme = parseFloat(total)+ parseFloat(total1)+ parseFloat(total2) + parseFloat(total3) + parseFloat(total4);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else if (nbre == 4)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  if (form2.boite2.checked)
  total2=form2.boite2.value;
  if (form2.boite3.checked)
  total3=form2.boite3.value;
  somme = parseFloat(total)+ parseFloat(total1)+ parseFloat(total2) + parseFloat(total3);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else if (nbre == 3)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  if (form2.boite2.checked)
  total2=form2.boite2.value;
  somme = parseFloat(total)+ parseFloat(total1)+ parseFloat(total2);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else if (nbre == 2)
{
  if (form2.boite.checked)
  total=form2.boite.value;
  if (form2.boite1.checked)
  total1=form2.boite1.value;
  somme = parseFloat(total)+ parseFloat(total1);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
else
{
  if (form2.boite.checked)
  total=form2.boite.value;
  somme = parseFloat(total);
  somme = Math.round (somme*100)/100;    // Arrondi a 2 apres la virgule
  form2.Total.value=somme+" Euros.";
}
}

function bloquenom()  // Controle formulaire
        {
var controle = eval('document.form1.nom');
// On se place sur le champ incriminé
controle.focus();
// On sélectionne le contenu pour faciliter la reprise de la saisie
controle.select();
        }

function bloquecode()  // Controle formulaire
{
var controle = eval('document.form1.cod');
// On se place sur le champ incriminé
controle.focus();
// On sélectionne le contenu pour faciliter la reprise de la saisie
controle.select();
}

function controle()  // Controle formulaire
{
var nomjava = document.form1.nom.value;
var codejava = document.form1.cod.value;

probleme = 0;
mini = '1';
maxi = '6';
RE2 = /^\d+$/;
if ((nomjava == '')&&(codejava == ''))
{
alert('Votre saisie est incorrecte. Vous devez saisir OU le nom OU le code');
return false;
}
if (nomjava != '')
{
     if ( probleme == 1 )
        {
        bloquenom(); // On active le blocage du champ
        return false;
        }
}
if (codejava != '')
{
   if (!RE2.test(codejava))
      {
      alert('Votre saisie est incorrecte. Vous devez saisir un code sur 6 chiffres maximum');
      probleme = 2; // On marque que la saisie n'est pas cohérente
          }
      if ( codejava.length > maxi )
          {
      alert('Vous ne devez pas saisir plus de ' + maxi + ' chiffres.');
      probleme = 2;
      }

// Si on a marqué qu'il y avait un problème
     if ( probleme == 2 )
        {
        bloquecode(); // On active le blocage du champ
        return false;
        }
}
}

function contre()  // Controle formulaire
{
var entree = document.form1.entree.value;

if (entree == '')
	{
	alert('Votre saisie est incorrecte. Vous devez saisir une entrée');
	return false;
	}
}

function validation()  // Controle formulaire UNIQUEMENT pour les annulations et les refus
{
var quantite = document.form1.quantite.value;
var dateap = document.form1.dateap.value;
var datedp = document.form1.datedp.value;
var prix = document.form1.prix.value;
var ver   = /^[0-9]+$/;

if (dateap == '')
	{
		alert('Votre date est vide, Vous devez remplir ce champ.');
		return false;
	}
if (datedp == '')
	{
		alert('Votre date est vide, Vous devez remplir ce champ.');
		return false;
	}
if (quantite == '')
	{
		alert('Votre nombre de Chambres est vide, Vous devez remplir ce champ.');
		return false;
	}
if (quantite != '')
	{
	if (ver.exec(quantite) == null)
		{
		alert('Votre nombre de Chambres est incorrect.');
		return false;
		}
	}
if (prix == '')
	{
		alert('Votre prix est vide, Vous devez remplir ce champ.');
		return false;
	}
if (prix != '')
	{
	if (ver.exec(prix) == null)
		{
		alert('Votre prix est incorrect.');
		return false;
		}
	}
if (dateap.search(/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{2,4}$/) == -1)
	{
	
	alert("Votre date est dans un format incorrect. Rappel  JJ/MM/AA.")
	return false;
	}
if (datedp.search(/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{2,4}$/) == -1)
	{
	
	alert("Votre date est dans un format incorrect. Rappel  JJ/MM/AA.")
	return false;
	}
}

function controlcontact() // Controle formulaire UNIQUEMENT pour les contacts
{
var nom = document.menuform.nom.value;
var email   = document.menuform.mail.value;

if (nom == '')
	{
	alert('Votre saisie est incorrecte. Vous devez saisir un nom');
	return false;
	}
if (email != '')
	{
if (email.indexOf("@")==-1)
			{ 
   	 		alert("Votre email est incorrect.");
   	 		return false;
			}
	}
}

function controlclient() // Controle formulaire UNIQUEMENT pour les clients
{
var code = document.menuform.code.value;
var email   = document.menuform.mail.value;
var nom   = document.menuform.nom.value;
var ver   = /^[0-9]+$/;
mini = '1';
maxi = '6';
RE2 = /^\d+$/;

if (email != '')
	{
if (email.indexOf("@")==-1)
			{ 
   	 		alert("Votre email est incorrect.");
   	 		return false;
			}
	}
	
if (code != '')
    	{
		if (ver.exec(code) == null)
			{ 
   	 		alert("Votre code est incorrect.");
   	 		return false;
			}
			if (code.length < maxi)
      			{
      			alert('Votre saisie est incorrecte. Vous devez saisir un code sur 6 chiffres.');
      			return false;
          		}
      			if ( code.length > maxi )
          			{
      				alert('Vous ne devez pas saisir plus de ' + maxi + ' chiffres.');
      				return false;
      				}		
   		}

if (nom == '')
    	{		
   	 	alert("Le nom de Client doit être rempli.");
   		return false;   
		}
		
}

function controlsuivi() // Controle formulaire UNIQUEMENT pour les suivis
{
var date = document.form1.date.value;
var futur = document.form1.futur.value;
var resume = document.form1.resume.value;
var contenu = document.form1.contenu.value;
// On recherche le caractere guillemet
var modele = /"/;

if (document.form1.contenu.type == 'textarea')
    	{
		if (contenu == '')
			{
			alert("Le contenu doit être rempli.");
   	 		return false;
			}
		// Teste de recherche du caractere interdit
		if (modele.exec(contenu) != null)
			{
			alert("Le caractère guillemet n'est pas autorisé.");
   	 		return false;
			}
   		}
if (document.form1.resume.type == 'textarea')
    	{
		// Teste de recherche du caractere interdit
		if (modele.exec(resume) != null)
			{
			alert("Le caractère guillemet n'est pas autorisé.");
   	 		return false;
			}
   		}
if (date == '')
    	{
		alert("Votre date doit être remplie.");
   	 	return false;
   		}
if (futur == '')
    	{
   	 	alert("Votre suivi futur doit être rempli.");
   	 	return false;
   		}
}

function controlreq15() // Controle formulaire UNIQUEMENT pour les requetes
{
var dateap = document.form1.dateap.value;
var datedp = document.form1.datedp.value;

if (dateap == '')
    	{
		alert("Votre date doit être remplie.");
   	 	return false;
   		}
if (datedp == '')
    	{
		alert("Votre date doit être remplie.");
   	 	return false;
   		}
}

function controlreq16() // Controle formulaire UNIQUEMENT pour les requetes
{
var opt = document.form2.opt.value;
var option4 = document.form2.option4.value;
var option7 = document.form2.option7.value;
var ver   = /^[0-9]+$/;

if (option4 != '')
    	{
		if (ver.exec(option4) == null)
			{ 
   	 		alert("Votre chiffre est incorrecte.");
   	 		return false;
			}
   		}
if (option7 != '')
    	{
		if (ver.exec(option7) == null)
			{ 
   	 		alert("Votre chiffre est incorrecte.");
   	 		return false;
			}
   		}
}

function controlreq17() // Controle formulaire UNIQUEMENT pour les requetes
{
var dateap = document.form17.dateap.value;
var datedp = document.form17.datedp.value;

if (dateap == '')
    	{
		alert("Votre date doit être remplie.");
   	 	return false;
   		}
if (datedp == '')
    	{
		alert("Votre date doit être remplie.");
   	 	return false;
   		}
}

function attention()  // Renvoie un message lorsque l'utilisateur n'est pas autorisé par modifier
{
alert("Vous n'avez pas les autorisations nécessaires...");
   	 	return false;
}

function popup_aide_1()
{ 
window.open("aide.php?aide=1" , "aide" , 'toolbar=no, location=no, directories=no, status=no, scrollbars=no, resizable=yes,  width=200, height=450, left=0, top=0"'  ); 
} 
function popup_aide_2()
{ 
window.open("aide.php?aide=2" , "aide" , 'toolbar=no, location=no, directories=no, status=no, scrollbars=no, resizable=yes,  width=200, height=450, left=0, top=0"'  ); 
} 

function SelObj(formname,selname,textname,str) {
  this.formname = formname;
  this.selname = selname;
  this.textname = textname;
  this.select_str = str || '';
  this.selectArr = new Array();
  this.initialize = initialize;
  this.bldInitial = bldInitial;
  this.bldUpdate = bldUpdate;
}

function initialize() {
  if (this.select_str =='') {
    for(var i=0;i<document.forms[this.formname][this.selname].options.length;i++) {
      this.selectArr[i] = document.forms[this.formname][this.selname].options[i];
      this.select_str += document.forms[this.formname][this.selname].options[i].value+":"+
      document.forms[this.formname][this.selname].options[i].text+",";
    }
  }
  else {
    var tempArr = this.select_str.split(',');
    for(var i=0;i<tempArr.length;i++) {
      var prop = tempArr[i].split(':');
      this.selectArr[i] = new Option(prop[1],prop[0]);
    }
  }
  return;
}

function bldInitial() {
  this.initialize();
  for(var i=0;i<this.selectArr.length;i++)
    document.forms[this.formname][this.selname].options[i] = this.selectArr[i];
  document.forms[this.formname][this.selname].options.length = this.selectArr.length;
  return;
}

function bldUpdate() {
  var str = document.forms[this.formname][this.textname].value.replace('^\\s*','');
  if(str == '') {this.bldInitial();return;}
  this.initialize();
  var j = 0;
  pattern1 = new RegExp("^"+str,"i");
  for(var i=0;i<this.selectArr.length;i++)
    if(pattern1.test(this.selectArr[i].text))
      document.forms[this.formname][this.selname].options[j++] = this.selectArr[i];
  document.forms[this.formname][this.selname].options.length = j;
  if(j==1){
    document.forms[this.formname][this.selname].options[0].selected = true;
  }
}

function setUp() {
  obj1 = new SelObj('menuform','ville','entry');
  obj1.bldInitial();
}

function controlville() // Controle formulaire UNIQUEMENT pour les requetes
{
var nomville = document.form1.nomville.value;
var cpville = document.form1.cpville.value;

if (nomville == '')
    	{
		alert("Votre ville doit être remplie.");
   	 	return false;
   		}
if (cpville == '')
    	{
		alert("Votre code postal doit être rempli.");
   	 	return false;
   		}
}
