<?php
class TableItem {
	public $name;
    public $type;
    public $doc_text;
    public $required;
    public $array;
    public $array2;
    public $head;
    public $array_id;

    public function __construct($name, $type, $doc_text, $required, $array, $array2, $head, $array_id){
        $this->name = $name;
        $this->type = $type;
        $this->doc_text = $doc_text;
        $this->required = $required;
        $this->array = $array;
        $this->array2 = $array2;
        $this->head = $head;
        $this->array_id = $array_id;

    }
}

class Part {
	public $param = array(); //items
    public $response  = array(); //items
    public $example;
    public $name;
    public $titel;
    public $type;
    public $link;


    public function __construct($name, $titel, $type, $link){
        $this->name = $name;
        $this->type = $type;
        $this->titel = $titel;
        $this->link = $link;
    }

    public function addItem($name, $type, $doc_text, $required){
        $item = new TableItem($name, $type, $doc_text, $required, false, false, false, 0);
        return $item;
    }

    public function setItemByArrayObjects($objects, $name, $type, $doc_text, $required, $id){
        $p = array();
        array_push($p, new TableItem($name, $type, $doc_text, $required, true, false, true, $id));
        switch ($objects) {
            case 'event':
                $p = array_merge($p, EventModel::getItemTable($required, $id, true, false));
                break;
            case 'quiz':
                $p = array_merge($p, QuizModel::getItemTable($required, $id, true));
                break;
            case 'quizInfo':
                $p = array_merge($p, QuizModel::getItemTableSingle($required, $id, true));
                break;
            case 'image':
                $p = array_merge($p, ImageModel::getItemTable($required, $id, true, false));
                break;
            case 'document':
                $p = array_merge($p, DocumentModel::getItemTable($required, $id, true));
                break;
            case 'solution':
                $p = array_merge($p, SolutionModel::getItemTable($required, $id, true, false));
                break;
            case 'answers':
                $p = array_merge($p, AnswerModel::getItemTable($required, $id, true, false));
                break;
            case 'question':
                $p = array_merge($p, QuestionModel::getItemTable($required, $id, true, false));
                break;
            case 'questionf':
                $p = array_merge($p, QuestionModel::getItemTableArray($required, $id, true, false));
                break;
            case 'last-qualifier':
                $p = array_merge($p, LastQualifierModel::getItemTable($required, $id, true, false));
                break;
        }
        return $p;
    }
    public function setItemByObtject($objects, $required){
        $p = array();
        switch ($objects) {
            case 'event':
                $p = array_merge($p, EventModel::getItemTable($required, 0, false, false));
                break;
            case 'quiz':
                $p = array_merge($p, QuizModel::getItemTable($required, 0, false));
                break;
            case 'quizInfo':
                $p = array_merge($p, QuizModel::getItemTableSingle($required, 0, false));
                break;
            case 'image':
                $p = array_merge($p, ImageModel::getItemTable($required, 0, false, false));
                break;
            case 'document':
                $p = array_merge($p, DocumentModel::getItemTable($required, 0, false));
                break;
            case 'solution':
                $p = array_merge($p, SolutionModel::getItemTableSingle($required, 0, false, false));
                break;
            case 'answers':
                $p = array_merge($p, AnswerModel::getItemTable($required, 0, false, false));
                break;
            case 'question':
                $p = array_merge($p, QuestionModel::getItemTableSingle($required, 0, false, false));
                break;
            case 'questionInfo':
                $p = array_merge($p, QuestionModel::getItemTable($required, 0, false, false));
                break;
            case 'last-qualifier':
                $p = array_merge($p, LastQualifierModel::getItemTableSingle($required, 0, false, false));
                break;
        }
        return $p;
    }
}

class Chapter {
	public $parts = array(); //parts
    public $name;
    public $titel;

    public function __construct($name, $titel){
        $this->name = $name;
        $this->titel = $titel;
    }

    public function createPart($name, $titel, $type, $link){
        $part = new Part($name, $titel, $type, $link);
        $parts[] = $part;
        return $part;
    }
}

