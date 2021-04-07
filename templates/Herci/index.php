<div class="h1 text-center mt-5">Seznam herců</div>

<?php if ($logged) {
    if ($role == "admin") { ?>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <?php echo $this->Html->link('Přidat herce', ['Controller' => 'Herci', 'action' => 'add'], ['class' => '']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="h3 bg-success mt-3 text-center rounded"><?= $this->Flash->render() ?></div>
            </div>
        </div>
<?php }
} ?>

<div class="row">
    <div class="col-12">
        <table class="table table-striped table-responzive">
            <tr>
                <th>Jméno</th>
                <th>Příjmení</th>
                <th>Datum narození</th>
                <?php if ($logged) {
                    if ($role == "admin") { ?>
                        <th>Edit</th>
                <?php }
                } ?>
            </tr>

            <?php
            foreach ($herci as $herec) : ?>
                <tr>
                    <td>
                        <?= $herec->jmeno ?>
                    </td>
                    <td>
                        <?= $herec->prijmeni ?>
                    </td>
                    <td>
                        <?= date_format($herec->datum_narozeni, 'd. m. Y') ?>
                    </td>
                    <?php if ($logged) {
                        if ($role == "admin") { ?>
                            <td>
                                <?= $this->Html->link('Upravit', ['Controller' => 'Herci', 'action' => 'edit', $herec->id_herec]) ?>
                            </td>
                    <?php }
                    } ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>