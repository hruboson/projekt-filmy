<?php
declare(strict_types=1);
namespace App\Controller;

class FilmyController extends AppController {

    public function index(){
        $this->loadModel('Filmy');
        $filmy = $this->Filmy->find()->all();
        $this->set('filmy', $filmy);
    }

    public function film($id){
        $this->set('id', $id);
    }

}
