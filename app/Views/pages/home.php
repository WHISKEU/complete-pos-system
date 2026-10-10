<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SimplePOS | Home</title>

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

<main class="home-container">

    <section class="hero-section">
        <p class="hero-label">SimplePOS</p>

        <h1>Complete Point-of-Sale Management System</h1>

        <p class="hero-description">
            Manage customers, staff accounts, products,
            inventory, and sales transactions in one secure system.
        </p>

        <?php if (session()->get('isLoggedIn')): ?>
            <a
                class="primary-button"
                href="<?= site_url('sales/new') ?>"
            >
                Record a Sale
            </a>
        <?php else: ?>
            <a
                class="primary-button"
                href="<?= site_url('login') ?>"
            >
                Staff Login
            </a>
        <?php endif; ?>
    </section>

    <?php if (session()->get('isLoggedIn')): ?>
        <section class="feature-grid">
            <a
                class="feature-card"
                href="<?= site_url('customers') ?>"
            >
                <h2>Customers</h2>
                <p>View and manage customer records.</p>
            </a>

            <a
                class="feature-card"
                href="<?= site_url('users') ?>"
            >
                <h2>Staff Accounts</h2>
                <p>Manage staff profiles and passwords.</p>
            </a>

            <a
                class="feature-card"
                href="<?= site_url('products') ?>"
            >
                <h2>Products</h2>
                <p>Manage product prices, images, and stock.</p>
            </a>

            <a
                class="feature-card"
                href="<?= site_url('sales') ?>"
            >
                <h2>Sales History</h2>
                <p>Review recorded sales transactions.</p>
            </a>
        </section>
    <?php endif; ?>

</main>

</body>
</html>