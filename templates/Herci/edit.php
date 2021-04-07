<div class="row">
    <div class="col-12 text-center h1">
        Upravit herce
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
            <?php echo $this->Form->postLink(
                __('Odstranit film'),
                ['controller' => 'Herci', 'action' => 'delete', $herec->id_herec],
                ['confirm' => __('Jste si jisti že chcete vymazat herce {0}?', $herec->jmeno." ".$herec->prijmeni), 'class' => 'side-nav-item']
            ) ?><br>
            <?php $this->Html->link(__('List movies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </div>
</div> 
<div class="row bg-select">
    <div class="col-12">
        <?= $this->Form->create($herec) ?>
        <fieldset>
            <legend><?= __('Upravit podrobnosti o herci') ?></legend>
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