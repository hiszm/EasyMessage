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
//检测用户是否点击了提交按钮
if(isset($_POST['pubMsg'])){
  $username=$_POST['username'];
  $title=strip_tags($_POST['title']);
  $content=strip_tags($_POST['content']);
  $time=time();
  //将其组成关联数组
  $data=compact('username','title','content','time');
  array_push($msgs,$data);
 $msgs=array_merge($msgs);
$msgs=serialize($msgs);
  if(file_put_contents($filename,$msgs)){
    echo "<script>alert('留言成功！');location.href='./index.php';</script>";
  }else{
    echo "<script>alert('留言失败！');location.href='./index.php';</script>";
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="./img/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="./img/jquery-ui"></script>
<link href="./img/bootstrap-combined.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="./img/bootstrap.min.js"></script>
<style>


</style>
</head>
<body>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="navbar navbar-inverse">
				<div class="navbar-inner">
					<div class="container-fluid">
						 <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar collapsed"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></a> <a href="#" class="brand">留言板</a>
						<div class="nav-collapse navbar-responsive-collapse collapse">
							<ul class="nav">
								<li >
									<a href="./index.php">主页</a>
								</li>
								<li >
									<a href="#">编辑</a>
								</li>
								<li class="active">
									<a href="./add.php">添加</a>
								</li>
								
								
							</ul>
							
						</div>
						
					</div>
				</div>
				
			</div>
			
				<h1>添加</h1>
			<form action="#" method="post"> 
				
				
           <label>用户名</label><input type="text" name="username" required />
           <label>标题</label><input type="text" name="title" required />
           <label>内容</label><textarea name="content" rows="5" cols="30" required></textarea>
           <hr>
           <input type="submit" class="btn btn-primary btn-lg" name="pubMsg" value="发布留言"/>
			
				
			</form>
		</div>
	</div>
</div>
</body>
</html>