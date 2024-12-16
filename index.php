<?php

// *****************************************************************************
// *****                       Historique des versions                     *****
// *****************************************************************************
// Copyright (c) 2022 - Serge Tsakiropoulos - Office de Tourisme de Martigues

// ***** V1.0  		- 30/06/2022 
// ***** 		 	- Version NON compatible donc re-écriture en partant de zéro ! 
// ***** V0.1    	- 30/06/2022 - Premiere version
// ***** V0.0      	- Ecriture du code - sur les cendre de la version Digne-les-bains car elle était pour la V1 de l'OpenAgenda
// *****              donc totalement incompatible.

	if (($_POST['keypublic']!='') &&($_POST['keysecret']!='')) {

            /*Notre fichier contient toujours le texte :
             *"abcdefmier texte dans mon fichier. Un autre texte"
             *ajouté précédemment*/
				$fichier = fopen('config/config.php.txt','w');
          
				fputs($fichier, "<?php\r\n");
				fputs($fichier, "	session_start();\r\n ");
				fputs($fichier, "	/*\r\n ");
				fputs($fichier, "	*---------------------------------------------------------------\r\n ");
				fwrite($fichier, utf8_decode("	* Les clefs de l\'API - Fichier config généré le module Aide-API \r\n"));
				fwrite($fichier, "	*---------------------------------------------------------------\r\n ");
				fwrite($fichier, "	*\r\n ");				
				fwrite($fichier, "	* ++++++++++++++++++++++++ E-mail ++++++++++++++++++++++++++++++++\r\n  ");
				fwrite($fichier, "	* @author : webmaster@martigues-tourisme.com \r\n  ");			
				fwrite($fichier, "	* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++\r\n  ");				
				fwrite($fichier, "	*\r\n ");				
				fwrite($fichier, "	*	Note : A quoi servent-elle et comment trouver les clefs public et secret ?\r\n ");
				fwrite($fichier, "	*\r\n ");
				fwrite($fichier, "	* Pour cela il vous vous rendre sur le site : https://openagenda.com/settings/apiKey\r\n");
				fwrite($fichier, "	* et copier les clef API.\r\n ");
				fwrite($fichier, "	*\r\n ");
				fwrite($fichier, utf8_decode("	* La procédure d\'authentification à suivre pour éditer du contenu sur OpenAgenda consiste à utiliser votre clé secrète\r\n "));
				fwrite($fichier, utf8_decode("	* pour récupérer un ticket d\'accès qui vous servira pendant toute votre session.\r\n "));
				fwrite($fichier, "	*\r\n ");
				fwrite($fichier, utf8_decode("	* ATTENTION : Celui-ci à une durée de vie limitée.\r\n "));
				fwrite($fichier, utf8_decode("	* Votre clé secrète sera mise à disposition sur votre compte OA sur demande à support@openagenda.com\r\n"));
				fwrite($fichier, "	*  \r\n ");
				fwrite($fichier, "	*  Vous pouvez consulter la documentation ici : \r\n ");
				fwrite($fichier, "	*	INFO ...>  : https://developers.openagenda.com/authentification/ \r\n ");
				fwrite($fichier, "	*/ \r\n ");
				fwrite($fichier, "	\r\n ");
				fwrite($fichier, "	\$_SESSION['last_version']='V2022-06-30-TSK'; \r\n ");
				fwrite($fichier, "\r\n ");
				fwrite($fichier, utf8_decode("	\$keys = array( /* Les clés API permettent de lire et écrire des données sur OpenAgenda via l\'API. */\r\n "));
				fwrite($fichier, "	  \"public\"=>\"".$_POST['keypublic']."\", /* Pour OpenAgenda en lecture */\r\n ");
				fwrite($fichier, utf8_decode("	  \"secret\"=>\"".$_POST['keysecret']."\"  /* Pour OpenAgenda en mode écriture et autres*/\r\n "));
				fwrite($fichier, "	);\r\n ");
				fwrite($fichier, "\r\n ");
				fwrite($fichier, "	\$agendaUid=".$_POST['agendaUid']."; /* <uid:65630513> */\r\n ");
				fwrite($fichier, "	\$territoireIds=array(\"".$_POST['territoireIds']."\"); /* Conseil de territoire : Pays de Martigues */ \r\n ");
				fwrite($fichier, "	\$selectionIds=array(\"".$_POST['selectionIds']."\");\r\n ");
				fwrite($fichier, "	\r\n ");
				fwrite($fichier, utf8_decode("	\$data_openagenda =array(); /* tableau qui va temporairement sauvegarder les données lu sur OpenAgenda 	*/\r\n "));
				fwrite($fichier, utf8_decode("	\$data_apidae	 =array(); /* tableau qui va également sauvegarder les données d\'Apidae 				*/\r\n "));
				fwrite($fichier, "\r\n ");
				fwrite($fichier, "\r\n ");
				fwrite($fichier, "	\$apiDomain = \"http://api.apidae-tourisme.com/api/\";\r\n ");
				fwrite($fichier, "	\r\n ");
				fwrite($fichier, "	\$apiKey=\"".$_POST['apiKey']."\"; /* QTfpNkyX <- OK | PhrnH4Dd */\r\n ");
				fwrite($fichier, "	\$projetId=\"".$_POST['projetId']."\"; /*  	6556 Martigues - OpenAgenda */ \r\n ");
				fwrite($fichier, "	// \$nbResult = \"200\";\r\n");
				fwrite($fichier, "	// \$dureemax = \"50\";\r\n ");
				fwrite($fichier, "\r\n ");
				fwrite($fichier, "	\$requete = array();\r\n");
				fwrite($fichier, "\r\n");
				fwrite($fichier, "	\$requete[\"territoireIds\"] = \$territoireIds;\r\n ");
				fwrite($fichier, "	\$requete[\"selectionIds\"] = \$selectionIds;\r\n ");
				fwrite($fichier, "	\$requete[\"identifiants\"] = \$identifiants;\r\n ");
				fwrite($fichier, "	\$requete[\"apiKey\"] = \$apiKey;\r\n ");
				fwrite($fichier, "	\$requete[\"projetId\"] = \$projetId;\r\n ");
				fwrite($fichier, "	// \$requete[\"dateDebut\"] = date(\"Y-m-d\");   // \$requete[\"dateDebut\"] = \"2022-09-10\";\r\n ");
				fwrite($fichier, "\r\n ");
				fwrite($fichier, "	// \$requete[\"responseFields\"] = array(\"@all\");\r\n ");
				fwrite($fichier,"   \$requete[\"responseFields\"] = array(	\"id\",\"nom\",\"theme\",\"localisation\",\"descriptionTarif\",\"presentation\",\"prestations\",\"illustrations\",\"aspects\",\"informations\",\"datesOuverture\",\"ouverture\",\"@informationsObjetTouristique\");");
				fwrite($fichier, "	\$url_Apidae = \$apiDomain.\"v002/agenda/detaille/list-objets-touristiques/\";\r\n ");
				fwrite($fichier, "\r\n ");
				fwrite($fichier, "	\$url_Apidae .=\"?\";\r\n ");
				fwrite($fichier, "	\$url_Apidae .= \"query=\".urlencode(json_encode(\$requete));\r\n");
				fwrite($fichier, "\r\n ");
				fwrite($fichier, "	\$url_OpenAgenda=\"https://openagenda.com/agendas/\".\$agendaUid.\"/events.v2.json?key\".\$keys[\"public\"];\r\n ");
				fwrite($fichier, "	\r\n ");
				fwrite($fichier, "	\$department		= 	\"Bouches-du-Rhône\";\r\n ");
				fwrite($fichier, "	\$timezone		=	\"Europe/Paris\";\r\n ");
				fwrite($fichier, "	\$countryCode 	= 	\"FR\";\r\n ");
				fwrite($fichier, "	\r\n ");
				fwrite($fichier, "?>\r\n ");
				fclose($fichier);	
				$fichier_config_maj="OK";
				
	}
