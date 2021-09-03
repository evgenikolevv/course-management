<?php require_once VIEW_ROOT . '/partials/header.php'; ?>

<h1>Login</h1>

<form class="form-body" action="<?php APP_ROOT ?>login" method="POST">
  <div class="form-group">
    <label for="exampleInputUsername">Username</label>
    <input type="text" class="form-control" id="username" name = "username"  placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword" name = "password" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php if (isset($data['error'])) : ?>
            <h4 class="danger"><?= $data['error'] ?></h3>
        <?php endif; ?>


<?php require_once VIEW_ROOT . '/partials/footer.php'; ?>