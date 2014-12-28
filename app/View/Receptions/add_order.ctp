<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>肯打鸡餐饮系统</title>
	<?php echo $this->Html->css("style.css");
		  echo $this->Html->css("table1.css");?>
	<style>
	body{background-color:#F2B66D;font-family:Arial, Helvetica, sans-serif;font-size:12px;text-align:center}
	#navcontainer{width:650px}
	#navlist
		{
			background-color:#0D0D0D;
			position: relative;
			left: 400px;
			margin: 0;
			padding: 0 0 20px 20px;
			border-bottom: 1px solid #444;
			box-shadow:2px 2px 7px #161D37;
		}
		
		#navlist ul, #navlist li
		{
			margin: 0;
			padding: 0;
			display: inline;
			list-style-type: none;
		}
		
		#navlist a:link, #navlist a:visited
		{
			float: left;
			line-height: 14px;
			margin: 0 10px 4px 10px;
			text-decoration: none;
			color: #999;
		}
		
		#navlist a:link#current, #navlist a:visited#current, #navlist a:hover
		{
			border-bottom: 1px solid #76B41C;
			padding-bottom: 5px;
			background: transparent;
			color: #fff;
		}
		
		#navlist a:hover { color: #fff; }
</style>
</head>
<body>
<div class = "logo">
<b class="word" style="color:F5F8F1;">肯</b><b class="word" style="color:D90D0D;">打</b><b class="word" style="color:F5F8F1;">鸡</b>

</div>
<div id="navcontainer">
<ul id="navlist">
<li><a href="../searchAllRooms" id="current">查看房台</a></li>
<li><a href="../searchAllBills" >查看账单</a></li>
</ul>
</div>
<div class = "all">
	<div class="rightbox">
			<h2 class="title">请点菜</h2>
			<form name="input" action="" method="post">
			<div class = "contentbox1">
			<table style="position:relative;top:50px;left:40px;">
			<thead>
			<tr>
			<th>#</th>        
			<th>菜品名称</th>
			<th>价格</th>
			<th>数量</th>
			</tr>
			</thead>
			<tr>
			<?php
				$count = 0;
				foreach ($Dishes as $dish):
					echo '<tr>';
					echo '<td><input type="checkbox" name="Dish['.$count.'][id]" value="'.$dish['Dish']['id'].'+'.$dish['Dish']['price'].'"/></td>'; 
					echo '<td>'.$dish['Dish']['name'].'</td>';
					echo '<td>'.$dish['Dish']['price'].'</td>';
					echo '<td><select name="Dish['.$count.'][count]">
					<option  value="0">0</option>
					<option  value="1">1</option>
					<option  value="2">2</option>
					<option  value="3">3</option>
					<option  value="4">4</option>
					<option  value="5">5</option>
					<option  value="6">6</option>
					<option  value="7">7</option>
					<option  value="8">8</option>
					<option  value="9">9</option>
					<option  value="10">10</option></td>';
					echo '</select>';
					echo '</tr>';
					$count++;
				endforeach;	
			?>
			</table>
			</div>
			<input style="position:relative; top:90px" type="submit" value="点餐" />
			</form>
			

		<br>
		<br>
		<br>
		<div>
		<a href='../searchAllRooms'>返回</a>
		</div>
		</div>
	<div class="contentbox2">
			<table style="position:absolute;top:50px;left:40px;">
				<thead>
				<caption>已点菜单</caption>
				<br />
				<br />
				<tr>
					<th>#</th>        
					<th>菜品名称</th>
					<th>价格</th>
					<th>数量</th>
				</tr>
				</thead>
				<tfoot>
				<tr>
				<td>&nbsp;</td>        
				<td></td>
				<td></td>
				</tr>
				</tfoot>    
				<tr>
				<?php
					$count = 1;
					foreach ($Order as $order):
						echo '<tr>';
						echo '<td>'.$count.'</td>';
						echo '<td>'.$order['Dish']["name"].'</td>';
						echo '<td>'.$order['Dish']["price"].'</td>';
						echo '<td>'.$order['Order']['count'].'</td>';
						$count++;
					endforeach;
				?>			
			</table>
			
			
		
	</div>
</div>
</body>
