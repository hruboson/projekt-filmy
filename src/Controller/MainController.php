<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\Event\EventInterface;

class MainController extends AppController {

    public function beforeFilter(EventInterface $event){
        $this->Authentication->allowUnauthenticated(['index']);

        parent::beforeFilter($event);
    }

   public function index(){
      
   }

}
