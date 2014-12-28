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
<li><a href="../searchAllRooms"  id="current">查看房台</a></li>
<li><a href="../searchAllBills" >查看账单</a></li>
</ul>
</div>
<div class = "all">
	<div class="rightbox">
		<h2 class="title">结账订单账单</h2>
		<div class="contentbox">
		<form name="input" action="" method="post">
		<table>
		<?php
			echo '<tr>';
        	echo '<th scope="row">房间名</th>';
            echo '<td>'.$Bill['Room']['name'].'</td>';
			echo '</tr>';
			echo '<tr>';
        	echo '<th scope="row">开房时间</th>';
            echo '<td>'.$Bill['Bill']['time'].'</td>';
			echo '</tr>';
			echo '<tr>';
        	echo '<th scope="row">付款状态</th>';
			if($Bill['Bill']['pay_status'] == 0 )
            echo '<td>未付款</td>';
			else
            echo '<td>已付款</td>';
			echo '</tr>';
			echo '<tr><th scope="row">付款方式</th>';
			echo '<td><select name="pay_method">
			<option  value="1">现金</option>
			<option  value="2">信用卡</option></td>';
			echo '</select>';
			echo '</tr>';
			echo '<tr>';
        	echo '<th scope="row">总计</th>';
            echo '<td>'.$Bill['Bill']['sum'].'</td>';
			echo '</tr>';
			echo '<tr>';
        	echo '<th scope="row">付款</th>';
            echo '<td><input type="text" name="pay_sum" /></td>'; 
			echo '</tr>';
			echo '<tr>';
        	echo '<th scope="row">找零</th>';
            echo '<td><input type="text" name="pay_change" /></td>';
			echo '</tr>';
			echo '<tr>';
        	echo '<th scope="row">点菜信息</th>';
            echo '<td>各种菜</td>';
			echo '</tr>';
			echo '<tr>';
        	echo '<th scope="row">备注</th>';
            echo '<td><input type="text" rows="10" cols="30" name="remark" /></td>';
			echo '</tr>';
		?>
		</table>		
		<input style="position:relative; top:10px" type="submit" value="交款" />
		</form>
		</div>
	</div>
</div>
</body>