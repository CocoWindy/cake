<?php

class Purchase extends AppModel
{
	public $belongsTo = array(
		'Supplier' => array(
			'className' => 'Supplier',
			'foreignKey' => 'supplier_id',
			'dependent' => true
		)
	);
}

?>