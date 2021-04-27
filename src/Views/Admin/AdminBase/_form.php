<div class="card col-lg-6 col-md-12">
  <div class="card-header">
    <h1 class="h2"><?= yieldContent('title', $this->resourceManager()->resourceLabel()) ?></h1>
  </div>
  <div class="card-body">
    <?php $form = \Web\Form::for($this->model(), $this->saveOrUpdatePath(), ['class' => 'modelForm']) ?>
    <div class="action-toolbar pb-3">
      <?php foreach ($this->resourceManager()->formActions($this->model()) as $action) : ?>
        <?= $this->resourceManager()->renderModelAction(null, $action, 'form', ['form' => $form]) ?>
      <?php endforeach; ?>
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