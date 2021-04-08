<?php 
namespace App\Model\Table;

use Cake\ORM\Table;

class SalyTable extends Table
{
    public function initialize(array $config): void
    {
        $this
        ->setTable('saly');
    }
}