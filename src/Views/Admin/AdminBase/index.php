<div class="card">
  <div class="card-header">
    <h1 class="h2"><?= yieldContent('title') ?></h1>
  </div>
  <div class="card-body">
    <div class="action-toolbar pb-3">
      <?= $this->resourceManager()->renderModelAction(null, 'new', 'index') ?>

      <a class="btn btn-warning search-panel-displayer" href="#"><i class="fa fa-search"></i>
        Search
      </a>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <?php foreach ($this->resourceManager()->listableAttributes() as $attribute) : ?>
            <th>
              <?= ucfirst($attribute) ?>
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