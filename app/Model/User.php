<?php

class User extends AppModel
{
	public $hasMany = array(
		'Blog' => array(
			'className' => 'Blog',
			'foreignKey' => 'user_id'
			),
		'Chat' => array(
			'className' => 'Chat',
			'foreignKey' => 'user_id'
			)
		);	

}

?>