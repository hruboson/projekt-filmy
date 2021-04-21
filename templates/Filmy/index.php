<div class="h1 text-center mt-5">Seznam filmů</div>

<?php if ($logged) {
    if ($role == "admin") { ?>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <?php echo $this->Html->link('Přidat film', ['Controller' => 'Filmy', 'action' => 'add'], ['class' => '']); ?>
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
        <table class="table table-striped">
            <tr>
                <th>Název</th>
                <th>Délka</th>
                <th>Hlavní postava</th>
                <th>Žánr</th>
                <th>Typ</th>
            </tr>

            <?php
            foreach ($filmy as $film) : ?>
                <tr>
                    <td>
                        <?= $this->Html->link($film->FilmyNazvy->nazev, ['Controller' => 'Filmy', 'action' => 'film', $film->id_film]) ?>
                    </td>
                    <td>
                        <?= $film->delka ?> minut
                    </td>
                    <td>
                        <?= $film->jmeno_hlavni_postavy ?>
                    </td>
                    <td>
                        <?= $film->FilmyZanry->zanr_nazev ?>
                    </td>
                    <td>
                        <?= $film->FilmyTypy->nazev ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>