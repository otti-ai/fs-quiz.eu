<?php
//Definition der Klasse
#[\AllowDynamicProperties]
class QuizModel {
	//Definition der Eigenschaften
	public $quiz_id;
	public $year;
    public $class;
    public $information;
    public $date;
    public $status;    
}

class QuizHandle {
    private $pdo;
    private $status = array('','complete', 'missing_questions', 'missing_correct_answer', 'incomplete', 'unpublished');

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
 
    public function getList(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-quizzes');
        $start_id = isset($_GET["start_id"]) ? $_GET["start_id"] : 1;
		$db->setLimitTo($start_id,25);
        //optional
        isset($_GET["year"]) ?  $db->addWhere('fs-quizzes','year',$_GET["year"]):0;
        isset($_GET["event_id"]) ?  $db->addWhere('fs-quizzes','event_id',$_GET["event_id"]):0;
        isset($_GET["class"]) ?  $db->addWhere('fs-quizzes','class',$_GET["class"]):0;
        isset($_GET["status"]) ?  $db->addWhere('fs-quizzes','status',array_search($_GET["status"],($this->status))):0;

        $quizzes = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'QuizModel');
        foreach($response as $row) {
            $row->status = $this->status[($row->status)];
            unset($row->event_id);
            $quizzes[] = $row;
        }
        return $quizzes;
    }

    public function getByID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-quizzes');
        $db->addWhere('fs-quizzes','quiz_id',$id);
        $quiz = $db->get_Data()->fetchObject('QuizModel');
        if($quiz) {
            $quiz->status = $this->status[($quiz->status)];
            $event = new EventHandle($this->pdo);
            $g = $event->getEventsByQuizID($quiz->quiz_id);
            $quiz->event = $g;
            $questionH = new QuestionHandle($this->pdo);
            $quiz->questions = $questionH->getListByQuizIDFull($id);
            $docH = new DocumentHandle($this->pdo);
            $d = $docH->getListByQuizID($id);
            $quiz->documents = $d;
            $last = new LastQualifierHandle($this->pdo);
            $l = $last->getListByQuizID($id);
            $quiz->last_qualifier = $l;
            unset($quiz->event_id);
        }
        return $quiz;
    }

    public function getDetailsByID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-quizzes');
        $db->addWhere('fs-quizzes','quiz_id',$id);
        $quiz = $db->get_Data()->fetchObject('QuizModel');
        if($quiz) {
            $quiz->status = $this->status[($quiz->status)];
            $event = new EventHandle($this->pdo);
            $g = $event->getEventsByQuizID($quiz->quiz_id);
            $quiz->event = $g;
            $docH = new DocumentHandle($this->pdo);
            $d = $docH->getListByQuizID($id);
            $quiz->documents = $d;
            $last = new LastQualifierHandle($this->pdo);
            if($last) {
                $l = $last->getListByQuizID($id);
                $quiz->last_qualifier = $l;
            }
            unset($quiz->event_id);
        }
        return $quiz;
    }

    public function getByEvents($event_id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-quiz-event');
        $db->addWhere('fs-quiz-event','event_id',$event_id);
        $db->setInnerJoin('fs-quizzes','quiz_id','quiz_id');
        $start_id = isset($_GET["start_id"]) ? $_GET["start_id"] : 1;
		$db->setLimitTo($start_id,25);
        //optional
        isset($_GET["year"]) ?  $db->addWhere('fs-quizzes','year',$_GET["year"]):0;
        isset($_GET["class"]) ?  $db->addWhere('fs-quizzes','class',$_GET["class"]):0;
        isset($_GET["status"]) ?  $db->addWhere('fs-quizzes','status',array_search($_GET["status"],($this->status))):0;

        $quizzes = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'QuizModel');
        foreach($response as $row) {
            unset($row->id);
            //unset($row->event_id);
            $row->status = $this->status[($row->status)];
            $quizzes[] = $row;
        }
        return $quizzes;
    }
}
?>