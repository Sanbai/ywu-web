<?php

$app = require __DIR__ . '/app.php';

$error_messages = array(
  'name' => '* name is required',
  'email' => '* email is required',
  'comment' => '* comment is required'
);

$errors = array(
  'name' => '*',
  'email' => '*',
  'comment' => '*'
);

$message = '';

function test_input($data, $name, & $errors, $error_messages) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);

  if (empty($data)) {
    $errors[$name] = $error_messages[$name];
  }
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $guest = array(
    'name' => '',
    'email' => '',
    'comment' => ''
  );
  $names = array_keys($guest);
  foreach($names as $name) {
    $guest[$name] = test_input($_POST[$name], $name, $errors, $error_messages);
  }

  if (!empty($guest['name']) && !empty($guest['email']) && !empty($guest['comment'])) {
    $model = $app['model'];
    $guestID = $model->create($guest);
    $guest = $model->read($guestID);
    $message = 'Just created a new guest!<br><pre>' . print_r($guest, true) . '</pre>';
  }

}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Guestbook</title>

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
      <div class="row">
        <div class="col-md-2"><h2>Guestbook</h2></div>
        <div class="col-md-4"><h2><a href="viewguestbook.php"> View Guestbook</a></h2></div>
      </div>


      <form class="form-horizontal" action="guestbook.php" method="post">

        <div class="form-group">
          <label for="inputName" class="col-sm-2 control-label">Name</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" name="name" placeholder="Name">
          </div>
          <div class="col-sm-4 text-danger">
            <?php echo $errors['name']; ?>
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-6">
            <input type="email" class="form-control" name="email" placeholder="Email">
          </div>
          <div class="col-sm-4 text-danger">
            <?php echo $errors['email']; ?>
          </div>
        </div>

        <div class="form-group">
          <label for="inputEmail" class="col-sm-2 control-label">Comment</label>
          <div class="col-sm-6">
            <textarea name="comment" class="form-control" rows="3" placeholder="Comment"></textarea>
          </div>
          <div class="col-sm-4 text-danger">
            <?php echo $errors['comment']; ?>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>

      <p class="lead">
        <?php echo $message; ?>
      </p>

    </div>

	</body>
</html
