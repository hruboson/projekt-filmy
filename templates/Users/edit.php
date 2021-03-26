<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="col-12">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete user'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
            ) ?><br>
            <?php //$this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend><?= __('Edit User') ?></legend>
            <?php
            echo $this->Form->control('username', ['class' => 'form form-control mb-1']);
            echo $this->Form->control('email', ['class' => 'form form-control mb-1']);
            echo $this->Form->control('password', ['class' => 'form form-control mb-1']);
            echo $this->Form->control('role', ['class' => 'form form-control mb-1']);
            ?>
        </fieldset>
        <?= $this->Form->button('Submit', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
        <div class="h3 bg-success mt-3 text-center rounded"><?= $this->Flash->render() ?></div>
    </div>
</div>