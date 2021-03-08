<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
$filename="msg.txt";
$msgs=[];
//检测文件是否存在
if(file_exists($filename)){
  //读取文件中的内容
  $string=file_get_contents($filename);
  if(strlen($string)>0){
    $msgs=unserialize($string);
  }
}

//获取文件的id值
$id=$_GET['id']-1;
//var_dump($msgs);
//释放数组中的值
unset($msgs[$id]);
//再将数组序列化
$msgs=array_merge($msgs);
$msgs=serialize($msgs);
file_put_contents($filename,$msgs);
if(@array_key_exists("$id",$msgs)){
	// echo "ok";
	echo "<script>alert('error');location.href='./index.php';</script>";
}
else{
	//echo "no";
    echo "<script>alert('OK');location.href='./index.php';</script>";
}
  

?>