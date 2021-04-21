<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class JazykyTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('jazyky');
        
        $this
        ->belongsTo('FilmyNazvy')
        ->setForeignKey('id_jazyk')
        ->setBindingKey('id_jazyk')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->belongsToMany('Filmy', [
        'through' => 'FilmyNazvy',
        'foreignKey' => 'id_jazyk',
        'bindingKey' => 'id_jazyk',
        'targetForeignKey' => 'id_film'
        ]);
    }
}

