<?php

class UserWedding extends Medium{

	public function get_joined_wedding($user_id){

		$weddings=$this->wedding_user->get_user_joined_wedding($user_id);

		foreach ($weddings as &$wedding) {
			
			$wedding['wedding_date']=date('Y-m-d',$wedding['wedding_date']);
		}
		
		return $weddings;
	}
}