?>
<!DOCTYPE html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width,initial-scale=1,shrink-to-fit=no" name="viewport">
	<link href="css/jost-v4-latin-regular.woff2" rel="preload" type="font/woff2">
	<link href="css/jost-v4-latin-700.woff2" rel="preload" type="font/woff2">
	<link href="css/aides.css" rel="stylesheet">
	
	<title>API - APIDAE vers OPENAGENDA -  Documentation</title>
</head>
<body class="docs single">

		<header class="navbar fixed-top navbar-expand-md navbar-light">
		<div class="container">
			<input class="menu-btn order-0" id="menu-btn" type="checkbox">
			<label class="menu-icon d-md-none" for="menu-btn"><span class="navicon"></span></label>
			<a class="navbar-brand order-1 order-md-0 me-auto"  style="color:#fff">Apidae-&gt; API -&gt; OpenAgenda - Office de Tourisme et des Loisirs de Martigues </a>
			<button aria-label="Toggle mode" class="btn btn-link order-2 order-md-4" id="mode" type="button">
				<span class="toggle-dark">
					<svg class="feather feather-moon" height="20" viewbox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg">
						<path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
					</svg>
				</span>
				<span class="toggle-light">
				<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sun">
					<circle cx="12" cy="12" r="5"></circle>
					<line x1="12" y1="1" x2="12" y2="3"></line>
					<line x1="12" y1="21" x2="12" y2="23"></line>
					<line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
					<line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
					<line x1="1" y1="12" x2="3" y2="12"></line>
					<line x1="21" y1="12" x2="23" y2="12"></line>
					<line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
					<line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
				</svg>
				</span>
			</button>
			<ul class="navbar-nav social-nav order-3 order-md-5"></ul>
			<div class="collapse navbar-collapse order-4 order-md-1">
				<ul class="navbar-nav main-nav me-auto order-5 order-md-2"></ul>
				<div class="break order-6 d-md-none"></div>
			</div>
		</div>
	</header>
	
	<div class="wrap container" role="document">
		<div class="content">
			<div class="row flex-xl-nowrap">
				<div class="col-lg-5 col-xl-4 menu_gauche">
					<nav aria-label="Main navigation" class="docs-links">
						<div class="page-links">
							<img src="images/logo.png" alt="Information générales du projet" width="300px">
							<nav id="TableOfContents">
								<ul>
									<li>
										<a href="#introduction">Introduction</a>
										<ul>
											<li>
												<a href="#prerequis">Ressources nécessaires</a>
											</li>
										</ul>
									</li>
									<li>
										<a href="#quick-start">Comment obtenir l'accès </a>
										<ul>
											<li>
												<a href="#clefapidae">Obtenir les clefs d'APIDAE</a>
											</li>
											<li>
												<a href="#clefopenagenda">Obtenir les clefs OpenAgenda</a>
											</li>

										</ul>
									</li>
									<li>
										<a href="#query-parameters">Les Fichiers sources de l'API.</a>
										<ul>
											<li>
												<a href="#basics">Descriptifs et fichiers</a>
											</li>
										</ul>
									</li>
									<li>
										<a href="#responses">Utilisations des clefs</a>
										<ul>
											<li>
												<a href="#default-response">Config.php</a>
											</li>
											<li>
												<a href="#extended-response">Les requêtes</a>
											</li>
										</ul>
									</li>
									<li>
										<a href="#token">Création d'un Token</a>
									</li>
									<li>
										<a href="#createve">Analyse des données APIDAE</a>
										<ul>
											<li>
												<a href="#titre">Titre de l'événement </a>
											</li>
											<li>
												<a href="#state">Etat de l'événement</a>
											</li>
											<li>
												<a href="#image">Image & copyright</a>
											</li>
											<li>
												<a href="#adresse">Création de l'adresse</a>
											</li>
											<li>
												<a href="#description">Description</a>
											</li>
											<li>
												<a href="#mot">Les mots clefs</a>
											</li>
											<li>
												<a href="#date">Gestions des date</a>
											</li>
											<li>
												<a href="#tarif">Tarif en clair </a>
											</li>											
										</ul>
									</li>										
								
								<!--	<li>
										<a href="#config">Création du fichier config.php.txt</a>
									</li> -->
							</nav>
						</div>
					</nav>
				</div>
				<main class="docs-content col-lg-12 col-xl-12">
					<h1>Avant de commencer</h1>
						<h2 id="introduction">
							Introduction<a aria-hidden="true" class="anchor" href="#introduction">&lt; Note du dev </a>
						</h2>
						<p>
							Vous trouverez ici toutes les ressources nécessaires pour paramétrer et utiliser notre l’API APIDAE / OPEN AGENDA. 
						</p>
						<p>
							Note et méthode de développement - Ce code source peut être utilisé et amélioré par tout le monde<br>
							A ce jour, aucun <b>Github</b> héberge ce code source (01/09/2022)..
						</p>
						<h3 id="prerequis">
							* Ressources nécessaires<a aria-hidden="true" class="anchor" href="#prerequis">&lt; Les outils à avoir </a>
						</h3>
						<p>
							* Pour modifier les fichiers PHP qui composent l'API, vous aurez besoin :
						</p>
						<p>	* D'un éditeur de texte. Dans ce guide, nous avons utilisé l'éditeur de code source <a href="https://notepad-plus-plus.org/downloads/" target="_blank">Notpad++</a> (gratuit et disponible pour Windows. <a href="http://www.codelobster.com/html_editing.html" target="_blank">sublime-text</a> est disponible sous Ubuntu). L'éditeur vous aidera à modifier les fichiers PHP pour développer, déboguer et tester l'API.
						</p>
						<p>	* Avoir un environnement web pour exécuter le code source de l'API (Généralement, il s’agit du  serveur qui héberge votre site Internet).
						</p>
						<p>	* Avoir un compte administrateur <a href="https://base.apidae-tourisme.com/consulter/recherche-intuitive/?0" target="_blank">APIDAE</a> 
						</p>
						<p>* Avoir un compte administrateur <a href="https://openagenda.com/martigues-tourisme/admin/events" target="_blank">OpenAgenda</a>.</p>

						<h2 id="quick-start">
							Comment obtenir l'accès <a aria-hidden="true" class="anchor" href="#quick-start">&lt; Les clefs</a>
						</h2>

							<p>Vous devez demander des clefs publics et privés au support d’Open Agenda. Une fois reçu par mail, on insère ces clefs dans le fichier Config de l’API. L’API va l’utiliser pour établir une liaison d’accès provisoire et sécurisé. </p>
							
							<p>Nous pouvons traduire token par "Jeton d'accès spécial". Il vous faudra donc fournir des clefs pour la lecture sur APIDAE et des clefs pour l'écriture sur l'OpenAgenda.</p>
							
							<p>* Les clefs APIDAE se récupèrent depuis votre compte administrateur après la création d'un projet </p>
							
							<p>* Les clefs OpenAgenda vous seront communiqué après une demande par email à l’équipe technique OpenAgenda </p>
							
							<p> <b>NB :</b> Les clefs utilisées dans ce guide sont des valeurs d'exemples. Elles n'existent pas et ne pourront donc pas être utilisées dans les tests de l'API.</p>
						
						<h3 id="clefapidae">
							Obtenir les clefs d'APIDAE<a aria-hidden="true" class="anchor" href="#clefapidae">#</a>
						</h3>
						
						<p>Veuillez suivre attentivement le tutoriel d'Apidae concernant la <a href="https://aide.apidae-tourisme.com/hc/fr/articles/360000828071-Cr%C3%A9er-son-projet-num%C3%A9rique#:~:text=Toute%20cr%C3%A9ation%20de%20projet%20est,la%20coordination%20globale%20du%20r%C3%A9seau." target="_blank">création d'un projet</a>.
							La validation de votre projet vous permettra de retrouver les clefs nécessaires à l'API tel que l'identifiant de votre projet et la clef API.
							Ils sont tous les deux uniques. Vous trouverez les clefs dans la rubrique <b>informations générales</b> de votre projet.</p>
						
						<br>
						<img src="images/apidae8.jpg" alt="Information générales du projet">
						
						
						<p>Les deux valeurs à noter dans le fichier config.php sont :</p>
						<p>Identifiant	:&nbsp;&nbsp;<code>6775</code></p>
						<p>Clef d'API	:&nbsp;&nbsp;<code>AbcdeF</code></p>
						
					
				
	<h3 id="clefopenagenda">Obtenir les clefs d'OpenAgenda<a aria-hidden="true" class="anchor" href="#clefopenagenda">#</a></h3>
			
						<p>Vous aurez besoin de 3 clefs : la clé secrète, la clé public et l’agenda UID à saisir dans le fichier config.php. </p>
						<p>L'activation de la clef privé (dites aussi clef secrète) doit être demandé par mail à support@openagenda.com (nécessaire aux opérations d'écriture).</p>
						<p>Une fois cette activation effectuée par OpenAgenda, la clef publique et secrète seront disponibles dans votre interface administrateur. </p>
						<p>Vos clefs d'accès en lecture et écriture sont disponibles dans la rubrique clés API de la page de paramétrage de votre compte </p>
						
