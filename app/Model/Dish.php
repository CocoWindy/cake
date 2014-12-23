<?php

class Dish extends AppModel
{
	public $belongsTo = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'dish_id',
			'dependent' => true
		)
	);
}

?>