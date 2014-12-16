<?php

echo $this->Html->link(
	'发帖',
	array('controller' => 'blogs','action' => 'add'),
	array('class' => 'button')	
	);

echo '<p/>';

echo $this->Html->link(
	'查看帖子',
	array('controller' => 'blogs','action' => 'allblogs'),
	array('class' => 'button')
	);

echo '<p/>';
echo '<p/>';

echo '好友圈： <br/>';
foreach ($Friends as $key => $value) {
	echo $this->Html->link(
		$value['Blog']['content'],
		array('controller' => 'blogs','action' => 'singleblog/'.$value['Blog']['id']));
	echo '&nbsp &nbsp &nbsp by '.$value['User']['username'].'&nbsp &nbsp'.$value['Blog']['time'];
	echo '<br/>';
}

echo '<p/>';
echo '<p/>';

echo '推荐:';
echo '<br/>';
foreach ($Recommend as $key => $value) {
	echo $this->Html->link(
		$value['content'],
		array('controller' => 'blogs','action' => 'singleblog/'.$value['id']));
	echo '<br/>';
}

echo '<p/>';
echo '<p/>';
echo '<p/>';

echo $this->Html->link(
	'退出',
	array('controller' => 'users','action' => 'logout'),
	array('class' => 'button')
	);

?>

<p/>
<p/>
<p/>
<p/>

<?php
	


?>