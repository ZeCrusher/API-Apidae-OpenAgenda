<?php 


	if (($_POST['keypublic']!='') &&($_POST['keysecret']!='')) {


            /*Notre fichier contient toujours le texte :
             *"abcdefmier texte dans mon fichier. Un autre texte"
             *ajouté précédemment*/
				$fichier = fopen('config.php.txt','w');
          
				fputs($fichier, "<?php\r\n");
				fputs($fichier, "	session_start();\r\n ");
				fputs($fichier, "	/*\r\n ");
				fputs($fichier, "	*---------------------------------------------------------------\r\n ");
				fwrite($fichier, "	* Les clefs de l\'API \r\n");
				fwrite($fichier, "	*---------------------------------------------------------------\r\n ");
				fwrite($fichier, "	*	Note : A quoi servent-elle et comment trouver les clefs public et secret ?\r\n ");
				fwrite($fichier, "	*\r\n ");
				fwrite($fichier, "	* Pour cela il vous vous rendre sur le site : https://openagenda.com/settings/apiKey\r\n");
				fwrite($fichier, "	* et copier les clef API.\r\n ");
				fwrite($fichier, "	*\r\n ");
				fwrite($fichier, "	* La procédure d\'authentification à suivre pour éditer du contenu sur OpenAgenda consiste à utiliser votre clé secrète\r\n ");
				fwrite($fichier, utf8_encode("	* pour récupérer un ticket d\'accès qui vous servira pendant toute votre session.\r\n "));
				fwrite($fichier, "	*\r\n ");
				fwrite($fichier, "	* ATTENTION : Celui-ci à une durée de vie limitée.\r\n ");
				fwrite($fichier, "	* Votre clé secrète sera mise à disposition sur votre compte OA sur demande à support@openagenda.com\r\n");
				fwrite($fichier, "	*  \r\n ");
				fwrite($fichier, "	*  Vous pouvez consulter la documentation ici : \r\n ");
				fwrite($fichier, "	*	INFO ...>  : https://developers.openagenda.com/authentification/ \r\n ");
				fwrite($fichier, "	*/ \r\n ");
				fwrite($fichier, "	\r\n ");
				fwrite($fichier, "	\$_SESSION['last_version']='V2022-06-30-TSK'; \r\n ");
				fwrite($fichier, "\r\n ");
				fwrite($fichier, "	\$keys = array( /* Les clés API permettent de lire et écrire des données sur OpenAgenda via l\'API. */\r\n ");
				fwrite($fichier, "	  \"public\"=>\"".$_POST['keypublic']."\", /* Pour OpenAgenda en lecture */\r\n ");
				fwrite($fichier, "	  \"secret\"=>\"".$_POST['keysecret']."\"  /* Pour OpenAgenda en mode écriture et autres*/\r\n ");
				fwrite($fichier, "	\r\n ");
				fwrite($fichier, "\r\n ");
				fwrite($fichier, "	\$agendaUid=".$_POST['agendaUid']."; /* <uid:65630513> */\r\n ");
				fwrite($fichier, "	\$territoireIds=array(\"".$_POST['territoireIds']."\"); /* Conseil de territoire : Pays de Martigues */ \r\n ");
				fwrite($fichier, "	\$selectionIds=array(\"".$_POST['selectionIds']."\");\r\n ");
				fwrite($fichier, "	\r\n ");
				fwrite($fichier, "	\$data_openagenda =array(); /* tableau qui va temporairement sauvegarder les données lu sur OpenAgenda 	*/\r\n ");
				fwrite($fichier, "	\$data_apidae	 =array(); /* tableau qui va également sauvegarder les données d\'Apidae 				*/\r\n ");
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
				fwrite($fichier, "	\$requete[\"territoireIds\"] = $territoireIds;\r\n ");
				fwrite($fichier, "	\$requete[\"selectionIds\"] = $selectionIds;\r\n ");
				fwrite($fichier, "	\$requete[\"identifiants\"] = $identifiants;\r\n ");
				fwrite($fichier, "	\$requete[\"apiKey\"] = \$apiKey;\r\n ");
				fwrite($fichier, "	\$requete[\"projetId\"] = \$projetId;\r\n ");
				fwrite($fichier, "	// \$requete[\"dateDebut\"] = date(\"Y-m-d\");   // \$requete[\"dateDebut\"] = \"2022-09-10\";\r\n ");
				fwrite($fichier, "\r\n ");
				//fwrite($fichier, "	\$requete[\"responseFields\"] = array(\"@all\");\r\n ");
				fwrite($fichier,"   \$requete[\"responseFields\"] = array(	\"id\",\"nom\",\"theme\",\"localisation\",\"descriptionTarif\",\"presentation\",\"prestations\",\"illustrations\",\"aspects\",\"informations\",\"datesOuverture\",\"ouverture\",\"@informationsObjetTouristique\");");
				fwrite($fichier, "	\$url_Apidae = $apiDomain.\"v002/agenda/detaille/list-objets-touristiques/\";\r\n ");
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


	echo "<h2>Lecture des clefs </h2>";

	echo '<form method="POST" action="install.php">';
	
	$txt_file = fopen('config/config.php','r');
	$num_ligne = 1;
										
	while ($line = fgets($txt_file))	 
	{
							
			$pos[0] = strpos($line, '"public"=>"');
			if ($pos[0] !== false) {	
				preg_match_all('/=>([^=> ]+)/', $line, $out, PREG_PATTERN_ORDER);
				$valkey = substr($out[0][0],3);
				$keypublic=substr($valkey,0,-3);
				// echo 'Public ".$keypublic." <br> ";
				echo '<p>Clef public OpenAgenda</p>';
				echo '<input type="text" value="'.$keypublic.'" name="keypublic" id= "keypublic" placeholder="Votre clef public..." >';
			}
		
			$pos[1] = strpos($line, '"secret"=>"');
		
			if ($pos[1] !== false) {	
				preg_match_all('/=>([^=> ]+)/', $line, $out, PREG_PATTERN_ORDER);
				$valkey = substr($out[0][0],3);
				$keysecret=substr($valkey,0,-3);
				// echo "Secret : =".$keysecret." <br> ";

				echo '<p>Clef Secrète OpenAgenda</p>';
				echo '<input type="text" value="'.$keysecret.'"  name="keysecret" id= "keysecret" placeholder="Votre clef Secrète..." >';
								
			}
			$pos[2] = strpos($line, '$agendaUid=');
			if ($pos[2] !== false) {	
				preg_match_all('/=([^; ]+)/', $line, $out, PREG_PATTERN_ORDER);
				$valkey=$out[0][0];
				$agendaUid = substr($valkey,1);
				// echo "AgendaUid >".$agendaUid."<br>";*

				echo '<p>AgendaUid OpenAgenda</p>';
				echo '<input type="text" value="'.$agendaUid.'" class="form-control input-sm validate[required]" name="agendaUid" id= "agendaUid" placeholder="Votre AgendaUid ..." >';
												
			}
			$pos[2] = strpos($line, '$territoireIds=array("');
			if ($pos[2] !== false) {	
				preg_match_all('/=([^; ]+)/', $line, $out, PREG_PATTERN_ORDER);
				$valkey=$out[0][0];
				$valkey = substr($out[0][0],8);
				$territoireIds = substr($valkey,0,-2);
				echo '<p>TerritoireIds</p>';
				echo '<input type="text" value="'.$territoireIds.'" class="form-control input-sm validate[required]" name="territoireIds" id= "territoireIds" placeholder="Votre TerritoireIds..." >';

			}
			$pos[3] = strpos($line, '$selectionIds=array("');
			if ($pos[3] !== false) {	
				preg_match_all('/=([^; ]+)/', $line, $out, PREG_PATTERN_ORDER);
				$valkey=$out[0][0];
				$valkey = substr($out[0][0],8);
				$selectionIds = substr($valkey,0,-2);
				echo '<p>SelectionIds APIDAE</p>';
				echo '<input type="text" value="'.$selectionIds.'" class="form-control input-sm validate[required]" name="selectionIds" id= "selectionIds" placeholder="Votre SelectionIds..." >';

			}			
			$pos[4] = strpos($line, '$apiKey="');
			if ($pos[4] !== false) {	
				preg_match_all('/=([^; ]+)/', $line, $out, PREG_PATTERN_ORDER);
				$valkey=$out[0][0];
				$valkey = substr($valkey,2);				
				$apiKey = substr($valkey,0,-1);
				echo '<p>ApiKey APIDAE</p>';
				echo '<input type="text" value="'.$apiKey.'" class="form-control input-sm validate[required]" name="apiKey" id= "apiKey" placeholder="Votre ApiKey..." >';

			}	
			$pos[5] = strpos($line, '$projetId="');
			if ($pos[5] !== false) {	
				preg_match_all('/=([^; ]+)/', $line, $out, PREG_PATTERN_ORDER);
				$valkey=$out[0][0];
				$valkey = substr($valkey,2);				
				$projetId = substr($valkey,0,-1);
				echo '<p>ProjetId APIDAE</p>';
				echo '<input type="text" value="'.$projetId.'" class="form-control input-sm validate[required]" name="projetId" id= "projetId" placeholder="Votre ProjetId..." >';

			}			

			$num_ligne++;$valkey="";
			// echo $num_ligne;
	}
	
	fclose($txt_file);									
	
	echo "<br><br><br>";
	echo '<div class="modal-footer">
		
		<input class="btn btn-sm" type="submit" name="submit" id="sauvegarder" value="sauvegarder">
		<input class="btn btn-sm" type="submit" name="submit" id="Recharger" value="Recharger">
	</div>';
	
	if ($fichier_config_maj=="OK") {
		echo '<br><br><br> Votre fichier a été enregistrer [<a href="config.php.txt" target="_blanck">config.php.txt</a>]';
	}
	
	echo '</form>';

						
	?>


