<?php

    /**
    * Améliorations à apporter :
    * Changer la liaison BDD en utilisant la classe Gestion BDD (prendre exemple sur les autres codes)
    * Enlever les echo en utilisant les balises php.
    * 
     */


//CONNEXION A LA BDD
$serveur     = "mysql2.lamp.ods";
$utilisateur = "lab0612sql3";
$password    = "XY02b21aBLaq";
$db          = "lab0612sql3db";

try {
    $bdd = new PDO('mysql:host=' . $serveur . ';dbname=' . $db, $utilisateur, $password);
}
catch (PDOException $e) {
    print "Erreur : " . $e->getMessage();
    die();
    
}


?>
 
<?php
function liste_pays()
{
    echo '<option selected="selected" value=""> </option>
          <option  value="Afghanistan">Afghanistan</option> 
          <option  value="Afrique du Sud">Afrique du Sud</option>
          <option  value="Albanie">Albanie</option> 
          <option  value="Algérie">Algérie</option> 
          <option  value="Allemagne">Allemagne</option> 
          <option  value="Andorre">Andorre</option> 
          <option  value="Angola">Angola</option>
          <option  value="Arabie saoudite">Arabie saoudite</option>
          <option  value="Argentine">Argentine</option>
          <option  value="Arménie">Arménie</option>
          <option  value="Australie">Australie</option>
          <option  value="Autriche">Autriche</option>
          <option  value="Azerbaïdjan">Azerbaïdjan</option>
          <option  value="Bahamas">Bahamas</option>
          <option  value="Bahreïn">Bahreïn</option>
          <option  value="Bangladesh">Bangladesh</option>
          <option  value="Barbade">Barbade</option>
          <option  value="Bélarus">Bélarus</option>
          <option  value="Belgique">Belgique</option>
          <option  value="Belize">Belize</option>
          <option  value="Bénin">Bénin</otpion>
          <option  value="Bolivie">Bolivie</option>
          <option  value="Bosnie-Herzégovine">Bosnie-Herzégovine</option>
          <option  value="Botswana">Botswana</option>
          <option  value="Brésil">Brésil</option>
          <option  value="Bulgarie">Bulgarie</option>
          <option  value="Burkina Faso">Burkina Faso</option>
          <option  value="Burundi">Burundi</option>
          <option  value="Cambodge">Cambodge</option>
          <option  value="Cameroun">Cameroun</option>
          <option  value="Canada">Canada</option>
          <option  value="Cap-Vert">Cap-Vert</option>
          <option  value="Chili">Chili</option>
          <option  value="Chine">Chine</option>
          <option  value="Chypre">Chypre</option>
          <option  value="Colombie">Colombie</option>
          <option  value="Comores">Comores</option>
          <option  value="Corée du Nord">Corée du Nord</option>
          <option  value="Corée du Sud">Corée du Sud</option>
          <option  value="Congo">Congo</option>
          <option  value="Costa Rica">Costa Rica</option>
          <option  value="Côte d\'Ivoire">Côte d\'Ivoire</option>
          <option  value="Croatie">Croatie</option>
          <option  value="Cuba">Cuba</option>
          <option  value="Danemark">Danemark</option>
          <option  value="Djibouti">Djibouti</option>
          <option  value="Dominique">Dominique</option>
          <option  value="Égypte">Égypte</option>
          <option  value="El Salvador">El Salvador</option>
          <option  value="Émirats arabes unis">Émirats arabes unis</option>
          <option  value="Équateur">Équateur</option>
          <option  value="Érythrée">Érythrée</option>
          <option  value="Espagne">Espagne</option>
          <option  value="Estonie">Estonie</option>
          <option  value="États-Unis d\'Amérique">États-Unis d\'Amérique</option>
          <option  value="Éthyopie">Éthyopie</option>
          <option  value="Fidji">Fidji</option>
          <option  value="Finlande">Finlande</option>
          <option  value="France">France</option>
          <option  value="Gabon">Gabon</option>
          <option  value="Gambie">Gambie</option>
          <option  value="Géorgie">Géorgie</option>
          <option  value="Ghana">Ghana</option>
          <option  value="Grèce">Grèce</option>
          <option  value="Grenade">Grenade</option>
          <option  value="Guatemala">Guatemala</option>
          <option  value="Guinée">Guinée</option>
          <option  value="Guinée Bissau">Guinée Bissau</option>
          <option  value="Guinée équatoriale">Guinée équatoriale</option>
          <option  value="Guyana">Guyana</option>
          <option  value="Haïti">Haïti</option>
          <option  value="Honduras">Honduras</option>
          <option  value="Hongrie">Hongrie</option>
          <option  value="Inde">Inde</option>
          <option  value="Indonésie">Indonésie</option>
          <option  value="Iran">Iran</option>
          <option  value="Iraq">Irak</option>
          <option  value="Irlande">Irlande</option>
          <option  value="Islande">Islande</option>
          <option  value="Israël">Israël</option>
          <option  value="Italie">Italie</option>
          <option  value="Jamaïque">Jamaïque</option>
          <option  value="Japon">Japon</option>
          <option  value="Jordanie">Jordanie</option>
          <option  value="Kazakhstan">Kazakhstan</option>
          <option  value="Kenya">Kenya</option>
          <option  value="Kirghizistan">Kirghizistan</option>
          <option  value="Kiribati">Kiribati</option>
          <option  value="Koweït">Koweït</option>
          <option  value="Lesotho">Lesotho</option>
          <option  value="Lettonie">Lettonie</option>
          <option  value="Liban">Liban</option>
          <option  value="Libye">Libye</option>
          <option  value="Libéria">Libéria</option>
          <option  value="Liechtenstein">Liechtenstein</option>
          <option  value="Lituanie">Lituanie</option>
          <option  value="Luxembourg">Luxembourg</option>
          <option  value="Macédoine (ERYM)">Macédoine (ERYM)</option>
          <option  value="Madagascar">Madagascar</option>
          <option  value="Malaisie">Malaisie</option>
          <option  value="Malawi">Malawi</option>
          <option  value="Maldives">Maldives</option>
          <option  value="Mali">Mali</option>
          <option  value="Malte">Malte</option>
          <option  value="Maroc">Maroc</option>
          <option  value="Maurice">Maurice</option>
          <option  value="Mauritanie">Mauritanie</option>
          <option  value="Mexique">Mexique</option>
          <option  value="Moldavie">Moldavie</option>
          <option  value="Monaco">Monaco</option>
          <option  value="Mongolie">Mongolie</option>
          <option  value="Monténégro">Monténégro</option>
          <option  value="Mozambique">Mozambique</option>
          <option  value="Myanmar">Myanmar</option>
          <option  value="Namibie">Namibie</option>
          <option  value="Népal">Népal</option>
          <option  value="Nicaragua">Nicaragua</option>
          <option  value="Niger">Niger</option>
          <option  value="Nigéria">Nigéria</option>
          <option  value="Norvège">Norvège</option>
          <option  value="Nouvelle-Zélande">Nouvelle-Zélande</option>
          <option  value="Oman">Oman</option>
          <option  value="Ouganda">Ouganda</option>
          <option  value="Ouzbékistan">Ouzbékistan</option>
          <option  value="Pakistan">Pakistan</option>
          <option  value="Panama">Panama</option>
          <option  value="Papouasie-Nouvelle-Guinée">Papouasie-Nouvelle-Guinée</option>
          <option  value="Paraguay">Paraguay</option>
          <option  value="Pays-Bas">Pays-Bas</option>
          <option  value="Pérou">Pérou</option>
          <option  value="Philippines">Philippines</option>
          <option  value="Pologne">Pologne</option>
          <option  value="Portugal">Portugal</option>
          <option  value="Qatar">Qatar</option>
          <option  value="Syrie">Syrie</option>
          <option  value="République centrafricaine">République centrafricaine</option>
          <option  value="République démocratique du Congo">République démocratique du Congo</option>
          <option  value="République dominicaine">République dominicaine</option>
          <option  value="République tchèque>République tchèque</option>
          <option  value="Russie">Russie</option>
          <option  value="Roumanie">Roumanie</option>
          <option  value="Royaume-Uni">Royaume-Uni</option>
          <option  value="Rwanda">Rwanda</option>
          <option  value="Sénégal">Sénégal</option>
          <option  value="Serbie">Serbie</option>
          <option  value="Seychelles">Seychelles</option>
          <option  value="Sierra Leone">Sierra Leone</option>
          <option  value="Singapour">Singapour</option>
          <option  value="Slovaquie">Slovaquie</option>
          <option  value="Slovénie">Slovénie</option>
          <option  value="Somalie">Somalie</option>
          <option  value="Soudan">Soudan</option>
          <option  value="Sri Lanka">Sri Lanka</option>
          <option  value="Suède">Suède</option>
          <option  value="Suisse">Suisse</option>
          <option  value="Suriname">Suriname</option>
          <option  value="Swaziland">Swaziland</option>
          <option  value="Tadjikistan">Tadjikistan</option>
          <option  value="Tanzanie">Tanzanie</option>
          <option  value="Taïwan">Taiwan</option>
          <option  value="Tchad">Tchad</option>
          <option  value="Thaïlande">Thaïlande</option>
          <option  value="Togo">Tpgp</option>
          <option  value="Trinité-et-Tobago">Trinité-et-Tobago</option>
          <option  value="Tunisie">Tunisie</option>
          <option  value="Turkménistan">Turkménistan</option>
          <option  value="Turquie">Turquie</option>
          <option  value="Ukraine">Ukraine</option>
          <option  value="Uruguay">Uruguay</option>
          <option  value="Venezuela">Venezuela</option>
          <option  value="Viet Nam">Viet Nam</option>
          <option  value="Yémen">Yémen</option>
          <option  value="Zambie">Zambie</option>
          <option  value="Zimbabwe">Zimbabwe</option>';
}

