<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<form action="mission_1-61.php" method="POST">
<input type="text" value="コメント" name="comment">
<input type="submit" value="送信/">
</form>

<?php
if(!empty($_POST['comment'])){
$mission=$_POST['comment'];
echo "ご入力ありがとうございます。<br>";
echo date("Y年m月d日 H時i分")."に".$_POST['comment']."を確認いたしました。";
$filename='mission_1-61_syadan.txt';
$fp=fopen($filename,'a');
fwrite($fp, $_POST['comment']."\n");
fclose($fp);
}
?>


</body>
</html>