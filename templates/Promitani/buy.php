<div class="row">
    <div class="col-12 text-center h1">
        Koupit vstupenku na promítání <br><?php echo $promitani->filmy->filmynazvy->nazev; ?>
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
            <legend><?= __('Koupit lístek') ?></legend>
            <?php
            echo "<b>Název filmu: </b>".$promitani->filmy->filmynazvy->nazev."<br>";
            echo "<b>Sál: </b>".$promitani->saly->nazev."<br>";
            echo "<b>Datum a čas promítání: </b>".date_format($promitani->datum, 'd. m. Y')." ".date_format($promitani->cas, 'h:i:s')."<br>";
            echo "Typ lístku: <br>";
            echo $this->Form->select('cena', $cenyOptions, ['class' => 'form form-control mb-1']); // num of seat
            echo $this->Form->control('misto', ['default' => 1, 'class' => 'form form-control mb-1', 'type' => 'number', 'max' => $promitani->saly->kapacita, 'min' => 0]);
            ?>
        </fieldset>
        <?= $this->Form->button('Koupit', ['type' => 'submit', 'class' => 'btn btn-primary mt-3 float-right']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>