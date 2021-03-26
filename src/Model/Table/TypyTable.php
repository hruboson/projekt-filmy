<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class TypyTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('filmy_typy');

    }
}