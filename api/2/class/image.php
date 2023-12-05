<?php
//Definition der Klasse
class ImageModel {
	//Definition der Eigenschaften
	public $img_id;
    public $path;

    public static function getItemTable($required, $id, $tabel, $inArray){
        $param = array();
        array_push($param, new TableItem('img_id', 'integer', '', $required, $tabel, $inArray,false, $id));
        array_push($param, new TableItem('path', 'string', '', $required, $tabel, $inArray,false, $id));
        return $param;
    }
}
class ImageHandle {
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

	public function getList(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-images');

		$images = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'ImageModel');
        foreach($response as $row) {
            $images[] = $row;
        }
        return $images;
    }

	public function getByID($id){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-images');
		$db->addWhere('fs-images','img_id',$id);
		$images = $db->get_Data()->fetchObject('ImageModel');
        return $images;
    }

	public function getQuestionList(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-images');
		$db->setInnerJoin('fs-question-img','img_id','img_id');
		$db->addSelects('fs-images',array('img_id','path'));
		$images = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'ImageModel');
        foreach($response as $row) {
            $images[] = $row;
        }
        return $images;
    }

	public function getSolutionList(){
        $db = new DB_Orginal($this->pdo);
        $db->setTable('fs-images');
		$db->setInnerJoin('fs-solution-img','img_id','img_id');
		$db->addSelects('fs-images',array('img_id','path'));
		$images = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'ImageModel');
        foreach($response as $row) {
            $images[] = $row;
        }
        return $images;
    }

    public function getByAllQuestionID($id){
		$db = new DB_Orginal($this->pdo);
        $db->setTable('fs-images');
		$db->setInnerJoin('fs-question-img','img_id','img_id');
		$db->addSelects('fs-images',array('img_id','path'));
		$db->addWhere('fs-question-img','question_id',$id);
		$images = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'ImageModel');
        foreach($response as $row) {
            $images[] = $row;
        }
        return $images;
    }

	public function getByAllSolutionID($id){
		$db = new DB_Orginal($this->pdo);
        $db->setTable('fs-images');
		$db->setInnerJoin('fs-solution-img','img_id','img_id');
		$db->addSelects('fs-images',array('img_id','path'));
		$db->addWhere('fs-solution-img','solution_id',$id);
		$images = array();
        $response = $db->get_Data()->fetchAll(PDO::FETCH_CLASS, 'ImageModel');
        foreach($response as $row) {
            $images[] = $row;
        }
        return $images;
    }
    public function getByAllSolutionByQuestionID($id){
		$db = new DB_Orginal($this->pdo);
        $sql = 'SELECT `fs-images`.`img_id` as `img_id`, `fs-images`.`path` as `path` FROM `fs-images` INNER JOIN (SELECT `fs-solution-img`.`img_id` FROM `fs-solution` INNER JOIN `fs-solution-img` ON `fs-solution-img`.`solution_id` = `fs-solution`.`solution_id` WHERE `fs-solution`.`question_id` = ?) AS `t1` ON `t1`.`img_id` = `fs-images`.`img_id`;';
		$images = array();
        $response = $db->direct_sql($sql,array($id))->fetchAll(PDO::FETCH_CLASS, 'ImageModel');
        foreach($response as $row) {
            $images[] = $row;
        }
        return $images;
    }
}
?>