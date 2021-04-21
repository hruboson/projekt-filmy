<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class FilmyZemeTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('filmyzeme')
        ->setPrimaryKey('id_propojeni');

        $this->belongsTo('filmy')
        ->setBindingKey('id_film')
        ->setForeignKey('id_film');
        
        $this->belongsTo('zeme')
        ->setBindingKey('id_zeme')
        ->setForeignKey('id_zeme');

    }
}
