<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="col-12 text-center h1">
        <?php echo $user->username; ?>
    </div>
</div>
<div class="row">
    <div class="col-12 h4">
        Zakoupené vstupenky
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-striped table-responzive">
            <tr>
                <th>Číslo vstupenky</th>
                <th>Datum a čas zakoupení</th>
                <th>Sál</th>
                <th>Datum promítání</th>
                <th>Film</th>
                <th>Cena</th>
            </tr>
            <tr>
                <?php foreach($vstupenky as $vstupenka){ ?>
                    <td><?= $vstupenka->id_vstupenka; ?></td>
                    <td><?= date_format($vstupenka->datum_cas_prodani, 'd. m. Y H:i:s'); ?></td>
                    <td><?= $vstupenka->promitani->saly->nazev; ?></td>
                    <td><?= date_format($vstupenka->promitani->datum, 'd. m. Y')." ".date_format($vstupenka->promitani->cas,'H:i:s'); ?></td>
                    <td><?= $vstupenka->promitani->filmy->filmynazvy->nazev; ?></td>
                    <td><?= $vstupenka->cena."Kč"; ?></td>
                <?php } ?>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="side-nav">
            <h4 class="heading"><?= __('Možnosti') ?></h4>
            <?= $this->Form->postLink(
                __('Delete user'),
                ['Controller' => 'Users', 'action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
            ) ?><br>
            <?php //$this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) 
            ?>
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