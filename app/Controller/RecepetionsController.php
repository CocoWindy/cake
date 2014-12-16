<?php

class ReceptionsController extends AppController
{
	$this->loadModel('Bill');
	$this->loadModel('Dish');
	$this->loadModel('Drink');
	$this->loadModel('Order');
	$this->loadModel('Room');
	$this->loadModel('User');
	$this->loadModel('Product');

	public function order()
	{
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
				$sum += $value['price'];
				$this->Order->save($order);
			}
			$bill['Bill']['sum'] = $sum;
			$this->Bill->save($bill);
		}
	}

	public function addOrder()
	{
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
				$sum['Bill']['sum'] += $value['price'];
				$this->Order->save($order);
			}
			$this->Bill->set('sum',$sum['Bill']['sum']);
			$this->Bill->save();
		}
	}

	public function cancelBill($id)
	{
		$this->Bill->delete($id,true);
	}

	public function cancelOrder($id)
	{
		$this->Order->delete($id,false);
	}
}

?>