<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SimplePOS | Edit User</title>

    <link
        rel="stylesheet"
        href="<?= base_url('css/style.css') ?>"
    >
</head>
<body>

<nav>
    <a href="<?= site_url('/') ?>">Home</a>
    <a href="<?= site_url('about') ?>">About</a>
    <a href="<?= site_url('customers') ?>">Customers</a>
    <a href="<?= site_url('users') ?>">Users</a>
    <a href="<?= site_url('products') ?>">Products</a>
    <a href="<?= site_url('sales') ?>">Sales</a>

    <span class="nav-user">
        Logged in as
        <?= esc((string) session()->get('username')) ?>
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

    <div class="form-group">
        <label for="username">Username</label>

        <input
            type="text"
            id="username"
            name="username"
            maxlength="50"
            value="<?= esc(
                old('username', $user['username']),
                'attr'
            ) ?>"
            required
        >

        <div class="error">
            <?= validation_show_error('username') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="full_name">Full Name</label>

        <input
            type="text"
            id="full_name"
            name="full_name"
            maxlength="100"
            value="<?= esc(
                old('full_name', $user['full_name']),
                'attr'
            ) ?>"
            required
        >

        <div class="error">
            <?= validation_show_error('full_name') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="password">New Password</label>

        <input
            type="password"
            id="password"
            name="password"
            minlength="8"
            maxlength="255"
            autocomplete="new-password"
        >

        <small>
            Leave blank to keep the current password.
            A new password must contain at least 8 characters.
        </small>

        <div class="error">
            <?= validation_show_error('password') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="password_confirm">
            Confirm New Password
        </label>

        <input
            type="password"
            id="password_confirm"
            name="password_confirm"
            minlength="8"
            maxlength="255"
            autocomplete="new-password"
        >

        <div class="error">
            <?= validation_show_error('password_confirm') ?>
        </div>
    </div>

    <div class="form-group">
        <label for="avatar">Profile Picture</label>

        <input
            type="file"
            id="avatar"
            name="avatar"
            accept=".jpg,.jpeg,.png,image/jpeg,image/png"
        >

        <small>
            Leave blank to keep the current picture.
            JPG or PNG only, maximum 2 MB.
        </small>

        <div class="error">
            <?= validation_show_error('avatar') ?>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit">Update User</button>

        <a href="<?= site_url('users') ?>" class="btn-cancel">
            Cancel
        </a>
    </div>
</form>

</body>
</html>