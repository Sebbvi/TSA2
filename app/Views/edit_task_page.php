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

    <h1>Edit Task</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <form action="<?= base_url('/tasks/update/' . $task['id']) ?>" method="post">
        <?= csrf_field() ?>
        <p>
            <label>Task Title (Required):</label><br>
            <input type="text" name="title" value="<?= esc($task['title']) ?>" required>
        </p>
        <p>
            <label>Task Date (Required):</label><br>
            <input type="date" name="task_date" value="<?= esc($task['task_date']) ?>" required>
        </p>
        <p>
            <label>Status:</label><br>
            <select name="status">
                <option value="pending" <?= $task['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="completed" <?= $task['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
            </select>
        </p>
        <button type="submit">Update Task</button>
        <a href="<?= base_url('/tasks') ?>">Cancel</a>
    </form>
</body>
</html>
