<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8">
</head>
<body>
<form action="mission_2-2.php" method="POST">
<input type="text" name="name" value="名前"><br>
<input type="text" name="comment" value="コメント"><br>
<input type="submit" value="送信/">
</form>
</body>

<?php
$filename='mission_2-2.txt';
$timestamp=time();
$a=0;
	if(empty($_POST['comment'])){
		echo "コメントを入力してください。";
	}
	if(empty($_POST['name'])){
		echo "名前を入力してください。";
	}

	$fp=fopen($filename,'a');
	$array=file('mission_2-2.txt');
	for($i=0; $i<count($array); $i++){
	    $a=$i+1;
	}

	$text=$a."<>".$_POST['name']."<>".$_POST['comment']."<>".date("Y年m月d日 H時i分");
	fwrite($fp,$text."\n");
	fclose($fp);

	$array=file($filename);
	foreach($array as $text){
		$brows=explode("<>",$text);
		foreach($brows as $brows){
			echo $brows." ";
		}
		echo "<br>";
	
	}
?>