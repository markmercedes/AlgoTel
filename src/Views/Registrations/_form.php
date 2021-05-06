<main class="form-register">
  <div class="card col-md-12">
    <div class="card-header">
      <h1 class="h2"><?= yieldContent('title', $this->resourceManager()->resourceLabel()) ?></h1>
    </div>
    <div class="card-body">
      <?php $form = \Web\Form::for($this->model(), $this->saveOrUpdatePath(), ['class' => 'modelForm']) ?>

      <?php foreach ($this->model()->errors() as $error) : ?>
        <div class="alert alert-danger" role="alert">
          <?= $error->getMessage($this->resourceManager()->labelFor($error->attribute)); ?>
        </div>
      <?php endforeach; ?>

      <?php foreach ($this->resourceManager()->editableAttributes() as $attribute) : ?>
        <?= $this->resourceManager()->fieldFor($this->model(), $attribute)->renderForm(['form' => $form]); ?>
      <?php endforeach; ?>

      <div class="action-toolbar pb-3">
        <input type="hidden" class="form-control" name="ReturnUrl" value="<?= Web\Params::get('ReturnUrl') ?>" />
        <?= $this->resourceManager()->renderModelAction(null, 'save', 'form', ['form' => $form]) ?>
      </div>

      <?php $form->closeTag() ?>
    </div>
  </div>
</main>

<style>
  html,
  body {
    height: 100%;
  }

  .form-register {
    width: 100%;
    max-width: 430px;
    padding: 15px;
    margin: auto;
  }
</style>