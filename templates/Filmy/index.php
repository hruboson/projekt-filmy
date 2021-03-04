<div class="h1 text-center mt-5">Seznam filmů</div>
<div class="text-center">
    <?php echo $this->Html->link('Film', ['controller' => 'Filmy', 'action' => 'film', '1', '_full' => true]); ?>
</div>
<div class="text-center">
    <?php var_dump($filmy); ?>
</div>