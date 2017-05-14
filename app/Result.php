<?php
/**
 * Created by PhpStorm.
 * User: mladen.batakovic
 * Date: 14.5.17.
 * Time: 15.56
 */
include "Api.php";

/** @var Api $apiClass */
$apiClass   = new Api();

$boardState = $_POST['state'];

$result = $apiClass->makeMove($boardState);

echo json_encode($result);
exit;