<?php

/**
  * Améliorations à apporter :
  * Ajouter des commentaires sur le code
  */ 


//détection de langue courante de la page
$currentlang = get_bloginfo('language');

if(strpos($currentlang,'fr')!==false){
  include('codes snippet/lang-fr.php');
}elseif(strpos($currentlang,'en')!==false){
  include('codes snippet/lang-en.php');
}else{
  echo("échec de reconnaissance de la langue");
}

$isAuthorized = false; 
$id = get_current_user_id();
if ($id > 0) {
  $user_info = get_userdata($id);
  $user_roles = $user_info->roles;
  //vérifie si l'uitilisateur est du groupe "administrator" (peut être changé par le groupe souhaité)
  $isAuthorized = in_array("administrator",$user_roles);
}
?>
	<FORM METHOD='POST' ACTION='../publications/' CLASS='form-publi'>

				<label for='grp'>Groupe</label>
				<select id='grp' name='groupe'>
					<option value='labo'>Tous les groupes</option>
					<option value='MICS'> MICS </option>
					<option value='MS2M'> MS2M </option>
					<option value='SUMO'> SUMO </option>
					<option value='MSC'> MSC </option>
				</select><br><br>
  
				<fieldset class='doc-search'>
					<legend>Type de document</legend>
					<div>
						<div class='type' id='publications'>
							<label for='publi' class='labtype'>Publications</label>
							<div class ='subtype'>
								<input type='checkbox' name='ART' id='art' checked><label for='art'>Article dans une revue</label>
								<input type='checkbox' name='COMM' id='comm'><label for='comm'>Communication dans un congrès</label>
                				<input type='checkbox' name='INV' id='inv'><label for='inv'>Communication invité</label>
								<input type='checkbox' name='COUV' id='couv'><label for='couv'>Chapitre d'ouvrage</label>
							</div>
							<div class='subtype'>
								<input type='checkbox' name='OTHER' id='other'><label for='other'>Autre publication</label>
								<input type='checkbox' name='OUV' id='ouv'><label for='ouv'>Ouvrage (y compris édition critique et traduction)</label>
							</div>
							<div class=subtype>
								<input type='checkbox' name='DOUV' id='douv'><label for='douv'>Direction d'ouvrage, proceedings, dossier</label>
								<input type='checkbox' name='POSTER' id='poster'><label for='poster'>Poster</label>
								<input type='checkbox' name='PATENT' id='patent'><label for='patent'>Brevet</label>
							</div>
						</div>

						<div class='type' id='nonpublies'>
							<label for='npubli' class='labtype'>Documents non publiés</label>
							<div class='subtype'>
								<input type='checkbox' name='UNDEFINED' id='undef'><label for='undef'>Pré-publication, document de travail</label>
								<input type='checkbox' name='REPORT' id='report'><label for='report'>Rapport</label>
							</div>
						</div>

						<div class='type' id='universitaires'>
							<label for='univ' class='labtype'>Travaux universitaires</label>
							<div class='subtype'>
								<input type='checkbox' name='THESE' id='these'><label for='these'>Thèse</label>
								<input type='checkbox' name='HDR' id='hdr'><label for='hdr'>HDR</label>
								<input type='checkbox' name='LECTURE' id='lecture'><label for='lecture'>Cours</label>
							</div>
						</div>

						<div class='type' id='donnees'>
							<label for='data' class='labtype'>Données de recherche</label>
							<div class='subtype'>
								<input type='checkbox' name='IMG' id='img'><label for='img'>Image</label>
								<input type='checkbox' name='VIDEO' id='vid'><label for='vid'>Vidéo</label>
								<input type='checkbox' name='MAP' id='map'><label for='map'>Carte</label>
								<input type='checkbox' name='SON' id='son'><label for='son'>Son</label>
							</div>
						</div>
					</div>
				</fieldset>

					<div class='depot'>
						<input type='checkbox' name='file' id='file' checked>
						<input type='checkbox' name='file' id='file' checked>
					</div>
					<?php
//détection de langue courante de la page
$currentlang = get_bloginfo('language');

if(strpos($currentlang,'fr')!==false){
  include('codes snippet/lang-fr.php');
}elseif(strpos($currentlang,'en')!==false){
  include('codes snippet/lang-en.php');
}else{
  echo("échec de reconnaissance de la langue");
}

