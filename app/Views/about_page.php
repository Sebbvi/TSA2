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

    <h1>Developer Information</h1>
    <p>This system was built for IT0049 - Web System Technologies.</p>
    
    <h3>Developer Profile:</h3>
    <ul>
        <li><strong>Name:</strong> John Sebastian Dalag</li>
        <li><strong>Student Number:</strong> 202310928</li>
        <li><strong>Course / Section:</strong> BSIT / TC31</li>
    </ul>
</body>
</html>
