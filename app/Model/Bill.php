<?php

class Bill extends AppModel
{
	public $belongsTo = array(
		'Room' => array(
			'className' => 'Room',
			'foreignKey' => 'room_id',
			'dependent' => true
		)
	);
	
}

?>