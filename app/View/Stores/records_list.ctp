<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>肯打鸡餐饮系统</title>
	<?php echo $this->Html->css("table2.css");
		  echo $this->Html->css("manu.css");		  
	?>
</head>

<body>
<div id="nav">
	<ul>
	<li class="menu2" onMouseOver="this.className='menu1'" onMouseOut="this.className='menu2'">查询	
	<div class="list">
		<a href="goodList">库存信息</a><br />
        <a href="supplierList">供应商信息</a><br />
        <a href="purchaseList">采购信息</a><br />
		<a href="recordsList">记录清单</a><br />
	</div>
	</li>
	<li class="menu2" onMouseOver="this.className='menu1'" onMouseOut="this.className='menu2'">管理
	<div class="list">
		<a href="purchase">进/出货</a><br />
		<a href="addGoods">增加新货物</a><br />
	</div>
	</li>
	</ul>
</div>
<div id="conbox">
<h3 >记录清单:</h2>
<div id="tabbox">
<table class="zebra">
    <thead>
    <tr>
        <th>#</th>        
        <th>货物名称</th>
		<th>改变数量</th>
		<th>操作类型</th>
        <th>工号</th>
	    <th>时间</th>
        <th>备注</th> 
    </tr>
    </thead>

	<?php
			$count = 0;
			foreach ($Records as $record):
				echo '<tr>';
				echo '<td>'.$count.'</td>'; 
				echo '<td>'.$record['Record']['name'].'</td>';
				echo '<td>'.$record['Record']['change_count'].'</td>';
				echo '<td>'.$record['Record']['operation'].'</td>';
				echo '<td>'.$record['Record']['time'].'</td>';
				echo '<td>'.$record['Record']['worker_id'].'</td>';
				echo '<td>'.$record['Record']['remark'].'</td>';
				echo '</tr>';
				$count++;
			endforeach;	
	?>
 

</table>
</div>
</div>
</body>
</html>