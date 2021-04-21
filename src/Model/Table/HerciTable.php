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
        ->belongsTo('FilmyHerci')
        ->setForeignKey('id_herec')
        ->setBindingKey('id_herec')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->belongsToMany('Filmy', [
        'through' => 'FilmyHerci',
        'foreignKey' => 'id_herec',
        'targetForeignKey' => 'id_film',
        ]);
    }
}

