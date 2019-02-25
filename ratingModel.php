<?php
include_once dirname(__DIR__).'/app/views/parts/Ratings/ratingController.php';
$render = new \stdClass();
if ($getRating->checkIfAlreadyRated()) {
    $render->message = "Sorry, you can only rate once!";
    $renderView = json_encode($render);
    echo $renderView;
} else {
    $getRating->insertRating($rating);
    $render->message = "Thank you for your rating! <br> You have rated: ".$rating;
    $render->ratingAvg = $getRating->calcAverage();
    $render->ratingCount = $getRating->numVote();
    $renderView = json_encode($render);
    echo $renderView;
}