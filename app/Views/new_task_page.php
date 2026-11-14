<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <nav>
        <a href="<?= base_url('/') ?>">Welcome</a> | 
        <a href="<?= base_url('/tasks') ?>">All Tasks</a> | 
        <a href="<?= base_url('/logout') ?>">Logout</a>
    </nav>
    <hr>

    <h1>Add New Task</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <form action="<?= base_url('/tasks/create') ?>" method="post">
        <?= csrf_field() ?>
        <p>
            <label>Task Title (Required):</label><br>
            <input type="text" name="title" value="<?= old('title') ?>" required>
        </p>
        <p>
            <label>Task Date (Required):</label><br>
            <input type="date" name="task_date" value="<?= old('task_date') ?>" required>
        </p>
        <p>
            <label>Status:</label><br>
            <select name="status">
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>
        </p>
        <button type="submit">Save Task</button>
        <a href="<?= base_url('/tasks') ?>">Cancel</a>
    </form>
</body>
</html>
