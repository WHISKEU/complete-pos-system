<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SimplePOS | New User</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
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
        Logged in as <?= esc((string) session()->get('username')) ?>
    </span>

    <a href="<?= site_url('logout') ?>">Logout</a>
    </nav>

    <h1>New User</h1>

    <form method="post" action="<?= site_url('users') ?>">
        <?= csrf_field() ?>

        <div>
            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                maxlength="50"
                value="<?= esc(old('username'), 'attr') ?>"
            >
            <div>
                <?= validation_show_error('username') ?>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                required
                minlength="8"
            >

            <?php if (session('errors.password')): ?>
                <div class="error">
                    <?= esc(session('errors.password')) ?>
                    <?= csrf_field() ?>
                </div>
            <?php endif; ?>
        </div>
        <div>
            <label for="full_name">Full Name</label>
            <input
                type="text"
                id="full_name"
                name="full_name"
                maxlength="100"
                value="<?= esc(old('full_name'), 'attr') ?>"
            >
            <div>
                <?= validation_show_error('full_name') ?>
            </div>
        </div>

        <button type="submit">Add User</button>
        <a href="<?= site_url('users') ?>">Cancel</a>
    </form>
</body>
</html>