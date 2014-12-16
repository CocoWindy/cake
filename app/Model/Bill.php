<?php

class Bill extends AppModel
{
	public $hasMany = array(
		'Order' => array(
			'className' => 'Order',
			'foreignKey' => 'bill_id',
			'dependent' => true
		)
	);

	public $hasOne = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'bill_id',
			'dependent' => true
		)
	);
}

?>