echo '<form id="formulaire-zrr" name="zrr" method="post" action="http://institut-clement-ader.org/formulaire-zrr/">
 
      Nom (last name)* : <input type="text" name="nom" required/>
      
      Prénom(s) (first name)*: <input type="text" name="prenom" required/>
      
      Nom marital (married name) : <input type="text" name="marital"/><br/><br/>
      
      <label for="sexe">Sexe* : <br/></label><select name="sexe" required/> 
          <option  value=""> </option>
          <option  value="masculin (male)"> masculin (male)</option>
          <option  value="féminin (female)"> féminin (female)</option>
         </select><br/><br/>
        
    <label for="identité">Type de pièce d\'identité (type of identity)* :<br/></label><select name="type_identité"/> 
          <option  value=""> </option>
          <option  value="passeport">passeport</option>
          <option  value="carte d\'identité (ID)">carte d\'identité (ID)</option>
          </select><br/><br/>
        
    Numéro de pièce d\'identité (ID number)* : <input type="text" name="ID_number" required/><br/><br/>
    
    Date de naissance (birthdate)* : <br/><input type="date" name="date_naissance" required/><br/><br/>
    
    Code postal et ville de naissance (zip code and birthplace)* : <br/><input type="text" name="code_ville_naissance" required/><br/><br/>
  
    <label for="pays_naissance">Pays de naissance (country of birth)* : <br/></label>
    <select name="pays_naissance" required>';
