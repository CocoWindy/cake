<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>肯打鸡餐饮系统</title>
	<?php echo $this->Html->css("style.css");?>
</head>
<body>
</head>
<body>
<div class = "all">
	<div class = "leftbox">
		<div = class= "menu"><a href = "">前台管理系统</a></div>
		<div = class= "menu"><a href = "">仓库管理系统</a></div>
		<div = class= "menu"><a href = "">人员管理系统</a></div>
	</div>
	<div class="rightbox">
		<h2 class="title">请点单</h2>
		<div class="contentbox">
		<table frame="hsides">
		<?php
			echo '<dl>';
			foreach ($Dishes as $dish):
				echo '<dt><input type="checkbox" name="Dish" value='.$dish['Dish']['name'].'/> '.$dish['Dish']['name'].'</dt>';
			endforeach;	
		//	foreach ($Drinks as $drink):
		//		echo '<dt><input type="checkbox" name="Dish" value='.$drink['Drink']['name'].'/> '.$dish['Drink']['name'].'</dt>';
		//	endforeach;	
			echo '</dl>';
		?>
	</table>
		</div>
		<form action="" method="post">
			<input type="submit" value="提交" />
		</form>
	</div>
</div>
</body>
