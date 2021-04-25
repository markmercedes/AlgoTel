<style>
  .property-types-showcase .row {
    padding-top: 2em;
    padding-bottom: 2em;
  }
</style>

<?php
$propertyTypes = [
  [
    'name' => 'Suites & Villas',
    'description' => 'Eden Roc at Cap Cana is a collection of luxury suites in a dreamy setting, with a touch of the Italian and French Rivieras, and a seductive aura of international glamour. Surrounded by lush greenery, verdant gardens, lagoon-style pools, awe-inspiring oceanfront panoramas, our property features multiple styles of accommodations, which means every traveler can find their ideal retreat.',
    'image' => "https://www.edenroccapcana.com/wp-content/uploads/2018/12/Beachfront-Suite_Living-Room_0245-1.jpg",
    'link' => '#'
  ],
  [
    'name' => 'A Feast of Flavors',
    'description' => 'Our skilled Chefs, cooks and sommeliers practice their art with the utmost respect for the environment and good living. Through their authenticity, passion and commitment, our Relais & Châteaux family invites you on memorable Delicious Journeys.',
    'image' => "https://www.edenroccapcana.com/wp-content/uploads/2018/12/Beachfront-Suite_Living-Room_0245-1.jpg",
    'link' => '#'
  ],
  [
    'name' => 'Wellness',
    'description' => 'Solaya Spa is an exclusive tropical escape that captures the rejuvenating aura of this Dominican paradise and offers a wide range of world-class opportunities to find beauty, balance and complete well-being. Our resort presents new Spa and Wellness facilities, offering nearly 3,000 square meters of indulgent space and 12 treatment rooms for the ultimate wellness experience.',
    'image' => "https://www.edenroccapcana.com/wp-content/uploads/2019/06/Eden-Roc-Wellness-Spa-1.jpg",
    'link' => '#'
  ],
  [
    'name' => 'Families',
    'description' => "Ideal for families as well as couples, Eden Roc Cap Cana's features the world class Koko Kid’s Club, located on a stunning lagoon and designed like tree house. Equipped with a mini spa for manicures, pedicures and hairstyling, the kids club also houses a video gaming area, bathrooms, and a central area for play and story-telling, and mini guests can even kayak from the club’s man made ‘beach’ on the lagoon.",
    'image' => "https://www.edenroccapcana.com/wp-content/uploads/2018/12/Highlights-4K.00_01_19_06.jpg",
    'link' => '#'
  ],
  [
    'name' => 'Golf',
    'description' => 'Punta Espada Golf Course- designed and signed by Jack Nicklaus, It incorporates all the paradise- like characteristics of Cap Cana throughout the 18 holes, all of which have an extraordinary view to the sea which make a perfect setting to find inspiration for best shots.',
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

          <a class="btn btn-primary" href="<?= $propertyType['link'] ?>">Ver mas</a>
        </div>
      <?php else : ?>
        <div class="col-6">
          <h3><?= $propertyType['name'] ?></h3>
          <p><?= $propertyType['description'] ?></p>

          <a class="btn btn-primary" href="<?= $propertyType['link'] ?>">Ver mas</a>
        </div>
        <div class="col-6">
          <img src="<?= $propertyType['image'] ?>" />
        </div>
      <?php endif; ?>
    </div>
  <?php endforeach ?>
</section>