//Definition der Klasse
class Doc_Print {
	//Definition der Eigenschaften
	public $chapters = array(); //chepters

    public function getEvent(){
        $event_chapter = new Chapter('event', 'Events');
        //events
        $event_part = $event_chapter->createPart('events', 'Get List', 'get', '/event');
        $event_part->param[] = $event_part->addItem('start_id', 'integer','first entry of response',false);
        $event_part->response = $event_part->setItemByArrayObjects('event','events', 'array(object)', 'limit to 25', false,0);
        $event_chapter->parts[] = $event_part;
        //events/1
        $event_part2 = $event_chapter->createPart('event', 'Get Event', 'get', '/event/{event_id}');
        $event_part2->param[] = $event_part2->addItem('event_id', 'integer','',true);
        $event_part2->response = $event_part2->setItemByObtject('event', false,0);
        $event_chapter->parts[] = $event_part2;
        //events/1/quizzes
        $event_part3 = $event_chapter->createPart('event-quiz', 'Get List of Quizzes', 'get', '/event/{event_id}/quizzes');
        $event_part3->param[] = $event_part3->addItem('event_id', 'integer','',true);
        $event_part3->param[] = $event_part3->addItem('start_id', 'integer','first entry of response',false);
        $event_part3->param[] = $event_part3->addItem('year', 'integer','',false);
        $event_part3->param[] = $event_part3->addItem('class', 'string','Allowed Values: ev, cv, dv',false);
        $event_part3->param[] = $event_part3->addItem('status', 'string','Allowed Values: complete, missing_questions, missing_solution, planned, unpublished',false);
        $event_part3->response = $event_part3->setItemByArrayObjects('quiz','quizzes', 'array(object)', 'limit to 25', false,0);
        $event_chapter->parts[] = $event_part3;

        return $event_chapter;
    }

    public function getQuiz(){
        $chapter = new Chapter('quiz', 'Quizzes');
        //quizzes
        $part = $chapter->createPart('quizzes', 'Get List', 'get', '/quiz');
        $part->param[] = $part->addItem('start_id', 'integer','first entry of response',false);
        $part->param[] = $part->addItem('event_id', 'integer','',false);
        $part->param[] = $part->addItem('year', 'integer','',false);
        $part->param[] = $part->addItem('class', 'string','Allowed Values: ev, cv, dv',false);
        $part->param[] = $part->addItem('status', 'string','Allowed Values: complete, missing_questions, missing_solution, planned, unpublished',false);
        $part->response = $part->setItemByArrayObjects('quiz','quizzes', 'array(object)', 'limit to 25', false,0);
        $chapter->parts[] = $part;
        //quizzes/1
        $part = $chapter->createPart('quiz', 'Get Quiz', 'get', '/quiz/{quiz_id}');
        $part->param[] = $part->addItem('quiz_id', 'integer','',true);
        $part->response = $part->setItemByObtject('quizInfo', false,0);
        $chapter->parts[] = $part;
        //quizzes/1/details
        $part = $chapter->createPart('quizdetails', 'Get Info', 'get', '/quiz/{quiz_id}/info');
        $part->param[] = $part->addItem('quiz_id', 'integer','',true);
        $part->response = $part->setItemByObtject('quiz', false,0);
        $chapter->parts[] = $part;
        //quizzes/1/questions
        $part = $chapter->createPart('quizgestions', 'Get Questions', 'get', '/quiz/{quiz_id}/questions');
        $part->param[] = $part->addItem('quiz_id', 'integer','',true);
        $part->response = $part->setItemByArrayObjects('questionf','questions', 'array(object)', '', false,0);
        $chapter->parts[] = $part;
        //quizzes/1/documents
        $part = $chapter->createPart('quizdoc', 'Get Documents', 'get', '/quiz/{quiz_id}/documents');
        $part->param[] = $part->addItem('quiz_id', 'integer','',true);
        $part->response = $part->setItemByArrayObjects('document','documents', 'array(object)', '', false,0);
        $chapter->parts[] = $part;
        return $chapter;
    }