?><?php
liste_pays();
?><?php
echo '</select><br/><br/>
        
    <label for="nationalié">Nationalité (nationality)* : <br/></label>
    <select name="nationalité" required>';
?><?php
liste_pays();
?><?php
echo '</select><br/><br/>
        
    <label for="autre_nationalié">Autre nationalité (other nationality)* : <br/></label>
    <select name="nationalité">';
?><?php
liste_pays();
?><?php
echo '</select><br/><br/>
        
    Adresse E-mail (e-mail)* : <input type="email" name="mail" required/><br/>
    
    Adresse principale actuelle (current main address)* : <input type="text" name="adresse_principale" required/><br/>
    
    Code postal et ville (zip code and city)* : <input type="text" name="code_ville_principale" required/><br/>
    
    <label for="pays">Pays (country)* : <br/></label>
    <select name="pays" required>';
?><?php
liste_pays();
?><?php
echo '</select><br/><br/>
    
    <label for="situation">Situation professionnelle actuelle (current professional situation)* : <br/></label>
    <select name="pays" required> 
          <option selected="selected" value=""> </option>
          <option  value="étudiant (student)">étudiant (student)</option> 
          <option  value="enseignement (teacher)">enseignement (teacher)</option>
          <option  value="chercheur (researcher)">chercheur (researcher)</option> 
          <option  value="enseignant-chercheur (researcher teacher)">enseignant-chercheur (researcher teacher)</option> 
          <option  value="Post-Doc">Post-Doc</option> 
          <option  value="salarié (salaried)">salarié (salaried)</option>
          <option  value="profession libérale (liberal profession)">profession libérale (liberal profession)</option> 
          <option  value="retraité (retired)">retraité (retired)</option> 
    </select><br/><br/>
    
    Organisme employeur actuel (name of the current employing organization)* : <input type="text" name="organisme" required/><br/>
    
    Adresse de l\'organisme employeur (address of employing organization)* : <input type="text" name="adresse_organisme" required/><br/>*
    
    Code postal et ville (zip code and city)* : <input type="text" name="code_ville_organisme" required/><br/>
    
    <label for="pays">Pays (country)* : <br/></label>
    <select name="pays_organisme" required>';
