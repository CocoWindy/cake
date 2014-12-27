<?php

class Order extends AppModel
{
	public $belongTo = array(
		'Bill' => array(
			'className' => 'Bill',
			'foreignKey' => 'bill_id',
			'dependent' => true
		),
		'Dish' => array(
			'className' => 'Dish',
			'foreignKey' => 'dish_id',
			'dependent' => true
		)
	);

}

?>