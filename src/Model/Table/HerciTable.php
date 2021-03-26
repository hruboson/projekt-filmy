<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class HerciTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('herci');
        
        $this
        ->belongsTo('filmyherci')
        ->setForeignKey('id_herec')
        ->setBindingKey('herec')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->belongsToMany('filmy', [
        'through' => 'filmyherci',
        'foreignKey' => 'id_herec',
        'targetForeignKey' => 'id_film',
        ]);
    }
}

