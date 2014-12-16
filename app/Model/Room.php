<?php

class Room extends AppModel
{
	public $hasOne = array(
		'Bill' => array(
			'className' => 'Bill',
			'foreignKey' => 'room_id',
			'dependent' => true
		)
	);
}

?>