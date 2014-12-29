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
<h3 >进货：</h3>
  <form name="input" action="" method="post">
  <?php
    echo '<select name="goods">';
		echo '<option  value="'.$_POST['good'].'">'.$_POST['good'].'</option>';
	echo '</select>';
  ?>
  <input type="text" name="count" />  
  <input type="submit" value="执行"/>
</body>
</html>