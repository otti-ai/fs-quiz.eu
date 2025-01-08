<?php
//Definition der Klasse
#[\AllowDynamicProperties]
class EventModel {
	//Definition der Eigenschaften
	public $id;
	public $short_name;
    public $event_name;
    public $country;
    public $website;
}

class EventHandle {
    private $pdo;
    private $status = array('','complete', 'missing_questions', 'missing_correct_answer', 'incomplete', 'unpublished');

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

    public function getEventsByQuizID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-quiz-event');
        $db->addWhere('fs-quiz-event','quiz_id',$id);
        $db->setInnerJoin('fs-events','event_id','id');
        $events = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'EventModel');
        foreach($response as $row) {
            unset($row->id);
            unset($row->quiz_id);
            $events[] = $row;
        }
        return $events;
    }

    public function getEventsByDocID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-documents-events');
        $db->addWhere('fs-documents-events','doc_id',$id);
        $db->setInnerJoin('fs-events','event_id','id');
        $events = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'EventModel');
        foreach($response as $row) {
            unset($row->doc_id);
            unset($row->event_id);
            $events[] = $row;
        }
        return $events;
    }

    public function getListEventsAll(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-events');
        $events = array();
        $responseEvents = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'EventModel');
        foreach($responseEvents as $row) {
            $row->quizzes = array();
            $events[] = $row;
        }

        $db->setTable('fs-quiz-event');
        $db->setInnerJoin('fs-quizzes','quiz_id','quiz_id');
        $db->addSelects('fs-quiz-event',array('quiz_id','event_id'));
        $db->addSelects('fs-quizzes',array('year','class','information','date','status'));
        $db->setOrderBy('date');
        $quizzes = array();
        $responseQuizzes = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'QuizModel');

        foreach($responseQuizzes as $row) {
            $row->status = $this->status[($row->status)];
            array_push($events[$row->event_id - 1]->quizzes, $row);
        }
        
        return $events;
    }
}
?>