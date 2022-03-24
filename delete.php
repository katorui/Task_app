<?php

if(isset($_GET['id'])) {
    $data_id = $_GET['id'];
}

try {
    $dbh = new PDO("mysql:host=localhost;dbname=task_management;charset=utf8mb4","root","root");
// PDOExceptionクラスのインスタンス$eからエラーメッセージを取得
} catch (PDOException $e) {
    // 接続できなかったらvar_dumpの後に処理を終了する
    error_log($e->getMessage());
    exit;
}
$stmt = $dbh->prepare("DELETE FROM task WHERE id = :id");
$stmt->bindParam(":id", $data_id);
$stmt->execute();
$dbh = null;
$delete_success = [
    "message" => "削除完了"
];
// header('Content-type: application/json; charset=utf-8');
echo json_encode($delete_success);
