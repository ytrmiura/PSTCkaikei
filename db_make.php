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



    /*
	 データベース
テーブル：member
    id
    学年
    性別
    名前
テーブル：event
    id
    年度
    月
    イベント名
テーブル：tainou
    id
    member_id
    event_id
    滞納額
// */
   //  $pdo->exec("CREATE TABLE IF NOT EXISTS member(
   //      id INTEGER PRIMARY KEY AUTOINCREMENT,
   //      grade INTEGER,
   //      sex INTEGER,    -- 0:男 1:女
   //      name VARCHAR(10)
   //  )");

   // $stmt = $pdo->query("INSERT INTO member(grade,sex,name) VALUES ('35','0','三浦雄太郎'), ('36','0','東大地') , ('35','1','上野みなみ'), ('36','0','渡瀬清志郎')");

   //  $stmt = $pdo->prepare("SELECT * FROM member");
   //  $res = $stmt->execute();
   //  $view='';
   //  if($res==false){ //$flag=falseが⼊っていればエラー􀀁
   //    $view = "SQLエラー";
   //  }else{
   //  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
   //  $view .= '<p>'. $result['grade'] . ',' . $result['sex'] .',' . $result['name']. '</p>';
   //  }
   //  }

   //  echo $view;


//      $pdo->exec("CREATE TABLE IF NOT EXISTS event(
//         id INTEGER PRIMARY KEY AUTOINCREMENT,
//         years INTEGER,
//         months INTEGER,    
//         event VARCHAR(10)
//     )");

// $stmt = $pdo->query("INSERT INTO event(years,months,event) VALUES ('2015','8','夏合宿'), ('2015','9','後期会費') , ('2015','10','秋合宿'), ('2015','12','クリパ')");

//     $stmt = $pdo->prepare("SELECT * FROM event");
//     $res = $stmt->execute();
//     $view='';
//     if($res==false){ //$flag=falseが⼊っていればエラー􀀁
//       $view = "SQLエラー";
//     }else{
//     while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
//     $view .= '<p>'. $result['years'] . ',' . $result['months'] .',' . $result['event']. '</p>';
//     }
//     }

//     echo $view;



//      $pdo->exec("CREATE TABLE IF NOT EXISTS tainou(
//         id INTEGER PRIMARY KEY AUTOINCREMENT,
//         member_id INTEGER,
//         event_id INTEGER,    
//         tainouhi INTEGER
//     )");

// $stmt = $pdo->query("INSERT INTO tainou(member_id,event_id,tainouhi) VALUES ('1','1','5000'), ('1','2','3000') , ('2','2','4000'), ('3','3','1000')");

//     $stmt = $pdo->prepare("SELECT * FROM tainou");
//     $res = $stmt->execute();
//     $view='';
//     if($res==false){ //$flag=falseが⼊っていればエラー􀀁
//       $view = "SQLエラー";
//     }else{
//     while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
//     $view .= '<p>'. $result['member_id'] . ',' . $result['event_id'] .',' . $result['tainouhi']. '</p>';
//     }
//     }

//     echo $view;



} catch (Exception $e) {

    echo $e->getMessage() . PHP_EOL;

}