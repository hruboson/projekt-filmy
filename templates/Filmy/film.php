<div class="h1 text-center mt-5"><?php echo $film->filmynazvy->nazev; ?></div>
<div class="row">
    <div class="col-12 text-center">
        <?php
        if ($logged) {
            if ($role == "admin") { ?>
                <?= "ID: " . $film->id_film; ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'Filmy', 'action' => 'edit', $film->id_film], ['class' => 'side-nav-item']) ?>
        <?php  }
        }
        ?>
    </div>
</div>
<div class="row mb-5 mt-3">
    <div class="col-3 text-center">
        <div class="h5">Jméno hlavní postavy</div>
        <div class="p"><?php echo $film->jmeno_hlavni_postavy ?></div>
    </div>
    <div class="col-3 text-center">
        <div class="h5">Délka filmu</div>
        <div class="p"><?php echo $film->delka ?> minut</div>
    </div>
    <div class="col-3 text-center">
        <div class="h5">Typ filmu</div>
        <div class="p"><?php echo $film->filmytypy->nazev ?></div>
    </div>
    <div class="col-3 text-center">
        <div class="h5">Žánr filmu</div>
        <div class="p"><?php echo $film->filmyzanry->zanr_nazev ?></div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="h4 text-center">Herci ve filmu</div>
        <ul class="list-group list-group-flush text-center">
            <?php foreach ($film->filmyherci as $herec) { ?>
                <li class="list-group-item"><?= $herec->herci->jmeno . " " . $herec->herci->prijmeni; ?></li>
            <?php } ?>
        </ul>
    </div>
    <div class="col-6">
        <div class="h4 text-center">Názvy filmu</div>
        <ol class="list-group list-group-numbered">
            <?php foreach ($filmynazvy as $nazev) { ?>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><?php echo $nazev->nazev; ?></div>
                    </div>
                    <span class="badge bg-primary rounded-pill"><?php echo $nazev->jazyky->jazyk; ?></span>
                </li>
            <?php } ?>
        </ol>
    </div>
</div>
<div class="row justify-content-center mt-3">
    <div class="col-6 text-center">
        <div class="h4 text-center">Země podílející se na tvorbě filmu</div>
        <ul class="list-group list-group-flush">
            <?php foreach ($film->filmyzeme as $zeme) { ?>
                <li class="list-group-item"><?= $zeme->zeme->nazev; ?></li>
            <?php } ?>
        </ul>
    </div>
</div>