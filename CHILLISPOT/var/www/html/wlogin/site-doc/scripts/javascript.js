var WLoginPopUp;
var blur = 0;
var starttime = new Date();
var startclock = starttime.getTime();
var mytimeleft = 0;
var context = '';
var next_url = '';
var timeleft_str = '';

function handler() {
    var argv = handler.arguments;
    var argc = argv.length;

    if ( argc == 0 ) {
	return null;
    }

    // context is always our first argument.
    context = argv[0];

    // timeleft is always our second argument (might be empty).
    if ( argv[1] ) {
	mytimeleft = argv[1];
    }

    // next_url is always our third argument (mostly null).
    if ( argv[2] ) {
	next_url = argv[2];
    }

    // context is always our first argument.
    switch ( context )
	{
	case 'success':
	    {
		success(argv[3],argv[4]);
		break;
	    }
	case 'failed':
	    {
		failed();
		break;
	    }
	case 'notyet':
	    {
		notyet();
		break;
	    }
	case 'popup2':
	    {
		popup2(argv[3]);
		break;
	    }
	case 'popup3':
	    {
		popup3();
		break;
	    }
	default:
	    {
		break;
	    }
	}

    return null;
}

function success(url,userurl) {
    if ( self.name == 'WLoginStatus' ) {
	doTime();
	self.location = url;
    }
    else {
	popUpWindow(url,'WLoginStatus','272','212',0,0,0,0);

	if ( userurl != '' ) {
	    WLoginPopUp.opener.location = userurl;
	}
    }
}

function failed() {
    document.form_1.uid.focus();

    if ( self.name != 'WLoginStatus' ) {
	closeWLoginPopUp();
    }
}

function notyet() {
    document.form_1.uid.focus();
}

function popup2(redirurl) {
    if ( self.name == 'WLoginStatus' ) {
	doTime();
	
	if ( redirurl ) {
	    opener.location = redirurl;
	}

	self.focus();
	blur = 0;
    }
}

function popup3() {
    if ( self.name == 'WLoginStatus' ) {
	self.focus();
	blur = 1;
    }
}

function doTime() {
    window.setTimeout('doTime()', 1000);
    t = new Date();
    time = Math.round((t.getTime() - starttime.getTime())/1000);

    if (mytimeleft) {
        time = mytimeleft - time;

        if (time <= 0) {
	    window.location = next_url;
        }
    }
    
    if (time < 0) {
	time = 0;
    }

    hours = (time - (time % 3600)) / 3600;
    time = time - (hours * 3600);
    mins = (time - (time % 60)) / 60;
    secs = time - (mins * 60);
    
    if (hours < 10) {
	hours = '0' + hours;
    }

    if (mins < 10) {
	mins = '0' + mins;
    }

    if (secs < 10) {
	secs = '0' + secs;
    }

    title = 'Online time: ' + hours + ':' + mins + ':' + secs;

    if ( ( context == 'popup2' ) && ( self.name == 'WLoginStatus' ) ) {
	document.getElementById("d").innerHTML = 
	    '<p class=\"body_note\">' + title + '</p>';
    }

    if (mytimeleft) {
        title = 'Remaining time: ' + hours + ':' + mins + ':' + secs;
    }
}

function doOnBlur(context) {
    if ( ( context == 'popup2' ) && ( self.name == 'WLoginStatus' ) ) {
        if ( blur == 0 ) {
	    blur = 1;
	    self.focus();
        }
    }
}

function closeWLoginPopUp() {
    if (WLoginPopUp && WLoginPopUp.open && !WLoginPopUp.closed) {
	WLoginPopUp.close();
    }
}

function popUpWindow(url,
		     name,
		     width,
		     height,
		     show_location,
		     show_directories,
		     show_menubar,
		     show_toolbar) {
    var features = 
	'width=' + width + ',' +
	'height=' + height + ',' +
	'screenx=20,' +
	'screeny=20,' +
	'location=' + show_location + ',' +
	'menubar=' + show_menubar + ',' +
	'toolbar=' + show_toolbar + ',' +
	'directories=' + show_directories + ',' + 
	'scrollbars=yes,' +
	'dependent=no';
    
    if (WLoginPopUp && WLoginPopUp.open && !WLoginPopUp.closed) {
	WLoginPopUp.close();
    }
    
    WLoginPopUp = window.open(url, name, features);
}

function controleclient() // Controle formulaire pour les clients
{
var sms = document.form_1.sms.value;

if (sms == '')
	{
	alert("Votre champ est vide...");
	return false;
	}
}
