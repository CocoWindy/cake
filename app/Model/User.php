<?php

class User extends AppModel
{
	public $belongsTo = array(
		'Worker' => array(
			'className' => 'Worker',
			'foreignKey' => 'worker_id'
			)
		);	

}

?>