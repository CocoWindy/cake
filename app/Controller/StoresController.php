<?php

class StoresController extends AppController
{
	$this->loadModel('Worker');
	$this->loadModel('Good');
	$this->loadModel('Purchase');
	$this->loadModel('StoreRecord');
	$this->loadModel('Supplier');

	//物资清单 + 取货
	public function goodsList()
	{
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
		$re = $this->StoreRecord->find('all',array('recursive' => 1,'order' => 'StoreRecord.time DESC'));
		$this->set('Records',$re);
	}

	//采购清单
	public function purchaseList()
	{
		$re = $this->Purchase->find('all',array('recursive' => 1,'order' => 'Purchase.time DESC'));
		$this->set('Purchase',$re);
	}

	//供应商信息
	public function supplierList()
	{
		$re = $this->Supplier->find('all');
		$this->set('Suppliers',$re);
	}

	//进货
	public function purchase()
	{
		if($this->request->is('post'))
		{
			$data = $this->request->data;
		}
	}
}

?>