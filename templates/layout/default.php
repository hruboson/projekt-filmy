<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

use function PHPUnit\Framework\equalTo;

$title = 'Filmy'
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $title ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <script src="https://kit.fontawesome.com/b96e4dad43.js" crossorigin="anonymous"></script>

    <?= $this->Html->css(['bootstrap.min', 'custom']) ?>
    <?= $this->Html->script(['bootstrap.bundle.min', 'custom']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <div id="mainSideNav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <?= $this->Html->link('Domů', ['controller' => 'Main', 'action' => 'index', '_full' => true]) ?>
        <?= $this->Html->link('Filmy', ['controller' => 'Filmy', 'action' => 'index', '_full' => true]) ?>
        <?= $this->Html->link('Herci', ['controller' => 'Herci', 'action' => 'index', '_full' => true]) ?>
        <?= $this->Html->link('Promítání', ['controller' => 'Promitani', 'action' => 'index', '_full' => true]) ?>
        <?php 
        if ($logged) {
            if ($role == "admin") { 
                echo $this->Html->link('Sály', ['controller' => 'Saly', 'action' => 'index', '_full' => true]);
            }
        } ?>
        <?php if (!$logged) { ?>
        <?= $this->Html->link('Přihlásit se', ['controller' => 'Users', 'action' => 'login'], ['class' => 'font-weight-light']) ?>
        <?= $this->Html->link('Registrace', ['controller' => 'Users', 'action' => 'add'], ['class' => 'font-weight-light']) ?>
        <?php } ?>
        <?php
        if ($logged) {
            echo $this->Html->link('Odhlásit se', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'font-weight-light']);
            if ($role == "admin") {
                echo $this->Html->link('Uživatelé', ['controller' => 'Users', 'action' => 'index'], ['class' => 'font-weight-light']);
            }
            echo $this->Html->link($username, ['controller' => 'Users', 'action' => 'edit', $user_id, '_full' => true], ['class' => 'font-weight-light small']);;
        }
        ?>
    </div>

    <button class="btn btn-primary mt-1 ml-1" onclick="openNav()"><i class="fa fa-bars" aria-hidden="true"></i></button>

    <div id="main" class="container">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>

</html>