<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class ZemeTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('zeme');
        
        $this
        ->belongsTo('filmyzeme')
        ->setForeignKey('id_zeme')
        ->setBindingKey('id_zeme')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->belongsToMany('filmy', [
        'through' => 'filmyzeme',
        'foreignKey' => 'id_zeme',
        'targetForeignKey' => 'id_film',
        ]);
    }
}