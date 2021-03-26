<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class FilmyZanryTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('filmy_zanry')
        ->setPrimaryKey('id_zanr')
        ->belongsTo('filmy')
        ->setForeignKey('id_film')
        ->setJoinType(\Cake\Database\Query::JOIN_TYPE_INNER);
    }
}

