<!-- Ce fichier permet de récupérer le mois de connaitre son nombre de semaines et de jour
Ce fichier est utilisé dans calendrier.php  -->
<?php 

class Month{
    // $days représente les différents jours de la semaine 
    private $days= [TXT_LUNDI,TXT_MARDI,TXT_MERCREDI,TXT_JEUDI,TXT_VENDREDI,TXT_SAMEDI,TXT_DIMANCHE];
    // $months représente les différents mois de l'année 
    private $months= [TXT_JANVIER,TXT_FEVRIER,TXT_MARS,TXT_AVRIL,TXT_MAI,TXT_JUIN,TXT_JUILLET,TXT_AOUT,TXT_SEPTEMBRE,TXT_OCTOBRE,TXT_NOVEMBRE,TXT_DECEMBRE];
    // $month représente le mois qui a été choisi lors de la déclaration de la variable
    private $month;
    // $year représente l'année qui a été choisi lors de la déclaration de la variable
    private $year;

    //Constructeur
    public function __construct(int $month ,int $year){
        $currentlang = get_bloginfo('language');
        if(strpos($currentlang,'fr')!==false){
          include('App/lang-fr.php');
        }elseif(strpos($currentlang,'en')!==false){
          include('App/lang-en.php');
        }else{
          echo("échec de reconnaissance de la langue");
        }
        //Si le mois est différent de -8 (considéré comme la valeur par défaut dans le fichier calendrier) ou si le mois est incorrect alors on prend le mois actuel
        if ($month === -8 || $month < 1 || $month > 12){
            $month=intval(date('m'));
        }
        //Si l'année est différent de -8 (considéré comme la valeur par défaut dans le fichier calendrier) alors on prends l'année actuelle
        if ($year ===-8){
            $year=intval(date('Y'));
        }
        $this->month=$month;
        $this->year=$year;
    }
    //Récupère $days 
    public function getDays(){
        return  $this->days;
    }
    //Récupère $Month
    public function getMonth(){
        return  $this->month;
    }
    //Récupère $Year
    public function getYear(){
        return  $this->year;
    }
    //Retourne le premier jour du mois
    public function getStartDay(): DateTime{
        return new DateTime("{$this->year}-{$this->month}-01");
    }
    //Retourne le mois et l'année
    public function toString(): string {
        return $this->months[$this->month -1].' '.$this->year;
    }
    //Retourne le nombre de semaine
    public function getWeeks(): int {
        $start= $this->getStartDay();
        $end = (clone $start)->modify('+1 month -1 day');
        $startweek= intval($start->format('W'));
        $endweek= intval($end->format('W'));
        //Gère le cas si la dernière semaine de décembre est considérée comme le premier de l'année suivante alors on récupère la dernière semaine de l'année et on rajoute une semaine 
        if($endweek==1){
            $endweek = intval((clone $end)->modify('- 7 days')->format('W'))+1;
        }
        //On prend la différence entre la semaine de début+1 et la semaine de fin
        $weeks= $endweek-$startweek+1;
        //Si cette différence est négative alors on prend la semaine de la date de fin 
        if ($weeks <0){
           $weeks = intval($end->format('W'));
        }
        return $weeks;
    }
    //Récupère les jours qui ne sont pas dans le mois
    public function withinMonth (DateTime $date): bool {
        return $this->getStartDay()->format('Y-m') === $date->format('Y-m');
    }
    //Passe au mois suivant 
    public function nextMonth():Month{
        $month = $this->month+1;
        $year = $this->year;
        //Gère le cas si on monte d'une année
        if ($month >12){
            $month = 1;
            $year += 1; 
        }
        return new Month($month,$year);
    }
    //Passe au mois précecedant 
    public function previousMonth():Month{
        $month = $this->month-1;
        $year = $this->year;
        //Gère le cas si on descend d'une année
        if ($month < 1){
            $month = 12;
            $year -= 1; 
        }
    return new Month($month,$year);
    }
}