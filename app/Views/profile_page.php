<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body>
    <nav>
        <a href="<?= base_url('/') ?>">Welcome</a> | 
        <a href="<?= base_url('/tasks') ?>">All Tasks</a> | 
        <a href="<?= base_url('/profile') ?>">Profile</a> | 
        <a href="<?= base_url('/about') ?>">About</a>
    </nav>
    <hr>

    <h1>Demo User Details</h1>

    <?php if (!empty($user)): ?>
        <ul>
            <li><strong>User ID:</strong> <?= $user['id'] ?></li>
            <li><strong>Username:</strong> <?= esc($user['username']) ?></li>
            <li><strong>Full Name:</strong> <?= esc($user['full_name']) ?></li>
            <li><strong>Email Address:</strong> <?= esc($user['email']) ?></li>
            <li><strong>Created At:</strong> <?= $user['created_at'] ?></li>
        </ul>
    <?php else: ?>
        <p>Demo user entry missing. Ensure database seeding is run.</p>
    <?php endif; ?>
</body>
</html>
