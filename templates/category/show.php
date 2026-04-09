<?php require __DIR__ . '/../header.php'; ?>

<h2 class="mb-4">Catégorie : <?= htmlspecialchars($category->getName()) ?></h2>

<div class="row">
  <?php if (empty($polls))
  { ?>
    <p class="text-muted">Aucun sondage dans cette catégorie.</p>
  <?php }
  else
  { ?>
    <?php include __DIR__ . '/../poll/poll_part.php'; ?>
  <?php } ?>
</div>

<a href="/categories" class="btn btn-secondary mt-3">Retour aux catégories</a>

<?php require __DIR__ . '/../footer.php'; ?>
