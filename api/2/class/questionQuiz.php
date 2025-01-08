<?php
//Definition der Klasse
#[\AllowDynamicProperties]
class QuestionQuizModel {
	//Definition der Eigenschaften
    public $position_index;

}

class QuestionQuizHandle {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getByQuestionID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-quiz-question');
        $db->addSelects('fs-quiz-question',array('quiz_id','position_index'));
        $db->addWhere('fs-quiz-question','question_id',$id);
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'QuestionQuizModel');
        foreach($response as $row) {
            $result[] = $row;
        }
        return $result;
    }

    public function getByListID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-quiz-question');
        $db->addSelects('fs-quiz-question',array('quiz_id','position_index'));
        $db->addWhere('fs-quiz-question','question_id',$id);
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'QuestionQuizModel');
        foreach($response as $row) {
            $result[] = $row;
        }
        return $result;
    }

}
?>