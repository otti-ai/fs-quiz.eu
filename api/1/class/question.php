<?php
//Definition der Klasse
class QuestionModel {
	//Definition der Eigenschaften
    public $text;
    public $time;
    public $type;

    public static function getItemTable($required, $id, $tabel , $inArray){
        $param = array();
        array_push($param, new TableItem('question_id', 'integer', '', $required, $tabel, $inArray, false, $id));
        array_push($param, new TableItem('text', 'string', '', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('time', 'integer', 'in sec', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('type', 'string', 'Allowed Values: single-choice, multi-choice, input, input-range', $required, $tabel, $inArray,false, $id));
        return $param;
    }
    public static function getItemTableSingle($required, $id, $tabel , $inArray){
        $param = array();
        array_push($param, new TableItem('question_id', 'integer', '', $required, $tabel, $inArray, false, $id));
        array_push($param, new TableItem('text', 'string', '', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('time', 'integer', 'in sec', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('type', 'string', 'Allowed Values: single-choice, multi-choice, input, input-range', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('quizzes', 'array(object)', '', $required, true, false, true, $id));
        $param = array_merge($param, QuestionQuizModel::getItemTableQuestion($required, $id, true, false));
        array_push($param, new TableItem('answers', 'array(object)', '', $required, true, false, true, $id));
        $param = array_merge($param, AnswerModel::getItemTable($required, $id, true, false));
        array_push($param, new TableItem('images', 'array(object)', '', $required, true, false, true, $id));
        $param = array_merge($param, ImageModel::getItemTable($required, $id, true, false));
        array_push($param, new TableItem('solutions', 'array(object)', '', $required, true, false, true, $id));
        $param = array_merge($param, SolutionModel::getItemTable($required, $id, true, false));
        return $param;
    }
    public static function getItemTableArray($required, $id, $tabel){
        $param = array();
        array_push($param, new TableItem('question_id', 'integer', '', $required, $tabel, false, false, $id));
        array_push($param, new TableItem('text', 'string', '', $required, $tabel, false,false, $id));
        array_push($param, new TableItem('time', 'integer', 'in sec', $required, $tabel, false,false, $id));
        array_push($param, new TableItem('type', 'string', 'Allowed Values: single-choice, multi-choice, input, input-range', $required, $tabel, false,false, $id));
        array_push($param, new TableItem('position_index', 'integer', '', $required, $tabel, false,false, $id));
        array_push($param, new TableItem('answers', 'array(object)', '', $required, true, true, true, $id));
        $param = array_merge($param, AnswerModel::getItemTable($required, $id, true, true));
        array_push($param, new TableItem('images', 'array(object)', '', $required, true, true, true, $id));
        $param = array_merge($param, ImageModel::getItemTable($required, $id, true, true));
        return $param;
    }
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
        $question->question_id = $id;
        $quizzes = new QuestionQuizHandle($this->pdo);
        $question->quizzes = $quizzes->getByQuestionID($id);
        $answerH = new AnswerHandle($this->pdo);
        $question->answers = $answerH->getByQuestionID($id);
        $imageH = new ImageHandle($this->pdo);
        $question->images = $imageH->getByAllQuestionID($id);
        $solutionH = new SolutionHandle($this->pdo);
        $question->solution = $solutionH->getListByQuestionID($id);
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