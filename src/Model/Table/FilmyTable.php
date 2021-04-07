<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class FilmyTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('filmy');

        $this
        ->belongsTo('filmynazvy')
        ->setForeignKey('id_film')
        ->setBindingKey('id_film')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->belongsToMany('jazyky', [
        'through' => 'filmynazvy',
        'foreignKey' => 'id_film',
        'bindingKey' => 'id_film',
        'targetForeignKey' => 'id_jazyk'
        ]);

        $this
        ->hasMany('filmyherci')
        ->setForeignKey('id_film')
        ->setBindingKey('id_film')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->belongsToMany('herci', [
        'through' => 'filmyherci',
        'foreignKey' => 'id_film',
        'targetForeignKey' => 'id_herec',
        ]);

        $this
        ->hasMany('filmyzeme')
        ->setForeignKey('id_film')
        ->setBindingKey('id_film')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->belongsToMany('zeme', [
        'through' => 'filmyzeme',
        'foreignKey' => 'id_film',
        'targetForeignKey' => 'id_zeme',
        ]);

        $this
        ->hasOne('filmyzanry')
        ->setForeignKey('id_zanr')
        ->setBindingKey('zanr')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->hasOne('filmytypy')
        ->setForeignKey('id_typ')
        ->setBindingKey('typ')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

    }
}

