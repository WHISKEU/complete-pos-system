<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SimplePOS | Edit User</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <nav>
        <a href="<?= site_url('/') ?>">Home</a>
        <a href="<?= site_url('about') ?>">About</a>
        <a href="<?= site_url('customers') ?>">Customers</a>
        <a href="<?= site_url('users') ?>">Users</a>
    <span class="nav-user">
        Logged in as <?= esc((string) session()->get('username')) ?>
    </span>

    <a href="<?= site_url('logout') ?>">Logout</a>
    </nav>

    <h1>Edit User</h1>

    <form
        method="post"
        action="<?= site_url('users/' . $user['id']) ?>"
        enctype="multipart/form-data"
    >
        <?= csrf_field() ?>

        <div>
            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                maxlength="50"
                value="<?= esc(old('username', $user['username']), 'attr') ?>"
            >
            <div>
                <?= validation_show_error('username') ?>
            </div>
        </div>

        <div>
            <label for="full_name">Full Name</label>
            <input
                type="text"
                id="full_name"
                name="full_name"
                maxlength="100"
                value="<?= esc(old('full_name', $user['full_name']), 'attr') ?>"
            >
            <div>
                <?= validation_show_error('full_name') ?>
            </div>
        </div>

        <div>
            <label for="avatar">Profile Picture</label>
            <input
                type="file"
                id="avatar"
                name="avatar"
                accept=".jpg,.jpeg,.png,image/jpeg,image/png"
            >
            <p>JPG or PNG only. Maximum size: 2 MB.</p>
            <div>
                <?= validation_show_error('avatar') ?>
            </div>
        </div>

        <button type="submit">Update User</button>
        <a href="<?= site_url('users') ?>">Cancel</a>
    </form>
</body>
</html>