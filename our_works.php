<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Наши работы</title>
</head>

<body>
  <?php require "blocks/header.php"; ?>

  <?php

  include "func.php";

  /* Request: add image to bd */
  if (isset($_POST['todo']) && $_POST['todo'] == 'Download' && !empty($_FILES['image']['tmp_name'])/* && substr($_FILES['image']['type'], 0, 5) === 'image' && $_FILES['image']['size'] <= 2 * 1024 * 1024 (2mb) */) {
    $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    sql_req("insert into images(visibility, image) values ('1', '$img')");
    //$_POST['todo'] = 'None';
    $_POST = array();
  }

  /* Request: delete image */
  if (isset($_POST['todo']) && $_POST['todo'] == 'delete') {
    sql_req("delete from images where id=" . intval($_POST['id']));
    $_POST = NULL;
  }

  /* Request: hide image */
  if (isset($_POST['todo']) && $_POST['todo'] == 'hide') {
    sql_req("update images set visibility='0' where id=" . intval($_POST['id']));
  }

  /* Request: show image */
  if (isset($_POST['todo']) && $_POST['todo'] == 'show') {
    sql_req("update images set visibility='1' where id=" . intval($_POST['id']));
  }

  /* Add button */
  echo "<form action='our_works.php' method = 'post' enctype='multipart/form-data'>" .
    "<input type='file' name = 'image'>" .
    "<input type='submit' name = 'todo' value='Download'>";
  echo "</form>";

  ?>


  <div class="">
    <div>
      <h2 class="">Наши работы</h2>
    </div>
    <?php $all = sql_req("select * from images order by id DESC"); ?>
    <div class="items">
      <?php foreach ($all as $row) : ?>

        <!-- Visible card -->
        <?php if ($row['visibility'] == 1) : ?>
          <?php $show_img = base64_encode($row['image']); ?>
          <div class="card-vis">
            <div class="">
              <!-- Image -->
              <div class="">
                <img src='data:image/jpeg; base64, <?php echo $show_img; ?>' class="card-img" alt="Oops..." width="99.9%">
              </div>

              <h2>Id: <?php echo $row['id']; ?></h2>

              <!-- Title -->
              <div class="">
                <h1 class="card-title">Title</h1>
              </div>

              <!-- Describe -->
              <div class="discript iems">
                <h3>Desciprion</h3>
              </div>

              <!-- Button -->
              <div class="card-button">
                <button type="button" class="">Button</button>
              </div>

              <form action='our_works.php' method='post'>
                <!-- Button: hide -->
                <div class="card-button-hide">
                  <input type='hidden' name='id' value='<?php echo $row['id']; ?>'>
                  <input type='submit' name='todo' value='hide'>
                </div>

                <!-- Button: delete -->
                <div class="card-button-delete">
                  <input type='hidden' name='id' value='<?php echo $row['id']; ?>'>
                  <input type='submit' name='todo' value='delete'>
                </div>
              </form>

            </div>
          </div>
        <?php endif; ?>

        <!-- Invisible card -->
        <?php if ($row['visibility'] == 0) : ?>
          <?php $show_img = base64_encode($row['image']); ?>
          <div class="card-invis">
            <div class="">
              <!-- Image -->
              <div class="">
                <img src='data:image/jpeg; base64, <?php echo $show_img; ?>' class="card-img" alt="Oops..." width="99.9%">
              </div>

              <h2>Id: <?php echo $row['id']; ?></h2>

              <!-- Title -->
              <div class="">
                <h1 class="card-title">Title</h1>
              </div>

              <!-- Describe -->
              <div class="discript iems">
                <h3>Desciprion</h3>
              </div>

              <!-- Button -->
              <div class="card-button">
                <button type="button" class="">Button</button>
              </div>

              <form action='our_works.php' method='post'>

                <!-- Button: show -->
                <div class="card-button-show">
                  <input type='hidden' name='id' value='<?php echo $row['id']; ?>'>
                  <input type='submit' name='todo' value='show'>
                </div>

                <!-- Button: delete -->
                <div class="card-button-delete">
                  <input type='hidden' name='id' value='<?php echo $row['id']; ?>'>
                  <input type='submit' name='todo' value='delete'>
                </div>

              </form>

            </div>
          </div>
        <?php endif; ?>

      <?php endforeach; ?>
    </div>
  </div>

  <button class="button-back"><a href="index.php">Назад</a></button>
  <?php require "blocks/footer.php"; ?>

</body>

</html>