<div class="row">
    <div class="col-12 text-center h1">
        Přidat herce
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
            <legend><?= __('Přidat herce') ?></legend>
            <?php
            echo $this->Form->control('jmeno', ['placeholder' => 'Jméno','class' => 'form form-control mb-1']);
            echo $this->Form->control('prijmeni', ['placeholder' => 'Příjmení', 'class' => 'form form-control mb-1']);
            echo $this->Form->control('datum_narozeni', ['placeholder' => 'Datum narození', 'type' => 'date', 'class' => 'form form-control mb-1']);
            ?>
        </fieldset>
        <?= $this->Form->button('Uložit', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>