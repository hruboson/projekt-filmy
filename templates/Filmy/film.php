<div class="h1 text-center mt-5"><?php echo $film->filmynazvy->nazev; ?></div>
<div class="text-center">
    ID: <?php echo $film->id_film; ?>

    
    <?= $this->Html->link(__('Edit'), ['controller' => 'Filmy', 'action' => 'edit', $film->id_film], ['class' => 'side-nav-item']) ?>
</div>