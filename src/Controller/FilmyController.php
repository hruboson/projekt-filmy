<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\Event\EventInterface;

class FilmyController extends AppController {

    public function beforeFilter(EventInterface $event){
        $this->Authentication->allowUnauthenticated(['index', 'film']);

        parent::beforeFilter($event);
    }

    public function index(){
        $this->loadModel('Filmy');
        $filmy = $this->Filmy->find()->all();
        $this->set('filmy', $filmy);
    }

    public function film($id){
        $this->set('id', $id);
    }

}
