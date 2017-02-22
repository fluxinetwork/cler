/*------------------------------*\

    #FLEXBOX WARNING

    Add an overlay for browsers which doesn't support flexbox with links to update them
    Flexbox support detection use Modernizr : https://modernizr.com/download?flexbox&q=flex

\*------------------------------*/

if (!Modernizr.flexbox) {
	var ieLink = 'http://windows.microsoft.com/fr-fr/internet-explorer/download-ie';
	var edgeLink = 'https://www.microsoft.com/fr-fr/windows/microsoft-edge';
	var ffLink = 'https://www.mozilla.org/fr/firefox/new/';
	var gcLink = 'https://www.google.com/chrome/browser/desktop/index.html'
	var cliqzLink = 'https://cliqz.com/fr/download';
	var operaLink = 'http://www.opera.com/fr/computer';

	var typo = 'font-family:Helvetica,Tahoma,Arial!important;';
	var h3Style = 'style="color:#F44336;margin-top:32px;background-color:#fff;display:inline-block;padding:8px 16px;border-radius:3px;'+typo+'"';
	var ulStyles = 'style="list-style:none;padding-left:16px;margin-top:24px;"';
	var liStyle = 'style="display:inline-block;margin-right:24px;"';
	var linkStyle = 'style="font-weight:700;color:#fff;text-decoration:none;display:inline-block;'+typo+'"';
	var buttonStyle = 'style="position:absolute;bottom:0;left:0;background-color:#000;padding:16px 80px 16px 80px;width:100%;color:#fff;text-align:left;'+typo+'"';
	var displayIcon = 'display:inline-block';

	var dom = '<div style="position:fixed;left:0;top:0;z-index:100000;width:100%;height:100%;background-color:#F44336;padding:64px;" class="flexwarning">';

	dom += '<h1 style="color:#fff;'+typo+'">Votre navigateur est obsolète,<br> la mise en page du site risque d\'être endommagée.</h1>';
	dom += '<h2 style="color:#fff;margin-top:40px;'+typo+'">Nous vous conseillons de le mettre à jour !</h2>';

	dom += '<h3 '+h3Style+'"><i class="fa fa-windows" style="margin-right:8px;'+displayIcon+'"></i><i class="fa fa-apple" style="margin-right:16px;'+displayIcon+'"></i>Navigateurs multi-plateformes</h3>';
	dom += '<ul '+ulStyles+'>';
	dom += '<li '+liStyle+'><a href="'+ffLink+'" '+linkStyle+'"><i class="fa fa-firefox" style="margin-right:8px;'+displayIcon+'"></i>Firefox</a></li>';
	dom += '<li '+liStyle+'><a href="'+gcLink+'" '+linkStyle+'"><i class="fa fa-chrome" style="margin-right:8px;'+displayIcon+'"></i>Chrome</a></li>';
	dom += '<li '+liStyle+'><a href="'+operaLink+'" '+linkStyle+'"><i class="fa fa-opera" style="margin-right:8px;'+displayIcon+'"></i>Opera</a></li>';
	dom += '</ul>';

	dom += '<h3 '+h3Style+'"><i class="fa fa-windows" style="margin-right:16px;'+displayIcon+'"></i>Navigateurs pour Windows</h3>';
	dom += '<ul '+ulStyles+'>';
	dom += '<li '+liStyle+'><a href="'+ieLink+'" '+linkStyle+'"><i class="fa fa-internet-explorer" style="margin-right:8px;'+displayIcon+'"></i>Internet Explorer</a></li>';
	dom += '<li '+liStyle+'><a href="'+edgeLink+'" '+linkStyle+'"><i class="fa fa-edge" style="margin-right:8px;'+displayIcon+'"></i>Edge pour Windows 10</a></li>';
	dom += '</ul>';

	dom += '<h3 '+h3Style+'">À découvrir</h3>';
	dom += '<ul '+ulStyles+'>';
	dom += '<li '+liStyle+'><a href="'+cliqzLink+'" '+linkStyle+'"><i class="fa fa-shield" style="margin-right:8px;'+displayIcon+'"></i>Cliqz, le navigateur qui respecte la vie privée</a></li>';
	dom += '</ul>';

	dom += '<button '+buttonStyle+' class="js-close-warning"><i class="fa fa-times-circle" style="color:#fff;margin-right:8px;'+displayIcon+'"></i>Fermer cet avertissement (on vous aura prévenu...)</button>';

	dom += '</div>';

	$('body').append(dom);

	if(!$('html').is('[class*="fa-events"]')) {
		$('.flexwarning .fa').css('display','none');
	}

	$('.js-close-warning').on('click', function(){
		$('.flexwarning').remove();
	})
}

