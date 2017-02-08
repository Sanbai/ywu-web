<?php

$app = require __DIR__ . '/app.php';

$model = $app['model'];
$guestList = $model->listGuests();

?>

<!DOCTYPE html>
<html>
  <head>
    <title>View Guestbook</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- not-required feature: meta tags -->
    <meta charset="utf-8" />
    <meta name="description" content="Homework assignment 5" />
    <meta name="keywords" content="web programming, html, css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

	<body>
    <div class="container">
      <h1> Guestbook </h1>
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Comment</th>
            <th>Created Time</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($guestList as $guest) { ?>
            <tr>
              <?php foreach($guest as $col) { ?>
                <td><?php echo $col; ?></td>
              <?php } ?>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <h3><a href="guestbook.php"> Creat Guest</a></h3>
    </div>

	</body>
</html
