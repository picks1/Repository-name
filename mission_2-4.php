<?php
$filename='mission_2-4.txt';
$flag=0;
//編集機能
if($flag!=1){
  if (!empty($_POST['edit'])) {
//編集番号欄に番号が入ったとき
      $edit = $_POST['edit']; //編集番号=$editで受け取る
      $ediCon = file($filename); //mission_2-5.txtファイル=$delConとする
      $k=$edit-1;
      $ediData=explode("<>",$ediCon[$k]);
      //$ediConの$i行目？にあたる部分から<>を取り除いたものを$ediDataとして考える
      

	if($ediData[4]){
	//$ediDataの4をpss2で受け取ったとき
	   $edihidd = $ediData[0];
	   $ediname=$ediData[1];
	   $edicomm=$ediData[2];
	   //$edinameと$edicommという変数に$ediDataの[1]名前と[2]コメントを入れる
	}
	$flag=1;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>mission2-4</title>
</head>
<body>
<!-- フォーム -->
<form action="mission_2-4.php" method="POST">
名前:<input type="text" name="name" value="<? echo $ediname; ?>"></label><!--名前入力フォーム-->
<br />
コメント:<input type="text" name="comment" value="<?echo $edicomm; ?>"></label><!--文字入力フォーム-->
<input type="hidden" name="num" value="<?if(!empty($edihidd)){echo $edihidd;}else{echo "0";} ?>">
<br />
<input type="submit" value="送信"><!--送信フォーム-->
<br /><br />
編集:<input type="text" name="edit" value=""></label><!--編集入力フォーム-->
<br />
<input type="submit" value="編集"><!--送信フォーム-->
<br /><br />
削除:<input type="text" name="delete" value="削除番号"><!--削除入力フォーム-->
<br />
<input type="submit" value="削除"><!--送信フォーム-->
</form>
</body>
</html>
<?php
$filename='mission_2-4.txt'; //コメント・名前の空白送信の表示
$timestamp=time();
$a=0;

	if(empty($_POST['comment'] )&& $flag!=1){
		echo "コメントを入力してください。";
	}
	if(empty($_POST['name']) && $flag!=1){
		echo "名前を入力してください。<br />";
	}//名前欄とコメント欄が空で無いとき//

//削除機能
if($flag!=1){
if ($_POST['delete']!="削除番号") {
//削除番号欄に番号が入ったとき

$delete = $_POST['delete']-1; //削除番号=$deleteで受け取る

$delCon = file($filename); //mission_2-5.txtファイル=$delConとする
$delData=explode("<>", $delCon[$delete]); //delData[4]を分割

     if($delData[4]){ 
     //$delData[4]=pss3で受け取るとき
	unset($delCon[$delete]); //textファイルの削除番号の割当解除
	file_put_contents($filename,implode('',$delCon));
	//文字列を連結させてファイルに書き込む
	$delCon = file($filename); //もう一度$delConを定義

	for ($j = 0; $j < count($delCon); $j++) {
	//$delConの行を数える
	     $delData = explode("<>", $delCon[$j]);
	     //$delConの行を数えて"<>"を取り除き配列
	     $delData[0] = $j+1;
	     $delCon[$j]=$delData[0]."<>".$delData[1]."<>".$delData[2]."<>".$delData[3]."<>".$delData[4];
	}

        file_put_contents($filename,implode('',$delCon)); //textファイルの空白を連結させる。（番号を詰める）
      }
$flag=1;
} //オープンされたファイルポインタをクローズ
}

//編集機能
if ($_POST['num']!=0) {
//編集番号欄に番号が入ったとき
      $edit = $_POST['num']; //編集番号=$numで受け取る
      
      $ediCon = file($filename); //mission_2-5.txtファイル=$ediConとする
      $k=$edit-1;
      $ediData=explode("<>",$ediCon[$k]);
      //$ediConの$k行目にあたる部分から<>を取り除いたものを$ediDataとして考える
      
	if($ediData[4]){
	//$ediData[4]をpass1で受け取るとき
	   $ediCon[$k]=$ediData[0]."<>".$_POST['name']."<>".$_POST['comment']."<>".date("Y年m月d日 H時i分")."<>".$ediData[4];
	   //編集番号の名前、コメント、日時を書き換える
	   file_put_contents($filename,implode('',$ediCon));
	   //$ediDataのk行目を切り取った文字列の左から1文字目から右から1文字目までを取り出す
	}
	$flag=1;
}

//画面表示
if($flag!=1){
	//echo "aaaaa<br />";
	if(!empty($_POST['name'])&&!empty($_POST['comment'])){
	$filename='mission_2-4.txt'; //コメント・名前の空白送信の表示
	$fp =fopen($filename,'a');
	$a = count(file($filename))+1;
	$text=$a."<>".$_POST['name']."<>".$_POST['comment']."<>".date("Y年m月d日 H時i分")."<>";
	fwrite($fp,$text."\n");
	fclose($fp);
	}
} //textに名前、コメント、日時、パスワードを書き出し表示してオープンされたファイルポインタをクローズ

	$array=file($filename);

	foreach($array as $text){
		$brows=explode("<>",$text);
		
		foreach($brows as $brows){
			echo $brows." ";

		echo "<br>";
	
		} //textファイルの"<>"を取り除き、表示
//var_dump($_POST);
	}
?>