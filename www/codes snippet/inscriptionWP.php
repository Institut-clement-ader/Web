<?php

	/**
    * Améliorations à apporter :
    * Ajouter des commentaires
    * Fermer la balise <php> si elle n'est pas utile pour que la partie html soit facilement détectée
    * Corriger l'erreur (probleme de balise)
    */

<p>Créer un nouvel utilisateur et l’ajouter à ce site.</p>
<form method="post" name="createuser" id="createuser" class="validate" novalidate="novalidate">
<input name="action" type="hidden" value="createuser" />
<input type="hidden" id="_wpnonce_create-user" name="_wpnonce_create-user" value="1130081283" /><input type="hidden" name="_wp_http_referer" value="/wp-admin/user-new.php" /><table class="form-table">
	<tr class="form-field form-required">
		<th scope="row"><label for="user_login">Identifiant <span class="description">(nécessaire)</span></label></th>
		<td><input name="user_login" type="text" id="user_login" value="" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="60" /></td>
	</tr>
	<tr class="form-field form-required">
		<th scope="row"><label for="email">Adresse de messagerie <span class="description">(nécessaire)</span></label></th>
		<td><input name="email" type="email" id="email" value="" /></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="first_name">Prénom </label></th>
		<td><input name="first_name" type="text" id="first_name" value="" /></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="last_name">Nom </label></th>
		<td><input name="last_name" type="text" id="last_name" value="" /></td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="url">Site web</label></th>
		<td><input name="url" type="url" id="url" class="code" value="" /></td>
	</tr>
	<tr class="form-field form-required user-pass1-wrap">
		<th scope="row">
			<label for="pass1">
				Mot de passe				<span class="description hide-if-js">(nécessaire)</span>
			</label>
		</th>
		<td>
			<input class="hidden" value=" " /><!-- #24364 workaround -->
			<button type="button" class="button wp-generate-pw hide-if-no-js">Afficher le mot de passe</button>
			<div class="wp-pwd hide-if-js">
								<span class="password-input-wrapper">
					<input type="password" name="pass1" id="pass1" class="regular-text" autocomplete="off" data-reveal="1" data-pw="ixlR3aFH!URVqOXmUUaJ$ARp" aria-describedby="pass-strength-result" />
				</span>
				<button type="button" class="button wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="Cacher le mot de passe">
					<span class="dashicons dashicons-hidden"></span>
					<span class="text">Cacher</span>
				</button>
				<button type="button" class="button wp-cancel-pw hide-if-no-js" data-toggle="0" aria-label="Annuler la modification du mot de passe">
					<span class="text">Annuler</span>
				</button>
				<div style="display:none" id="pass-strength-result" aria-live="polite"></div>
			</div>
		</td>
	</tr>
	<tr class="form-field form-required user-pass2-wrap hide-if-js">
		<th scope="row"><label for="pass2">Répétez le mot de passe <span class="description">(nécessaire)</span></label></th>
		<td>
		<input name="pass2" type="password" id="pass2" autocomplete="off" />
		</td>
	</tr>
	<tr class="pw-weak">
		<th>Confirmation du mot de passe</th>
		<td>
			<label>
				<input type="checkbox" name="pw_weak" class="pw-checkbox" />
				Confirmer l’utilisation du mot de passe faible			</label>
		</td>
	</tr>
	<tr>
		<th scope="row">Envoyer une notification à l’utilisateur</th>
		<td>
			<input type="checkbox" name="send_user_notification" id="send_user_notification" value="1"  checked='checked' />
			<label for="send_user_notification">Envoyer un message au nouvel utilisateur à propos de son compte.</label>
		</td>
	</tr>
	<tr class="form-field">
		<th scope="row"><label for="role">Rôle</label></th>
		<td><select name="role" id="role">
			
	<option selected='selected' value='member'>Membre</option>
	<option value='administrator'>Administrateur</option>			</select>
		</td>
	</tr>
	</table>

        <table>
        <table class="form-table">
        		<tr>
        			<th scope="row">Autres rôles</th>
        			<td>
<select multiple="multiple" id="ure_select_other_roles" name="ure_select_other_roles" style="width: 500px;" >
<option value="administrator" >Administrator</option>
<option value="member" >Membre</option>
</select><br>
<input type="hidden" name="ure_other_roles" id="ure_other_roles" value="" /><span id="ure_other_roles_list"></span>        			</td>
        		</tr>
        </table>		
                    
        </table>

<p class="submit"><input type="submit" name="createuser" id="createusersub" class="button button-primary" value="Ajouter un utilisateur"  /></p>
</form>

?>