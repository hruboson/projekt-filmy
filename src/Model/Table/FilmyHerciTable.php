<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class FilmyHerciTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('filmy_herci')
        ->setPrimaryKey('id_propojeni');

        $this->belongsTo('filmy')
        ->setBindingKey('id_film')
        ->setForeignKey('herec');
        
        $this->belongsTo('herci')
        ->setBindingKey('id_herec')
        ->setForeignKey('film');

        /*$this
        ->belongsToMany('filmy')
        ->setForeignKey('id_film')
        ->setBindingKey('film');

        $this
        ->belongsToMany('herci')
        ->setForeignKey('id_herec')
        ->setBindingKey('herec');*/

    }
}

