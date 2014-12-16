<?php

class ReceptionsController extends AppController
{
	$this->loadModel('Bill');
	$this->loadModel('Dish');
	$this->loadModel('Drink');
	$this->loadModel('Order');
	$this->loadModel('Room');
	$this->loadModel('User');

	//选菜下单
	public function order($roomId,$groupBy = null)
	{
		$re = $this->Dish->find('all',array('recursive' => 1,'group' => $groupBy));
		
		$this->set('Dishs',$re);
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			$dishList = $data['Dish'];
			$roomId = $data['RoomId'];

			$this->Bill->create();
			$bill['Bill']['number'] = ;
			$bill['Bill']['room_id'] = $room_id;
			$this->Bill->save($bill);

			$bill_id = $this->Bill->id;

			$sum = 0;
			foreach ($dishList as $key => $value) {
				$this->Order->create();
				$order = null;
				$order['Order']['bill_id'] = $reBill['Bill']['id'];
				$order['Order']['dish_id'] = $value['dish_id'];
				$order['Order']['count'] = $value['count'];
				$order['Order']['status'] = 0;
				$sum += $value['price'];
				$this->Order->save($order);
			}
			$bill['Bill']['sum'] = $sum;
			$this->Bill->save($bill);
		}
	}

	//追加下单
	public function addOrder()
	{
		$re = $this->Dish->find('all',array('recursive' => 1,'group' => $groupBy));
		
		$this->set('Dishs',$re);
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			$dishList = $data['Dish'];
			$billId = $data['BillId'];

			$this->Bill->id = $billId;
			$sum = $this->Bill->find('first',array('conditions' => array('Bill.id' => $billId),'fields' => array('Bill.sum'),'recursive' => 1));
			foreach ($dishList as $key => $value) {
				$this->Order->create();
				$order = null;
				$order['Order']['bill_id'] = $billId;
				$order['Order']['dish_id'] = $value['dish_id'];
				$order['Order']['count'] = $value['count'];
				$order['Order']['status'] = 0;
				$sum['Bill']['sum'] += $value['price'];
				$this->Order->save($order);
			}
			$this->Bill->set('sum',$sum['Bill']['sum']);
			$this->Bill->save();
		}
	}

	//取消下单
	public function cancelOrder($id)
	{
		$this->Order->delete($id,false);
	}

	//房台信息
	public function searchAllRooms()
	{
		$re = $this->Room->find('all',array('recursive' => 1));
		$this->set('Rooms',$re);
	}

	//单条房台信息（可修改）
	public function searchRoomByNumber($number)
	{
		$re = $this->Room->find('first',array('conditions' => array('Room.number' => $number),'recursive' => 2));
		
		$this->set('Room',$re);

		if($this->request->is('post'))
		{
			$array = $this->request->data;
			$this->Room->id = $re['Room']['id'];

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

	//账单信息
	public function searchAllBills()
	{
		$re = $this->Bill->find('all',array('recursive' => 1,'order' => 'Bill.time DESC'));
		$this->set('Bills',$re);
	}

	//下单信息
	public function searchOrder($roomId)
	{
		$bill = $this->Bill->find('first',array('conditions' => array('Bill.room_id' => $roomId),'order' => array('Bill.time DESC'),'recursive' => 2));
		$orders = $this->Order->find('all',array('conditions' => array('Order.bill_id' => $bill['Bill']['id']),'recursive' => 1));
		$this->set('Orders',$orders);
	}

	//结账
	public function checkOut($roomId)
	{
		$bill = $this->Bill->find('first',array('conditions' => array('Bill.room_id' => $roomId),'order' => array('Bill.time DESC'),'recursive' => 2));
		$this->set('Bill',$bill);
		if($this->request->is('post'))
		{
			$this->Bill->id = $bill['Bill']['id'];
			$data = $this->request->data;
			$bill['Bill']['pay_method'] = $data['pay_method'];
			$bill['Bill']['pay_status'] = $data['pay_status'];
			$bill['Bill']['pay_sum'] = $data['pay_sum'];
			$bill['Bill']['pay_change'] = $data['pay_change'];
			$bill['Bill']['remark'] = $data['remark'];
			$this->Bill->save($data);
		}
	}

}

?>