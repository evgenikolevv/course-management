<?php require_once VIEW_ROOT . '/partials/header.php'; ?>

<h1>Register</h1>

<form class="form-body" action="<?php APP_ROOT ?>register" method="POST">
  <div class="form-group">
    <label for="exampleInputUsername">Username</label>
    <input type="text" class="form-control" id="username" name = "username"  placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name = "password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputFirstName">First Name</label>
    <input type="text" class="form-control" id="firstname" name = "firstname"  placeholder="Enter first name">
  </div>
  <div class="form-group">
    <label for="exampleInputLastName">Last Name</label>
    <input type="text" class="form-control" id="lastname" name = "lastname"  placeholder="Enter last name">
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>

<?php if (isset($data['error'])) : ?>
            <h4 class="danger"><?= $data['error'] ?></h3>
        <?php endif; ?>

<?php require_once VIEW_ROOT . '/partials/footer.php'; ?>