<img src="images/clef_openagenda.jpg" alt="Information générales du projet">


						<p>La clef secrète doit être renseignée dans le fichier Config.php de l’API. Le fait de renseigner cette clef permet d’effectuer une demande d’accès (token) aux données OpenAgenda. </p>
						<p>* Voir création d'un Token dans fonction access_token_get($secret) dans le fichier fonctions_API.php</p>
						<p>ATTENTION : le ticket d'accès/token a une durée de vie limitée lors de l'utilisation de votre API.</p>
						<p>Vous pouvez consulter la <a href="https://developers.openagenda.com/authentification/" target="_blank">documentation d'OpenAgenda</a> pour approfondir la procédure d'authentification.</p>
						<p><b>AgendaUid  : </b> l'<b>UID</b> (son numéro d'identification) de l'agenda est visible dans la barre latérale en bas à droite de l'agenda.</p>
						<br>
						<img src="images/uid.jpg" alt="Information générales du projet">
						<br>

						<p><b><h3>Les trois valeurs à noter dans le fichier config sont donc :</h3></b></p>
						<p>Clef public  :&nbsp;&nbsp;<code>3cadd4ccb8484442a87432cf0f94c</code></p>
						<p>Clef secrète :&nbsp;&nbsp;<code>c071a53f48074d6c8c849fb1f0223</code><br></p>
						<p>AgendaUid    :&nbsp;&nbsp;<code>65630513</code><br></p>



						
					<h2 id="query-parameters">Les fichiers sources de l'API<a aria-hidden="true" class="anchor" href="#query-parameters"># Contenu du dossier</a></h2>
					<h3 id="basics">Descriptif<a aria-hidden="true" class="anchor" href="#basics"> > Fichiers PHP</a></h3>
					<p>l'API est développée en PHP. Le PHP est un langage de programmation web simple et efficace. Il est préférable d'avoir quelques notions de programmation pour éditer et utiliser l'API.</p>
					<p>L'API a été compressée dans un fichier au format ZIP. Il contient un dossier <b>/fonctions</b>, un dossier <b>/exemple</b> et deux fichiers d'utilisation dans le dossier racine.</p>
					<table>
						<thead>
							<tr>
								<th>Fichiers</th>
								<th style="text-align:left">Descriptions</th>
								<th>Dossier</th>
								<th style="text-align:center">Modifier?</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><code>config.php</code></td>
								<td style="text-align:left">Ce fichier contiendra vos clefs APIDAE et OpenAgenda.</td>
								<td>API/config/</td>
								<td style="text-align:center"><b>OUI</b></td>
							</tr>
							<tr>
								<td><code>fonctions_API.php</code></td>
								<td style="text-align:left">Ce fichier contient toutes les fonctions utiles à l'API.</td>
								<td>API/fonctions/</td>
								<td style="text-align:center"><b>NON</b></td>
							</tr>
							<tr>
								<td><code>test_api.php</code></td>
								<td style="text-align:left">Fichier d'exemple pour <b>lire</b> et <b>afficher</b> les données sur OpenAgenda et APIDAE. Affichage brut des données. </td>
								<td>API</td>
								<td style="text-align:center"><b>OUI</b></td>
							</tr>
							<tr>
								<td><code>create_event.php</code></td>
								<td style="text-align:left">Création d'un événement sur OpenAgenda. Ajoute un événement à modérer.</td>
								<td>API</td>
								<td style="text-align:center"><b>OUI</b></td>
							</tr>							
							<tr>
								<td><code>update_event.php</code></td>
								<td style="text-align:left">Mise à jour d'un événement <b>déjà</b> existant sur Openagenda. Il peut être créé avec le fichier d'exemple create_event.php</td>
								<td>API</td>
								<td style="text-align:center"><b>OUI</b></td>
							</tr>								
						</tbody>
					</table>
					<p></p>
		
				
					<h2 id="responses">Utilisation des clefs<a aria-hidden="true" class="anchor" href="#responses">> Edition de config.php</a></h2>
					<p>Vous avez à présent toutes les clefs APIDAE et OpenAgenda. Vous pouvez modifier votre fichier config.php.</p>
						<p>Clef public  :&nbsp;&nbsp;<code>3cadd4ccb8484442a87432cf0f94c</code></p>
						<p>Clef secrète :&nbsp;&nbsp;<code>c071a53f48074d6c8c849fb1f0223</code><br></p>
						<p>AgendaUid    :&nbsp;&nbsp;<code>65630513</code><br></p>
						<p>Identifiant  :&nbsp;&nbsp;<code>6775</code></p>
						<p>Clef d'API :&nbsp;&nbsp;<code>AbcdeF</code><br></p>
						
					<h3 id="default-response">Config.php<a aria-hidden="true" class="anchor" href="#default-response">Valeurs à saisir </a></h3>
					<p>Vous devez copier et coller vos clefs dans ce fichier. La moindre erreur peut empêcher son bon fonctionnement.</p> 

					
					<pre><code class="language-nof">
	$keys = array( /* Les clés API permettent de lire et écrire des données sur OpenAgenda via l'API. */
	  'public' => '3cadd4ccb8484442a87432cf0f94c', /* Pour OpenAgenda en lecture */
	  'secret' => 'c071a53f48074d6c8c849fb1f0223'  /* Pour OpenAgenda en mode écriture et autres*/
	);

	/*
		Clef disponible via la page : https://openagenda.com/martigues-tourisme
	*/
	$agendaUid = 65630513;  
	/* Valeur d'exemple à retrouver dans votre APIDAE  : */
	$territoireIds = array('5693912'); /* Conseil de territoire : Pays de Martigues */ 
	$selectionIds = array('126230');

	$apiDomain = "http://api.apidae-tourisme.com/api/";
	
	$apiKey = 'AbcdeF'; // LA CLEF de l'API APIDAE  
	$projetId = '6775'; 
	
	$nbResult = '200'; 

	/*
	 *  Requêtes Apidae
	 */

	$requete = array(); /* Sauvegarde de la requête dans un tableau */

	$requete['territoireIds'] = $territoireIds;
	$requete['selectionIds'] = $selectionIds;
	$requete['identifiants'] = $identifiants;
	$requete['apiKey'] = $apiKey;
	$requete['projetId'] = $projetId;
	//$requete['dateDebut'] = date("Y-m-d"); /* Défini un début de période dans la liste des événements */
	// $requete['dateDebut'] = "2022-09-10"; /* date("Y-m-d") = date du jour ou une date en clair "2022-09-10" */
	
	// Vous pouvez afficher SEULEMENT une liste via leur identifiant 
	// $identifiants = array( '5591771','5591811','5591834','5592056','5592230','5801215');
					
	$requete['identifiants'] = $identifiants;
	$requete["responseFields"] = array("@all");
	$url_Apidae = $apiDomain."v002/agenda/detaille/list-objets-touristiques/";
	$url_Apidae .= '?';
	$url_Apidae .= 'query='.urlencode(json_encode($requete));
	$url_OpenAgenda="https://openagenda.com/agendas/".$agendaUid."/events.v2.json?key=".$keys['public'];
	
	/* Pour la création de la requête ADRESSE */
	$department		= 	"Bouches-du-Rhône"; 
	$timezone		=	"Europe/Paris"; /* Fuseau horaire de référence */
	$countryCode 	= 	"FR";
	
