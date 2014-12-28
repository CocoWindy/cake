<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>肯打鸡餐饮系统</title>
	<?php echo $this->Html->css("style.css");
	?>
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
<li><a href="searchAllRooms"  id="current">查看房台</a></li>
<li><a href="searchAllBills" >查看账单</a></li>
</ul>
</div>
<div class = "all">
		<div class="rightbox">
		<h2 class="title">房台列表</h2>
		<div class="contentbox">
		<?php
				echo '<table frame="hsides" align ="left">';
				foreach ($Rooms as $room):
				//echo '<div class="iteam">';
				echo '<tr>';
				echo '<form name="input" action  = "" method="post">';
				echo '<td style="width:10px">'.$room['Room']['number'].'</td>';
				echo '<td style="width:100px">'.$room['Room']['name'].'</td>';
				if($room['Room']['status'] == "0")
					$status = "空房间";
				else
					$status = "已使用";
				echo '<td style="width:100px">'.$status.'</td>';
				if($room['Room']['status'] == "0")
					echo '<td style="width:80px"><a href="order/'.$room['Room']['number'].'"><button style="width:50px;height:20px" type="submit" form="input" >点单</button></a></td>';
				else {
					echo '<td style="width:80px"><a href="addOrder/'.$room['Room']['number'].'"><button style="width:50px;height:20px" type="submit" form="input" >加单</button></a></td>';
					echo '<td style="width:80px"><a href="searchRoomById/'.$room['Room']['number'].'"><button style="width:50px;height:20px" type="submit" form="input" >查看</button></a></td>';
					echo '<td style="width:80px"><a href="checkOut/'.$room['Room']['number'].'"><button style="width:50px;height:20px" type="submit" form="input" >结账</button></a></td>';
				}
				echo '</tr>';
				//echo '</div>';
				endforeach;
				
		?>
		</div>
	</div>
</div>
</body>
