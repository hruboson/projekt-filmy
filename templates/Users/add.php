<div class="row">
    <div class="col-12 text-center h1">
        Registrace
    </div>
</div>
<div class="row">
    <div class="col-4 mx-auto">
        <div class="users form">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <?= $this->Form->control('username', ['required' => true, 'class' => 'form form-control', 'placeholder' => 'Username']) ?>
                <?= $this->Form->control('email', ['required' => true, 'class' => 'form form-control', 'placeholder' => 'example@mail.com', 'autocomplete' => 'on']) ?>
                <?= $this->Form->control('password', ['required' => true, 'class' => 'form form-control']) ?>

            </fieldset>
            <?= $this->Form->button('Register', ['type' => 'submit', 'class' => 'btn btn-primary mt-3']); ?>
            <?= $this->Form->end() ?>
            <div class="h3 bg-success mt-3 text-center rounded"><?= $this->Flash->render() ?></div>
        </div>
    </div>
</div>