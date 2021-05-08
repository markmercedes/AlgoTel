<?= $this->renderPartial('_form') ?>


<div class="card col-lg-10 col-md-12 mt-5">
  <div class="card-header">
    <table>
      <?php foreach ($this->model()->orderItems() as $item) : ?>
        <tr>
          <td><?= $item->id ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</div>