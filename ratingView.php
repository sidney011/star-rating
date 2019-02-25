<?php include_once "ratingController.php"; ?>
<div class="space-18"></div>
<h4>Rate this page</h4>
<div class="star-rating">
    <form method="GET">
        <input id="star-5" type="radio" name="rating" <?=round($getRating->calcAverage()) == 5 ? "checked" : ""; ?>
        value="5">
        <label for="star-5" title="5 stars">
            <i class="active fa fa-star" aria-hidden="true"></i>
        </label>
        <input id="star-4" type="radio" name="rating" <?=round($getRating->calcAverage()) == 4 ? "checked" : ""; ?>
        value="4">
        <label for="star-4" title="4 stars">
            <i class="active fa fa-star" aria-hidden="true"></i>
        </label>
        <input id="star-3" type="radio" name="rating" <?=round($getRating->calcAverage()) == 3 ? "checked" : ""; ?>
        value="3">
        <label for="star-3" title="3 stars">
            <i class="active fa fa-star" aria-hidden="true"></i>
        </label>
        <input id="star-2" type="radio" name="rating" <?=round($getRating->calcAverage()) == 2 ? "checked" : ""; ?>
        value="2">
        <label for="star-2" title="2 stars">
            <i class="active fa fa-star" aria-hidden="true"></i>
        </label>
        <input id="star-1" type="radio" name="rating" <?=round($getRating->calcAverage()) == 1 ? "checked" : ""; ?>
        value="1">
        <label for="star-1" title="1 star">
            <i class="active fa fa-star" aria-hidden="true"></i>
        </label>
    </form>
</div>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "WebPage",
  "name": "<?= !empty($schema) ? $schema : ''; ?>",
  "description": "<?= !empty($description) ? $description : ''; ?>",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "<?= $getRating->calcAverage(); ?>",
    "bestRating": "5",
    "ratingCount": "<?= $getRating->numVote(); ?>"
  }
}
</script>
<div>
    <span>
        <?= !empty($schema) ? $schema : ''; ?></span>
    <div class="rating-view">
        Average Rating: <span class="rating-view--average">
            <?= $getRating->calcAverage(); ?></span></span><br>
        Vote(s): <span class="rating-view--count">
            <?= $getRating->numVote(); ?></span></span><br>
    </div>
</div>