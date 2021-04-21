<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class VstupenkyTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('vstupenky');

        $this
        ->hasOne('Promitani')
        ->setForeignKey('id_promitani')
        ->setBindingKey('id_promitani')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->hasOne('user')
        ->setForeignKey('id_user')
        ->setBindingKey('id')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);;
    }
}