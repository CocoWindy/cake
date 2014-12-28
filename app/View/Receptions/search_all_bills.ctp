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
<li><a href="searchAllRooms"  >查看房台</a></li>
<li><a href="searchAllBills"  id="current">查看账单</a></li>
</ul>
</div>
<div class = "all">
	<div class="rightbox">
		<h2 class="title">查看全部账单</h2>
		<br>
		<div class="contentbox">
		<?php
			echo '<table cellspacing="0">';
			echo '<tr><th>Bill Number</th><th>Room ID</th><th>账单状况</th><th>金额</th><th>付款</th><th>找零</th></tr>';
			foreach ($Bills as $bill):
				echo '<tr><td>'.$bill['Bill']['number'].'</td><td>'.$bill['Bill']['room_id'].'</td><td>'.$bill['Bill']['pay_status'].'</td><td>'.$bill['Bill']['sum'].'</td><td>'.$bill['Bill']['pay_sum'].'</td><td>'.$bill['Bill']['pay_change'].'</td></tr>';
			endforeach;
		?>
		</table>
		</div>
	</div>
</div>
</body>
