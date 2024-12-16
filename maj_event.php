<?php 				
				
			
	if (!file_exists("config/config.php")) {	
		header ('Location: 404.html');	exit();	
	} 
	else { 	
		include "config/config.php";
	}
	
	if (!file_exists("fonctions/fonctions_API.php")) 	{	
		header ('Location: 404.html');	exit();	
	} 
	else { 	
		include "fonctions/fonctions_API.php";
	}
			
			
	$Openagenda_event_adresse = array(
		'name' 			=> 	"TEST - Office de Tourisme de Martigues", /* Si vous voulez utiliser l'api a des fin de test, écrivez 'test' dans vos titres et placez une valeur booléenne vrai sous une clé 'test' dans vos requêtes. */
		'address' 		=> 	"Maison du Tourisme",
		'postalCode'	=> 	"13500",
		'city'			=> 	"Martigues",
		'department'	=>	"Bouche du Rhône",				/* Dans config.php car non présent dans le json d'APIDAE */
		'timezone'		=>	"Europe/Paris",					/* idem - config.php */
		'countryCode' 	=>	"FR",							/* idem - config.php */
		'latitude'		=> 	"43.405584024485634", 
		'longitude'		=> 	"5.047411988755189",
		'test'			=> 	false
	);
					
/* Etape 1 - Demande de accessToken - Un token d'accès valide est nécessaire aux opérations d'écriture*/
	$accessToken = access_token_get($keys['secret']); /* $keys['secret'] => voir dans le fichier config.php ou il y a deux clefs, une public et une privé */
	
	$route = "https://openagenda.com/agendas/".$agendaUid."/events.v2.json?key=".$keys['public'];

	$received_content_id_adresse = create_localisation_event($accessToken,$Openagenda_event_adresse,$agendaUid);

	echo "Location : ".$received_content_id_adresse."<br>";

	$result_loc=json_decode($received_content_id_adresse,false);
	if ($result_loc->error!="") { /* En cas d'erreur, arrêt du script avec die !  */
		die("Il existe une erreur dans la création de la Localisation.  ['".$result_loc->error."']");
	}
	$result_uid_location=$result_loc->location->uid;	
	
	$begin 	= date( 'Y-m-d\TH:i:sO');
    $end 	= date( 'Y-m-d\TH:i:sO');
	$event_heure_ouverture[] = array('begin' => $begin, 'end' => $end);
						
	$Openagenda_event_data = array(
		'title' => array('fr' => "Test - Martigues MAJ"),
		'state' => 0, /* 0: événement non publié, à contrôler - 1: événement non publié, controlé - 2: événement publié (valeur par défaut) */
		'image' 			=> 	array('url' => "https://rehost.diberie.com/Picture/Get/f/80551"),
		'imageCredits'	=>	"Crédit photo Office de Tourisme de Martigues ;)",
		'locationUid' 	=> 	$result_uid_location,
		'longDescription' => 	array('fr'=> 'il y a ici une description en version longue. Il ne peut excéder 10000 caractères par langue'),
		'description' 	=> 	array('fr'=>'Description est champ obligatoire ne pouvant excéder 200 caractères par langue.'), /* Champ obligatoire ne pouvant excéder 200 caractères par langue */
		'public' 			=> 	25,	
		'nature' 			=> 	57, /* NON DOCUMENTÉ */
		'thematique' 		=>	2,  /* NON DOCUMENTÉ */
		'fadas' 			=>	46, /* NON DOCUMENTÉ */
		'featured'		=> false, /* true quand l'événement doit apparaître en tête de liste ( en une ) */
		'keywords' 		=> 	array('fr' => "Mot1, Mot2, Mot3"),
		'timings' 		=> 	$event_heure_ouverture,
		'slug' 			=>	"Identifiant-pour-construire-une-URL-lisible"					  
	);
		
	// echo "<pre>";
	// var_dump($Openagenda_event_data);
	// echo "<pre>";
	
		
	$received_content_id_event = update_event($accessToken,$Openagenda_event_data,$agendaUid,"13899272");

	echo "HAAA >".$received_content_id_event;
	
?>					

