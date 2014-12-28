<?php

class Worker extends AppModel
{
	public $belongsTo = array(
		'Job' => array(
			'className' => 'Job',
			'foreignKey' => 'job_id',
			'dependent' => true
		)
	);
}

?>