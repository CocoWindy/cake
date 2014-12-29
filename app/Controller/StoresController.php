<?php

class StoresController extends AppController
{
	public function index()
	{}

	//物资清单
	public function goodList()
	{
		$this->loadModel('Good');

		$re = $this->Good->find('all');
		$this->set('Goods',$re);
	}

	public function addGoods()
	{
		$this->loadModel('Good');
		if($this->request->is('post'))
		{
			$data = $this->request->data;

			$this->Good->create();
			$good['Good']['number'] = $data['number'];
			$good['Good']['name'] = $data['name'];
			$good['Good']['category'] = $data['category'];
			$good['Good']['unit'] = $data['unit'];
			$good['Good']['count'] = 0;
			$good['Good']['cost'] = 0;
			$this->Good->save($good);

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

		$re = $this->Good->find('all',array('fields' => ('Good.name')));
		$this->set('Goods',$re);

		if($this->request->is('post'))
		{
			$data = $this->request->data;
			$count = $data['count'];
			$choose = $data['choose'];
			$name = $data['goods'];
			$amount = $data['amount'];
			
			/*$count = $data['count'];
			$category = $data['category'];
			$unit = $data['unit'];
			$workerId = $data['workerId'];
			$remark = $data['remark'];*/

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
			else
			{
				$this->Good->id = $good['Good']['id'];
				if($choose == 0)
				{
					$good['Good']['count'] -= $count;
				}
				else
				{
					$good['Good']['cost'] = ($good['Good']['count']*$good['Good']['cost'] + $amount)/($good['Good']['count']+$count);
					$good['Good']['count'] += $count;
				}
				$this->Good->save($good);
				$id = $this->Good->id;
			}

			$this->StoreRecord->create();
			$record['StoreRecord']['good_id'] = $id;
			$record['StoreRecord']['change_count'] = $count;
			$record['StoreRecord']['operation'] = $choose;
			//$record['StoreRecord']['worker_id'] = $workerId;
			if(empty($amount))
			{
				$amount = 0;
			}
			$record['StoreRecord']['amount'] = $amount;
			//$record['StoreRecord']['remark'] = $remark;
			$this->StoreRecord->save($record);

			$this->redirect(array('controller' => 'Stores','action' => 'goodList'));
		}
	}
}

?>