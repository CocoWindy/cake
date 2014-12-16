<?php

class RoomsController extends AppController
{

	public function searchAll()
	{
		$re = $this->Room->find('all',array('recursive' => 1));debug($re);
		$this->set('Rooms',$re);
	}

	public function searchById($id)
	{
		$re = $this->Room->find('first',array('conditions' => array('Room.id' => $id),'recursive' => 2));
		
		$this->set('Room',$re);
	}


	public function searchByNumber($number)
	{
		$re = $this->Room->find('first',array('conditions' => array('Room.number' => $number),'recursive' => 2));
		
		$this->set('Room',$re);
	}

	public function add()
	{

	}

	public function delete()
	{

	}

	public function modify($id,$array)
	{
		$box = $this->Room->find('first',array('conditions' => array('Room.id' => $id),'recursive' => 1));
		$this->Room->id = $id;

		if(!empty($array['number']))
		{
			$editData['Room']['number'] = $array['number'];
		}
		else
		{
			$editData['Room']['number'] = $box['Room']['number'];
		}

		if(!empty($array['name']))
		{
			$editData['Room']['name'] = $array['name'];
		}
		else
		{
			$editData['Room']['name'] = $box['Room']['name'];
		}

		if(!empty($array['type']))
		{
			$editData['Room']['type'] = $array['type'];
		}
		else
		{
			$editData['Room']['type'] = $box['Room']['type'];
		}

		if(!empty($array['status']))
		{
			$editData['Room']['status'] = $array['status'];
		}
		else
		{
			$editData['Room']['status'] = $box['Room']['status'];
		}

		$this->Room->save($editData);
	}
}

?>