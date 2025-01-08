<?php
//Definition der Klasse
#[\AllowDynamicProperties]
class SystemStatusModel {
	//Definition der Eigenschaften
	public $quizzes;
	public $questions;
	public $last_change;
    public $avg_daily_views;
}

class SystemStatusHandle {
    private $pdo;
    private $status = array('','complete', 'missing_questions', 'missing_correct_answer', 'incomplete', 'unpublished');

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
 
    public function getAll(){
        $db = new DB_Orginal($this->pdo);
        $sql = 'SELECT (SELECT COUNT(*) FROM   `fs-quizzes`) AS "quizzes", (SELECT COUNT(*) FROM   `fs-questions`) AS "questions", (SELECT `DATE` FROM `fsQuizChangelog` ORDER BY id DESC LIMIT 1) AS "last_change", (SELECT ROUND(COUNT(DISTINCT `ID`)/ 7) FROM `fs-statistic-website` WHERE time >= DATE_SUB(NOW(), INTERVAL 7 DAY)) as "avg_daily_views" FROM    dual;';
        $systemStatus = array();
        $response = $db->direct_sql($sql,array())->fetchAll(PDO::FETCH_CLASS, 'SystemStatusModel');
        foreach($response as $row) {
            $systemStatus[] = $row;
        }
        return $systemStatus[0];
    }
}
?>