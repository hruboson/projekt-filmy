<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class ZanryTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('filmy_zanry');

    }
}