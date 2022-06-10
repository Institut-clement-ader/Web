<?php

/**
  * Améliorations à apporter :
  * Ajouter des commentaires sur le code
  */ 

//détection de langue courante de la page
$currentlang = get_bloginfo('language');

if(strpos($currentlang,'fr')!==false){
  include('App/lang-fr.php');
}elseif(strpos($currentlang,'en')!==false){
  include('App/lang-en.php');
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


	<label for='grp'><?=TXT_GROUPE_RAVANCEE?></label>
				<select id='grp' name='groupe'>
					<option value='labo'><?=TXT_TOUSGROUPE_RAVANCEE?></option>
					<option value='MICS'> MICS </option>
					<option value='MS2M'> MS2M </option>
					<option value='SUMO'> SUMO </option>
					<option value='MSC'> MSC </option>
				</select><br><br>
  
				<fieldset class='doc-search'>
					<legend><?=TXT_TYPEDOC_RAVANCEE?></legend>
					<div>
						<div class='type' id='publications'>
							<label for='publi' class='labtype'><?=TXT_PUBLICATIONS_RAVANCEE?></label>
							<div class ='subtype'>
								<input type='checkbox' name='ART' id='art' checked><label for='art'><?=TXT_ART_RAVANCEE?></label>
								<input type='checkbox' name='COMM' id='comm'><label for='comm'><?=TXT_COMM_RAVANCEE?></label>
                				<input type='checkbox' name='INV' id='inv'><label for='inv'><?=TXT_INV_RAVANCEE?></label>
								<input type='checkbox' name='COUV' id='couv'><label for='couv'><?=TXT_CHAPITRE_RAVANCEE?></label>
							</div>
							<div class='subtype'>
								<input type='checkbox' name='OTHER' id='other'><label for='other'><?=TXT_AUTRE_RAVANCEE?></label>
								<input type='checkbox' name='OUV' id='ouv'><label for='ouv'><?=TXT_OUVRAGE_RAVANCEE?></label>
							</div>
							<div class=subtype>
								<input type='checkbox' name='DOUV' id='douv'><label for='douv'><?=TXT_DIRECTION_RAVANCEE?></label>
								<input type='checkbox' name='POSTER' id='poster'><label for='poster'><?=TXT_POSTER_RAVANCEE?></label>
								<input type='checkbox' name='PATENT' id='patent'><label for='patent'><?=TXT_BREVET_RAVANCEE?></label>
							</div>
						</div>

						<div class='type' id='nonpublies'>
							<label for='npubli' class='labtype'><?=TXT_NONPUBLI_RAVANCEE?></label>
							<div class='subtype'>
								<input type='checkbox' name='UNDEFINED' id='undef'><label for='undef'><?=TXT_PREPUBLI_RAVANCEE?></label>
								<input type='checkbox' name='REPORT' id='report'><label for='report'><?=TXT_RAPPORT_RAVANCEE?></label>
							</div>
						</div>

						<div class='type' id='universitaires'>
							<label for='univ' class='labtype'><?=TXT_TRAVAUXUNIV_RAVANCEE?></label>
							<div class='subtype'>
								<input type='checkbox' name='THESE' id='these'><label for='these'><?=TXT_THESE_RAVANCEE?></label>
								<input type='checkbox' name='HDR' id='hdr'><label for='hdr'><?=TXT_HDR_RAVANCEE?></label>
								<input type='checkbox' name='LECTURE' id='lecture'><label for='lecture'><?=TXT_COURS_RAVANCEE?></label>
							</div>
						</div>

						<div class='type' id='donnees'>
							<label for='data' class='labtype'><?=TXT_DONNEES_RAVANCEE?></label>
							<div class='subtype'>
								<input type='checkbox' name='IMG' id='img'><label for='img'><?=TXT_IMAGE_RAVANCEE?></label>
								<input type='checkbox' name='VIDEO' id='vid'><label for='vid'><?=TXT_VIDEO_RAVANCEE?></label>
								<input type='checkbox' name='MAP' id='map'><label for='map'><?=TXT_CARTE_RAVANCEE?></label>
								<input type='checkbox' name='SON' id='son'><label for='son'><?=TXT_SON_RAVANCEE?></label>
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
