<?php
class AyudaController extends AyudaAppController {

	public function index(){
		return $this->redirect(array('controller'=>'contenidos','action' => 'index'));
	}
}
?>