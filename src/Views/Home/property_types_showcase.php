<style>
  .property-types-showcase .row {
    padding-top: 2em;
    padding-bottom: 2em;
  }
</style>

<?php
$propertyTypes = [
  [
    'name' => 'Suites y Villas',
    'description' => 'Eden Roc en Cap Cana es una colección de suites de lujo en un entorno de ensueño, con un toque de las Rivieras italiana y francesa, y un aura seductora de glamour internacional. Rodeado de exuberante vegetación, jardines verdes, piscinas estilo laguna, impresionantes panoramas frente al mar, nuestra propiedad cuenta con múltiples estilos de alojamiento, lo que significa que cada viajero puede encontrar su refugio ideal.',
    'image' => "https://www.edenroccapcana.com/wp-content/uploads/2018/12/Beachfront-Suite_Living-Room_0245-1.jpg",
    'link' => '#'
  ],
  [
    'name' => 'Una fiesta de sabores',
    'description' => 'Nuestros expertos Chefs, cocineros y sommeliers practican su arte con el máximo respeto por el medio ambiente y el buen vivir. Gracias a su autenticidad, pasión y compromiso, nuestra familia Relais & Châteaux le invita a disfrutar de deliciosos viajes memorables.',
    'image' => "https://www.edenroccapcana.com/wp-content/uploads/2018/12/Beachfront-Suite_Living-Room_0245-1.jpg",
    'link' => '#'
  ],
  [
    'name' => 'Bienestar',
    'description' => 'Solaya Spa es un exclusivo escape tropical que captura el aura rejuvenecedora de este paraíso dominicano y ofrece una amplia gama de oportunidades de clase mundial para encontrar belleza, equilibrio y completo bienestar. Nuestro resort presenta nuevas instalaciones de spa y bienestar, que ofrecen casi 3.000 metros cuadrados de espacio indulgente y 12 salas de tratamiento para la máxima experiencia de bienestar.',
    'image' => "https://www.edenroccapcana.com/wp-content/uploads/2019/06/Eden-Roc-Wellness-Spa-1.jpg",
    'link' => '#'
  ],
  [
    'name' => 'Familias',
    'description' => "Ideal para familias y parejas, Eden Roc Cap Cana's cuenta con el club infantil Koko de clase mundial, ubicado en una laguna impresionante y diseñado como una casa en el árbol. Equipado con un mini spa para manicuras, pedicuras y peluquería, el club infantil también alberga un área de videojuegos, baños y un área central para jugar y contar historias, y los mini huéspedes pueden incluso hacer kayak desde la 'playa' artificial del club en la laguna.",
    'image' => "https://www.edenroccapcana.com/wp-content/uploads/2018/12/Highlights-4K.00_01_19_06.jpg",
    'link' => '#'
  ],
  [
    'name' => 'Golf',
    'description' => 'El campo de golf Punta Espada, diseñado y firmado por Jack Nicklaus, incorpora todas las características paradisíacas de Cap Cana a lo largo de los 18 hoyos, todos los cuales tienen una vista extraordinaria al mar que hacen un escenario perfecto para encontrar inspiración para los mejores golpes.',
    'image' => "https://www.edenroccapcana.com/wp-content/uploads/2018/12/Punta-Espada12_DJI_0163-.jpg",
    'link' => '#'
  ],
]
?>

<section class="container property-types-showcase">
  <?php foreach ($propertyTypes as $index => $propertyType) : ?>
    <div class="row">
      <?php if (Utils\Math::isEven($index)) : ?>
        <div class="col-6">
          <img src="<?= $propertyType['image'] ?>" />
        </div>
        <div class="col-6">
          <h3><?= $propertyType['name'] ?></h3>
          <p><?= $propertyType['description'] ?></p>
        </div>
      <?php else : ?>
        <div class="col-6">
          <h3><?= $propertyType['name'] ?></h3>
          <p><?= $propertyType['description'] ?></p>
        </div>
        <div class="col-6">
          <img src="<?= $propertyType['image'] ?>" />
        </div>
      <?php endif; ?>
    </div>
  <?php endforeach ?>
</section>