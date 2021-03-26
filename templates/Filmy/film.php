<div class="h1 text-center mt-5"><?php echo $film->filmynazvy->nazev; ?></div>
<?php //debug($film); debug($herci)
debug($film)
?>
<div class="text-center">
    ID: <?php echo $film->id_film; ?>

    
    <?= $this->Html->link(__('Edit'), ['controller' => 'Filmy', 'action' => 'edit', 1], ['class' => 'side-nav-item']) ?>
</div>