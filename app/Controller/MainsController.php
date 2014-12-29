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

	public function allow()
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
			$user = $this->Session->read('User');
			$this->set('User',$user);
			//$this->flash('Please logout first',array('controller' => 'users','action' => 'personal'),3);
		}
		if($this->request->is('post'))
		{
			if($this->Session->check('User'))
			{
				$this->Session->destroy();
				$this->redirect(array('controller' => 'Mains','action' => 'login'));
			}
			else
			{
				$data = $this->request->data;
				$box = $this->User->find('first',array(
						'conditions' => array('User.name' => $data['username'],'User.password' => $data['password']),
						'recursive' => 2
					)
				);
				if(!empty($box))
				{
					$User = $this->Session->write('User',$box);	
					$job_id = $box['Worker']['Job']['id'];
					switch ($job_id) {
						case '1':
						{
							$this->redirect(array('controller' => 'Receptions','action' => 'searchAllRooms'));
							break;
						}
						case '2':
						{
							$this->redirect(array('controller' => 'Receptions','action' => 'searchAllRooms'));
							break;
						}
						case '3':
						{
							$this->redirect(array('controller' => 'Stores','action' => 'index'));
							break;
						}
						case '4':
						{
							$this->redirect(array('controller' => 'Stores','action' => 'index'));
							break;
						}
						default:
							# code...
							break;
					}
				}
				else
				{
					$this->Session->setFlash("Username or password error");
				}
			}
		}
	}
}

?>