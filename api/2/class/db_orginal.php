<?php
//Definition der Klasse
class DB_Orginal {
	//Definition der Eigenschaften
	private $pdo;
    private $innerJoins = array();
    private $select = array();
    private $where = array();
    private $param = array();
    private $table;
    private $limit = 0;
    private $start = 0;

    public function __construct($pdo){
		$this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public function get_Data(){
        $sql = "SELECT ";
        if(count($this->select)>0){
            foreach($this->select as $s){
                $sql .= "`".$s['table']."`.`".$s['row']."`, ";
            }
            $sql = substr($sql,0,-2);
        }else{
            $sql .= "*";
        }
        $sql .= " FROM `".$this->table."`";
        if(count($this->innerJoins)>0){
            foreach($this->innerJoins as $j){
                $sql .= " INNER JOIN `".$j['table']."` ON `".$this->table."`.`".$j['from_row']."` = `".$j['table']."`.`".$j['to_row']."`";
            }
        }
        if(count($this->where)>0){
            $sql .= " WHERE ";
            foreach($this->where as $i){
                $sql .= "`".$i['table']."`.`".$i['row']."` = ? AND "; 
                array_push($this->param,$i['param']);
            }
            $sql = substr($sql,0,-5);
        }
        if($this->limit>0){
            $sql .= " LIMIT ?, ?";
            array_push($this->param,$this->start);
            array_push($this->param,$this->limit);
        }
        //echo $sql;
        //echo json_encode($this->param);
        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->param);

        return $statement;
    }

    public function direct_sql($sql, $dataArray){
        $statement = $this->pdo->prepare($sql);
        $statement->execute($dataArray);

        return $statement;
    }

    public function setInnerJoin($join_table,$from_row,$to_row){
        array_push($this->innerJoins,array(
            'table' => $join_table,
            'from_row' => $from_row,
            'to_row' => $to_row,
        ));
    }

    public function addSelects($table, $rows){
        foreach($rows as $r){
            array_push($this->select,array(
                'table' => $table,
                'row' => $r,
            ));
        }
    }

    public function addWhere($table, $row, $param){
        array_push($this->where,array(
            'table' => $table,
            'row' => $row,
            'param' => $param,
        ));
    }

    public function setTable($table){
        $this->table = $table;
    }

    public function setLimitTo($start,$limit){
        $this->limit = $limit;
        $this->start = $start-1;
    }

}
?>