<?php

foreach ($Blog as $key => $value) {
	echo $this->Html->div($key,$value['content']);
	echo $this->Html->div($key,$value['time']);
	
	echo '<p/>';
}

?>