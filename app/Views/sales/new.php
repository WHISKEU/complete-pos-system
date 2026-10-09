<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SimplePOS | Record Sale</title>

    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<nav>
    <a href="<?= site_url('/') ?>">Home</a>
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

    <h1>Record Sale</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="error-message">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('sales') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="product_id">Product</label>

            <select id="product_id" name="product_id" required>
                <option value="">Select a product</option>

                <?php foreach ($products as $product): ?>
                    <option
                        value="<?= esc($product['id']) ?>"
                        <?= old('product_id') == $product['id']
                            ? 'selected'
                            : '' ?>
                    >
                        <?= esc($product['name']) ?>
                        — ₱<?= number_format(
                            (float) $product['price'],
                            2
                        ) ?>
                        — Stock: <?= esc($product['stock_quantity']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="error">
                <?= validation_show_error('product_id') ?>
            </div>
        </div>

        <div class="form-group">
            <label for="customer_id">
                Customer <small>(Optional)</small>
            </label>

            <select id="customer_id" name="customer_id">
                <option value="">Walk-in customer</option>

                <?php foreach ($customers as $customer): ?>
                    <option
                        value="<?= esc($customer['id']) ?>"
                        <?= old('customer_id') == $customer['id']
                            ? 'selected'
                            : '' ?>
                    >
                        <?= esc($customer['full_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="error">
                <?= validation_show_error('customer_id') ?>
            </div>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>

            <input
                type="number"
                id="quantity"
                name="quantity"
                value="<?= esc(old('quantity'), 'attr') ?>"
                min="1"
                required
            >

            <div class="error">
                <?= validation_show_error('quantity') ?>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit">Record Sale</button>

            <a href="<?= site_url('sales') ?>" class="btn-cancel">
                Cancel
            </a>
        </div>
    </form>

</main>

</body>
</html>