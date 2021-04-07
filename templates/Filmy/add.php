<?php
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
?>
<div class="row">
    <div class="col-12 text-center h1">
        Přidat film
    </div>
</div>
<div class="row bg-select">
    <div class="col-12">
        <?= $this->Form->create() ?>
        <fieldset>
            <legend><?= __('Přidat podrobnosti o filmu') ?></legend>
            <?php
            echo $this->Form->control('nazev', ['placeholder' => 'Výchozím jazykem je čeština','class' => 'form form-control mb-1']);

            echo $this->Form->control('delka', ['placeholder' => '1', 'default' => '1', 'type' => 'number', 'class' => 'form form-control mb-1']);
            echo $this->Form->control('jmeno_hlavni_postavy', ['placeholder' => 'Jméno hlavní postavy', 'class' => 'form form-control mb-1']);
            echo $this->Form->select('typ', $typyOptions, ['class' => 'form form-control mb-1']);
            echo $this->Form->select('zanr', $zanryOptions, ['class' => 'form form-control mb-1']);

            ?>
        </fieldset>
        <?= $this->Form->button('Uložit', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>