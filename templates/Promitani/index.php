<div class="h1 text-center mt-5">Seznam Promítání</div>
<?php if ($logged) {
    if ($role == "admin") { ?>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <?php echo $this->Html->link('Přidat promítání', ['Controller' => 'Promitani', 'action' => 'add'], ['class' => '']); ?>
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
                <th>Číslo promítání</th>
                <th>Datum</th>
                <th>Čas</th>
                <th>Sál</th>
                <th>Film</th>
                <?php if ($logged) { ?>
                    <th>Akce</th>
                    <?php if ($role == "admin") { ?>
                        <th>Edit</th>
                <?php }
                } ?>
            </tr>

            <?php
            foreach ($promitani as $prom) : ?>
                <tr>
                    <td class="text-center">
                        <?= $prom->id_promitani ?>
                    </td>
                    <td>
                        <?= date_format($prom->datum, 'd. m. Y') ?>
                    </td>
                    <td>
                        <?= date_format($prom->cas, 'h:i:s') ?>
                    </td>
                    <td>
                        <?= $prom->saly->nazev ?>
                    </td>
                    <td>
                        <?= $prom->filmy->filmynazvy->nazev ?>
                    </td>
                    <?php if ($logged) { ?>
                        <td>
                        <?php echo $this->Html->link('Koupit vstupenku', ['Controller' => 'Promitani', 'action' => 'buy', (int)$prom->id_promitani]) ?>

                        </td>
                        <?php if ($role == "admin") { ?>
                            <td>
                                <?= $this->Html->link('Upravit', ['Controller' => 'Promitani', 'action' => 'edit', $prom->id_promitani]) ?>
                            </td>
                    <?php }
                    } ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>