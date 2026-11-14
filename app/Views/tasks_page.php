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
        <a href="<?= base_url('/profile') ?>">Profile</a> | 
        <a href="<?= base_url('/about') ?>">About</a> | 
        <?php if (session()->get('isLoggedIn')): ?>
            <a href="<?= base_url('/tasks/new') ?>">+ New Task</a> | 
            <a href="<?= base_url('/logout') ?>">Logout (<?= esc(session()->get('username')) ?>)</a>
        <?php else: ?>
            <a href="<?= base_url('/login') ?>">Login</a>
        <?php endif; ?>
    </nav>
    <hr>

    <h1><?= $title ?></h1>

    <?php if (session()->get('isLoggedIn')): ?>
        <p><a href="<?= base_url('/tasks/new') ?>">+ Add New Task</a></p>
    <?php endif; ?>

    <table border="1" cellpadding="8">
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Status</th>
            <?php if (session()->get('isLoggedIn')): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= esc($task['title']) ?></td>
                <td><?= esc($task['task_date']) ?></td>
                <td><?= esc($task['status']) ?></td>
                <?php if (session()->get('isLoggedIn')): ?>
                    <td>
                        <a href="<?= base_url('/tasks/edit/' . $task['id']) ?>">Edit</a>
                        <form action="<?= base_url('/tasks/delete/' . $task['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Archive this task?');">
                            <?= csrf_field() ?>
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
