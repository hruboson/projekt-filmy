<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class FilmyTypyTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('filmytypy')
        ->setPrimaryKey('id_typ');
    }
}

