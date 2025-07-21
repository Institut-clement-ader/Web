<?php

/**
 * Template Name: Page perso
 *
 * Displays the Contact Page Template of the theme.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
get_header(); ?>

<?php do_action('spacious_before_body_content'); ?>

<div id="primary">
  <div id="content" class="clearfix">

    <?php
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

    // ----- PHP FUNCTIONS -----

    //FONCTION "STATUS TO STRING"
    function statusToString($stat)
    {
      switch ($stat) {
        case "adm":
          return "Administratif";
          break;
        case "air":
          return "Assistant ingénieur";
          break;
          return "Attaché temporaire d'enseignement et de recherche";
          break;
        case "cr":
          return "Chargé de recherche";
          break;
        case "doc":
          return "Doctorant";
          break;
        case "eca":
          return "Enseignant-chercheur associé";
          break;
        case "icere":
          return "Professeur";
          break;
        case "igt":
          return "Ingénieur";
          break;
        case "ir":
          return "Ingénieur de recherche";
          break;
        case "ma":
          return "Maître de conférence";
          break;
        case "maa":
          return "Maître de conférence";
          break;
        case "mcf":
          return "Maître de conférence";
          break;
        case "mcfa":
          return "Maître de conférence associé";
          break;
        case "pa":
          return "Professeur associé";
          break;
        case "postdoc":
          return "Post-doctorant";
          break;
        case "pr":
          return "Professeur";
          break;
        case "prag":
          return "Professeur agrégé associé";
          break;
        case "pri":
          return "Professeur invité";
          break;
        case "tech":
          return "Technicien";
          break;
        case "maître de conférences":
          return "Maître de conférence";
          break;
        case "pra":
          return "Professeur associé";
          break;
        default:
          return ucfirst($stat);
          break;
      }
    }


    //FONCTION "TUTELLE TO STRING"
    function tutelleToString($tut)
    {
      switch ($tut) {
        case "INSA":
          return ' - Institut National des Sciences Appliquées de Toulouse (<a href="http://www.insa-toulouse.fr" target="_blank">INSA de Toulouse</a>)';
          break;
        case "EMAC":
          return ' - Ecole Nationale Supérieure des Mines d\'Albi-Carmaux (<a href="http://www.mines-albi.fr" target="_blank">Mines Albi</a>)';
          break;
        case "ISAE-SUPAERO":
          return ' - Institut Supérieur de l\'Aéronautique et de l\'espace (<a href="http://www.isae.fr" target="_blank">ISAE-SUPAERO</a>)';
          break;
        case "UPS":
          return ' - Université Paul Sabatier (<a href="http://www.ups-tlse.fr" target="_blank">UPS</a>)';
          break;
        case "IUT GMP":
          return ' - Institut Universitaire de Technologie en Génie Mécanique et Productique de Toulouse (<a href="http://iut-gmp-toulouse.ups-tlse.fr" target="_blank">IUT GMP</a>)';
          break;
        case "IUT DE TARBES":
          return ' - Institut Universitaire de Technologie de Tarbes (<a href="http://www.iut-tarbes.fr" target="_blank">IUT de Tarbes</a>)';
          break;
        case "IUT DE FIGEAC":
          return ' - Institut Universitaire de Technologie de Figeac (<a href="http://www.iutfigeac.com/" target="_blank">IUT de Figeac</a>)';
          break;
        case "CUFR J.F. CHAMPOLLION":
          return ' - Centre Universitaire de Formation et de recherche Jean-François Champollion (<a href="http://www.univ-jfc.fr/" target="_blank">CUFR J.F. Champollion</a>)';
          break;
        case "UT-2 JEAN JAURèS":
          return ' - Université Toulouse 2 - Jean Jaurès (<a href="http://www.univ-tlse2.fr" target="_blank">UT2 - Jean Jaurès</a>)';
          break;
        case "UT1":
          return ' - Université Toulouse 1  Capitole (<a href="http://www.ut-capitole.fr/" target="_blank">UT1 Capitole</a>)';
          break;
        case "ICAM":
          return ' - Institut Catholique des Arts et Métiers (<a href="http://www.icam.fr/vie-etudiante/campus/le-site-de-toulouse" target="_blank">ICAM</a>)';
          break;
        case "IMT MINES ALBI":
          return ' - Ecole Nationale Supérieure des Mines d\'Albi-Carmaux (<a href="http://www.mines-albi.fr" target="_blank">IMT Mines Albi</a>)';
          break;
        case "CNRS":
          return ' - Centre National de la Recherche Scientifique (<a href="http://www.cnrs.fr/" target="_blank">CNRS</a>)';
          break;
        default:
          return $tut;
          break;
      }
    }


    //FONCTION "GROUPE TO STRING"
    function groupeToString($grp)
    {
      switch ($grp) {
        case "MS2M":
          return ' <b>Modélisation des Systèmes et Microsystèmes Mécaniques</b> (<a href="../../groupe-ms2m" target="_blank">MS2M</a>)';
          break;
        case "MSC":
          return ' <b>Matériaux et Structures Composites</b> (<a href="../../groupe-msc" target="_blank">MSC</a>)';
          break;
        case "MICS":
          return ' <b>Métrologie, Identification, Contrôle et surveillance</b> (<a href="../../groupe-mics" target="_blank">MICS</a>)';
          break;
        case "SUMO":
          return ' <b>Surfaces, Usinages, Matériaux et Outillages</b> (<a href="../../groupe-sumo" target="_blank">SUMO</a>)';
          break;
        case "ESTA":
          return ' <b>Ingénieurs, Techniciens et Administratifs</b>';
          break;
        case "ITA":
          return ' <b>Ingénieurs, Techniciens et Administratifs</b>';
          break;
        default:
          return $grp;
          break;
      }
    }


    //FONCTION "PLACE TO STRING"
    function placeToString($place)
    {
      switch ($place) {
        case "ECA MONTAUDRAN":
          return 'Espace Clément Ader, 3 rue Caroline Aigle<br />31400 Toulouse';
          break;
        case "MINES ALBI":
          return 'Mines d\'Albi-Carmaux,  Campus Jarlard<br />81013 Albi';
          break;
        case "IUT DE TARBES":
          return 'IUT, 1 rue Lautréamont<br />65016 Tarbes';
          break;
        case "AUTRE":
          return '';
          break;
        default:
          return $place;
          break;
      }
    }


    //FONCTION "DECODE UTF"
    function decodeutf($string)
    {
      $search = array('Ã©', 'Ã', 'à´', 'à¨', 'àª', 'â€™', 'â€“', 'à‰', 'à»', 'à®', ' â€”', 'Â°', 'â€', 'Å“', '"œ', 'à§', 'Âµ');
      $replace = array('é', 'à', 'ô', 'è', 'ê', '\'', '-', 'É', 'û', 'î', ' : ', '°', '"', 'œ', '"', 'ç', 'µ');
      $string = str_replace($search, $replace, $string);
      return $string;
    }


    if (have_posts() || !have_posts()) {

      /**Get all of the data about the author from the WordPress and Pods generated user profile fields.**/
      //First get the_post so WordPress knows who's author page this is
      the_post();
      global $curauth;
      $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
      //get the author's meta data and store in array $user
      $user = get_userdata(get_the_author_meta('ID'));
      //Escape all of the meta data we need into variables
      //$name = esc_attr($curauth->user_firstname) . '&nbsp;' . esc_attr($curauth->user_lastname);
      //see wp_usermeta to find where the infos are retrieved

      //Information en haut de la page
      $name = esc_attr($curauth->display_name);
      $title = esc_attr($curauth->title);

      //Téléphone de recherche
      if (strlen(esc_attr($curauth->tlphone_recherche)) == 10) {
        $phoneR = eeb_content(chunk_split(esc_attr($curauth->tlphone_recherche), 2, ' '));
      } else {
        $phoneR = esc_attr($curauth->tlphone_recherche);
      }
      //Téléphone d'enseignement
      if (strlen(esc_attr($curauth->tlphone_enseig)) == 10) {
        $phoneE = eeb_content(chunk_split(esc_attr($curauth->tlphone_enseig), 2, ' '));
      } else {
        $phoneE = esc_attr($curauth->tlphone_enseig);
      }
      //Informations a côté de la photo
      $email = eeb_email(esc_attr($curauth->user_email));
      $status = esc_attr($curauth->status);
      $hdr = esc_attr($curauth->hdr);
      $etablissement = esc_attr($curauth->tablissement_de_rattachement);
      $groupeP = esc_attr($curauth->groupe_primaire);
      $groupeS = esc_attr($curauth->groupe_secondaire);
      $groupeT = esc_attr($curauth->groupe_tertiaire);
      $loc = esc_attr($curauth->actv_rech);
      $numbu = esc_attr($curauth->office_num);

      //Informations en bas de la page 
      $actR = esc_attr($curauth->activit_de_recherche);
      $actE = esc_attr($curauth->activit_enseig);
      $respC = esc_attr($curauth->resp_coll);
      $actA = esc_attr($curauth->activit_adm);
      $actT = esc_attr($curauth->activit_tech);
      $misc = esc_attr($curauth->misc);

      //ID pour récupérer les publications 
      $idH = esc_attr($curauth->idhal);

      echo '<article>';
      echo ' <header class="entry-header">';
      echo ' <h1 class="entry-title">' . $name . '</h1>';
      echo ' </header>';

      echo ' <div class="author-info">';
      echo ' <div class="author-avatar">';
      echo '  <table cellpadding="3" border="0" id = "author">';
      echo ' <tbody>';
      echo ' <col width="14%">';
      echo ' <col width="86%">';
      echo '<tr>';
      echo '<td>';

      //vérifier si l'image existe
      function is_url_exist($url)
      {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($code == 200) {
          $status = true;
        } else {
          $status = false;
        }
        curl_close($ch);
        return $status;
      }
      //si il n'a pas uploadé d'image mais qu'il en a une qui vient de l'ancien site
      $pathtoImage = site_url() . "/imagesPerso/" . ($curauth->nickname) . ".jpg";
      //si l'utilisateur a uploadé une image depuis WP
      if ($curauth->_pods_photo_didentit != null) {
        echo '<div id="photo_profil">' . pods_image($curauth->photo_didentit, 'thumbnail', 964) . '</div>';
      } else if (is_url_exist($pathtoImage)) {
        echo '<div id="photo_profil"> <img src=' . $pathtoImage . ' /> </div>';
        //si il n'y a aucune image
      } else {
        echo '<div id="photo_profil"> <img src=' . site_url() . '/imagesPerso/default.png /> </div>';
      }

      echo '</td><td class="author_details"><b>';
      echo statusToString(strtolower($status));
      if ($hdr == 1 && ($status != 'pr' && $status != 'pri' && $status != 'pra' && $status != 'Professeur associé' && $status != 'Professeur invité' && $status != 'Professeur (ou équivalent)' && $status != 'Professeur')) {
        echo ' (HDR)';
      }
      echo '</b>' . tutelleToString(strtoupper($etablissement)) . '<br />';
      if (strlen($groupeP) > 0) {
        echo 'Membre du groupe ' . groupeToString(strtoupper($groupeP)) . '<br />';
        if (strlen($groupeS) > 0 && $groupeS != 'AXTR') {
          echo ' et du groupe ' . groupeToString(strtoupper($groupeS)) . '<br />';
          if (strlen($groupeT) > 0 && $groupeT != 'AXTR') {
            echo ' et du groupe ' . groupeToString(strtoupper($groupeT)) . '<br />';
          }
        }
      }
      echo '<i>';
      if (strlen($numbu) > 0) {
        echo $numbu . ', ';
      }
      if (strlen($loc) > 0) {
        echo placeToString(strtoupper($loc));
      }
      echo '<br />';
      echo '</i>';
      echo '<i class="fa fa-envelope"></i>&nbsp;<a href="mailto:' . str_replace($email, "'", '"') . '"> ' . $email . '</a><br />';
      if (strlen($phoneR) > 0) {
        echo ' &nbsp;<i class="fa fa-phone"></i> &nbsp;' . $phoneR . ' (recherche)<br />';
      }
      if (strlen($phoneE) > 0) {
        echo ' &nbsp;<i class="fa fa-phone"></i> &nbsp;' . $phoneE . ' (enseignement)<br />';
      }

      echo '</td>';
      echo '</tr>';
      echo '</tbody>';
      echo '</table>';
      echo ' </div>';

      echo '<div class="author-description">';

      if (strlen(html_entity_decode($actR)) > 8) {
        echo '<h6><b>Activités de recherche :</b></h6>' . decodeutf(html_entity_decode($actR)) . '<br/>';
      }
      if (strlen(html_entity_decode($actE)) > 8) {
        echo '<br/><h6><b>Activités d\'enseignement :</b></h6>' . decodeutf(html_entity_decode($actE)) . '<br/>';
      }
      if (strlen(html_entity_decode($respC)) > 8) {
        echo '<br/><h6><b>Responsabilités collectives :</b></h6>' . decodeutf(html_entity_decode($respC)) . '<br/>';
      }
      if (strlen(html_entity_decode($actA)) > 8) {
        echo '<br/><h6><b>Activités administratives de soutien à la recherche :</b></h6>' . decodeutf(html_entity_decode($actA)) . '<br/>';
      }
      if (strlen(html_entity_decode($actT)) > 8) {
        echo '<br/><h6><b>Activités techniques de soutien à la recherche :</b></h6>' . decodeutf(html_entity_decode($actT)) . '<br/>';
      }
      if (strlen(html_entity_decode($misc)) > 8) {
        echo '<br/><h6><b>Autre :</b></h6>' . decodeutf(html_entity_decode($misc)) . '<br/>';
      }


      function docTypeConvert($doctype)
      {

        switch ($doctype) {

          case 'ART':
            return 'ACL';
            break;
          case 'COMM':
            return 'COM';
            break;
          case 'COUV':
            return 'CO';
            break;
          case 'OUV':
            return 'O';
            break;
          case 'DOUV':
            return 'DO';
            break;
          case 'POSTER':
            return 'P';
            break;
          case 'PATENT':
            return 'B';
            break;
          case 'THESE':
            return 'PhD';
            break;
          case 'HDR':
            return 'HDR';
            break;
          default:
            return 'AP';
            break;
        }
      }



      $url = 'https://api.archives-ouvertes.fr/search/?q=&fq=authIdHal_s:' . $idH . '&wt=json&sort=producedDate_tdate%20desc&rows=10000&&fl=producedDateY_i,docType_s,authFullName_s,title_s,journalTitle_s,page_s,volume_s,uri_s,doiId_s,issue_s,localReference_s,journalPublisher_s,subTitle_s,conferenceTitle_s';

      //utilisation de curl pour récupérer le json
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_TIMEOUT, 5);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $data = curl_exec($ch);
      curl_close($ch);
      //on transforme le json en array php
      $json = json_decode($data, true);

      //Affichage du nombre de résultats
      $nbResultats = $json['response']['numFound'];
      $strNbResultats = $nbResultats;

      if ($nbResultats > 0) {

        echo '<br/><h6><b>Production scientifique :</b></h6>';
        echo $nbResultats . ' contributions trouvées';
        //permettre de télécharger la fiche Excel si l'utilisateur est connecté
        if (is_user_logged_in()) {
          echo "<br /><br /><FORM METHOD='POST' ACTION='" . site_url() . "/excel-des-publications/' CLASS='form-publi'>";
          echo '<input type="hidden" name="url" value=' . $url . '>';
          echo "<br /><button type=submit class='spanExcel'><i class='fa fa-table'></i>&nbsp &nbsp &nbspTélécharger au format Excel</button><br /></FORM>";
        }
        echo '<br><br>';
        echo "<table width=\"100%\" class=\" tab_publications tablesorter {sortlist: [[0,1]]}\"><col width ='6%'><col width ='5%'><col width ='80%'><col width ='9%'>" . "<THEAD>" . "<tr>" . "<th>Année</th><th>Type</th><th>Auteurs et titre du document</th><th>Liens</th></tr></THEAD><TBODY>";
        foreach ($json['response']['docs'] as $docs) {
          echo "<tr>";

          //affichage de l'annee
          echo '<td>' . $docs['producedDateY_i'] . '</td>';

          //affichage du type de publi
          echo '<td>' . docTypeConvert($docs['docType_s']) . '</td>';

          echo "<td>";
          //récupération des auteurs
          $auteurs = '';
          foreach ($docs['authFullName_s'] as $auth) {
            $auteurs .= $auth . ', ';
          }
          //on enlève la dernière virgule et l'espace
          $auteurs = substr($auteurs, 0, -2);
          //affichage des auteurs
          echo $auteurs . '.';

          //récupération des titres
          $titres = '';
          foreach ($docs['title_s'] as $tit) {
            $titres .= $tit . '. ';
          }
          //on enlève le dernier point et l'espace
          $titres = substr($titres, 0, -2);
          //affichage du titre
          echo ' <b>' . $titres . '</b>.';

          //récupération des sous-titres
          $stitres = '';
          if (!empty($docs['subTitle_s'])) {
            foreach ($docs['subTitle_s'] as $stit) {
              $stitres .= $stit . '. ';
            }
            //on enlève le dernier point et l'espace
            $stitres = substr($stitres, 0, -2);
            //affichage du sous-titre
            if (strlen($stitres) > 0) {
              echo ' <b>' . $stitres . '</b>.';
            }
          }

          $misc = " ";
          //affichage du titre de la revue
          if (!empty($docs['journalTitle_s'])) {
            $misc .= $docs['journalTitle_s'] . ',';
          }
          //affichage du titre de la conférence
          if (!empty($docs['conferenceTitle_s'])) {
            $misc .= $docs['conferenceTitle_s'] . ',';
          }
          //affichage du publisher
          if (!empty($docs['journalPublisher_s'])) {
            $misc .= ' ' . $docs['journalPublisher_s'] . ',';
          }
          //affichage des pages
          if (!empty($docs['page_s'])) {
            $misc .= ' ' . $docs['page_s'] . ',';
          }
          //affichage du volume
          if (!empty($docs['volume_s'])) {
            $misc .= ' ' . $docs['volume_s'] . ',';
          }
          $misc = substr($misc, 0, -1);
          echo '<i>' . $misc . '</i>';

          //affichage du lien (HAL) et du DOI s'il existe
          echo '<td><a href =' . $docs['uri_s'] . ' target="_blank">[hal]</a>';
          echo '<a href =' . $docs['uri_s'] . '/bibtex target="_blank">[bib]</a>';
          if (!empty($docs['doiId_s'])) {
            echo '<a href=http://dx.doi.org/' . $docs['doiId_s'] . ' target="_blank"> [doi] </a>';
          }
        }
        echo '</td></tr>';
        echo "</TBODY></table><br>";
      }


      echo '</div>';
      echo '</div>';
    }
    ?>


    <?php while (have_posts()) : the_post(); ?>

      <?php get_template_part('content', 'page'); ?>


    <?php endwhile; ?>

  </div><!-- #content -->
</div><!-- #primary -->

<?php spacious_sidebar_select(); ?>

<?php do_action('spacious_after_body_content'); ?>

<?php get_footer(); ?>