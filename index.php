<?php

	require_once 'app/init.php';

	$itemsQuery = $db->prepare("
		SELECT id, name, done
		FROM items
		WHERE user = :user
	");

	$itemsQuery->execute([
		'user' => $_SESSION['user_id']
	]);

	$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="shortcut icon" type="img/favicon.png" href="http://localhost/todo/img/favicon.png"/>
		<title>ToDo List</title>

		<link href="http://fonts.googleapis.com/css?family=Shadows+Into+Light+Two" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

		<link rel="stylesheet" href="<?php testParsing(); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<img class="#" src="http://localhost/todo/img/1.png" alt="BAUST" style="width:1360px;height:180px;">
		<div class="list">
			<center> <h1 class="header"> .. To Do ..</h1> </center>

			<?php if(!empty($items)): ?>
			<ul class="items">
				<?php foreach($items as $item): ?>
				<li>
					<span class="item<?php echo $item['done'] ? ' done' : ''?>"> <?php echo parse($item['name']); ?></span>
					<a class="delete-button" href="mark.php?as=delete&item=<?php echo $item['id']; ?>">Delete</a>
					<?php if(!$item['done']): ?> 
						<a class="done-button" href="mark.php?as=done&item=<?php echo $item['id']; ?>">Mark as done</a>
					<?php else: ?>
						<a class="undone-button" href="mark.php?as=undone&item=<?php echo $item['id']; ?>">Mark as undone</a>						
					<?php endif; ?>
				</li>
				<?php endforeach; ?>
			</ul>
			<?php else: ?>
				<p>You haven't added any items yet.</p>
			<?php endif; ?>

			<form class="item-add" action="add.php" method="POST">
				<input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" maxlength="30" required>
				<input type="submit" value="Add" class="submit">
			</form>

		</div>
		
		<footer>
            <center><p>Copyright &copy; <a href="https://www.facebook.com/x.3xp1r3.x">Fahmid Hasan Anabi</a> || ToDO List</p></center>
        </footer>
		
	</div>

	</body>

</html>