<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SimplePOS | About</title>

    <link
        rel="stylesheet"
        href="<?= base_url('css/style.css') ?>"
    >
</head>
<body>

<nav>
    <a href="<?= site_url('/') ?>">Home</a>
    <a href="<?= site_url('about') ?>">About</a>

    <?php if (session()->get('isLoggedIn')): ?>
        <a href="<?= site_url('customers') ?>">Customers</a>
        <a href="<?= site_url('users') ?>">Users</a>
        <a href="<?= site_url('products') ?>">Products</a>
        <a href="<?= site_url('sales') ?>">Sales</a>

        <span class="nav-user">
            Logged in as
            <?= esc((string) session()->get('username')) ?>
        </span>

        <a href="<?= site_url('logout') ?>">Logout</a>
    <?php else: ?>
        <a class="nav-login" href="<?= site_url('login') ?>">
            Login
        </a>
    <?php endif; ?>
</nav>

<main class="about-container">

    <section class="about-header">
        <p class="hero-label">About the project</p>

        <h1>About SimplePOS</h1>

        <p>
            SimplePOS is a CodeIgniter 4 Point-of-Sale system
            designed to help staff manage customers, user accounts,
            products, inventory, and sales transactions.
        </p>
    </section>

    <section class="about-grid">
        <article class="about-card">
            <h2>Account Management</h2>

            <p>
                Staff can manage customer and user records using
                validated create and edit forms.
            </p>
        </article>

        <article class="about-card">
            <h2>Product and Inventory</h2>

            <p>
                Products include prices, stock quantities, and
                prepared display images.
            </p>
        </article>

        <article class="about-card">
            <h2>Sales Management</h2>

            <p>
                Staff can record transactions, prevent excessive
                quantities, reduce inventory, and view sales history.
            </p>
        </article>

        <article class="about-card">
            <h2>Security</h2>

            <p>
                Management pages require staff authentication,
                passwords are securely hashed, and uploaded files
                are validated.
            </p>
        </article>
    </section>

</main>

</body>
</html>