<?php

class MainsController extends AppController
{
	public $components = array('Acl');

	public function addAcl()
	{
		$this->Acl->Aro->create();
		$this->Acl->Aro->save(array('parent_id' => null, 'alias' => 'waiter'));

		$this->Acl->Aco->create();
		$this->Acl->Aco->save(array('parent_id' => null, 'alias' => 'bill'));
	}

	public function index()
	{
		$this->loadModel('Worker');
		$this->loadModel('Job');
		
		//$this->Acl->allow('waiter', 'room','read');
		$this->Acl->allow('waiter', 'bill');
		//$this->Acl->allow('cashier', 'room','read');
		//$this->Acl->allow('cashier', 'bill');

		//$this->Acl->deny('waiter', 'bill', 'delete');

		$re = $this->Acl->check('waiter', 'bill', 'read');
		debug($re);
	}
}

?>