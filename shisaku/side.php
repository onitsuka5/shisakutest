<?php
$id = $_POST['id'];


// データベース接続

$host = 'db-test.c4jqi9mk21c8.ap-northeast-1.rds.amazonaws.com';
$dbname = 'training3';
$dbuser = 'admin';
$dbpass = 'Samurai$1';

try {
$dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser,$dbpass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

// データ取得
$sql = "SELECT * FROM users;";
$stmt = $dbh->prepare($sql);
$stmt->execute();



//あらかじめ配列を生成しておき、while文で回す。
$memberList = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 $memberList[]=array(
  'id' =>$row['id'],
  'name'=>$row['name'],
  'email'=>$row['email']
 );
}




//jsonとして出力
//header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);
?>