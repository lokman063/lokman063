<?php


?>
<!doctype html>
<html lang="en">

<?php include_once($_SERVER['DOCUMENT_ROOT'].'/phpcrud/admin/views/elements/head.php');?>
<body>
<?php //include_once($_SERVER['DOCUMENT_ROOT'].'/phpcrud/admin/views/elements/header.php'); ?>
<main role="main">
<div class="container marketing">
        <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->

    <form method="post" action="controll.php" role="form">
      <input type="email" id="email" class="fadeIn second" name="email" placeholder="login">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <button type="submit"> Login</button>
      </form>
 

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>

  </div>
</div>
    </div>

</main>
<?php include_once($_SERVER['DOCUMENT_ROOT'].'/phpcrud/admin/views/elements/scripts.php'); ?>
</body>
</html>