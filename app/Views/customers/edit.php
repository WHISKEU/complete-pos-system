<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SimplePOS | Edit Customer</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <nav>
        <a href="<?= site_url('/') ?>">Home</a>
        <a href="<?= site_url('about') ?>">About</a>
        <a href="<?= site_url('customers') ?>">Customers</a>
        <a href="<?= site_url('users') ?>">Users</a>
        <a href="<?= site_url('products') ?>">Products</a>
    <span class="nav-user">
        Logged in as <?= esc((string) session()->get('username')) ?>
    </span>

    <a href="<?= site_url('logout') ?>">Logout</a>
    </nav>

    <h1>Edit Customer</h1>

    <form
        method="post"
        action="<?= site_url('customers/' . $customer['id']) ?>"
    >
        <?= csrf_field() ?>

        <div>
            <label for="full_name">Full Name</label>
            <input
                type="text"
                id="full_name"
                name="full_name"
                value="<?= esc(old('full_name', $customer['full_name']), 'attr') ?>"
            >
            <div>
                <?= validation_show_error('full_name') ?>
            </div>
        </div>

        <div>
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="<?= esc(old('email', $customer['email']), 'attr') ?>"
            >
            <div>
                <?= validation_show_error('email') ?>
            </div>
        </div>

        <div>
            <label for="phone">Phone</label>
            <input
                type="tel"
                id="phone"
                name="phone"
                inputmode="numeric"
                maxlength="11"
                pattern="09[0-9]{9}"
                placeholder="09XXXXXXXXX"
                value="<?= esc(old('phone', $customer['phone']), 'attr') ?>"
            >
            <div>
                <?= validation_show_error('phone') ?>
            </div>
        </div>

        <button type="submit">Update Customer</button>
        <a href="<?= site_url('customers') ?>">Cancel</a>
    </form>
</body>
</html>