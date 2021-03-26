<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
debug($film);
$typyOptions = array();
foreach ($typy as $typ) {
    $typyOptions[(string)$typ['id_typ']] = $typ['nazev'];
}
$zanryOptions = array();
foreach ($zanry as $zanr) {
    $zanryOptions[(string)$zanr['id_zanr']] = $zanr['zanr_nazev'];
}

?>
<div class="row">
    <div class="col-12 text-center h1">
        <?php echo $film->filmynazvy[0]->nazev; // 0 is value of cz 
        ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="side-nav">
            <h4 class="heading"><?= __('Možnosti') ?></h4>
            <?= $this->Form->postLink(
                __('Odstranit film'),
                ['controller' => 'Filmy', 'action' => 'delete', $film->id_film],
                ['confirm' => __('Jste si jisti že chcete vymazat film {0}?', $film->filmynazvy[0]->nazev), 'class' => 'side-nav-item']
            ) ?><br>
            <?php $this->Html->link(__('List movies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <?= $this->Form->create($film) ?>
        <fieldset>
            <legend><?= __('Upravit podrobnosti o filmu') ?></legend>
            <?php
            echo $this->Form->control('delka', ['class' => 'form form-control mb-1']);
            echo $this->Form->control('jmeno_hlavni_postavy', ['class' => 'form form-control mb-1']);
            //echo $this->Form->control('typ', ['class' => 'form form-control mb-1']);
            echo $this->Form->select('typ', $typyOptions, ['class' => 'form form-control mb-1']);
            echo $this->Form->select('zanr', $zanryOptions, ['class' => 'form form-control mb-1']);

            ?>
        </fieldset>
        <?= $this->Form->button('Uložit', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
        <div class="h3 bg-success mt-3 text-center rounded"><?= $this->Flash->render() ?></div>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <?= $this->Form->create($nazvy, ['url' => ['action' => 'updateJazyky', $film->id_film]]); ?>
        

        <div class="h4 mt-3">Názvy</div>
        <?php foreach ($film->filmynazvy as $nazev) {
            echo $this->Form->text($nazev->jazyky->jazyk, ['default' => $nazev->nazev, 'class' => 'form form-control mb-1']);
        } ?>
        <?= $this->Form->button('Uložit', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>