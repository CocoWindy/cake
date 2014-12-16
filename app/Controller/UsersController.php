<?php

class UsersController extends AppController
{
	public function index()
	{
	}


	public function login()
	{
		if($this->Session->check('User'))
		{
			$this->flash('Please logout first',array('controller' => 'users','action' => 'personal'),3);
		}
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			$box = $this->User->find('first',array(
					'conditions' => array('username' => $data['User']['username'],'password' => $data['User']['password']),
					'fields' => array('User.username'),
					'recursive' => 0
				)
			);
			if(!empty($box))
			{
				$User = $this->Session->write('User',$box);	
				$this->redirect(array('controller' => 'users','action' => 'personal'));
			}
			else
			{
				$this->Session->setFlash("Username or password error");
			}
		}

	}

	public function logout()
	{
		if($this->Session->check('User'))
		{
			$this->Session->destroy();
			$this->redirect(array('controller' => 'users','action' => 'login'));
		}
		else
		{
			$this->redirect(array('controller' => 'users','action' => 'login'));
		}
	}

					
	public function create()
	{
		if($this->request->is('post'))
		{
			$this->User->create();
			$data['User']['username'] = $this->request->data['User']['name'];
			$data['User']['password'] = $this->request->data['User']['password'];
			if(!empty($data['User']['username']))
			{
				$box = $this->User->find('first',array(
					'conditions' => array('username' => $this->request->data['User']['Name'])
					)
				);
				if(empty($box))
				{
					if($data['User']['password'] == $this->request->data['User']['again'])
					{
						if(!empty($data['User']['password']))
						{
							if($this->User->save($data))
							{
								$user = $this->User->find('first',array(
									'conditions' => array('username' => $data['User']['username']),
									'fields' => array('User.id','User.username')));
								$User = $this->Session->write('User',$user);	
								$this->redirect(array('controller' => 'users','action' => 'personal'));
							}
							else
							{
								$this->Session->setFlash('TAT');
							}
						}
						else
						{
							$this->Session->setFlash('Please input the password');
						}
					}
					else
					{
						$this->Session->setFlash('Two input password is not consistent');
					}
				}
				else
				{
					$this->Session->setFlash('The username has been existed');
				}
			}
			else
			{
				$this->Session->setFlash('The username can not be empty');
			}
		}
	}

	public function allblog()
	{
		if($this->Session->check('User'))
		{
			$User = $this->Session->read('User');
			$box = $this->User->find('all',array(
				'conditions' => array('id' => $User['User']['id']),'recursive' => 1)
			);
			$this->set('Blog',$box[0]['Blog']);
		}
		else
		{
			$this->flash('Please login first',array('controller' => 'users','action' => 'login'),3);
		}
	}

	public function personal()
	{
		if($this->Session->check('User'))
		{
			$User = $this->Session->read('User');	

			$FNumber = $this->User->Chat->find('all',array(
				'conditions' => array('user_id' => $User['User']['id'])));
			for($i = 0; $i < sizeof($FNumber); ++$i)
			{
				$FNumber[$i] = $FNumber[$i]['Chat']['user_two'];
			}
			//debug($FNumber);
			$Friends = $this->User->Blog->find('all',array(
				'conditions' => array('user_id' => $FNumber),
				'fields' => array('Blog.id','Blog.content','Blog.time','User.username')));
			//debug($Friends);
			$this->set('Friends',$Friends);

			$array = $this->User->Blog->find('all',array(
				'conditions' => array('user_id' != $User['User']['id']),
				'order' => array('Blog.id')));
			
			$Number = sizeof($array);
			$Recommend = array(-1,-1,-1,-1,-1);

			//debug($array);
			
			if($Number > 5)
			{
				for($i = 0; $i < 5; ++$i)
				{
					$isOK = false;
					while(!$isOK)
					{
						$isOK = true;
						$box = mt_rand(1,$Number);

						for($time = 0; $time < $i; $time++)
						{
							if($Recommend[$time] == $box)
							{
								$isOK = false;
								break;
							}
						}
					}
					$Recommend[$i] = $box;
				}

				//debug($Recommend);

				for($i = 0; $i < 5; ++$i)
				{
					$a = $Recommend[$i] - 1;
					$Recommend[$i] = $array[$a]['Blog'];
				}

				//debug($Recommend);

				$this->set('Recommend',$Recommend);
			}
			else
			{
				$this->set('Recommend',null);
			}
		}	
		else
		{
			$this->redirect(array('controller' => 'users','action' => 'login'));	
		}
	}

	public function addchat($userID)
	{
		if($this->Session->check('User'))
		{
			$User = $this->Session->read('User');
			if($userID != $User['User']['id'])
			{
				$data['Chat']['user_id'] = $User['User']['id'];
				$data['Chat']['user_two'] = $userID;
				$this->User->Chat->save($data);
				$this->redirect(array('controller' => 'users','action' => 'personal'));
			}
		}
		else
		{
			$this->redirect(array('controller' => 'users','action' => 'login'));
		}
	}
}

?>