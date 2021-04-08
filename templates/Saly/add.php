<?php
$three_dOptions = array('1' => 'Ano', '0' => 'Ne');
$zvukOptions = array('1' => 'Ano', '0' => 'Ne');
?>
<div class="row">
    <div class="col-12 text-center h1">
        Přidat sál
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
            <legend><?= __('Přidat sál') ?></legend>
            <?php
            echo $this->Form->control('nazev', ['placeholder' => 'Název sálu','class' => 'form form-control mb-1']);
            echo $this->Form->control('kapacita', ['placeholder' => 'Kapacita', 'type' => 'number','class' => 'form form-control mb-1']);
            echo $this->Form->select('three_dimensional', $three_dOptions,['placeholder' => '3D', 'class' => 'form form-control mb-1']);
            echo $this->Form->select('prostorovy_zvuk', $zvukOptions,['placeholder' => 'Film', 'type' => 'date', 'class' => 'form form-control mb-1']);
            ?>
        </fieldset>
        <?= $this->Form->button('Uložit', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>