    public function getImage(){
        $chapter = new Chapter('image', 'Images');
        //images
        $part = $chapter->createPart('images', 'Get List', 'get', '/image');
        $part->param[] = $part->addItem('start_id', 'integer','first entry of response',false);
        $part->response = $part->setItemByArrayObjects('image','images', 'array(object)', 'limit to 25', false,0);
        $chapter->parts[] = $part;
        //images/1
        $part = $chapter->createPart('image', 'Get Image', 'get', '/image/{img_id}');
        $part->param[] = $part->addItem('img_id', 'integer','',true);
        $part->response = $part->setItemByObtject('image',false,0);
        $chapter->parts[] = $part;
        //images/solution
        $part = $chapter->createPart('solutionList', 'Get List of Solutions', 'get', '/image/solution');
        $part->param[] = $part->addItem('start_id', 'integer','first entry of response',false);
        $part->response = $part->setItemByArrayObjects('image','images', 'array(object)', 'limit to 25', false,0);
        $chapter->parts[] = $part;
        //images/question
        $part = $chapter->createPart('questionList', 'Get List of Questions', 'get', '/image/question');
        $part->param[] = $part->addItem('start_id', 'integer','first entry of response',false);
        $part->response = $part->setItemByArrayObjects('image','images', 'array(object)', 'limit to 25', false,0);
        $chapter->parts[] = $part;
        return $chapter;
    }

    public function getDocs(){
        $chapter = new Chapter('document', 'Documents');
        //document
        $part = $chapter->createPart('documents', 'Get List', 'get', '/document');
        $part->param[] = $part->addItem('start_id', 'integer','first entry of response',false);
        $part->param[] = $part->addItem('year', 'integer','',false);
        $part->param[] = $part->addItem('event_id', 'integer','',false);
        $part->response = $part->setItemByArrayObjects('document','documents', 'array(object)', 'limit to 25', false,0);
        $chapter->parts[] = $part;
        //document/1
        $part = $chapter->createPart('document', 'Get Document', 'get', '/document/{doc_id}');
        $part->param[] = $part->addItem('doc_id', 'integer','',true);
        $part->response = $part->setItemByObtject('document',false,0);
        $chapter->parts[] = $part;
        return $chapter;
    }

    public function getSolutions(){
        $chapter = new Chapter('solution', 'Solutions');
        //solutions
        $part = $chapter->createPart('solutions', 'Get List', 'get', '/solution');
        $part->param[] = $part->addItem('start_id', 'integer','first entry of response',false);
        $part->response = $part->setItemByArrayObjects('solution','solutions', 'array(object)', 'limit to 25', false,0);
        $chapter->parts[] = $part;
        //solution/1
        $part = $chapter->createPart('solution', 'Get Solution', 'get', '/solution/{solution_id}');
        $part->param[] = $part->addItem('solution_id', 'integer','',true);
        $part->response = $part->setItemByObtject('solution',false,0);
        $chapter->parts[] = $part;
        //solution/1/images
        $part = $chapter->createPart('solutionImg', 'Get Image List', 'get', '/solution/{solution_id}/images');
        $part->param[] = $part->addItem('solution_id', 'integer','',true);
        $part->response = $part->setItemByArrayObjects('image','images', 'array(object)', '', false,0);
        $chapter->parts[] = $part;
        //solution/question/1
        $part = $chapter->createPart('solutionQuestion', 'Get Solution of Question', 'get', '/solution/question/{question_id}');
        $part->param[] = $part->addItem('question_id', 'integer','',true);
        $part->response = $part->setItemByArrayObjects('solution','solutions', 'array(object)', '', false,0);
        $chapter->parts[] = $part;
        return $chapter;
    }

