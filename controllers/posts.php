<?php
include_once __DIR__ . '/../models/post.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

if ($_REQUEST['action'] === 'index') {
  echo json_encode(Posts::all());
} elseif ($_REQUEST['action'] === 'post') {
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $new_post = new Post(null, $body_object->name, $body_object->image, $body_object->body);
  $all_posts = Posts::create($new_post);
  echo json_encode($all_posts);
} else if ($_REQUEST['action'] === 'update'){
  $request_body = file_get_contents('php://input');
  $body_object = json_decode($request_body);
  $updated_post = new Post($_REQUEST['id'], $body_object->name, $body_object->image, $body_object->body);
  $all_posts = Posts::update($updated_post);
  echo json_encode($all_posts);
  } else if ($_REQUEST['action'] === 'delete') {
    $all_posts = Posts::delete($_REQUEST['id']);
    echo json_encode($all_posts);
  }

 ?>
