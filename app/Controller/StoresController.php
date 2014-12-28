<?php

class StoresController extends AppController
{
	// $this->loadModel('Worker');
	// $this->loadModel('Good');
	// $this->loadModel('Purchase');
	// $this->loadModel('StoreRecord');
	// $this->loadModel('Supplier');

	//物资清单 + 取货
	public function goodsList()
	{
		$this->loadModel('StoreRecord');
		$this->loadModel('Good');

		$re = $this->Good->find('all');
		$this->set('Goods',$re);
		if($this->request->is('post'))
		{
			$data = $this->request->data;
			$good = $data['Good'];
			$count = $data['count'];
			$workerId = $data['workerId'];
			$remark = $data['remark'];

			$good['Good']['count'] = $good['Good']['count'] - $count;
			$this->Good->id = $good['Good']['id'];
			$this->Good->save($good);

			$this->StoreRecord->create();
			$record['StoreRecord']['good_id'] = $good['Good']['id'];
			$record['StoreRecord']['change_count'] = $count;
			$record['StoreRecord']['operation'] = 1;
			$record['StoreRecord']['worker_id'] = $workerId;
			$record['StoreRecord']['amount'] = $count * $good['Good']['cost'];
			$record['StoreRecord']['remark'] = $remark;
			$this->StoreRecord->save($record);
		}
	}

	//记录清单
	public function recordsList()
	{
		$this->loadModel('StoreRecord');

		$re = $this->StoreRecord->find('all',array('recursive' => 1,'order' => 'StoreRecord.time DESC'));
		$this->set('Records',$re);
	}

	//采购清单
	public function purchaseList()
	{
		$this->loadModel('Purchase');

		$re = $this->Purchase->find('all',array('recursive' => 1,'order' => 'Purchase.time DESC'));
		$this->set('Purchase',$re);
	}

	//供应商信息
	public function supplierList()
	{
		$this->loadModel('Supplier');

		$re = $this->Supplier->find('all');
		$this->set('Suppliers',$re);
	}

	//进货
	public function purchase()
	{
		$this->loadModel('Good');
		$this->loadModel('StoreRecord');

		if($this->request->is('post'))
		{
			$data = $this->request->data;
			$name = $data['name'];
			$count = $data['count'];
			$amount = $data['amount'];
			$category = $data['category'];
			$unit = $data['unit'];
			$workerId = $data['workerId'];
			$remark = $data['remark'];

			$good = $this->Good->find('first',array('conditions' => array('Good.name'=> $name)));
			$id = 0;
			if(empty($good))
			{
				$this->Good->create();
				$good['Good']['name'] = $name;
				$good['Good']['category'] = $category;
				$good['Good']['unit'] = $unit;
				$good['Good']['count'] = $count;
				$good['Good']['cost'] = $amount / $count;
				$this->Good->save($good);
				$id = $this->Good->id;
			}
			else{
				$this->Good->id = $good['Good']['id'];
				$good['Good']['cost'] = ($good['Good']['count']*$good['Good']['cost'] + $amount)/($good['Good']['count']+$count);
				$good['Good']['count'] += $count;
				$this->Good->save($good);
				$id = $this->Good->id;
			}

			$this->StoreRecord->create();
			$record['StoreRecord']['good_id'] = $id;
			$record['StoreRecord']['change_count'] = $count;
			$record['StoreRecord']['operation'] = 2;
			$record['StoreRecord']['worker_id'] = $workerId;
			$record['StoreRecord']['amount'] = $amount;
			$record['StoreRecord']['remark'] = $remark;
			$this->StoreRecord->save($record);
		}
	}
}

?>