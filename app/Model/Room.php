<?php

class Room extends AppModel
{
	public $hasMany = array(
		'Bill' => array(
			'className' => 'Bill',
			'foreignKey' => 'room_id',
			'dependent' => true
		)
	);
}

?>