<div class="h1 text-center mt-5">Seznam filmů</div>
<div class="row">
    <div class="col-12">
        <table class="table table-striped">
            <tr>
                <th>ID</th>
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
                        <?= $this->Html->link($film->id_film, ['Controller' => 'Filmy', 'action' => 'film', $film->id_film]) ?>
                    </td>
                    <td>
                        <?= $this->Html->link($film->filmynazvy->nazev, ['Controller' => 'Filmy', 'action' => 'film', $film->id_film]) ?>
                    </td>
                    <td>
                        <?= $film->delka ?> minut
                    </td>
                    <td>
                        <?= $film->jmeno_hlavni_postavy ?>
                    </td>
                    <td>
                        <?= $film->filmyzanry->zanr_nazev ?>
                    </td>
                    <td>
                        <?= $film->filmytypy->nazev ?>
                    </td>
                </tr>
            <?php endforeach; ?> 

        </table>
    </div>
</div>