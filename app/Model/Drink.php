<?php

class Drink extends AppModel
{
	public $belongsTo = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'drink_id',
			'dependent' => true
		)
	);
}

?>