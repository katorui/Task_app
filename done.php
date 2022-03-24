<?php

if(isset($_GET['id'])) {
    $data_id = $_GET['id'];
    // echo json_encode($data_id);
    // exit;
}
// データベース接続クラスPDOのインスタンス$dbhを作成する
try {
    $dbh = new PDO("mysql:host=localhost;dbname=task_management;charset=utf8mb4","root","root");
// PDOExceptionクラスのインスタンス$eからエラーメッセージを取得
} catch (PDOException $e) {
    // 接続できなかったらvar_dumpの後に処理を終了する
    error_log($e->getMessage());
    exit;
}

$num = 1;
$stmt = $dbh->prepare("UPDATE task SET done = :done WHERE id = :id");
$stmt->bindParam(":done", $num);
$stmt->bindParam(":id", $data_id);
$stmt->execute();
$dbh = null;
$done_success = [
    "message" => "完了"
];
header('Content-type: application/json; charset=utf-8');
echo json_encode($done_success);
