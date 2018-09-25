<?php
if(isset($_POST['comment'])){
$comment=$_POST['comment'];
echo $comment;
}
?>

<!DOCTYPE html>
<htmllang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<from action="mission_1-5.php" metod="post">
<input type="text" name="comment/" value="コメント">
<input type="submit" value="送信/">
</from>

<?php
if($_POST['comment']=='完成'){
echo "おめでとう。";
} else{
}
?>

<?php
$filename='mission_1-5_syadan.txt';
$fp=fopen($filename,'w');
fwrite($fp,$_POST['comment']);
fclose($fp);
?>

</body>
</html>