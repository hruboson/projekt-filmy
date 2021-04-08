<?php
$salyOptions = array();
foreach ($saly as $sal) {
    $salyOptions[(string)$sal['id_sal']] = $sal['nazev'];
}
$filmyOptions = array();
foreach ($filmy as $film) {
    $filmyOptions[(string)$film['id_film']] = $film->filmynazvy['nazev'];
}
?>
<div class="row">
    <div class="col-12 text-center h1">
        Upravit promítání
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="h3 bg-success mt-3 text-center rounded"><?= $this->Flash->render() ?></div>
    </div>
</div>
<div class="row bg-select">
    <div class="col-12">
        <div class="side-nav">
            <h4 class="heading"><?= __('Možnosti') ?></h4>
            <?= $this->Form->postLink(
                __('Odstanit promítání'),
                ['Controller' => 'Promitani', 'action' => 'delete', $promitani->id_promitani],
                ['confirm' => __('Jste si jisti že chcete odstranit promítání? # {0}?', $promitani->id_promitani), 'class' => 'side-nav-item']
            ) ?><br>
            <?php //$this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) 
            ?>
        </div>
    </div>
</div>
<div class="row bg-select">
    <div class="col-12">
        <?= $this->Form->create($promitani) ?>
        <fieldset>
            <legend><?= __('Upravit promítání') ?></legend>
            <?php
            echo $this->Form->control('datum', ['placeholder' => 'Datum', 'type' => 'date', 'class' => 'form form-control mb-1']);
            echo $this->Form->control('cas', ['placeholder' => 'Čas', 'type' => 'time', 'class' => 'form form-control mb-1']);
            echo $this->Form->select('id_sal', $salyOptions, ['placeholder' => 'Sál', 'type' => 'date', 'class' => 'form form-control mb-1']);
            echo $this->Form->select('id_film', $filmyOptions, ['placeholder' => 'Film', 'type' => 'date', 'class' => 'form form-control mb-1']);
            ?>
        </fieldset>
        <?= $this->Form->button('Uložit', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>