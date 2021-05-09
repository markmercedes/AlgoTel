<div class="row">
  <div class="col-8 mb-4">
    <div class="card">
      <div class="card-header">
        <h1 class="h2">Facturado por fecha</h1>
      </div>
      <div class="card-body">
        <form class="mb-4">
          <div class="row">
            <div class="col">
              <input type='text' name="date-from" class="form-control bg-white date-input" data-value='<?= $this->dateFrom() ?>' />
            </div>
            <div class="col">
              <input type='text' name="date-to" class="form-control bg-white date-input" data-value='<?= $this->dateTo() ?>' />
            </div>
            <div class="col-2">
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"> </i> Filtrar</button>
            </div>
          </div>
        </form>

        <canvas id="line-chart" width="800" height="350"></canvas>
      </div>
    </div>
  </div>
  <div class="col-4 mb-4">
    <div class="card">
      <div class="card-header">
        <h1 class="h2">Por estado</h1>
      </div>
      <div class="card-body">
        <canvas id="pie-chart" width="400" height="150"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-12">

    <div class="card">
      <div class="card-header">
        <h1 class="h2">Facturado por fecha</h1>
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Ordenes completadas</th>
              <th>Facturado</th>
            </tr>
          </thead>
          <tbody>
            <?php $total = 0 ?>
            <?php foreach ($this->bookingsPerDay as $bookingDay) : ?>
              <tr>
                <?php $total += $bookingDay['total'] ?>
                <td><?= $bookingDay['order_date'] ?></td>
                <td><?= number_format($bookingDay['orders']) ?></td>
                <td><?= number_format($bookingDay['total'], 2) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="2">
                Total facturado
              </th>
              <th><?= number_format($total, 2) ?></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-12">

    <div class="card">
      <div class="card-header">
        <h1 class="h2">Ordenes por estado</h1>
      </div>
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Estado</th>
              <th>Ordenes</th>
            </tr>
          </thead>
          <tbody>
            <?php $total = 0 ?>
            <?php foreach ($this->bookingsByStatus as $bookingStatus) : ?>
              <?php $total += $bookingDay['orders'] ?>
              <tr>
                <td><?= statusLabel($bookingStatus['order_status']) ?></td>
                <td><?= number_format($bookingStatus['orders']) ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
          <tfoot>
            <tr>
              <th>
                Total
              </th>
              <th><?= number_format($total) ?></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
    const CHART_COLORS = {
      red: 'rgb(255, 99, 132)',
      orange: 'rgb(255, 159, 64)',
      yellow: 'rgb(255, 205, 86)',
      green: 'rgb(75, 192, 192)',
      blue: 'rgb(54, 162, 235)',
      purple: 'rgb(153, 102, 255)',
      grey: 'rgb(201, 203, 207)'
    };

    new Chart(document.getElementById("pie-chart"), {
      type: 'pie',
      data: {
        labels: <?= json_encode(array_map(function ($item) {
                  return plainStatusLabel($item['order_status']);
                }, $this->bookingsByStatus)) ?>,
        datasets: [{
          backgroundColor: Object.values(CHART_COLORS),
          data: <?= json_encode(array_map(function ($item) {
                  return $item['orders'];
                }, $this->bookingsByStatus)) ?>
        }]
      },
      options: {
        title: {
          display: true,
          text: 'Predicted world population (millions) in 2050'
        }
      }
    });

    new Chart(document.getElementById("line-chart"), {
      type: 'line',
      data: {
        labels: <?= json_encode(array_map(function ($item) {
                  return $item['order_date'];
                }, $this->bookingsPerDay)) ?>,
        datasets: [{
          data: <?= json_encode(array_map(function ($item) {
                  return $item['total'];
                }, $this->bookingsPerDay)) ?>,
          label: "Facturado",
          borderColor: "#3e95cd",
          fill: true
        }]
      },
      options: {
        title: {
          display: true,
          text: 'World population per region (in millions)'
        }
      }
    });
  });
</script>