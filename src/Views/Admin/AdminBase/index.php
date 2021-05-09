<script>
  $(function() {
    $('.btn-destroy-item').click(function(e) {
      e.preventDefault();

      if (confirm('seguro que desea eliminar este item?')) {
        var form = $('#delete-resource-form');
        form.find('[name="id"]').val($(this).data('resourceId'));
        form.submit();
      }
    })
  });
</script>

<div class="card">
  <form id='delete-resource-form' method='post' action='<?= linkTo([$this->currentRoute(), 'destroy']) ?>'>
    <input type='hidden' name='id' />
  </form>
  <div class="card-header">
    <h1 class="h2"><?= yieldContent('title', $this->resourceManager()->resourcesLabel()) ?></h1>
  </div>
  <div class="card-body">
    <div class="action-toolbar pb-3">
      <?php foreach ($this->resourceManager()->topListActions() as $action) : ?>
        <?= $this->resourceManager()->renderModelAction(null, $action, 'index') ?>
      <?php endforeach; ?>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <?php foreach ($this->resourceManager()->listableAttributes() as $attribute) : ?>
            <th>
              <?= $this->resourceManager()->labelFor($attribute) ?>
            </th>
          <?php endforeach; ?>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($this->resourceManager()->items() as $item) : ?>
          <tr>
            <?php foreach ($this->resourceManager()->listableAttributes() as $attribute) : ?>
              <td>
                <?= $item->{$attribute} ?>
              </td>
            <?php endforeach; ?>
            <td>
              <?php foreach ($this->resourceManager()->listableActions() as $action) : ?>
                <?= $this->resourceManager()->renderModelAction($item, $action, 'index') ?>
              <?php endforeach; ?>
            </td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>