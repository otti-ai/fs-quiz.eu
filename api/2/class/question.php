<?php
//Definition der Klasse
class QuestionModel {
	//Definition der Eigenschaften
    public $text;
    public $time;
    public $type;
}
class QuestionHandle {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getList(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-questions');
        $start_id = isset($_GET["start_id"]) ? $_GET["start_id"] : 1;
		$db->setLimitTo($start_id,25);
        //optional
        isset($_GET["type"]) ?  $db->addWhere('fs-questions','type',$_GET["type"]):0;

        $questions = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'QuestionModel');
        foreach($response as $row) {
            $q = new QuestionModel();
            $q->text = $row->text;
            $q->time = $row->time;
            $q->type = $row->type;
            $q->question_id = $row->id;
            $questions[] = $q;
        }
        return $questions;
    }

    public function getListAll(){
        $db = new DB_Orginal($this->pdo);
        $sql = 'SELECT `fs-questions`.`text` as `text`, `fs-questions`.`id` as `question_id`, `fs-questions`.`type` as `type`, `fs-events`.`event_name` as `event_name`, `fs-events`.`id` as `event_id`, `fs-quizzes`.`year` as `year`, `fs-quizzes`.`class` as `class`, `fs-question-category`.`mechanical` as `mechanical`, `fs-question-category`.`electronic` as `electronic`, `fs-question-category`.`scoring` as `scoring`, `fs-question-category`.`static` as `static`, `fs-question-category`.`dynamic` as `dynamic`, `fs-question-category`.`rule` as `rule`, `fs-question-category`.`math` as `math` FROM ((( `fs-quiz-question` LEFT JOIN `fs-questions` ON `fs-quiz-question`.`question_id` = `fs-questions`.`id` ) LEFT JOIN `fs-question-category` ON `fs-questions`.`id` = `fs-question-category`.`question_id`) INNER JOIN `fs-quizzes` ON `fs-quizzes`.`quiz_id` = `fs-quiz-question`.`quiz_id`) INNER JOIN `fs-events` ON `fs-events`.`id` = `fs-quizzes`.`event_id`;';
        $response = $db->direct_sql($sql,array())->fetchAll(PDO::FETCH_CLASS, 'QuestionModel');
        foreach($response as $row) {
            $imageH = new ImageHandle($this->pdo);
            $row->images = $imageH->getByAllQuestionID($row->question_id);
            $solutionH = new SolutionHandle($this->pdo);
            $row->solution = $solutionH->getListByQuestionID($row->question_id);
            $questions[] = $row;
        }
        return $questions;
    }

    public function getByIDFull($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-questions');
        $db->addWhere('fs-questions','id',$id);
        $db->addSelects('fs-questions',array('text','time','type'));
        $question = $db->get_Data()->fetchObject('QuestionModel');
        if($question){
            $question->question_id = $id;
            $quizzes = new QuestionQuizHandle($this->pdo);
            $question->quizzes = $quizzes->getByQuestionID($id);
            $answerH = new AnswerHandle($this->pdo);
            $question->answers = $answerH->getByQuestionID($id);
            $imageH = new ImageHandle($this->pdo);
            $question->images = $imageH->getByAllQuestionID($id);
            $solutionH = new SolutionHandle($this->pdo);
            $question->solution = $solutionH->getListByQuestionID($id);
        }
        return $question;
    }

    public function getByIDDetails($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-questions');
        $db->addWhere('fs-questions','id',$id);
        $db->addSelects('fs-questions',array('text','time','type'));
        $question = $db->get_Data()->fetchObject('QuestionModel');
        $question->question_id = $id;
        return $question;
    }

    public function getListByQuizIDFull($quiz_id){
        $db = new DB_Orginal($this->pdo);

        $db->setTable('fs-quiz-question');
        $db->setInnerJoin('fs-questions','question_id','id');
        $db->addSelects('fs-quiz-question',array('position_index','question_id'));
        $db->addSelects('fs-questions',array('text','time','type'));
        $db->addWhere('fs-quiz-question','quiz_id',$quiz_id);

        $questions = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'QuestionModel');
        foreach($response as $row) {
            $answerH = new AnswerHandle($this->pdo);
            $row->answers = $answerH->getByQuestionID($row->question_id);
            $imageH = new ImageHandle($this->pdo);
            $row->images = $imageH->getByAllQuestionID($row->question_id);
            $solutionH = new SolutionHandle($this->pdo);
            $row->solution = $solutionH->getListByQuestionID($row->question_id);
            $questions[] = $row;
        }
        return $questions;
    }
}
?>