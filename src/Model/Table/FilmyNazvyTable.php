<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class FilmyNazvyTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('filmy_nazvy');

        $this->belongsTo('filmy')
        ->setBindingKey('id_film')
        ->setForeignKey('id_film')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);
        
        $this->belongsTo('jazyky')
        ->setBindingKey('id_jazyk')
        ->setForeignKey('jazyk')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);
    }

}

