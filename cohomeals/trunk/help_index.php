<?php
	include_once 'includes/init.php';
	print_header('','','',true);
?>

<h2>Help Index</h2>

<b>Software help topics:</b>
<ul>
  <li><a href="help_view.php">Viewing available meal times and details</a></li>
  <li><a href="help_eat.php">Signing up or canceling dining</a></li>
  <li><a href="help_work.php">Signing up or canceling working</a></li>
  <li><a href="help_financial.php">Financial log</a></li>
  <li><a href="help_user.php">Viewing and changing user info</a></li>
  <li><a href="help_add_meal.php">Add or edit meal</a></li>
  <?php if ( $is_meal_coordinator ) { ?>
    <li><a href="help_add_user.php">Add or edit user</a></li>
  <?php } ?>
</ul>

<b>Resources:</b>
<ul>
  <li><a href="MealPlanDesignV1.pdf">Meal plan design</a></li>
</ul>

<b>Quick tips:</b>
<ul>
  <li>To log out, click the "Logout" link at the bottom of the page trailers.</li>
  <li>The main navigation buttons are at the bottom of each page.</li>
  <li>You can locate links since they are colored blue when you roll your mouse over them.</li>
</ul>

<?php include_once "includes/help_trailer.php"; ?>
</body>
</html>
