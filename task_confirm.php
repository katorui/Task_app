<?php

if(isset($_POST['post_test'])) {
    // echo json_encode($_POST['post_test']);
    $task = $_POST['post_test'];
    // 文字列であるか、10文字以内であるか
    if(!is_string($task)) {
        $data = [
            "status" => "error",
            "error_message" => "文字列で入力してください"
        ];
        echo json_encode($data);
    }

    if(mb_strlen($task) > 10) {
        $data = [
            "status" => "error",
            "error_message" => "10文字以内で入力してください"
        ];
        echo json_encode($data);
    }
}
error_log($task);

if($task) {
    // データベース接続クラスPDOのインスタンス$dbhを作成する
    try {
        $dbh = new PDO("mysql:host=localhost;dbname=task_management;charset=utf8mb4","root","root");
    // PDOExceptionクラスのインスタンス$eからエラーメッセージを取得
    } catch (PDOException $e) {
        // 接続できなかったらvar_dumpの後に処理を終了する
        error_log($e->getMessage());
        exit;
    }
    // データ取得用SQL
    $stmt = $dbh->prepare("INSERT INTO task(task_name) VALUES (:task_name)");
    // SQLをセット
    $stmt->bindParam( ":task_name", $task, PDO::PARAM_STR);
    // SQLを実行
    $stmt->execute();
    $dbh = null;
    $data = [
        "status" => "success",
        "message" => "タスクを保存しました"
    ];
    echo json_encode($data);
}
