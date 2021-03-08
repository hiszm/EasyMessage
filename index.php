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