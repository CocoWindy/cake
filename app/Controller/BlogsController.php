<?php

class BlogsController extends AppController
{
	//blog
	public function add()
	{
		if($this->Session->check('User'))
		{
			$User = $this->Session->read('User');
			if ($this->request->is('post'))
			{			
				$this->Blog->create();
				$data['Blog']['content'] = $this->request->data['Blog']['content'];
				$data['Blog']['time'] = $this->request->data['Blog']['time'];
				$data['Blog']['user_id'] = $User['User']['id'];
				if ($this->Blog->save($data)) 
				{
					$this->redirect(array('controller' => 'blogs','action' => 'allblogs'));
				} 
				else 
				{
					$this->Session->setFlash('TAT');
				}
			}
		}
		else
		{
			$this->flash('Please login first',array('controller' => 'users','action' => 'login'),3);
		}
	}
	
	//edit your blog
	public function edit($blogID)
	{
		$User = $this->Session->read('User');
		if(!empty($User))
		{				
			$box = $this->Blog->find('first',array('conditions' => array('Blog.id' => $blogID),'recursive' => 1));
			$this->set('Blog',$box);
			if ($this->request->is('post')) 
			{

				if(($box['User']['username'] == $User['User']['username']) || ($box['User']['username'] == 'admin'))
				{
					
					$this->Blog->id = $blogID;
					$data['Blog']['title'] = $this->request->data['Blog']['title'];
					$data['Blog']['content'] = $this->request->data['Blog']['content'];
					$data['Blog']['created'] = $this->request->data['Blog']['created'];
					$data['Blog']['user_id'] = $User['User']['id'];
					if ($this->Blog->save($data)) 
					{
						$this->flash('Succeed!','SingleBlog/'.$blogID,3);
					} 
					else 
					{
						$this->Session->setFlash('TAT');
					}
				}
				else
				{
					$this->Session->setFlash('You are not allowed to change this blog');
				}
			}
		}
		else
		{
			$this->Session->setFlash('Please login first');
		}
		
	}
	
	
	//a blog,contains its auther and all comments
	public function singleblog($blogID)
	{
		if($this->Session->check('User'))
		{
			$rt = $this->Blog->find('first',array('conditions' => array('Blog.id' => $blogID),'recursive' => 2));
			$this->set('Blog',$rt);
		}
		else
		{
			$this->flash('Please login first',array('controller' => 'users','action' => 'login'),3);
		}
	}
	
	//all blogs list
	public function allblogs()
	{
		if($this->Session->check('User'))
		{
			$User = $this->Session->read('User');
			$rt = $this->Blog->find('all',array(
					'conditions' => array('Blog.user_id' => $User['User']['id']),
					'order' => array('Blog.time DESC'),
					'fields' => array('Blog.content','Blog.time'),
					'recursive' => 0
				)
			);
			$this->set('Blogs',$rt);
		}
		else
		{
			$this->flash('Please login first',array('controller' => 'users','action' => 'login'),3);
		}
	}
	
	public function delete($blogID)
	{
		if($this->Session->check('User'))
		{
			$box = $this->Blog->find('first',array('conditions' => array('Blog.id' => $blogID),'recursive' => 1));
			$User = $this->Session->read('User');
			if(($box['User']['username'] == $User['User']['username']) || ($User['User']['username'] == 'admin'))
			{
				if($this->Blog->delete($blogID,true))
				{
					$this->redirect(array('controller' => 'blogs','action' => 'allblogs'));
				}
				else
				{
					$this->Session->setFlash('TAT');
				}
			}
			else
			{
				$this->Session->setFlash('You are not allowed to delete this blog');
			}
		}
		else
		{
			$this->flash('Please login first',array('controller' => 'users','action' => 'login'),3);
		}
	}

	public function test($blogID)
	{
		debug($this->Blog->find('first',array('conditions' => array('Blog.id' => $blogID),'recursive' => 3)));
	}
}

?>