<?php

class Order extends AppModel
{
	public $hasOne = array(
		'Dish' => array(
			'className' => 'Dish',
			'foreignKey' => 'dish_id',
			'dependent' => true
		),
		'Bill' => array(
			'className' => 'Bill',
			'foreignKey' => 'bill_id',
			'dependent' => true
		),
		'Drink' => array(
			'className' => 'Drink',
			'foreignKey' => 'drink_id',
			'dependent' => true
		)
	);
}

?>