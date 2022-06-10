<?php


function statusToString($stat) {
        
    switch ($stat) {
        
      case "adm" :
        return "Administratif";
        break;
      case "air" :
        return "Assistant ingénieur";
        break;
      case "ater" :
        return "Attaché temporaire d'enseignement et de recherche";
        break;
      case "cr" :
        return "Maître de conférence (ou équivalent)";
        break;
      case "doc" :
        return "Doctorant";
        break;
      case "eca" :
        return "Enseignant-chercheur associé";
        break;
      case "icere" :
        return "Professeur (ou équivalent)";
        break;
      case "igt" :
        return "Ingénieur";
        break;
      case "ir" :
        return "Ingénieur de recherche";
        break;
      case "ingénieur - chercheur":
        return "Maître de conférence (ou équivalent)";
        break;
      case "ma" :
        return "Maître de conférence (ou équivalent)";
        break;
      case "maa" :
        return "Maître de conférence (ou équivalent)";
        break;
      case "mcf" :
        return "Maître de conférence (ou équivalent)";
        break;
      case "mcfa" :
        return "Maître de conférence associé";
        break;
      case "pa" :
        return "Maître de conférence (ou équivalent)";
        break;
      case "postdoc" :
        return "Post-doctorant";
        break;
      case "pr" :
        return "Professeur (ou équivalent)";
        break;
      case "professeur émérite" :
        return "Professeur (ou équivalent)";
        break;
      case "prag" :
        return "Professeur agrégé associé";
        break;
      case "pri" :
        return "Professeur invité";
        break;
      case "tech" :
        return "Technicien";
        break;
      case "maître de conférences" :
        return "Maître de conférence (ou équivalent)";
        break;
      case "maître assistant" :
        return "Maître de conférence (ou équivalent)";
        break;
      case "enseignant-chercheur" :
        return "Maître de conférence (ou équivalent)";
        break;
      case "pra" :
        return "Professeur associé";
        break;
      default :
        return ucfirst($stat);
        break;
    }
  }

?>