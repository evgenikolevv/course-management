<?php require_once VIEW_ROOT . '/partials/header.php'; ?>

<h1>My Courses</h1>

<?php if (isset($data['courses'])) : ?>
    <h3 class="form-title">Results: </h3>
    <table class="table">
        <thead>
            <th>Id</th>
            <th>Course Name</th>
            <th>Added at</th>
            <th>Updated at</th>
            <th>Creator's id</th>
        </thead>
        <tbody>
            <?php foreach ($data['courses'] as $course) : ?>
                <form  action="<?php APP_ROOT ?>mycourses" method="POST">
                <tr class="table-row">
                    <td class="table-cell">
                        <input type="hidden" value="<?= $course['id'] ?>" name="course_id"><?= $course['id'] ?>
                    </td>
                    <td class="table-cell">
                        <?= $course['name'] ?>
                    </td>
                    <td class="table-cell">
                        <?= $course['created_at'] ?>
                    </td>
                    <td class="table-cell">
                        <?= $course['updated_at'] ?>
                    </td>
                    <td class="table-cell">
                        <?= $course['user_id'] ?>
                    </td>
                    <td class="table-cell">
                        <input type="submit" value = "delete" class="button btn btn-primary">
                    </td>
                </tr>
            </form>
            <?php endforeach; ?>
        </tbody>
    </table>
    </form>
<?php endif; ?>

<?php if (isset($data['error'])) : ?>
    <h4 class="danger"><?= $data['error'] ?></h3>
<?php endif; ?>

<?php if (isset($data['message'])) : ?>
    <h4 class="danger"><?= $data['message'] ?></h3>
<?php endif; ?>

<?php require_once VIEW_ROOT . '/partials/footer.php'; ?>