<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class FilmyHerciTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('filmyherci')
        ->setPrimaryKey('id_propojeni');

        $this->belongsTo('filmy')
        ->setBindingKey('id_film')
        ->setForeignKey('id_film');
        
        $this->belongsTo('herci')
        ->setBindingKey('id_herec')
        ->setForeignKey('id_herec');

    }
}

