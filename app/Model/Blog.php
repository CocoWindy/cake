<?php

class Blog extends AppModel
{
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'fields' => array('username')
		)
	);
	
	public $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'blog_id',
			'conditions' => array('Comment.toId' => NULL),
			'order' => 'Comment.time DESC',
			'dependent' => true
		)
	);
	
	public $validate = array(
		
		'content' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please write yout blog.'
			),
			'maxLength' => array(
				'rule' => array('maxLength',140),
				'message' => 'The mian body must be no larger than 140 characters long.'
			)
		)
	);
	
}
?>