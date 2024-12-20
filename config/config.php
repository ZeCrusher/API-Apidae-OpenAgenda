<?php

	session_start();

	/*
	*---------------------------------------------------------------
	* Les clefs de l'API
	*---------------------------------------------------------------
	*	Note : A quoi servent-elle et comment trouver les clefs public et secret ?
	*
	* Pour cela il vous vous rendre sur le site : https://openagenda.com/settings/apiKey
	* et copier les Cl�s API. 
	*
	* La proc�dure d'authentification � suivre pour �diter du contenu sur OpenAgenda consiste � utiliser votre cl� secr�te 
	* pour r�cup�rer un ticket d'acc�s qui vous servira pendant toute votre session. 
	*
	* ATTENTION : Celui-ci � une dur�e de vie limit�e.
	* Votre cl� secr�te sera mise � disposition sur votre compte OA sur demande � support@openagenda.com
	*  
	*  Vous pouvez consulter la documentation ici : 
	*	INFO ...>  : https://developers.openagenda.com/authentification/
	*/
	
	$_SESSION['last_version'] ="V2022-06-30-TSK"; 

	$keys = array(
	  "public"=>"3cadd4ccb8484442a87432cf0f94c93a", /* Pour OpenAgenda en lecture */
	  "secret"=>"c071a53f48074d6c8c849fb1f0223f4e"  /* Pour OpenAgenda en mode �criture et autres*/
	);

	$agendaUid=65630513; /* <uid:65630513> */
	$territoireIds=array("5693912"); /* Conseil de territoire : Pays de Martigues */ 
	// $selectionIds=array("133484");
	$selectionIds=array("130723"); 

	
	$data_openagenda =array(); /* tableau qui va temporairement sauvegarder les donn�es lu sur OpenAgenda 	*/
	$data_apidae	 =array(); /* tableau qui va �galement sauvegarder les donn�es d'Apidae 				*/


	$apiDomain = "https://api.apidae-tourisme.com/api/";
	
	$apiKey="monapikey"; /* QTfpNkyX <- OK | PhrnH4Dd */
	$projetId="6775"; /*  	6556 Martigues - OpenAgenda */ 
	// $nbResult = '200';
	// $dureemax = "50";

	$requete = array();

	$requete['territoireIds'] = $territoireIds;
	$requete['selectionIds'] = $selectionIds;
	$requete['identifiants'] = $identifiants;
	$requete['apiKey'] = $apiKey;
	$requete['projetId'] = $projetId;
	// $requete['dateDebut'] = date("Y-m-d");   // $requete['dateDebut'] = "2022-09-10";

//	$requete["responseFields"] = array("@all");
	// $requete["responseFields"] = array("@default");

 
	 $requete["responseFields"] = array("id",
										"nom",
										"theme",
										"localisation",
										"descriptionTarif",
										"presentation",
										"reservation",
										"prestations",
										"illustrations",
										"aspects",
										"informations",
										"datesOuverture",
										"ouverture",
										"@informationsObjetTouristique");

	
	$url_Apidae = $apiDomain."v002/agenda/detaille/list-objets-touristiques/";

	$url_Apidae .= '?';
	$url_Apidae .= 'query='.urlencode(json_encode($requete));

	$url_OpenAgenda="https://openagenda.com/agendas/".$agendaUid."/events.v2.json?key=".$keys['public'];
	
	$department		= 	"Bouches-du-Rh�ne";
	$timezone		=	"Europe/Paris";
	$countryCode 	= 	"FR";
	
?>