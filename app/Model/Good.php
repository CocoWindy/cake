<?php

class Good extends AppModel
{
	public $hasMany = array(
		'StoreRecord' => array(
			'className' => 'StoreRecord',
			'foreignKey' => 'good_id',
			'dependent' => true
		)
	);
}

?>