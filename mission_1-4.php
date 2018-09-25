<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<from action="mission_1-4.php" method="POST">
<input type="text" name="comment" value="コメント"><br/>
<input type="submit" value="送信/">
</from>
</body>
</html>

<?php
if(!empty($_POST['comment'])){
$mission=$_POST['comment'];
echo "ご入力ありがとうございます。<br>";
echo date("Y年m月d日 H時i分")."に".$_POST['comment']."を確認いたしました。";
fclose($fp);
}
?>