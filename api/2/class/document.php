<?php
//Definition der Klasse
class DocumentModel {
	//Definition der Eigenschaften
	public $doc_id;
	public $type;
    public $path;
    public $year;
    public $version;
    public $event_id;

    public static function getItemTable($required, $id, $tabel){
        $param = array();
        array_push($param, new TableItem('doc_id', 'integer', '', $required, $tabel,false, false, $id));
        array_push($param, new TableItem('type', 'string', 'Allowed Values: Rulebook, Hybrid Rules, Additional Rules, Handbook, Registration, Additional Documents', $required, $tabel,false, false, $id));
        array_push($param, new TableItem('path', 'integer', '', $required, $tabel,false, false, $id));
        array_push($param, new TableItem('year', 'integer', '', $required, $tabel,false, false, $id));
        array_push($param, new TableItem('version', 'string', '', $required, $tabel,false, false, $id));
        array_push($param, new TableItem('event_id', 'integer', 'ID 0 for all events', $required, $tabel,false, false, $id));
        return $param;
    }
}
class DocumentHandle {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getListByQuizID($id){
        $db = new DB_Orginal($this->pdo);
        $sql = "SELECT `fs-documents`.`doc_id` as `doc_id`, `fs-documents`.`type` as `type`, `fs-documents`.`path` as `path`, `fs-documents`.`year` as `year`, `fs-documents`.`version` as `version`, `fs-documents`.`event_id` as `event_id` FROM `fs-quizzes`, `fs-documents` WHERE `fs-documents`.`year` = `fs-quizzes`.`year` AND `fs-quizzes`.`quiz_id` = ? AND (`fs-quizzes`.`event_id` = `fs-documents`.`event_id` OR `fs-documents`.`event_id` = 0);";
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
		$documents = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'DocumentModel');
        foreach($response as $row) {
            $documents[] = $row;
        }
        return $documents;
    }
    public function getListAll(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-documents');
        $start_id = isset($_GET["start_id"]) ? $_GET["start_id"] : 1;
        //optional
        isset($_GET["year"]) ?  $db->addWhere('fs-documents','year',$_GET["year"]):0;
        isset($_GET["event_id"]) ?  $db->addWhere('fs-documents','event_id',$_GET["event_id"]):0;
		$documents = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'DocumentModel');
        foreach($response as $row) {
            $documents[] = $row;
        }
        return $documents;
    }
}
?>