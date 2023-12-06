<?php
//Definition der Klasse
class SolutionModel {
	//Definition der Eigenschaften
	public $solution_id;
    public $question_id;
	public $text;
}
class SolutionHandle {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getListByQuestionID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-solution');
		$db->addWhere('fs-solution','question_id',$id);
		$solutions = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'SolutionModel');
        foreach($response as $row) {
            $imageH = new ImageHandle($this->pdo);
            $row->images = $imageH->getByAllSolutionByQuestionID($id);
            $solutions[] = $row;
        }
        return $solutions;
    }
    public function getByID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-solution');
        $db->addWhere('fs-solution','solution_id',$id);
        $solution = $db->get_Data()->fetchObject('SolutionModel');
        $imageH = new ImageHandle($this->pdo);
        $solution->images = $imageH->getByAllSolutionID($id);
        return $solution;
    }
    public function getList(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-solution');
        $start_id = isset($_GET["start_id"]) ? $_GET["start_id"] : 1;
		$db->setLimitTo($start_id,25);
        //optional
        isset($_GET["question_id"]) ?  $db->addWhere('fs-solution','question_id',$_GET["question_id"]):0;

		$solutions = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'SolutionModel');
        foreach($response as $row) {
            $imageH = new ImageHandle($this->pdo);
            $row->images = $imageH->getByAllSolutionID($row->solution_id);
            $solutions[] = $row;
        }
        return $solutions;
    }
}
?>