$isAuthorized = false; 
$id = get_current_user_id();
if ($id > 0) {
  $user_info = get_userdata($id);
  $user_roles = $user_info->roles;
  //vérifie si l'uitilisateur est du groupe "administrator" (peut être changé par le groupe souhaité)
  $isAuthorized = in_array("administrator",$user_roles);
}
?>
	<form METHOD='POST' ACTION='../publications/' CLASS='form-publi'>


				<label for='grp'>Groupe</label>
				<select id='grp' name='groupe'>
					<option value='labo'>Tous les groupe</option>
					<option value='MICS'> MICS </option>
					<option value='MS2M'> MS2M </option>
					<option value='SUMO'> SUMO </option>
					<option value='MSC'> MSC </option>
				</select><br><br>
  
				<fieldset class='doc-search'>
					<legend>Type de document</legend>
					<div>
						<div class='type' id='publications'>
							<label for='publi' class='labtype'>Publications</label>
							<div class ='subtype'>
								<input type='checkbox' name='ART' id='art' checked><label for='art'>Article dans une revue</label>
								<input type='checkbox' name='COMM' id='comm'><label for='comm'>Communication dans un congrès</label>
                				<input type='checkbox' name='INV' id='inv'><label for='inv'>Communication invité</label>
								<input type='checkbox' name='COUV' id='couv'><label for='couv'>Chapitre d'ouvrage</label>
							</div>
							<div class='subtype'>
								<input type='checkbox' name='OTHER' id='other'><label for='other'>Autre publication</label>
								<input type='checkbox' name='OUV' id='ouv'><label for='ouv'>Ouvrage (y compris édition critique et traduction)</label>
							</div>
							<div class=subtype>
								<input type='checkbox' name='DOUV' id='douv'><label for='douv'>Direction d'ouvrage, proceedings, dossier</label>
								<input type='checkbox' name='POSTER' id='poster'><label for='poster'>Poster</label>
								<input type='checkbox' name='PATENT' id='patent'><label for='patent'>Brevet</label>
							</div>
						</div>

						<div class='type' id='nonpublies'>
							<label for='npubli' class='labtype'>Documents non publiés</label>
							<div class='subtype'>
								<input type='checkbox' name='UNDEFINED' id='undef'><label for='undef'>Pré-publication, document de travail</label>
								<input type='checkbox' name='REPORT' id='report'><label for='report'>Rapport</label>
							</div>
						</div>

						<div class='type' id='universitaires'>
							<label for='univ' class='labtype'>Travaux universitaires</label>
							<div class='subtype'>
								<input type='checkbox' name='THESE' id='these'><label for='these'>Thèse</label>
								<input type='checkbox' name='HDR' id='hdr'><label for='hdr'>HDR</label>
								<input type='checkbox' name='LECTURE' id='lecture'><label for='lecture'>Cours</label>
							</div>
						</div>

						<div class='type' id='donnees'>
							<label for='data' class='labtype'>Données de recherche</label>
							<div class='subtype'>
								<input type='checkbox' name='IMG' id='img'><label for='img'>Image</label>
								<input type='checkbox' name='VIDEO' id='vid'><label for='vid'>Vidéo</label>
								<input type='checkbox' name='MAP' id='map'><label for='map'>Carte</label>
								<input type='checkbox' name='SON' id='son'><label for='son'>Son</label>
							</div>
						</div>
					</div>
				</fieldset>

					<div class='depot'>
						<input type='checkbox' name='file' id='file' checked>
						<input type='checkbox' name='notice' id='notice' checked>
						<input type='checkbox' name='annex' id='annexe' checked>
					</div>			
				<br/>

				Période :<br/><br/>
				<label for='debut'>De</label>
				<input id='debut' type='number' min='2009' max='<?=(idate('Y')+1)?>' name='annee1' value='<?=(idate('Y')-4)?>' required/>
				<label for='fin'>à</label>
				<input id='fin' type='number' min='2009' max='<?=(idate('Y')+1)?>' name='annee2' value='<?=date('Y')?>' required /><br /><br />
				<input type=submit value='Rechercher' name='submit'><br/>
</form>
