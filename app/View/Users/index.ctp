<?php


echo $this->Html->link(
	'登录',
	array('controller' => 'users','action' => 'login'),
	array('class' => 'button')	
	);

echo '<p/>';

echo $this->Html->link(
	'注册',
	array('controller' => 'users','action' => 'create'),
	array('class' => 'button')
	);


?>