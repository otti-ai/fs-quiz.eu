<?php
//Definition der Klasse
class StatisticModel {
	//Definition der Eigenschaften
	public $date;
    public $api_calls;
	public $website_views;
    public $most_popular_site;
    public $most_used_api_call;
}
class StatisticViewsModel {
	//Definition der Eigenschaften
	public $date;
    public $path;
	public $views;
}
class StatisticCallsModel {
	//Definition der Eigenschaften
	public $date;
    public $endpoint;
	public $calls;
}
class StatisticHandle {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getByDate($date){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-statistic');
        $db->addWhere('fs-statistic','date',$date);
        $statistic = $db->get_Data()->fetchObject('StatisticModel');
        return $statistic;
    }
    public function getList(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-statistic');
		$db->setLimitTo(1,14);
        $db->setOrderBy('date');
        //optional
        $today = new DateTime('now');
        $startDay = isset($_GET["start_date"]) ?  new DateTime($_GET["start_date"]) : new DateTime('now -1 days');
        if($today<$startDay){$startDay = new DateTime('now -1 days');}
        $endDay = isset($_GET["end_date"]) ? new DateTime($_GET["end_date"]) : new DateTime($startDay->format('Y-m-d'). ' -14 days');
        if($startDay<$endDay){
            $tmp = $endDay;
            $endDay = $startDay;
            $startDay = $tmp;
        }

        $difEnd = $startDay->diff($endDay);
        $difStart = $today->diff($startDay);
        $db->setLimitTo($difStart->days,$difEnd->days+1);
        isset($_GET["days"]) ? $db->setLimitTo($difStart->days, $_GET["days"]):0;

		$statistic = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'StatisticModel');
        foreach($response as $row) {
            if(substr($row->most_used_api_call,0,2)=="/1"){
                $row->most_used_api_call = "/1/{api-key}".substr($row->most_used_api_call,7);
            }
            $statistic[] = $row;
        }
        return $statistic;
    }

    public function getListOfViewsByDate($date){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-statistic-views');
        $db->addWhere('fs-statistic-views','date',$date);
        $db->setLimitTo(1,10);
        $db->setOrderBy('views');

        $statistic = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'StatisticViewsModel');
        foreach($response as $row) {
            $statistic[] = $row;
        }
        return $statistic;
    }

    public function getListOfCallsByDate($date){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-statistic-calls');
        $db->addWhere('fs-statistic-calls','date',$date);
        $db->setLimitTo(1,10);
        $db->setOrderBy('calls');

        $statistic = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'StatisticCallsModel');
        foreach($response as $row) {
            if(substr($row->endpoint,0,2)=="/1"){
                $row->endpoint = "/1/{api-key}".substr($row->endpoint,7);
            }
            $statistic[] = $row;
        }
        return $statistic;
    }
}
?>