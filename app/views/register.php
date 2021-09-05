<?php require_once VIEW_ROOT . '/partials/header.php'; ?>

<h1>Register</h1>

<form class="form-body" action="<?php APP_ROOT ?>register" method="POST">
  <div class="form-group">
    <input type="text" class="form-control" id="username" name = "username"  placeholder="Enter username">
  </div>
  <div class="form-group">
    <input type="password" class="form-control" id="exampleInputPassword1" name = "password" placeholder="Password">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="firstname" name = "firstname"  placeholder="Enter first name">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" id="lastname" name = "lastname"  placeholder="Enter last name">
  </div>
  <button type="submit" class="button btn btn-primary">Register</button>
  <span>or <a href="<?php APP_ROOT?>login">Login</a></span>
</form>

<?php if (isset($data['error'])) : ?>
            <h4 class="danger"><?= $data['error'] ?></h3>
        <?php endif; ?>

<?php require_once VIEW_ROOT . '/partials/footer.php'; ?>