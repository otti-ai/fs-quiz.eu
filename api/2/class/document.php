<?php
//Definition der Klasse
#[\AllowDynamicProperties]
class DocumentModel {
	//Definition der Eigenschaften
	public $doc_id;
	public $type;
    public $path;
    public $year;
    public $version;
}
class DocumentHandle {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getListByQuizID($id){
        $db = new DB_Orginal($this->pdo);
        $sql = "SELECT DISTINCT `fs-documents`.`doc_id` as `doc_id`, `fs-documents`.`type` as `type`, `fs-documents`.`path` as `path`, `fs-documents`.`year` as `year`, `fs-documents`.`version` as `version` FROM (`fs-quizzes` INNER JOIN `fs-quiz-event` ON `fs-quiz-event`.`quiz_id` = `fs-quizzes`.`quiz_id`) LEFT JOIN (`fs-documents-events` LEFT JOIN `fs-documents` ON `fs-documents-events`.`doc_id` = `fs-documents`.`doc_id`) ON (`fs-documents-events`.`event_id` = `fs-quiz-event`.`event_id` OR `fs-documents-events`.`event_id` = 0) AND `fs-documents`.`year` = `fs-quizzes`.`year` WHERE `fs-quizzes`.`quiz_id` = ?;";
		$documents = array();
        $response = $db->direct_sql($sql,array($id))->fetchAll(PDO::FETCH_CLASS, 'DocumentModel');
        foreach($response as $row) {
            $documents[] = $row;
        }
        return $documents;
    }
    public function getByID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-documents');
        $db->addWhere('fs-documents','doc_id',$id);
        $doc = $db->get_Data()->fetchObject('DocumentModel');
        unset($doc->event_id);
        $eventsH = new EventHandle($this->pdo);
        $doc->event = $eventsH->getEventsByDocID($doc->doc_id);
        return $doc;
    }
    public function getList(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-documents');
        $start_id = isset($_GET["start_id"]) ? $_GET["start_id"] : 1;
		$db->setLimitTo($start_id,25);
        //optional
        isset($_GET["year"]) ?  $db->addWhere('fs-documents','year',$_GET["year"]):0;
        isset($_GET["event_id"]) ?  $db->addWhere('fs-documents','event_id',$_GET["event_id"]):0;
        isset($_GET["type"]) ?  $db->addWhere('fs-documents','type',$_GET["type"]):0;
		$documents = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'DocumentModel');
        foreach($response as $row) {
            $eventsH = new EventHandle($this->pdo);
            $row->event = $eventsH->getEventsByDocID($row->doc_id);
            $documents[] = $row;
        }
        return $documents;
    }
    public function getListAll(){
        $db = new DB_Orginal($this->pdo);
        $sql = "SELECT `fs-documents`.`doc_id` AS `doc_id`, `fs-documents`.`type` AS `type`, `fs-documents`.`path` AS `path`, `fs-documents`.`year` AS `year`, `fs-documents`.`version` AS `version`, GROUP_CONCAT(`fs-documents-events`.`event_id` SEPARATOR ',') AS `event_ids` FROM `fs-documents-events` INNER JOIN `fs-documents` ON `fs-documents`.`doc_id` = `fs-documents-events`.`doc_id` GROUP BY `fs-documents`.`doc_id` ORDER BY `fs-documents`.`doc_id` DESC;";
		$documents = array();
        $response = $db->direct_sql($sql,array())->fetchAll(PDO::FETCH_CLASS, 'DocumentModel');
        foreach($response as $row) {
            $documents[] = $row;
        }
        return $documents;
    }
}
?>