<?php
// //DB接続
// function db(){
//   return new PDO('mysql:dbname=gs_db_tweet;host=localhost', 'root', 'ym941214dec');
// }

//認証OK時の初期値セット
function loginSessionSet($val){
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["id"]      = $val['id'];
  $_SESSION["grade"]      = $val['grade'];
  $_SESSION["name"]      = $val['name'];
  
}

//セッションチェック用関数
function sessionCheck(){
  if(isset($_SESSION["chk_ssid"]) != session_id()){
      echo "ログインしてください";
      exit();
  }else{
     session_regenerate_id(true);
     $_SESSION["chk_ssid"] = session_id();
  }
}

//HTML XSS対策
function htmlEnc($value) {
    return htmlspecialchars($value,ENT_QUOTES);
}


function username_count($value){

}

function tweet_count($value){
  
}


?>
