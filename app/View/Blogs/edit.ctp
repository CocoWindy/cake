<?php

echo $this->Form->create();
echo $this->Form->input('title',array('default' => $Blog['Blog']['title']));
echo $this->Form->input('content',array('rows' => '10','default' => $Blog['Blog']['content']));
echo $this->Form->end('submit');

?>