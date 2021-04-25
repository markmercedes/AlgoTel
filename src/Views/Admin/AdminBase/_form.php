<div class="card">
  <div class="card-header">
    <h1 class="h2"><?= yieldContent('title', 'Edit') ?></h1>
  </div>
  <div class="card-body">
    <?php $form = \Web\Form::for($this->model(), $this->saveOrUpdatePath(), ['class' => 'modelForm']) ?>
    <div class="action-toolbar pb-3">
      <?= $this->resourceManager()->renderModelAction(null, 'save', 'form', ['form' => $form]) ?>
      <?= $this->resourceManager()->renderModelAction(null, 'new', 'form') ?>
      <?= $this->resourceManager()->renderModelAction(null, 'cancel', 'form') ?>
    </div>

    <?php foreach ($this->model()->errors() as $error) : ?>
      <div class="alert alert-danger" role="alert">
        <?= $error->getMessage($this->resourceManager()->labelFor($error->attribute)); ?>
      </div>
    <?php endforeach; ?>

    <?php foreach ($this->resourceManager()->editableAttributes() as $attribute) : ?>
      <?= $this->resourceManager()->fieldFor($this->model(), $attribute)->renderForm(['form' => $form]); ?>
    <?php endforeach; ?>

    <?php $form->closeTag() ?>
  </div>
</div>