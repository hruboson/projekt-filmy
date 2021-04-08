<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class PromitaniTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('promitani');
        
        $this->hasOne('saly')        
        ->setForeignKey('id_sal')
        ->setBindingKey('id_sal')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this->hasOne('filmy')        
        ->setForeignKey('id_film')
        ->setBindingKey('id_film')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);;
    }
}