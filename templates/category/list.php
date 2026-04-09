<?php require __DIR__ . '/../header.php'; ?>

<h2 class="mb-4">Catégories</h2>
<div class="row">
  <?php foreach ($categories as $category)
  { ?>
    <div class="col-md-3 mb-3">
      <a href="/category/?id=<?= $category->getId() ?>" class="text-decoration-none">
        <div class="card text-center">
          <div class="card-body">
            <h4 class="card-title"><?= htmlspecialchars($category->getName()) ?></h4>
            <p class="card-text">Voir les sondages</p>
          </div>
        </div>
      </a>
    </div>
  <?php } ?>
</div>

<?php require __DIR__ . '/../footer.php'; ?>
