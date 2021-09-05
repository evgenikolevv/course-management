<?php require_once VIEW_ROOT . '/partials/header.php'; ?>

<div class="form">
  <h1>Login</h1>
  <form class="form-body" action="<?php APP_ROOT ?>login" method="POST">
    <div class="form-group">
      <input type="text" class="form-control" id="username" name = "username"  placeholder="Enter username">
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="exampleInputPassword" name = "password" placeholder="Password">
    </div>
    <button type="submit" class="button btn btn-primary">Login</button>
    <span>or <a href="<?php APP_ROOT?>register">Register</a></span>
  </form>
</div>

<?php if (isset($data['error'])) : ?>
            <h4 class="danger"><?= $data['error'] ?></h3>
        <?php endif; ?>


<?php require_once VIEW_ROOT . '/partials/footer.php'; ?>