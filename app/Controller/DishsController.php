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
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			$dish['Dish']['number'] = $data['number'];
			$dish['Dish']['name'] = $data['name'];
			$dish['Dish']['type'] = $data['type'];
			$dish['Dish']['price'] = $data['price'];
			$dish['Dish']['discount'] = $data['discount'];
			$dish['Dish']['duration'] = $data['duration'];
			$dish['Dish']['status'] = $data['status'];

			$this->Dish->create();
			$this->Dish->save($dish);
		}
	}

	public function delete($id = null)
	{
		$dish = $this->Dish->find('first',array('conditions' => array('Dish.id' => $id)));
		if(empty($dish))
		{

		}
		else
		{
			$this->set('Dish',$dish);
			if($this->request->is('post'))
			{
				$this->Dish->delete($id,false);
			}
		}
	}

	public function modify($id)
	{
		$dish = $this->Dish->find('first',array('conditions' => array('Dish.id' => $id)));
		$this->set('Dish',$dish);
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			$dish['Dish']['number'] = $data['Dish']['number'];
			$dish['Dish']['name'] = $data['Dish']['name'];
			$dish['Dish']['type'] = $data['Dish']['type'];
			$dish['Dish']['price'] = $data['Dish']['price'];
			$dish['Dish']['discount'] = $data['Dish']['discount'];
			$dish['Dish']['duration'] = $data['Dish']['duration'];
			$dish['Dish']['status'] = $data['Dish']['status'];

			$this->Dish->id = $id;
			$this->Dish->save($dish);
		}
	}
}

?>