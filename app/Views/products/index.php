<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SimplePOS | Products</title>

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

<main class="container">

    <div class="page-header">
        <h1>Product Management</h1>

        <a href="<?= site_url('products/new') ?>" class="btn-add">
            + Add New Product
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="success-message">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="6">No products found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td>
                                <?php if (! empty($product['image'])): ?>
                                    <img
                                        src="<?= base_url(
                                            'uploads/products/'
                                            . $product['image']
                                        ) ?>"
                                        alt="<?= esc($product['name']) ?>"
                                        class="product-image"
                                    >
                                <?php else: ?>
                                    <div class="product-placeholder">
                                        No image
                                    </div>
                                <?php endif; ?>
                            </td>

                            <td><?= esc($product['name']) ?></td>

                            <td>
                                ₱<?= number_format(
                                    (float) $product['price'],
                                    2
                                ) ?>
                            </td>

                            <td>
                                <?= esc((string) $product['stock_quantity']) ?>
                            </td>

                            <td><?= esc($product['created_at']) ?></td>

                            <td class="action-buttons">
                                <a
                                    href="<?= site_url(
                                        'products/edit/' . $product['id']
                                    ) ?>"
                                    class="btn-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="<?= site_url(
                                        'products/delete/' . $product['id']
                                    ) ?>"
                                    method="post"
                                    onsubmit="return confirm(
                                        'Delete this product?'
                                    );"
                                >
                                    <?= csrf_field() ?>

                                    <button type="submit" class="btn-delete">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</main>

</body>
</html>