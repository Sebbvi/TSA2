<!DOCTYPE html>
<html lang="en">
<head>
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

    <h1>Tasks for Today (<?= date('F j, Y') ?>)</h1>

    <?php if (!empty($tasks) && is_array($tasks)): ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Task ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <?php if (session()->get('isLoggedIn')): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task['id'] ?></td>
                        <td><?= esc($task['title']) ?></td>
                        <td><strong><?= esc($task['status']) ?></strong></td>
                        <?php if (session()->get('isLoggedIn')): ?>
                            <td>
                                <a href="<?= base_url('/tasks/edit/' . $task['id']) ?>">Edit</a> | 
                                <form action="<?= base_url('/tasks/delete/' . $task['id']) ?>" method="post" style="display:inline;" onsubmit="return confirm('Archive this task?');">
                                    <?= csrf_field() ?>
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No tasks scheduled for today!</p>
    <?php endif; ?>
</body>
</html>
