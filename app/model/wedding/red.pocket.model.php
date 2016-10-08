<?php

/**
 * 结婚红包
 */
class WeddingRedPocketModel extends BaseModel{

	protected $table='wedding_red_pocket';

	public function getUserRedPocket($user_id){

		$sql="SELECT rp.wedding_id,rp.amount,rp.bless,w.groom,w.bride FROM tt_wedding_red_pocket rp LEFT JOIN tt_wedding w ON rp.wedding_id=w.id AND rp.user_id=".(int)$user_id;

		return $this->find($sql);
	}

	/**
	 * 添加红包
	 * @param  integer $wedding_id 
	 * @param  float(9,2) $amount 
	 * @param  string $bless 
	 * @return integer   插入的id
	 */
	public function addWeddingRedPocket($wedding_id,$amount,$bless){

		return $this->insert(array('wedding_id'=>$wedding_id,'amount'=>$amount,'bless'=>$bless,'status'=>1,'create_date'=>time()));
	}
}