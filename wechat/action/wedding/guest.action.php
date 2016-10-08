<?php

/**
 * 来宾
 */
class GuestAction extends VKWeddingAction
{

    public function index(){

        $this->title='参与来宾';

    	$this->display('wedding/guest');
    }

    public function review(){

        $this->title='来宾主页';

		$this->display('wedding/guest_review');
    }
}