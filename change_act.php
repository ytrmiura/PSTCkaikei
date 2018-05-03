<?php
	session_start();
	include('include/func.php');

	for ($i=0; $i < $_POST["count"]; $i++) {
		$tainouhi = "tainouhi".$i;
		$event = "event".$i; 
		try {

		    // 接続
		    $pdo = new PDO('sqlite:test.db');
		    // SQL実行時にもエラーの代わりに例外を投げるように設定
		    // (毎回if文を書く必要がなくなる)
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
		    // デフォルトのフェッチモードを連想配列形式に設定 
		    // (毎回PDO::FETCH_ASSOCを指定する必要が無くなる)
		    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		    $stmt = $pdo->prepare("UPDATE tainou SET tainouhi=? WHERE id=? AND event=?");
		    $stmt->execute([$_POST[$tainouhi],$_SESSION["id"],$_POST[$event]]);

		    } catch (Exception $e) {
				echo $e->getMessage() . PHP_EOL;

			}

	}
header("Location: mypage_act_with_complete.php");


