<?php
include('datenbank.php');
$sql = 'SELECT * FROM (SELECT `fs-testquiz-user`.`teamname`, COUNT(`fs-testquiz-result`.`user_id`) as "count", SUM(`correct`) as "correct", SUM(`time`) as "time" FROM `fs-testquiz-result` INNER JOIN `fs-testquiz-user` ON `fs-testquiz-result`.`user_id` = `fs-testquiz-user`.`token` GROUP BY `fs-testquiz-result`.`user_id`) a WHERE `count` = 10 ORDER BY `correct` DESC, `time` ASC;';
$statement = $pdo->prepare($sql);
$statement->execute();
$count = 1;
    $html = '<table class="table table-striped"><thead><tr><th scope="col">#</th><th scope="col">Team</th></tr></thead><tbody>';
    foreach ($statement as $row) {
        $html .= '<tr><th scope="row">'.$count.'</th><td>'.$row[0].'</tr>';
        $count += 1;
    }
    $html .= '</tbody>';
    echo $html;
?>
