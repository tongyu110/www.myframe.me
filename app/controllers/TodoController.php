<?php


namespace app\controllers;
use app\models\Test;
use app\models\Todo;

class TodoController extends BaseController{

	public function index($id,$name) {

		echo $id;
		echo "Home";

	}

        public function del($id) {
            $todo = Todo::byId($id);
            $todo->delete();
            
        }
        
        /**
         * /todo/edit/1
         * @param type $id
         */
        public function edit($id) {
            
            $tobo = Todo::byId($id);
            $tobo->title = '第一条修改了';
            $tobo->save();
            echo 'edit';
            
        }
        
	public function create() {
            
            $todo = new Todo();
            $todo->title = '第二条';
            $todo->save();
            echo 'create';

	}

	public function remove() {

            $this->render('remove');

	}


	public function init() {
            
	    $migrator = new \Pheasant\Migrate\Migrator();
	    $migrator->initialize(Test::schema(),'test');
	    echo "Migrate done";
			
	}




}
