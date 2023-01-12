<?php
//Definition der Klasse
class Status {
	//Definition der Eigenschaften
	public $status_id;
	public $name;

	public function db_create($status_id, $name) {
		$this->status_id = $status_id;
		$this->name = $name;
	}
}
?>