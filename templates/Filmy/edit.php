<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$typyOptions = array();
foreach ($typy as $typ) {
    $typyOptions[(string)$typ['id_typ']] = $typ['nazev'];
}
$zanryOptions = array();
foreach ($zanry as $zanr) {
    $zanryOptions[(string)$zanr['id_zanr']] = $zanr['zanr_nazev'];
}
$jazykyOption = array();
foreach ($jazyky as $jazyk) {
    $jazykyOptions[(string)$jazyk['id_jazyk']] = $jazyk['jazyk'];
}
$herciOptions = array();
foreach ($herci as $herec) {
    $herciOptions[(string)$herec['id_herec']] = $herec['jmeno'] . " " . $herec['prijmeni'];
}
$zemeOptions = array();
foreach ($zeme as $zemeLocal) {
    $zemeOptions[(string)$zemeLocal['id_zeme']] = $zemeLocal['nazev'];
}

?>
<div class="row">
    <div class="col-12 text-center h1">
        <?php echo $this->Html->link($film->FilmyNazvy->nazev, ['action' => 'film', $film->id_film]);
        ?>
    </div>
</div>
<div class="row bg-select">
    <div class="col-12">
        <div class="side-nav">
            <h4 class="heading"><?= __('Možnosti') ?></h4>
            <?php echo $this->Form->postLink(
                __('Odstranit film'),
                ['controller' => 'Filmy', 'action' => 'delete', $film->id_film],
                ['confirm' => __('Jste si jisti že chcete vymazat film {0}?', $film->FilmyNazvy->nazev), 'class' => 'side-nav-item']
            ) ?><br>
            <?php $this->Html->link(__('List movies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </div>
</div> 
<div class="row mt-3">
    <div class="col-12">
        <div class="h3 bg-success mt-3 text-center rounded"><?= $this->Flash->render() ?></div>
    </div>
</div>
<div class="row bg-select">
    <div class="col-12">
        <?= $this->Form->create($film) ?>
        <fieldset>
            <legend><?= __('Upravit podrobnosti o filmu') ?></legend>
            <?php
            echo $this->Form->control('delka', ['class' => 'form form-control mb-1']);
            echo $this->Form->control('jmeno_hlavni_postavy', ['class' => 'form form-control mb-1']);
            echo $this->Form->select('typ', $typyOptions, ['class' => 'form form-control mb-1']);
            echo $this->Form->select('zanr', $zanryOptions, ['class' => 'form form-control mb-1']);

            ?>
        </fieldset>
        <?= $this->Form->button('Uložit podrobnosti', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<div class="row bg-select">
    <div class="col-12">
        <?= $this->Form->create($filmynazvy, ['url' => ['action' => 'updateJazyky', $film->id_film]]); ?>


        <div class="h4 mt-3">Názvy</div>
        <?php foreach ($filmynazvy as $nazev) {
            echo $nazev->jazyky->jazyk;
            echo "<div class='row'>";

            echo $this->Form->text((string)$nazev->Jazyky->id_jazyk, ['default' => $nazev->nazev, 'class' => 'form form-control mb-1 col-11'])
                . "<div class='col-1'>" . $this->Html->link('Odstranit', ['Controller' => 'Filmy', 'action' => 'removeJazyk', $nazev->id_propojeni], ['class' => 'btn btn-danger mb-1 font-weight-bold']) . "</div>";
            echo "</div>";
        } ?>
        <?= $this->Form->button('Uložit názvy', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
    </div>
    <div class="col-12 mt-3">
        <?= $this->Form->create($jazyky, ['url' => ['action' => 'addJazyk', $film->id_film]]); ?>
        <?= $this->Form->select('novy_jazyk', $jazykyOptions, ['class' => 'form form-control mb-1']); ?>
        <?= $this->Form->button('Přidat jazyk', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<div class="row bg-select">
    <div class="col-12">
        <div class="h4 mt-3">Herci</div>
        <?php foreach ($filmyherci as $herec) {
            echo "<div class='row'>";

            echo $this->Form->text((string)$herec->id_propojeni, ['default' => $herec->Herci->jmeno . " " . $herec->Herci->prijmeni, 'class' => 'form form-control mb-1 col-11', 'disabled' => 'true'])
                . "<div class='col-1'>" . $this->Html->link('Odstranit', ['Controller' => 'Filmy', 'action' => 'removeHerec', $herec->id_propojeni], ['class' => 'btn btn-danger mb-1 font-weight-bold']) . "</div>";
            echo "</div>";
        } ?>
    </div>
    <div class="col-12 mt-3">
        <?= $this->Form->create($jazyky, ['url' => ['action' => 'addHerec', $film->id_film]]); ?>
        <?= $this->Form->select('novy_herec', $herciOptions, ['class' => 'form form-control mb-1']); ?>
        <?= $this->Form->button('Přidat Herce', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<div class="row bg-select">
    <div class="col-12">
        <div class="h4 mt-3">Země podílející se na tvorbě filmu</div>
        <?php foreach ($filmyzeme as $zeme) {
            echo "<div class='row'>";

            echo $this->Form->text((string)$zeme->id_propojeni, ['default' => $zeme->Zeme->nazev, 'class' => 'form form-control mb-1 col-11', 'disabled' => 'true'])
                . "<div class='col-1'>" . $this->Html->link('Odstranit', ['Controller' => 'Filmy', 'action' => 'removeZeme', $zeme->id_propojeni], ['class' => 'btn btn-danger mb-1 font-weight-bold']) . "</div>";
            echo "</div>";
        } ?>
    </div>
    <div class="col-12 mt-3">
        <?= $this->Form->create($jazyky, ['url' => ['action' => 'addZeme', $film->id_film]]); ?>
        <?= $this->Form->select('nova_zeme', $zemeOptions, ['class' => 'form form-control mb-1']); ?>
        <?= $this->Form->button('Přidat zemi', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>