<?php
//Definition der Klasse
class EventModel {
	//Definition der Eigenschaften
	public $id;
	public $short_name;
    public $event_name;
    public $country;
    public $website;

    public static function getItemTable($required, $id, $tabel, $isArray){
        $param = array();
        array_push($param, new TableItem('id', 'integer', '', $required, $tabel,$isArray, false, $id));
        array_push($param, new TableItem('short_name', 'string', '', $required, $tabel,$isArray, false, $id));
        array_push($param, new TableItem('event_name', 'string', '', $required, $tabel,$isArray, false, $id));
        array_push($param, new TableItem('country', 'string', '', $required, $tabel,$isArray, false, $id));
        array_push($param, new TableItem('website', 'string', '', $required, $tabel,$isArray, false, $id));
        return $param;
    }
}

class EventHandle {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getByID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-events');
        $db->addWhere('fs-events','id',$id);
        $event = $db->get_Data()->fetchObject('EventModel');
        return $event;
    }

    public function getListEvents(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-events');
        $start_id = isset($_GET["start_id"]) ? $_GET["start_id"] : 1;
		$db->setLimitTo($start_id,25);
        $events = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'EventModel');
        foreach($response as $row) {
            $events[] = $row;
        }
        return $events;
    }
}
?>