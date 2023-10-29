<?php
//Definition der Klasse
class LastQualifierModel {
	//Definition der Eigenschaften
	public $last_qualifier_id;
	public $time;
    public $score;
    public $correct_answers;
    public $method;

    public static function getItemTable($required, $id, $tabel , $inArray){
        $param = array();
        array_push($param, new TableItem('last_qualifier_id', 'integer', '', $required, $tabel, $inArray, false, $id));
        array_push($param, new TableItem('time', 'integer', 'in sec', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('correct_answers', 'integer', '', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('score', 'float', '', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('method', 'string', 'Allowed Values: time, correctness, score', $required, $tabel, $inArray,false, $id));
        return $param;
    }
    public static function getItemTableSingle($required, $id, $tabel , $inArray){
        $param = array();
        array_push($param, new TableItem('last_qualifier_id', 'integer', '', $required, $tabel, $inArray, false, $id));
        array_push($param, new TableItem('quiz_id', 'integer', '', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('time', 'integer', 'in sec', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('correct_answers', 'integer', '', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('score', 'float', '', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('method', 'string', 'Allowed Values: time, correctness, score', $required, $tabel, $inArray,false, $id));
        return $param;
    }
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