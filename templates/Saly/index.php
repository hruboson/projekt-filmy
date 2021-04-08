<div class="h1 text-center mt-5">Seznam sálů</div>
<?php if ($logged) {
    if ($role == "admin") { ?>
        <div class="row">
            <div class="col-12 text-center mb-3">
                <?php echo $this->Html->link('Přidat sál', ['Controller' => 'Saly', 'action' => 'add'], ['class' => '']); ?>
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
                <th class="text-center">ID sálu</th>
                <th>Název</th>
                <th class="text-center">Kapacita</th>
                <th class="text-center">3D</th>
                <th class="text-center">Prostorový zvuk</th>
                <?php if ($logged) { ?>
                    <?php if ($role == "admin") { ?>
                        <th>Edit</th>
                <?php }
                } ?>
            </tr>

            <?php
            foreach ($saly as $sal) : ?>
                <tr>
                    <td class="text-center">
                        <?= $sal->id_sal ?>
                    </td>
                    <td>
                        <?= $sal->nazev ?>
                    </td>
                    <td class="text-center">
                        <?= $sal->kapacita ?>
                    </td>
                    <td class="text-center">
                        <?php switch($sal->three_dimensional){
                            case '0': 
                                echo "Ne";
                                break;
                            case '1': 
                                echo 'Ano';
                                break;
                            default:
                                echo 'Neznámo';
                                break;
                        } ?>
                    </td>
                    <td class="text-center">
                        <?php switch($sal->prostorovy_zvuk){
                            case '0': 
                                echo "Ne";
                                break;
                            case '1': 
                                echo 'Ano';
                                break;
                            default:
                                echo 'Neznámo';
                                break;
                        } ?>
                    </td>
                    <?php if ($logged) { ?>
                        <?php if ($role == "admin") { ?>
                            <td>
                                <?= $this->Html->link('Upravit', ['Controller' => 'Saly', 'action' => 'edit', $sal->id_sal]) ?>
                            </td>
                    <?php }
                    } ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>