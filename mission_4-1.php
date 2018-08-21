<?php
//データベース作成
$dsn='データベース名';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
$flag=0;

$sql1 ='SELECT * FROM mission4';
	$result = $pdo -> query($sql1);
	$q= 1;
	foreach($result as $row){
		$q += 1;
	}

if(isset($_POST['edit'])&&$_POST['edit']!="編集番号"){
//編集する前の段階
   $sql="SELECT*FROM mission4 where id=:id"; //データベース
   $stmt=$pdo->prepare($sql); //results中身から表示
   $stmt->bindParam(":id",$k,PDO::PARAM_INT); //idのセット
   $k=$_POST['edit']; //編集先の配列番号取得
   $stmt->execute();
   $result=$stmt->fetch(PDO::FETCH_ASSOC); //配列としての呼び出し
   $stmt->closeCursor();

   if($result['pass']==$_POST['pass2']){ //パスワードが一致したとき
      $ediData0=$result['id'];
      $ediData1=$result['name'];
      $ediData2=$result['comment'];
      $ediData3=$result['pass'];
    }
     else{
	   echo "no pass0<br />"; //passが編集前と一致しない場合
          }
   $flag=1;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>mission4</title>
</head>
<body>
<!-- フォーム -->
<form action="mission_4-1.php" method="post">
名前:<input type="text" name="name" value="<? echo $ediData1; ?>"></label><!--名前入力フォーム-->
<br />
コメント:<input type="text" name="comment" value="<?echo $ediData2; ?>"></label><!--文字入力フォーム-->
<input type="hidden" name="num" value="<?if(!empty($ediData0)){echo $ediData0;}else{echo "0";} ?>"
<br />
パスワード:<input type="text" name="pass1" value=""></label><!--文字入力フォーム-->
<input type="submit" value="送信"><!--送信フォーム-->
<br /><br />
編集:<input type="text" name="edit" value="編集番号"></label><!--編集入力フォーム-->
<br />
パスワード:<input type="text" name="pass2" value=""></label><!--パスワード入力フォーム-->
<input type="submit" value="編集"><!--送信フォーム-->
<br /><br />
削除:<input type="text" name="delete" value="削除番号"><!--削除入力フォーム-->
<br />
パスワード:<input type="text" name="pass3" value=""></label><!--パスワード入力フォーム-->
<input type="submit" value="削除"><!--送信フォーム-->
</form>
</body>
</html>

<?php
//編集機能
if($flag==1){}
else if($_POST['num']!="0"){
//編集番号欄に番号が入ったとき
        $sql = "SELECT * FROM mission4 where id = :id";//データベース読みだし
	$stmt = $pdo -> prepare($sql);
	$stmt->bindParam(":id", $i, PDO::PARAM_INT);
	$i=$_POST['num'];//編集先の配列番号を取得
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC); //配列としての呼び出し
	
	if($result['pass']==$_POST['pass1']){ //パスワードが一致したとき
	   $name = $_POST['name'];
	   $comment = $_POST['comment'];
	   $time = date("Y年m月d日 H時i分");
	   $sql="update mission4 set name='$name',comment='$comment',time='$time' where id=:id";
           $result=$pdo->prepare($sql);
	   $result -> bindParam(':id', $i, PDO::PARAM_INT);
	   $result -> execute();
	   //編集番号の名前、コメント、日時を書き換える
         }
	  else{
		echo "no pass1<br />"; //passと編集後のpassが一致しない場合
	       }
$flag=1;
}
else if(isset($_POST['delete'])&&$_POST['delete']!="削除番号"){ 
//削除フォームに番号がかかれたら
        $sql = "SELECT * FROM mission4 where id = :id";//データベース読みだし
	$stmt = $pdo -> prepare($sql);
	$stmt->bindParam(":id", $i, PDO::PARAM_INT);
	$i=$_POST['delete'];//削除先の配列番号を取得
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_ASSOC); //配列としての呼び出し
	if($result['pass']==$_POST['pass3']){ //パスワードが一致したとき
	   $sql='SELECT * FROM mission4'; //データベースを読み出す
	   $result=$pdo->query($sql);
	   
	   foreach($result as $row){ //削除表示
	           if($row['id']>$_POST['delete']&&$row['id']<=$q){ //番号を詰める
		      $id=$row['id']-1;
   		      $name=$row['name'];
		      $comment=$row['comment'];
		      $time=$row['time'];
		      $pass=$row['pass'];
		      $sql="update mission4 set name='$name',comment='$comment',time='$time',pass='$pass' where id=$id";
		      $result=$pdo->query($sql);
		    }
	    }
	    --$q;
	    $sql="delete from mission4 where id=$q"; //最後のデータ完全消去
	    $result=$pdo->query($sql);

	  }else{
		 echo "no pass2<br />"; //passが削除前と一致しない場合
		}
	$flag=1;
}

if($flag!=1){
if(isset($_POST['name']) && isset($_POST['comment']) && isset($_POST['pass1'])){
//名前欄とコメント欄が空で無いとき
	$sql = $pdo -> prepare("INSERT INTO mission4 (id,name, comment,time,pass) VALUES (:id,:name, :comment,:time,:pass)");
	$sql -> bindParam(':id', $id, PDO::PARAM_INT);
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$sql -> bindParam(':time', $time, PDO::PARAM_STR);
	$sql -> bindParam(':pass', $pass, PDO::PARAM_STR);

	$sql1 ='SELECT * FROM mission4';
	$result = $pdo -> query($sql1);
	$id = 1;
	foreach($result as $row){
		$id += 1;
	}
	$name = $_POST['name'];
	$comment = $_POST['comment'];
	$time = date("Y年m月d日 H時i分");
	$pass = $_POST['pass1'];
	$sql -> execute();
}
}//名前とコメントが空じゃ無いときのif文の閉じる

//入力したデータの表示
$sql='SELECT*FROM mission4';
$result=$pdo->query($sql);
foreach($result as $row){
//$rowの中身はテーブルのカラム名
echo $row['id'].',';
echo $row['name'].',';
echo $row['comment'].',';
echo $row['time'].',';
echo $row['pass'].'<br>';
}

?>
