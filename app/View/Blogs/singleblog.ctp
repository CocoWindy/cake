<?php

echo $this->Html->div('Blog',$Blog['Blog']['content']);

echo '<p/> <p/>';

echo $this->Html->link('加私聊',
	array('controller' => 'users','action' => 'addchat/'.$Blog['Blog']['user_id']));

echo '<p/> <p/>';

echo $this->Form->create('Comment',array('type' => 'post','action' => 'add/'.$Blog['Blog']['id']));
echo $this->Form->input('content',array('rows' => 4));
echo $this->Form->end('submit');

echo '<p/> <p/>';

foreach ($Blog['Comment'] as $key => $value) {
	echo $this->Html->div($key,$value['content']);
	echo $this->Html->div($key,$value['time']);
	
	echo '<p/>';
}

echo '<p/> <p/>';

echo $this->Html->link('返回',
	array('controller' => 'users','action'=> 'personal'));


?>