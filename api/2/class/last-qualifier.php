<?php
//Definition der Klasse
class LastQualifierModel {
	//Definition der Eigenschaften
	public $last_qualifier_id;
	public $time;
    public $score;
    public $correct_answers;
    public $method;
}
class LastQualifierHandle {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getListByQuizID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-last-qualifier');
		$db->addWhere('fs-last-qualifier','quiz_id',$id);
        $last_qualifier = $db->get_Data()->fetchObject('LastQualifierModel');
        unset($last_qualifier->quiz_id);
        if(!$last_qualifier){
            $last_qualifier = null;
        }
        return $last_qualifier;
    }
    public function getByID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-last-qualifier');
        $db->addWhere('fs-last-qualifier','last_qualifier_id',$id);
        $last_qualifier = $db->get_Data()->fetchObject('LastQualifierModel');
        return $last_qualifier;
    }
    public function getList(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-last-qualifier');
        $start_id = isset($_GET["start_id"]) ? $_GET["start_id"] : 1;
		$db->setLimitTo($start_id,25);

        $last_qualifier = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'LastQualifierModel');

        return $last_qualifier;
    }
}
?>