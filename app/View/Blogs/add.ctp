<?php

echo $this->Form->create();
echo $this->Form->input('content',array('rows' => '10'));
echo $this->Form->end('submit');

echo '<p/> <p/>';
echo $this->Html->link('返回',
	array('controller' => 'users','action'=> 'personal'));

?>