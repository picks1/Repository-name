<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equal="Content-Type" content="text/html"; charset="UTF-8">
</head>
<body>
<form action="mission_1-7.php" method="POST">
<input type="text" name="comment" value="コメント:"/>
<input type="submit" value="送信/">
</form>
</body>
</html>

<?php
$filename="mission_1-7.txt";
if(empty($_POST['comment'])){
	echo "入力をお願いします。";
}else{
	$fp=fopen($filename,'a');
	fwrite($fp,$_POST['comment']."\n");
	fclose($fp);
	$array=file("mission_1-7.txt",FILE_IGNORE_NEW_LINES);
	foreach($array as $comment){
		echo $comment;
		echo "<br>";
	}
}
if($_POST['comment']=='完成'){
	echo "<br/>"."おめでとう!<br/>";
}
?>

