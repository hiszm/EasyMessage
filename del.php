<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
$filename="msg.txt";
$msgs=[];
//����ļ��Ƿ����
if(file_exists($filename)){
  //��ȡ�ļ��е�����
  $string=file_get_contents($filename);
  if(strlen($string)>0){
    $msgs=unserialize($string);
  }
}

//��ȡ�ļ���idֵ
$id=$_GET['id']-1;
//var_dump($msgs);
//�ͷ������е�ֵ
unset($msgs[$id]);
//�ٽ��������л�
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