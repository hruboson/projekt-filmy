<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class FilmyNazvyTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('filmynazvy');

        $this->belongsTo('Filmy')
        ->setBindingKey('id_film')
        ->setForeignKey('id_film')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);
        
        $this->belongsTo('Jazyky')
        ->setBindingKey('id_jazyk')
        ->setForeignKey('id_jazyk')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);
    }

}

