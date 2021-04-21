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
        ->belongsTo('FilmyNazvy')
        ->setForeignKey('id_film')
        ->setBindingKey('id_film')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->belongsToMany('Jazyky', [
        'through' => 'FilmyNazvy',
        'foreignKey' => 'id_film',
        'bindingKey' => 'id_film',
        'targetForeignKey' => 'id_jazyk'
        ]);

        $this
        ->hasMany('FilmyHerci')
        ->setForeignKey('id_film')
        ->setBindingKey('id_film')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->belongsToMany('Herci', [
        'through' => 'FilmyHerci',
        'foreignKey' => 'id_film',
        'targetForeignKey' => 'id_herec',
        ]);

        $this
        ->hasMany('FilmyZeme')
        ->setForeignKey('id_film')
        ->setBindingKey('id_film')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->belongsToMany('Zeme', [
        'through' => 'FilmyZeme',
        'foreignKey' => 'id_film',
        'targetForeignKey' => 'id_zeme',
        ]);

        $this
        ->hasOne('FilmyZanry')
        ->setForeignKey('id_zanr')
        ->setBindingKey('zanr')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

        $this
        ->hasOne('FilmyTypy')
        ->setForeignKey('id_typ')
        ->setBindingKey('typ')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);

    }
}

