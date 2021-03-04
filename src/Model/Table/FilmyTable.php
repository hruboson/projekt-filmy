<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class FilmyTable extends Table
{
    public function initialize(array $config): void
    {
        $this->setTable('filmy');
    }
}

