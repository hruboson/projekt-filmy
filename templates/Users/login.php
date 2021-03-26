<div class="row">
    <div class="col-12 text-center h1">
        Login
    </div>
</div>
<div class="row">
    <div class="col-4 mx-auto">
        <div class="users form text-center">
            <?= $this->Flash->render() ?>
            <?= $this->Form->create() ?>
            <fieldset>
                <?= $this->Form->control('email', ['required' => true, 'class' => 'form form-control', 'placeholder' => 'example@mail.com', 'autocomplete' => 'on']) ?>
                <?= $this->Form->control('password', ['required' => true, 'class' => 'form form-control', 'placeholder' => '*****']) ?>
            </fieldset>
            <?= $this->Form->button('Login', ['type' => 'submit','class' => 'btn btn-primary mt-3']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>