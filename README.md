## 首页
![在这里插入图片描述](https://img-blog.csdnimg.cn/20210308101546805.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L2phbmtpbjY=,size_16,color_FFFFFF,t_70)

## 添加留言

![在这里插入图片描述](https://img-blog.csdnimg.cn/2021030810161293.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L2phbmtpbjY=,size_16,color_FFFFFF,t_70)


## 删除留言

![在这里插入图片描述](https://img-blog.csdnimg.cn/20210308101630640.png?x-oss-process=image/watermark,type_ZmFuZ3poZW5naGVpdGk,shadow_10,text_aHR0cHM6Ly9ibG9nLmNzZG4ubmV0L2phbmtpbjY=,size_16,color_FFFFFF,t_70)

## 项目结构
```
C:.
│  add.php
│  del.php
│  edit.php
│  index.php
│  msg.txt
│
└─img
        bootstrap-combined.min.css
        bootstrap.min.js
        jquery-2.0.0.min.js

```



##  add.php
```php
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
```
## del.php
```php

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
```



##  edit.php


```php

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
$id=$_GET['id'];
if(!empty($id)){
	$id=$_GET['id']-1;
	//echo "$id";
}
//对数组进行重新排序 
$msgs=array_merge($msgs);


if(isset($_POST['pubMsg'])){
   $msgs[$id]["username"]=$_POST['username'];
   $msgs[$id]["title"]=strip_tags($_POST['title']);
   $msgs[$id]["content"]=strip_tags($_POST['content']);
   $msgs[$id]["time"]=time();
  //将其组成关联数组
  

  $msgs=serialize($msgs);
  if(file_put_contents($filename,$msgs)){
    echo "<script>alert('修改成功！');location.href='./index.php';</script>";
  }else{
    echo "<script>alert('修改失败！');location.href='./index.php';</script>";
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
								<li class="active">
									<a href="">编辑</a>
								</li>
								<li >
									<a href="./add.php">添加</a>
								</li>
								
								
							</ul>
							
						</div>
						
					</div>
				</div>
				
			</div>
			
			<h1>编辑</h1>
			<form action="#" method="post"> 
				
				
           <label>用户名</label><input type="text" name="username" required value="<?php echo $msgs[$id]["username"]?>" />
           <label>标题</label><input type="text" name="title" required value="<?php echo $msgs[$id]["title"]?>"  />
           <label>内容</label><textarea name="content" rows="5" cols="30" required ><?php echo $msgs[$id]["content"]?> </textarea>
           <hr>
           <input type="submit" class="btn btn-primary btn-lg" name="pubMsg" value="发布留言"/>
			
				
			</form>
		</div>
	</div>
</div>
</body>
</html>

```



## index.php

```php
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
								<li class="active">
									<a href="./index.php">主页</a>
								</li>
								<li >
									<a href="#">编辑</a>
								</li>
								<li >
									<a href="./add.php">添加</a>
								</li>
								
								
							</ul>
							
						</div>
						
					</div>
				</div>
				
			</div>
			
			<?php if(is_array($msgs)&&count($msgs)>0):?>
				<table class="table">
					<thead>
						<tr>
							<th>
								编号
							</th>
							<th>
								用户
							</th>
							<th>
								时间
							</th>
							<th>
								内容
							</th>
							<th>
								操作
							</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1;$j=1;$k=1;foreach($msgs as $val):?>
						<tr class="success">
								<td>
		                			<?php echo $i++;?>
		              			</td>
					              <td>
					                <?php echo $val['username'];?>
					              </td>
					              <td>
					                <?php echo $val['title'];?>
					              </td>
					              <td>
					                <?php echo date("m/d/Y H:i:s",$val['time']);?>
					              </td>
					              <td>
					                <?php echo $val['content'];?>
					              </td>
								<td>
									<a href="edit.php?id=<?php echo $j++?>">编辑</a>|
									<a href="del.php?id=<?php echo $k++?>">删除</a>
								</td>
							</tr>
						<?php endforeach;?>
				
					</tbody>
				</table>
			  <?php endif;?>
			<a class="btn" href="./add.php">发表留言</a>
         
			
				
			
		</div>
	</div>
</div>
</body>
</html>


```
## msg.txt

```

a:3:{
i:0;a:4:{s:8:"username";s:15:"我是最帅的";s:5:"title";s:21:"楼下的都没我帅";s:7:"content";s:26:"如题 我不想多说了 ";s:4:"time";i:1615168088;}
i:1;a:4:{s:8:"username";s:27:"我是用户我最帅的的";s:5:"title";s:18:"楼上都没我帅";s:7:"content";s:49:"如题 不想多说 我就是最刷的  啊哈哈";s:4:"time";i:1615168088;}
i:2;a:4:{s:8:"username";s:9:"摸鱼师";s:5:"title";s:12:"测试标题";s:7:"content";s:10:"moyushi.cn";s:4:"time";i:1615168088;}}

```



## code

https://github.com/hiszm/EasyMessage