<?php

class DishsController extends AppController
{
	public function searchAll($groupBy = null)
	{
		$re = $this->Dish->find('all',array('recursive' => 1,'group' => $groupBy));
		
		$this->set('Dishs',$re);
	}

	public function add()
	{

	}

	public function delete()
	{

	}

	public function modify()
	{

	}
}

?>