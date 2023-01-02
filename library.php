<?php 

  $db = json_decode(file_get_contents('db.json'), true);

?>

<!DOCTYPE html>
<html lang="en">
<?php require 'partials/head.php' ?>
<body>

<a class="btn btn-info" href="index.php">Torna</a>



<div class="container">
  <div class="row row-cols-6">

      <?php foreach($db as $record) :?>
        <div class="col">
            <div class="card">
          <img src="<?php echo $record['cover_img']?>" class="card-img-top" alt="<?php echo $record['title']?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $record['title']?></h5>
            <h6 class="card-subtitle"><?php echo $record['author']?></h6>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
        </div>
      <?php endforeach ;?>
      
    </div>
  </div>
</div>




</body>
</html>