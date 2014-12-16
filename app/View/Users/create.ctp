<?php

echo $this->Form->create();
echo $this->Form->input('name');
echo $this->Form->input('password');
echo $this->Form->input('again',array('type' => 'password'));
echo $this->Form->end('create');

?>