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
        Přidat promítání
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <div class="h3 bg-success mt-3 text-center rounded"><?= $this->Flash->render() ?></div>
    </div>
</div>
<div class="row bg-select">
    <div class="col-12">
        <?= $this->Form->create() ?>
        <fieldset>
            <legend><?= __('Přidat promítání') ?></legend>
            <?php
            echo $this->Form->control('datum', ['placeholder' => 'Datum', 'type' => 'date','class' => 'form form-control mb-1']);
            echo $this->Form->control('cas', ['placeholder' => 'Čas', 'type' => 'time','class' => 'form form-control mb-1']);
            echo $this->Form->select('id_sal', $salyOptions,['class' => 'form form-control mb-1']);
            echo $this->Form->select('id_film', $filmyOptions,['class' => 'form form-control mb-1']);
            ?>
        </fieldset>
        <?= $this->Form->button('Uložit', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>