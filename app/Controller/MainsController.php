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

	public function login()
	{
		$this->loadModel('User');
		if($this->Session->check('User'))
		{
			//$this->flash('Please logout first',array('controller' => 'users','action' => 'personal'),3);
		}
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			$box = $this->User->find('first',array(
					'conditions' => array('username' => $data['User']['username'],'password' => $data['User']['password']),
					'recursive' => 1
				)
			);
			if(!empty($box))
			{
				$User = $this->Session->write('User',$box);	
				//$this->redirect(array('controller' => 'users','action' => 'personal'));
			}
			else
			{
				$this->Session->setFlash("Username or password error");
			}
		}
	}
}

?>