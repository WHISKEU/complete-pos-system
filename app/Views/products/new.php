<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SimplePOS | Add Product</title>

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

<main class="form-container">

    <h1>Add New Product</h1>

    <form
        action="<?= site_url('products') ?>"
        method="post"
        enctype="multipart/form-data"
    >
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="name">Product Name</label>

            <input
                type="text"
                id="name"
                name="name"
                value="<?= esc(old('name'), 'attr') ?>"
                maxlength="100"
                required
            >

            <div class="error">
                <?= validation_show_error('name') ?>
            </div>
        </div>

        <div class="form-group">
            <label for="price">Price</label>

            <input
                type="number"
                id="price"
                name="price"
                value="<?= esc(old('price'), 'attr') ?>"
                min="0"
                step="0.01"
                required
            >

            <div class="error">
                <?= validation_show_error('price') ?>
            </div>
        </div>

        <div class="form-group">
            <label for="stock_quantity">Stock Quantity</label>

            <input
                type="number"
                id="stock_quantity"
                name="stock_quantity"
                value="<?= esc(old('stock_quantity'), 'attr') ?>"
                min="0"
                step="1"
                required
            >

            <div class="error">
                <?= validation_show_error('stock_quantity') ?>
            </div>
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>

            <input
                type="file"
                id="image"
                name="image"
                accept=".jpg,.jpeg,.png"
            >

            <small>Optional. JPG or PNG only, maximum 2 MB.</small>

            <div class="error">
                <?= validation_show_error('image') ?>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit">Save Product</button>

            <a href="<?= site_url('products') ?>" class="btn-cancel">
                Cancel
            </a>
        </div>
    </form>

</main>

</body>
</html>