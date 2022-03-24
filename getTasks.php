<?php

// データベース接続クラスPDOのインスタンス$dbhを作成する
try {
    $dbh = new PDO("mysql:host=localhost;dbname=task_management;charset=utf8mb4","root","root");
// PDOExceptionクラスのインスタンス$eからエラーメッセージを取得
} catch (PDOException $e) {
    // 接続できなかったらvar_dumpの後に処理を終了する
    error_log($e->getMessage());
    exit;
}

$stmt = $dbh->query("select * from task ORDER BY id DESC");
// 最終的にhtmlへ渡される
// fetchメソッドでSQLの結果を取得
// 定数をPDO::FETCH_ASSOC:に指定すると連想配列で結果を取得できる
$all = $stmt->fetchAll(PDO::FETCH_ASSOC);
$dbh = null;

header('Content-type: application/json; charset=utf-8');
echo json_encode($all);
// echo json_encode(['text' => $_POST['post_test']]);