?><?php
liste_pays();
?><?php
echo '</select><br/><br/><br/>
    
    Indiquez et précisez si vous avez fait une autre demande d\'accès simultanément à celle-ci (indicate and precise if you submited another access authorization )* : <input type="text" name="autre_demande" required/><br/>
    
    
    <label for="authorisation_zrr">Avez-vous déjà reçu une autorisation d\'accès à une ZRR (have you already received a ZRR access authorization )* : <br/></label>
    <select name="autorisation_zrr" required> 
          <option selected="selected" value=""> </option>
          <option  value="oui (yes)">oui (yes)</option> 
          <option  value="non (no)">non (no)</option>
          <option  value="ne sait pas (not applicable)">ne sait pas (not applicable)</option> 
    </select><br/><br/>
    
    Si oui, indiquez la ZRR concernée (if so, indicate the ZRR concerned )* : <input type="text" name="zrr_concernee"/><br/>
    
    Si oui, indiquez la référence de l\'habilitation (if so, indicate the reference of the authorization )* : <input type="text" name="reference_habilitation"/><br/>
    
    <label for="defense_nationale">Êtes vous habilité au titre de la protection du secret de la défense nationale (de you have an accreditation for French national defence information )* : <br/></label>
    <select name="defense_nationale" required> 
          <option selected="selected" value=""> </option>
          <option  value="oui (yes)">oui (yes)</option> 
          <option  value="non (no)">non (no)</option>
          <option  value="ne sait pas (not applicable)">ne sait pas (not applicable)</option> 
    </select><br/><br/>
    
    Si oui, indiquez le niveau d\'habilitation (if so, indicate the authorization level )* : <input type="text" name="niveau_habilitation"/><br/>
    
    Si oui, indiquez la référence de l\'habilitation (if so, indicate the reference of the authorization )* : <input type="text" name="reference_habilitation_defense"/><br/><br/>
    
    
    
    
         <input type="submit" name="valider" value="Valider"/>
     </form>';
?>