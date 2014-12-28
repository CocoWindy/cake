<?php

class Job extends AppModel
{
	public $hasMany = array(
		'Worker' => array(
			'className' => 'Worker',
			'foreignKey' => 'job_id',
			'dependent' => true
		)
	);
}

?>