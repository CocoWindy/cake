<?php

class ReceptionsController extends AppController
{
	//选菜下单
	//返回Dishs菜单信息
	//接受post请求	Dish选菜信息 RoomId房台id	
	public function order($roomId,$groupBy = null)
	{
		$this->loadModel('Room');
		$this->loadModel('Dish');
		$this->loadModel('Bill');
		$this->loadModel('Order');

		$re = $this->Dish->find('all',array('recursive' => 1,'group' => $groupBy));
		//debug($re);
		$this->set('Dishes',$re);
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			$dishList = $data['Dish'];
			//debug($dishList);
			if(!empty($dishList))
			{
				$room = $this->Room->find('first',array('conditions' => array('Room.id' => $roomId)));
				$room['Room']['status'] = 1;
				$this->Room->id = $room['Room']['id'];
				$this->Room->save($room);

				$this->Bill->create();
				$bill['Bill']['number'] = 0;
				$bill['Bill']['room_id'] = $roomId;
				$this->Bill->save($bill);

				$bill_id = $this->Bill->id;

				$sum = 0;
				foreach ($dishList as $key => $value) {
					if(!empty($value['id']))
					{
						$pos = strpos($value['id'], '+');

						$id = substr($value['id'], 0 ,$pos);
						$price = substr($value['id'], $pos+1);

						$this->Order->create();
						$order = null;
						$order['Order']['bill_id'] = $bill_id;
						$order['Order']['dish_id'] = $id;
						$order['Order']['count'] = $value['count'];
						$order['Order']['status'] = 0;
						$sum += $price;
						$this->Order->save($order);
					}
					
				}
				$bill['Bill']['sum'] = $sum;
				$this->Bill->save($bill);

				$this->redirect(array('controller' => 'Receptions','action' => 'searchRoomById/'.$roomId));
			}
			else
			{
				$this->redirect(array('controller' => 'Receptions','action' => 'searchAllRooms'));
			}
		}
	}

	//追加下单
	//返回Dishs菜单信息
	//接受post请求 Dish选菜信息 BillId账单id
	public function addOrder($roomId)
	{
		$this->loadModel('Dish');
		$this->loadModel('Bill');
		$this->loadModel('Order');

		$dish = $this->Dish->find('all');
		$bill = $this->Bill->find('first',array('conditions' => array('Bill.room_id' => $roomId),'order' => 'Bill.time DESC'));
		$order = $this->Order->find('all',array('conditions' => array('Order.bill_id' => $bill['Bill']['id']),'recursive' => 1));
		
		$this->set('Dishes',$dish);
		$this->set('Order',$order);
		//debug($order);
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			$dishList = $data['Dish'];

			$this->Bill->id = $bill['Bill']['id'];
			$sum = $bill['Bill']['sum'];
			foreach ($dishList as $key => $value) {
				if(!empty($value['id']))
				{
					$pos = strpos($value['id'], '+');

					$id = substr($value['id'], 0 ,$pos);
					$price = substr($value['id'], $pos+1);

					$this->Order->create();
					$order = null;
					$order['Order']['bill_id'] = $bill['Bill']['id'];
					$order['Order']['dish_id'] = $id;
					$order['Order']['count'] = $value['count'];
					$order['Order']['status'] = 0;
					$sum += $price;
					$this->Order->save($order);
				}
			}
			$bill['Bill']['sum'] = $sum;
			$this->Bill->save($bill);
		}
	}

	//取消下单
	public function cancelOrder($id)
	{
		$this->loadModel('Order');
		$this->Order->delete($id,false);
	}

	//房台信息
	//返回Rooms房台信息
	public function searchAllRooms()
	{
		$this->loadModel('Room');
		$re = $this->Room->find('all',array('recursive' => 1));
		$this->set('Rooms',$re);
	}

	//单条房台信息（可修改）
	//返回Room单条房台信息
	//接受post请求  房台信息（含修改）
	public function searchRoomById($id)
	{
		$this->loadModel('Room');
		$re = $this->Room->find('first',array('conditions' => array('Room.id' => $id),'recursive' => 3));
		
		$this->set('Room',$re);
		//debug($re);

		if($this->request->is('post'))
		{
			$array = $this->request->data;
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

	//换台
	public function changeRoom($roomOne,$roomTwo)
	{
		$this->loadModel('Bill');
		$re = $this->Bill->find('first',array('conditions' => array('Bill.room_id' => $roomOne),'recursive' => 1,'order' => 'Bill.time DESC'));
		$this->Bill->id = $re['Bill']['id'];
		$re['Bill']['room_id'] = $roomTwo;
		$this->Bill->save($re);
	}

	//并台

	//账单信息
	//返回Bills账单信息
	public function searchAllBills()
	{
		$this->loadModel('Bill');
		$re = $this->Bill->find('all',array('recursive' => 1,'order' => 'Bill.time DESC'));
		$this->set('Bills',$re);
	}

	//下单信息
	//返回Orders下单信息
	public function searchOrder($roomId)
	{
		$this->loadModel('Bill');
		$this->loadModel('Order');
		$bill = $this->Bill->find('first',array('conditions' => array('Bill.room_id' => $roomId),'order' => array('Bill.time DESC'),'recursive' => 2));
		$orders = $this->Order->find('all',array('conditions' => array('Order.bill_id' => $bill['Bill']['id']),'recursive' => 1));
		$this->set('Orders',$orders);
	}

	//做菜
	public function changeDishesStatus()
	{
		$this->loadModel('Order');
		if($this->request->is('post'))
		{
			$dishes = $this->request->data;
			$this->Order->saveMany($dishes);
		}
	}

	//结账
	//返回Bill账单信息
	//接受post请求  账单信息（含修改）
	public function checkOut($roomId)
	{
		$this->loadModel('Bill');
		$this->loadModel('Room');

		$room = $this->Room->find('first',array('conditions' => array('Room.id' => $roomId),'recursive' => 1));
		$bill = $this->Bill->find('first',array('conditions' => array('Bill.room_id' => $roomId),'order' => array('Bill.time DESC'),'recursive' => 2));
		$this->set('Bill',$bill);
		if($this->request->is('post'))
		{
			$this->Bill->id = $bill['Bill']['id'];
			$data = $this->request->data;
			debug($data);
			$bill['Bill']['pay_method'] = $data['pay_method'];
			$bill['Bill']['pay_status'] = 1;
			$bill['Bill']['pay_sum'] = $data['pay_sum'];
			$bill['Bill']['pay_change'] = $data['pay_change'];
			$bill['Bill']['remark'] = $data['remark'];
			$this->Bill->save($data);

			$room['Room']['status'] = 0;
			$this->Room->id = $room['Room']['id'];
			$this->Room->save($room);
		}
	}

}

?>