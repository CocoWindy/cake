<?php

foreach ($Blogs as $key => $value) {
	echo $this->Html->link('0.0',
		array('controller' => 'blogs','action' => 'singleblog/'.$value['Blog']['id']));
	echo $this->Html->div($key,$value['Blog']['content']);
	echo $this->Html->div($key,$value['Blog']['time']);
	
	echo '<p/>';
	echo '<p/>';
}

echo '<p/>';
echo '<p/>';
echo $this->Html->link('返回',
	array('controller' => 'users','action'=> 'personal'));

?>