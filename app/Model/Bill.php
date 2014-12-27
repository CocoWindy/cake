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
	
	public $hasMany = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'bill_id',
			'dependent' => true
		)
	);
}

?>