<?php

try {

    // 接続
    $pdo = new PDO('sqlite:pstc.db');
    // SQL実行時にもエラーの代わりに例外を投げるように設定
    // (毎回if文を書く必要がなくなる)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
    // デフォルトのフェッチモードを連想配列形式に設定 
    // (毎回PDO::FETCH_ASSOCを指定する必要が無くなる)
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


    $stmt = $pdo->prepare("INSERT INTO member(grade,sex,name) VALUES (:grade,:sex,:name)");
    $stmt ->bindValue(":grade",$_POST["grade"]);
	$stmt->bindValue(':sex', $_POST["sex"]);
	$stmt->bindValue(':name', $_POST["name"]);
	$res = $stmt->execute();

	header("Location: index.html");

} catch (Exception $e) {

    echo $e->getMessage() . PHP_EOL;

}