</code></pre>
					<p> Vous pouvez indiquer une liste d'événement via leurs identifiants sous forme d'un tableau, ainsi qu'une date de début des événements.</p>
					<p><i>Ils ont été notés dans le fichier config.php en commentaires via // </i></p>
					<pre><code class="language-nof">
	//$requete['dateDebut'] = date("Y-m-d"); /* Défini un début de période dans la liste des événements */
	// $requete['dateDebut'] = "2022-09-10"; /* date("Y-m-d") = date du jour ou une date en clair "2022-09-10" */
					</code></pre>	
		
					<hr style="border-top: 1px solid rgba(255,255,255,0.15);">
	
					<h2 id="extended-response">Les requêtes<a aria-hidden="true" class="anchor" href="#extended-response">#</a></h2>
					<p>Toutes les demandes de lectures et d'écritures se font par des requêtes construites en format <b>JSON</b>. Le JSON, pour JavaScript Object Notation, est un format d'échange de données structurées.</p>
					<p> Exemple d'une requête envoyé par l'API pour se connecter à APIDAE, toutes ces valeurs viennent du fichier config.php.</p>
					
					<p> La requête en clair : </p>				
				<pre><code class="language-nof">
{
  "query" : {
    "selectionIds" : [ 126230 ],
    "territoireIds" : [ 5693912 ],
    "searchFields" : "NOM_DESCRIPTION_CRITERES",
    "dateDebut" : "2022-08-30",
    "first" : 0,
    "count" : 20,
    "order" : "IDENTIFIANT",
    "asc" : true,
    "responseFields" : [ "@all" ],
    "apiKey" : "AbcdeF",
    "projetId" : 6775
  }
</code></pre>					
					
					<!-- <p>La requête est convertie grâce à une ligne de codes dans le fichier <code>config.php</code>.Le fichier <code>test_api.php</code> se charge de l’exécuter.</p>					
					<p>La requête mentionnée ci-dessus est traduite par la ligne de code ci-dessous (visible dans le fichier config.php) :</p>
					<pre><code class="language-nof">$url_Apidae .= 'query='.urlencode(json_encode($requete));</code></pre>
					<p>Explications : <code>urlencode</code> va la convertir pour l'envoyer via l'URL "http://api.apidae-tourisme.com/api/v002/agenda/detaille/list-objets-touristiques/?query=%7B%22<b>territoireIds</b>%22%3A%5B%22<b>5693912</b>%22%5D%2C%22selection..."<p>

					<p>Et dans le fichier test_api.php : </p>
					<pre><code class="language-nof">$results_API = API_Resource($url_Apidae);</code></pre>
					<p>La requête mentionnée ci-dessus est également traduite par la ligne de code ci-dessous (visible dans le fichier test_api.php) :</p>
					<p><code>API_Resource</code> est la fonction qui va se charger de la requête à envoyer à APIDAE</p> -->
			
			
			
				<p>La requête est convertie grâce à une ligne de codes dans le fichier config.php . Le fichier test_api.php se charge de l’exécuter.</p>
				<p>La requête mentionnée ci-dessus est traduite par la ligne de code ci-dessous (visible dans le fichier config.php) :</p>
				<p><pre><code class="language-nof">$url_Apidae .= 'query='.urlencode(json_encode($requete));</code></pre></p>

				<p>Explications : urlencode est la fonction qui va convertir la requête pour l'envoyer sur APIDAE via l'URL :
				<p><pre><code class="language-nof">"http://api.apidae-tourisme.com/api/v002/agenda/detaille/list-objets-touristiques/?query=%7B%22territoireIds%22%3A%5B%225693912%22%5D%2C%22selection..."</code></pre></p>
				<p>La requête mentionnée ci-dessus est également traduite par la ligne de code ci-dessous (visible dans le fichier test_api.php) :</p>
				<p><pre><code class="language-nof">$results_API = API_Resource($url_Apidae);</code></pre></p>

				<p>Explications : API_Resource est la fonction qui va se charger de la requête à envoyer à APIDAE</p>
				<p><b>PHP</b></p>

	<pre><code class="language-nof">
function API_Resource($url_source)
{
	$session = curl_init(); /* initialise une nouvelle session et retourne un identifiant de session cURL à utiliser avec les fonctions curl_setopt(), curl_exec() et curl_close(). */
	curl_setopt($session, CURLOPT_POST, 1);
	curl_setopt($session, CURLOPT_URL, $url_source);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

	$result = curl_exec($session);
	if (!$result)	{
		die("Il existe une erreur dans votre URL !! ");
	}
	curl_close($session); /* Fermeture de la session */
	
	return $result; 

}
</code></pre>	

<p>Le résultat est un flux/fichier au format JSON. Vous trouverez un exemple dans le dossier <code>\exemples\JSON-APIDAE.txt </code></p>

<h2 id="token">Création d'un Token d'accès</h2>

<p>Avant toute manipulation de données, vous devez récupérer un token d'accès valide nécessaire aux opérations en écriture.</p>
<p>La fonction access_token_get est disponible dans le fichier fonctions_API.php. Elle vous permet d’en faire la demande à OpenAgenda. La clef secrète ($secret) récupéré au préalable est la variable qui sera vérifiée par OpenAgenda.  </p>

<p><b>PHP</b></p>

<pre><code class="language-nof">	
function access_token_get($secret)
{
	$Url_AccessToken =  'https://api.openagenda.com/v2/requestAccessToken';
	$retour_curl = curl_init(); /* Initialise une session cURL */ 
	/* Initialise une nouvelle session et retourne un identifiant de session cURL à utiliser avec les fonction */
    curl_setopt($retour_curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($retour_curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt( $retour_curl, CURLOPT_URL, $Url_AccessToken );
	curl_setopt($retour_curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($retour_curl, CURLOPT_POST, true);
	curl_setopt($retour_curl, CURLOPT_POSTFIELDS, array(
		'grant_type' => 'authorization_code',
		'code' => $secret
	));

  $received_content = curl_exec($retour_curl);
  $access_token = json_decode( $received_content, true )["access_token"];

  return $access_token;
}
</code></pre>

<p>NB : Vous trouverez dans les fichiers sources PHP (dossier API), une demande de token via la fonction ci-contre : </p>
<p><pre><code class="language-nof">$accessToken = access_token_get($keys['secret']);</code></pre></p>
<p>On va retrouver la variable $accessToken dans chaque fonction liée à OpenAgenda. Exemple :  </p>
<pre><code class="language-nof">create_localisation_event($accessToken,$Openagenda_event_adresse,$agendaUid);</code></pre></p>

<p>Veuillez trouver ci-contre, un exemple d'un token retourné par la fonction : </p>
<p><pre><code class="language-nof">03a502330951edff9495a17adf1b6234</code></pre></p>


<h2 id="createve">Analyse des données APIDAE<a aria-hidden="true" class="anchor" href="#createve">#</a></h2>
					
<!--	
				echo "<br/><br/>";
				echo "├state > [<b>". $retourfiche->state."</b>] <br />";		
				echo "├titre/nom > [<b>".$titre."</b>] <br />";	
				echo "├descriptifCourt > [<b>". substr($retourfiche->presentation->descriptifCourt->libelleFr, 0, 80)."...</b>] <br />";	
				echo "├descriptifDetaille > [<b>".	substr($retourfiche->presentation->descriptifDetaille->libelleFr, 0, 80)."...</b>] <br />";	
				echo "├Note > [<b>".				substr($retourfiche->presentation->typologiesPromoSitra[0]->libelleFr, 0, 80)."...</b>] <br />";	
				echo "├Communication > [<b>". $retourfiche->informations->moyensCommunication[0]->type->libelleFr."</b> │ <b>". $retourfiche->informations->moyensCommunication[0]->coordonnees->fr."</b>] <br />";	
				echo "├Site > [<b>".$retourfiche->gestion->membreProprietaire->siteWeb."</b>] <br />";		
				echo "├date > [<b>". $retourfiche->ouverture->periodeEnClair->libelleFr."</b>] <br />";		
				echo "├Adresse > [<b>". $event_adresse."</b>] <br />";
				echo "├reservation > [<b>". $retourfiche->reservation->organismes[0]->moyensCommunication[0]->coordonnees->fr."</b>] <br />";
				for  ($j=0;$j<$nb_date_ouverture;$j++) 
				echo "├ Période : ".$event_heure_ouverture[$j]['date']." -> Debut <b>".$event_heure_ouverture[$j]['begin']." </b>│ Fin :".$event_heure_ouverture[$j]['end']."</br>";
				echo "</pre>";	
				echo "├Nombre de tarif : [<b>". $nb_tarif."</b>] - TarifsEnClair : <b>".$tarifsEnClair."</b><br />";					
				for  ($j=0;$j<$nb_tarif;$j++) 
					echo "├ tarifs_minimum : ".$event_tarif[$j]['tarifs_minimum']." -> tarifs_maximum <b>".$event_tarif[$j]['tarifs_maximum']." </b>│ cible_tarif :".$event_tarif[$j]['tarif_cible']."</br>";
				echo "</pre>";	
				echo "├Adresse > [<b>". $event_adresse."</b>] <br />";
				echo "└geolocalisation > [<b>". $geolocalisation_lat.",". $geolocalisation_long."</b>] <br /><hr>";						
				
-->				

<p>La variable $Openagenda_event_data que l’on retrouve dans le fichier create_event.php ; est utilisée dans l'API . Elle utilise les données APIDAE pour les envoyer à l’OpenAgenda. </p>
<p>On parlera ici d'objet lorsque nous souhaitons accéder aux données. </p>
<p>Les valeurs comme « title », « image », « description » et « locationUid » sont obligatoires. Ce sont des chaînes de caractères ou des tableaux.</p>

<p><b>PHP</b></p>		
<pre><code class="language-nof">					
$Openagenda_event_data = array(
	'title' => array('fr' => $titre),
	'state' => 0, 
	'image' 			=> 	array('url' => $event_illustrations[0]['photo_url']),
	'imageCredits'	=>	$event_illustrations[0]['photo_copyright'],
	'locationUid' 	=> 	$result_uid_location, 
	'longDescription' => 	array('fr'=> $descriptifDetaille),
	'description' 	=> 	array('fr'=> substr($descriptifCourt, 0, 200).'...'), 
	'public' 			=> 	25,	
	'conditions'		=> 	$result_event_tarif,
	'registration' 	=> 	array('fr'=> $reservation_registration),
	'nature' 			=> 	57, /* NON DOCUMENTÉ */
	'thematique' 		=>	2,  /* NON DOCUMENTÉ */
	'fadas' 			=>	46, /* NON DOCUMENTÉ */
	'featured'		=> 	false, /* true quand l'événement doit apparaître en tête de liste ( en une ) */
	'keywords' 		=> 	array('fr' => "Visite, Photographie, Nature"),
	'timings' 		=> 	$event_heure_ouverture,
	'slug' 			=>	$slug					  
);
</code></pre>

	<p><h4>Format des données relatives à l'API</h4></p>
<p>La variable $retourfiche contient tous les objets de votre projet APIDAE. Par conséquent, votre projet APIDAE nécessite de contenir des sélections et/ou des filtres afin d’afficher un contenu. </p>
<p>La variable est présente dans les fichiers test_api.php, create_event.php et update_event.php. Dans les explications qui suivent, nous retrouverons constamment la variable $retourfiche. </p>
<p>Exemple : <code>$titre = $retourfiche->nom->libelleFr;</code>. Nous affichons ici le titre de l'événement (voir ci-dessous)</p>

	<!-- **************************************************************************************************************************** -->
	<p><h4 id="titre">* titre de l'événement : </h4></p>

Le titre qui s’affiche dans l’objet APIDAE (JSON) :
"nom" : {
	"libelleFr" : "Rando-découverte de l'Etang de Berre"
},

<p>La ligne de code pour obtenir la donnée depuis APIDAE : </p>
<pre><code class="language-nof">$titre = $retourfiche->nom->libelleFr;</code></pre>
<p>La ligne de code dans la requête pour OpenAgenda <code>'title' => array('fr' => $titre) sous forme de tableau array('fr'=>"Rando..",'en'=>"Hike..").</code></p>
<p>Note : Nous traitons ici QUE la version "FR" du titre de l'événement.</p>
<p>Le résultat obtenu dans l’OpenAgenda title (JSON) :</p>
    <p><pre><code class="language-nof">"title": {
        "fr": "Rando-découverte de l'Etang de Berre",
        "en": "Hike-discovery of the Etang de Berre",
    },</code></pre></p>


	<!-- **************************************************************************************************************************** -->
	
	<!-- <p>Le résultat obtenu dans l’OpenAgenda title (JSON)</p>
	
	<pre><code class="language-nof">"nom" : {
	"libelleFr" : "Rando-découverte de l'Etang de Berre"
	},</code></pre>
	
	-->
	
	<h4 id="state">* Etat de l'événement - state : </h4>
	<p><code class="language-nof">'state' => 0,</code> <i>  Valeur uniquement dans OpenAgenda.</i></p>
	<p> State représente l'état de la publication de votre événement avec : </p>
	<p>
	- 0 : événement non publié et à modéré  (recommandé).<br>
	- 1 : événement non publié, prêt à publier.<br>
	- 2 : événement publié (valeur par défaut si state n'est pas dans la requête)<br></p>
	
						  
	<p><h4 id="image">* image & copyright: </h4></p>
	<p>Attention : l'API prend en compte une seule image et donc un seul crédit photo.</p>
	
	<p>Les données récupérées de l’objet APIDAE (JSON) : </p>
<pre><code class="language-nof">"illustrations" : [ {
	"identifiant" : 12416505,
	"link" : false,
	"type" : "IMAGE",
	"nom" : {
	"libelleFr" : "Camping Paradis, visite des décors"
	},
	"legende" : { },
	"copyright" : {
	"libelleFr" : "OTC Martigues"
	},
	"traductionFichiers" : [ {
	"locale" : "fr",
	"url" : "https://static.apidae-tourisme.com/filestore/objets-touristiques/images/145/233/12577169.jpg",
	"urlListe" : "https://static.apidae-tourisme.com/filestore/objets-touristiques/images/145/233/12577169-liste.jpg",
	"urlFiche" : "https://static.apidae-tourisme.com/filestore/objets-touristiques/images/145/233/12577169-fiche.jpg",
	"urlDiaporama":"https://static.apidae-tourisme.com/filestore/objets-touristiques/images/145/233/12577169-diaporama.jpg",
	"extension" : "jpg",
	"fileName" : "20190816_094658",
	"taille" : 2946673,
	"hauteur" : 3024,
	"largeur" : 4032,
	"lastModifiedDate" : "2022-02-10T15:56:05.770+0000"
} ],</code></pre>

<p>La ligne de code pour obtenir les données depuis APIDAE : </p>
<p><pre><code class="language-nof">$photo_url			= $retourfiche->illustrations[0]->traductionFichiers[0]->urlDiaporama;
$photo_copyright 	= $retourfiche->illustrations[0]->traductionFichiers[0]->copyright->libelleFr;
$photo_fileName		= $retourfiche->illustrations[0]->traductionFichiers[0]->fileName;
$photo_libelleFr	= $retourfiche->illustrations[0]->traductionFichiers[0]->nom->libelleFr;
					
$event_illustrations = array(	'photo_url'	=> $photo_url,
								'photo_copyright' 	=> $photo_copyright,
								'photo_fileName'	=> $photo_fileName,
								'photo_libelleFr'	=> $photo_libelleFr	   );
</code></pre>
</p>
<p>Pour tester l’affichage de la photo avec le crédit photo à tout moment, voici le code à intégrer : </p>

<pre><code class="language-nof">echo '&lsaquo;img src="'.$event_illustrations[0]['photo_url'].'" width="240px" height="200px" style="border-radius:8px"&rsaquo;'; 
echo 'Crédit '.$event_illustrations[0]['photo_copyright'];</code></pre>	

<p>Le résultat obtenu dans l’OpenAgenda image -> url (JSON) :</p>

<pre><code class="language-nof">"image": {
	"url" : "https://static.apidae-tourisme.com/filestore/objets-touristiques/images/145/233/12577169-diaporama.jpg"
},</code></pre>


	<p><h4 id="adresse">* Création de l'adresse & GPS.</h4></p>
	<p>Avant la création d'un événement, vous devez créer un lieu, comme un bâtiment, parc, plage, etc. Chaque lieu à son identifiant propre. Vous devrez par la suite l'associer à votre événement.</p>
	
	<p>La localisation qui s’affiche dans l’objet APIDAE (JSON) : </p>
	
	<pre><code class="language-nof"> "localisation" : {
        "adresse" : {
          "nomDuLieu" : "Lieu de tournage de la série Camping Paradis",
          "adresse1" : "Chemin de la batterie",
          "adresse2" : "Après le camping L'Arquet - Côte Bleue",
          "adresse3" : "La Couronne",
          "codePostal" : "13500",
          "commune" : {
            "id" : 4467,
            "code" : "13056",
            "nom" : "Martigues",
            "pays" : {
              "elementReferenceType" : "Pays",
              "id" : 532,
              "libelleFr" : "France",
              "ordre" : 78
            },
            "codePostal" : "13500"
          }
        },
        "geolocalisation" : {
          "valide" : true,
          "geoJson" : {
            "type" : "Point",
            "coordinates" : [ 5.056848, 43.328275 ]
          }
        },
        "perimetreGeographique" : [ {
          "id" : 4467,
          "code" : "13056",
          "nom" : "Martigues",
          "pays" : {
            "elementReferenceType" : "Pays",
            "id" : 532,
            "libelleFr" : "France",
            "ordre" : 78
          },
          "codePostal" : "13500"
        } ],
        "lieu" : {
          "id" : 15156
        }
      },</code></pre>
	<!--<p> Objet OPENAGENDA <b>location</b> (JSON) :</p>
<pre><code class="language-nof">"location": {
	"city": "La Couronne"",
	"timezone": "Europe/Paris",
	"postalCode": "13500",
	"latitude": 43.328275,
	"countryCode": "FR",
	"department": "Bouches-du-Rhône",
	"longitude": 5.056848,
	"address": "Chemin de la batterie, Après le camping L'Arquet - Côte Bleue",
	"name": "Lieu de tournage de la série Camping Paradis",
	},</code></pre>-->
<p> Ligne de code pour obtenir les données depuis APIDAE : </p> 

<pre><code class="language-nof">
$event_adresse = $retourfiche->localisation->adresse->nomDuLieu.", ";	
$event_adresse.= $retourfiche->localisation->adresse->adresse1.", ";	
$event_adresse.= $retourfiche->localisation->adresse->adresse2.", ";	
$event_adresse.= $retourfiche->localisation->adresse->codePostal." ";	
$event_adresse.= $retourfiche->localisation->adresse->commune->nom;		

$event_adresse.=", ".$retourfiche->localisation->adresse->commune->pays->libelleFr." ";

$geolocalisation_long		=$retourfiche->localisation->geolocalisation->geoJson->coordinates['0'];
$geolocalisation_lat		=$retourfiche->localisation->geolocalisation->geoJson->coordinates['1'];
$complement_geolocalisation	=$retourfiche->localisation->geolocalisation->complement->libelleFr;
								
$nomDuLieu 	= $retourfiche->localisation->adresse->nomDuLieu;
$codePostal = $retourfiche->localisation->adresse->codePostal;
$ville		= $retourfiche->localisation->adresse->commune->nom;
</code></pre>			

<p>Note : vous pouvez déterminer si la valeur existe avec la fonction php isset. Si la valeur est inexistante, elle ne sera pas reprise dans la création de l’adresse. </p>
<pre><code class="language-nof">if (isset($retourfiche->localisation->adresse->commune->pays->libelleFr))	{
$event_adresse.=", ".$retourfiche->localisation->adresse->commune->pays->libelleFr." ";
		}</code></pre>

<p>La valeur « countryCode » dans OpenAgenda équivaut à la valeur "Code Pays" d’APIDAE ( voir countryCode Code pays ISO 3166-1 Alpha 2). Vous la trouverez dans le fichier config.php à "FR".</p>
<p>Le tableau "coordinates" récupéré d’APIDAE contient 2 valeurs GPS : [ 5.056848, 43.328275 ]. On utilise la variable coordinates['0'] pour 5.056848 et la variable coordinates['1'] pour 43.328275.</p> 

<pre><code class="language-nof">$geolocalisation_long=$retourfiche->localisation->geolocalisation->geoJson->coordinates['0'];
$geolocalisation_lat=$retourfiche->localisation->geolocalisation->geoJson->coordinates['1'];</code></pre>

<p> Création de la requête : <p>
<pre><code class="language-nof">
$Openagenda_event_adresse = array(
'name' 			=> 	$nomDuLieu,
'address' 		=> 	$event_adresse,
'postalCode'	=> 	$codePostal,
'city'			=> 	$ville,
'department'	=>	$department,				/* Dans config.php car non présent dans le json d'APIDAE */
'timezone'		=>	$timezone,					/* config.php */
'countryCode' 	=>	$countryCode,				/* config.php */
'latitude'		=> 	$geolocalisation_lat,
'longitude'		=> 	$geolocalisation_long,
);</code></pre>
</p>
<p><b>Note</b> : il y a une concaténation de l'adresse avec <code>$event_adresse.=</code> car il n'existe qu'un objet pour la sauvegarder avec cette ligne <code>'address'=>$event_adresse</code></p> 
<p>Plus d'info ici -> <a href="https://developers.openagenda.com/10-structure-lieu/" target="_blank">https://developers.openagenda.com/10-structure-lieu/</a> </p>

<p>Le résultat attendu sur l’OpenAgenda location (JSON) :</p>
<pre><code class="language-nof">"location": {
	"city": "La Couronne"",</code></pre>

	
	<p><h2 id="description">* Description court et détaillé : </h2></p>
<p>La description courte de l'événement est limitée à 200 caractères par langue - ce champ est OBLIGATOIRE.</p>
<p>La description longue est limitée à 10000 caractères par langue – ce champ est OPTIONNEL. L’événement pourra se créer sur l’OpenAgenda sans avoir de descriptif détaillé. Ce qui n’est pas le cas s’il n’a pas de descriptif court. </p>


<pre><code class="language-nof">$descriptifCourt	= $retourfiche->presentation->descriptifCourt->libelleFr;
$descriptifDetaille	= $retourfiche->presentation->descriptifDetaille->libelleFr;
</code></pre>


<p><h2 id="mot">* Les mots clefs.</h2></p>

<p>Les thèmes des fiches APIDAE de type manifestation sont repris dans le champ « Mots clés » de la fiche OpenAgenda. La quantité des tags est limité à 100 sous réserve que la chaîne de caractère n’atteint pas 255 caractères. Ce champ est optionnel. </p>

<pre><code class="language-nof">$b=0;$keywords="";
do 	{ /* la virgule permet de couper les mots par OpenAgenda */
	$keywords.=$retourfiche->informationsFeteEtManifestation->themes[$b]->libelleFr.", ";
}
while ($retourfiche->informationsFeteEtManifestation->themes[++$b]->libelleFr!="");
$keywords=substr($keywords, 0, -2); /* Pour supprimer la virgule en fin de chaine et l'espace ", " */</code></pre>



<p><h2 id="date">* Gestions des dates :</h2></p> 
<p></p>

<p>A noter : Il existe un décalage horaire de 2h entre la date affichée sur APIDAE et celle importé dans OpenAgenda. Il s’agit d’un bug connu à laquelle nous avons apporté un correctif au sein de l’API. </p>

<p>Pour pallier à ce problème, nous avons ajouté 2h à l’heure de début et de fin avec le bout de code « +0200 ». Exemple ci-dessous </p>
<p></p>

<pre><code class="language-nof"> => $begin."+0200";</code></pre>
<p></p>

<p>Important à savoir : Chaque objet doit contenir obligatoirement un horaire de fin. L’absence d’information pour ce champ empêche la bonne publication de l’objet sur l’OpenAgenda. </p>

<p>Forme de la date à avoir sur OpenAgenda : </p>
<pre><code class="language-nof">{
  "begin": "2021-02-25T17:00:00+0200",
  "end": "2021-02-25T19:00:00+0200"
},</code></pre>

<p></p>

<pre><code class="language-nof">$nb_date_ouverture=0;
do 
{
/* Recherche des horaires - Ouvertures et fermetures ainsi que la date en cours  */
$begin=$json_event_date_ouverture->periodesOuvertures[$nb_date_ouverture]->dateDebut."T".$json_event_date_ouverture->periodesOuvertures[$nb_date_ouverture]->horaireOuverture;
$end=$json_event_date_ouverture->periodesOuvertures[$nb_date_ouverture]->dateFin  ."T".$json_event_date_ouverture->periodesOuvertures[$nb_date_ouverture]->horaireFermeture;
$date_ouverture=$json_event_date_ouverture->periodesOuvertures[$nb_date_ouverture]->dateDebut;
$event_heure_ouverture[] = array('begin' => $begin."+0200", 'end' => $end."+0200");
} 
while ($json_event_date_ouverture->periodesOuvertures[++$nb_date_ouverture]->dateDebut!="");</code></pre>


<p></p>

<p><h2 id="tarif">* Tarif en clair : </h2></p>

<p>Ici, nous récupérons les « tarifs en clair » sur APIDAE. Cette astuce permet de remplir directement le champ « Conditions de participation, tarifs » disponible sur OpenAgenda. Le champ ne peut pas excéder le nombre de 255 caractères. </p>

<p><b>PHP</b></p>

<pre><code class="language-nof">$tarifsEnClair=$retourfiche->descriptionTarif->tarifsEnClair->libelleFr;	</code></pre>

<p>Il existe néanmoins un bout de code source qui extrait les tarifs pour y récupérer toutes les plages des tarifs mini, maxi ainsi que la cible s’y attachant. 

<pre><code class="language-nof">$nb_periode=0;
do 	{	
	do 	{
		$tarifs_minimum=$retourfiche->descriptionTarif->periodes[$nb_periode]->tarifs[$nb_tarif]->minimum;					
		$tarifs_maximum=$retourfiche->descriptionTarif->periodes[$nb_periode]->tarifs[$nb_tarif]->maximum;	
		$tarif_cible=$retourfiche->descriptionTarif->periodes[$nb_periode]->tarifs[$nb_tarif]->type->libelleFr;	
		$tarif_description=$retourfiche->descriptionTarif->periodes[$nb_periode]->tarifs[$nb_tarif]->type->description;	
		$event_tarif[$nb_tarif]= array('tarifs_minimum'=>$tarifs_minimum, 'tarifs_maximum'=>$tarifs_maximum, 'tarif_cible'=>$tarif_cible, 'description'=>$tarif_description);
	} 
	while ($retourfiche->descriptionTarif->periodes[$nb_periode]->tarifs[++$nb_tarif]->minimum!="");
} 
while ($retourfiche->descriptionTarif->periodes[++$nb_periode]->tarifs[$nb_tarif]->minimum!="");</code></pre>



<!--

					<h2 id="token">Création d'un Token<a aria-hidden="true" class="anchor" href="#token">#</a></h2>
				
					<p>Avant toute écriture sur Openagenda, vous devez recupérer un token qui vous servira via la fonction <b>access_token_get($secret)</b> </p>
					
					
				<pre><code class="language-nof">					
function access_token_get($secret)
{
  $Url_AccessToken =  'https://api.openagenda.com/v2/requestAccessToken';

  $retour_curl = curl_init(); /* Initialise une session cURL */ 

	/* Initialise une nouvelle session et retourne un identifiant de session cURL à utiliser avec les fonction */
    curl_setopt($retour_curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($retour_curl, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt( $retour_curl, CURLOPT_URL, $Url_AccessToken );
	curl_setopt($retour_curl, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($retour_curl, CURLOPT_POST, true);

	curl_setopt($retour_curl, CURLOPT_POSTFIELDS, array(
		'grant_type' => 'authorization_code',
		'code' => $secret
	));

  $received_content = curl_exec($retour_curl);
  $access_token = json_decode( $received_content, true )["access_token"];
  return $access_token;
}					
</code></pre>					
					
					
		-->			
<!--
					<ul>
						<li>Private pages or pages that require authentication or login</li>
						<li>Advanced bot-prevention installed at the targeted website</li>
						<li>Captcha protection</li>
						<li>Paywall protection</li>
						<li>Temporary networking issues or downtimes</li>
						<li>Webmasters not following best practices (no <a href="https://www.linkpreview.net/open-graph-meta-tags/">meta tags</a>, <a href="https://www.linkpreview.net/open-graph-meta-tags/">open graph</a>, or other content clues)
						</li>
						<li>Restrictions based on IP address or range of addresses (known cloud providers block)</li>
						<li>Crawling exclusion by robots.txt rules (error 423)</li>
					</ul>
					
					
					<p>You can use our <a href="https://my.linkpreview.net/">Preview Tool</a> to try and report incorrect URL, or use <a href="https://cards-dev.twitter.com/validator">Similar Validator</a> to double-check if the URL can be parsed correctly by a different engine.</p>
					<h2 id="image-processing-and-validation">Image Processing and Validation<a aria-hidden="true" class="anchor" href="#image-processing-and-validation">#</a></h2>
					<p>Sometimes the website can provide og:image that is not accessible, served via the insecure HTTP protocol, invalid, or the URL is simply wrong. LinkPreview API can help and process images to validate them and extract additional data such as image width, image height, content-type, and size. Supported web image formats include <code>jpeg</code>, <code>png</code>, <code>gif</code>, <code>ico</code>, and <code>webp</code> images up to 5MB in size.</p>
					<p>To validate the image, send your request with additional field <code>image_size</code> and check if the returned image size is greater than zero. You can also use image width and height parameters to calculate the image orientation (portrait/landscape) and use that to decide which of your layouts to render. You can use image size to discard images that are too small or too big for your specific layout.</p>
					<p>It is highly recommended to set up a proxy and serve all the images through your own cached and secure environment without leaking users IP addresses. See <a href="https://github.com/interactive32/lpproxy">example</a>.</p>
					<h2 id="same-origin-policy">Same-origin policy<a aria-hidden="true" class="anchor" href="#same-origin-policy">#</a></h2>
					<p>Bypassing same-origin policy is handled automatically. You can use either CORS or JSONP requests to bypass same-origin policy in your front-end application. Since CORS allows you to use POST requests we recommend this method for all modern applications. JSONP is provided for compatibility reasons.</p>
					<h2 id="caching">Caching<a aria-hidden="true" class="anchor" href="#caching">#</a></h2>
					<p>The LinkPreview API will cache requested pages and it will return the cached response for a while. Any page updates will get noted on its next crawl and not immediately. The exact TTL depends on various parameters and it can take up to a day for this cache to expire.</p>
					<h2 id="per-domain-limits">Per Domain Limits<a aria-hidden="true" class="anchor" href="#per-domain-limits">#</a></h2>
					<p>Each request requires some resources to be allocated from the requested website. Too many connections to a single website imply a lot of burden for that server and can be flagged as a DoS attack. A Denial of Service(DoS) attack means that you are trying to make the server so busy that it’s incapable of dealing with other requests.</p>
					<p>To avoid congestion and protect smaller websites, our service will rate-limit requests made to the same domain in short bursts.</p>
					<p>You can make a maximum of 1 request each second to a single domain. If you go over this limit, the error 426 will be thrown.</p>
					<p>However, this limit is not imposed on high-throughput domains such as Youtube, Amazon, Twitter, etc since they have a lot of resources to handle our requests.</p>
					<p>If you for some reason need a higher limit, please contact us to request the increase.</p>
					
					<p>In order to use the LinkPreview API without attribution, you can upgrade to one of our paid plans.</p>
					
					<h2 id="exemples">Quelques exemples<a aria-hidden="true" class="anchor" href="#exemples">&lt;- Cas pratiques</a></h2>
					
					<p>L'utilisation de notre API nécessite quelques connaissances techniques et des compétences en programmation. Veuillez noter que nous ne fournissons pas de support pour vos applications, plugins, cms ou frameworks Web qui utilisent notre API. Nous n'avons malheureusement pas le temps d'aider tout le monde.</p>
					
					<h3 id="codepen">Codepen<a aria-hidden="true" class="anchor" href="#codepen">#</a></h3>
					
					<p><a href="https://codepen.io/alcalbg/pen/xxONEjW">Simple working example - Frontend with Bulma CSS</a></p>
					
					<p><a href="https://codepen.io/alcalbg/full/XWambRd">LinkPreview HTML Generator - Email Template</a></p>
					
					<h3 id="javascript">Javascript<a aria-hidden="true" class="anchor" href="#javascript">#</a></h3>
					
					<h4 id="post-request-using-javascript--fetch-api">POST request using javascript / Fetch API<a aria-hidden="true" class="anchor" href="#post-request-using-javascript--fetch-api">#</a></h4>
					
					<pre>
						<code class="language-nof">
							var data = {key: '123456', q: 'https://www.google.com'}
							fetch('https://api.linkpreview.net', {
							  method: 'POST',
							  mode: 'cors',
							  body: JSON.stringify(data),
							}).then(res =&gt; {
							  if (res.status != 200) {
								console.log(res.status)
								throw new Error('something went wrong');
							  }
							  return res.json()
							}).then(response =&gt; {
							  console.log(response)
							}).catch(error =&gt; {
							  console.log(error)
							})
						</code>
					</pre>
					<h4 id="post-request-using-javascript--axios">POST request using javascript / axios<a aria-hidden="true" class="anchor" href="#post-request-using-javascript--axios">#</a></h4>
					<pre><code class="language-nof">import axios from 'axios'

axios.post(
  'https://api.linkpreview.net',
  {
    q: 'https://www.google.com',
    key: '123456'
  }).then(resp =&gt; {
    console.log(resp.data)
  }).catch(err =&gt; {
    // something went wrong
    console.log(err.response.status)
  })
</code></pre>
					<h3 id="php-python-ruby-curl">PHP, Python, Ruby, cURL<a aria-hidden="true" class="anchor" href="#php-python-ruby-curl">#</a></h3>
					<h4 id="shell--curl">Shell / cURL<a aria-hidden="true" class="anchor" href="#shell--curl">#</a></h4>
					<pre><code class="language-shell">curl --data "key=123456&amp;q=https://www.google.com" https://api.linkpreview.net
</code></pre>
					<h4 id="php-using-curl">PHP using curl<a aria-hidden="true" class="anchor" href="#php-using-curl">#</a></h4>
					<pre><code class="language-nof">$target = urlencode("https://www.google.com");
$key = "123456";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.linkpreview.net?key={$key}&amp;q={$target}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = json_decode(curl_exec($ch));
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($status != 200) {
    // something went wrong
    print_r($status);
    die;
}

print_r($output);
</code></pre>
					<h4 id="post-request-using-python">POST request using Python<a aria-hidden="true" class="anchor" href="#post-request-using-python">#</a></h4>
					<pre><code class="language-nof">import requests

api_url = 'https://api.linkpreview.net'
api_key = '123456'
target = 'https://www.google.com'
response = requests.get(api_url, params={'key': api_key, 'q': target})
print(response.json())
</code></pre>
					<h4 id="post-request-using-ruby">POST request using Ruby<a aria-hidden="true" class="anchor" href="#post-request-using-ruby">#</a></h4>
					<pre><code class="language-nof">require('httparty')

response = HTTParty.post('https://api.linkpreview.net?key=123456&amp;q=https://www.google.com')
puts response.body

</code></pre>
					<h3 id="jquery">JQuery<a aria-hidden="true" class="anchor" href="#jquery">#</a></h3>
					<h4 id="jquery-simple-cors-request">jQuery simple CORS request<a aria-hidden="true" class="anchor" href="#jquery-simple-cors-request">#</a></h4>
					<pre><code class="language-nof">$.ajax({
    url: "https://api.linkpreview.net?key=123456&amp;q=https://www.google.com",
    success: function(result) {
        console.log(result);
    },
    error: function(error) {
        // something went wrong
        console.log(error.status)
    }
});
</code></pre>
					<h4 id="jquery-preflight-cors-request">jQuery preflight CORS request<a aria-hidden="true" class="anchor" href="#jquery-preflight-cors-request">#</a></h4>
					<pre><code class="language-nof">$.ajax({
    url: "https://api.linkpreview.net?key=123456&amp;q=https://www.google.com",
    type: "GET",
    contentType: "application/json",
    success: function(result){
        console.log(result);
    },
    error: function(error) {
        // something went wrong
        console.log(error.status)
    }
});
</code></pre>
					<h4 id="jquery-cross-origin-request-using-jsonp">jQuery cross-origin request using JSONP<a aria-hidden="true" class="anchor" href="#jquery-cross-origin-request-using-jsonp">#</a></h4>
					<pre><code class="language-nof">var target = "https://www.google.com";
var key    = "123456";

$.ajax({
    url: "https://api.linkpreview.net",
    dataType: "jsonp",
    data: {q: target, key: key},
    success: function (response) {
        if (response.error) {
            console.log(response.description);
            return;
        }
        console.log(response);
    },
    error: function(error) {
        // something went wrong
        console.log(error.status)
    }
});
</code></pre>
					<h3 id="full-frontend-example">Full Frontend Example<a aria-hidden="true" class="anchor" href="#full-frontend-example">#</a></h3>
					<p>Frontend code using Bulma CSS and Javascript with Fetch API:</p>
					<pre><code class="language-nof">
                    
                    TEST
        </code>
    </pre>
	
	-->
				</main>
			</div>
		</div>
		<footer class="footer text-muted">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 order-last order-lg-first">
						<ul class="list-inline">
							<li class="list-inline-item">
								<a href="www.martigues-tourisme.com">martigues-tourisme.com</a> | 2022 | <a href="index2.php">V2</a>
							</li>
						</ul>
					</div>
					<div class="col-lg-8 order-first order-lg-last text-lg-end">
						<ul class="list-inline"></ul>
					</div>
				</div>
			</div>
		</footer>
	
	<script defer src="js/highlight.min.js"></script>
	<script defer src="js/main.min.js"></script>
	
	
	</div>
</body>
</html>