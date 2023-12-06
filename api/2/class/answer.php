<?php
//Definition der Klasse
class AnswerModel {
	//Definition der Eigenschaften
	public $answer_id;
	public $question_id;
    public $answer_text;
    public $is_correct;
}
class AnswerHandle {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

	public function getList(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-answer');
		$start_id = isset($_GET["start_id"]) ? $_GET["start_id"] : 1;
		$db->setLimitTo($start_id,25);
		$answers = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'AnswerModel');
        foreach($response as $row) {
			if($row->is_correct>0){
				$row->is_correct = true;
			}else{
				$row->is_correct = false;
			}
            $answers[] = $row;
        }
        return $answers;
    }
	public function getByID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-answer');
        $db->addWhere('fs-answer','answer_id',$id);
        $doc = $db->get_Data()->fetchObject('AnswerModel');
        return $doc;
    }

    public function getByQuestionID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-answer');
        $db->addWhere('fs-answer','question_id',$id);
		$answers = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'AnswerModel');
        foreach($response as $row) {
			if($row->is_correct>0){
				$row->is_correct = true;
			}else{
				$row->is_correct = false;
			}
            $answers[] = $row;
        }
        return $answers;
    }
}
?>