    public function getAnswers(){
        $chapter = new Chapter('answers', 'Answers');
        //answer
        $part = $chapter->createPart('answers', 'Get List', 'get', '/answer');
        $part->param[] = $part->addItem('start_id', 'integer','first entry of response',false);
        $part->response = $part->setItemByArrayObjects('answers','answers', 'array(object)', 'limit to 25', false,0);
        $chapter->parts[] = $part;
        //answer/1
        $part = $chapter->createPart('answer', 'Get Answer', 'get', '/answer/{answer_id}');
        $part->param[] = $part->addItem('answer_id', 'integer','',true);
        $part->response = $part->setItemByObtject('answers',false,0);
        $chapter->parts[] = $part;
        return $chapter;
    }

    public function getQuestions(){
        $chapter = new Chapter('questions', 'Questions');
        //question
        $part = $chapter->createPart('questions', 'Get List', 'get', '/question');
        $part->param[] = $part->addItem('start_id', 'integer','first entry of response',false);
        $part->response = $part->setItemByArrayObjects('question','questions', 'array(object)', 'limit to 25', false,0);
        $chapter->parts[] = $part;
        //question/1
        $part = $chapter->createPart('question', 'Get Question', 'get', '/question/{question_id}');
        $part->param[] = $part->addItem('question_id', 'integer','',true);
        $part->response = $part->setItemByObtject('question',false,0);
        $chapter->parts[] = $part;
        //questions/1/info
        $part = $chapter->createPart('questionInfo', 'Get Info', 'get', '/question/{question_id}/info');
        $part->param[] = $part->addItem('question_id', 'integer','',true);
        $part->response = $part->setItemByObtject('questionInfo',false,0);
        $chapter->parts[] = $part;
        //questions/1/answer
        $part = $chapter->createPart('questionAnswers', 'Get Answers', 'get', '/question/{question_id}/answers');
        $part->param[] = $part->addItem('question_id', 'integer','',true);
        $part->response = $part->setItemByArrayObjects('answers','answers', 'array(object)', '', false,0);
        $chapter->parts[] = $part;
        //questions/1/img
        $part = $chapter->createPart('questionImage', 'Get Images', 'get', '/question/{question_id}/images');
        $part->param[] = $part->addItem('question_id', 'integer','',true);
        $part->response = $part->setItemByArrayObjects('image','images', 'array(object)', '', false,0);
        $chapter->parts[] = $part;
        return $chapter;
    }

    public function getLast(){
        $chapter = new Chapter('last-qualifier', 'Last Qualifier');
        //last-qualifier
        $part = $chapter->createPart('last-qualifiers', 'Get List', 'get', '/last-qualifier');
        $part->param[] = $part->addItem('start_id', 'integer','first entry of response',false);
        $part->response = $part->setItemByArrayObjects('last-qualifier','last-qualifier', 'array(object)', 'Results of the last direct qualifiers; limit to 25', false,0);
        $chapter->parts[] = $part;
        //last-qualifier/1
        $part = $chapter->createPart('last-qualifier', 'Get Last Qualifier', 'get', '/last-qualifier/{last_qualifier_id}');
        $part->param[] = $part->addItem('last_qualifier_id', 'integer','',true);
        $part->response = $part->setItemByObtject('last-qualifier',false,0);
        $chapter->parts[] = $part;
        //last-qualifier/quiz/1
        $part = $chapter->createPart('last-qualifierQuiz', 'Get Last Qualifier of Quiz', 'get', '/last-qualifier/quiz/{quiz_id}');
        $part->param[] = $part->addItem('quiz_id', 'integer','',true);
        $part->response = $part->setItemByObtject('last-qualifier',false,0);
        $chapter->parts[] = $part;
        return $chapter;
    }

    public function createChapter(){
        $chapters = array();
        $chapters[] = $this->getAnswers();
        $chapters[] = $this->getDocs();
        $chapters[] = $this->getEvent();
        $chapters[] = $this->getImage();
        $chapters[] = $this->getImage();
        $chapters[] = $this->getLast();
        $chapters[] = $this->getQuiz();
        $chapters[] = $this->getSolutions();
        //echo json_encode($chapters);
        return $chapters;
    }

}
?>