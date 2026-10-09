<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SimplePOS | Sales History</title>

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

<main class="accounts-container">

    <div class="accounts-header">
        <h1>Sales History</h1>

        <a class="add-button" href="<?= site_url('sales/new') ?>">
            + Record Sale
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
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Staff</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                <?php if (empty($sales)): ?>
                    <tr>
                        <td colspan="6">No sales recorded yet.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($sales as $sale): ?>
                        <tr>
                            <td><?= esc($sale['product_name']) ?></td>

                            <td>
                                <?= esc(
                                    $sale['customer_name']
                                    ?? 'Walk-in customer'
                                ) ?>
                            </td>

                            <td><?= esc($sale['staff_name']) ?></td>

                            <td><?= esc((string) $sale['quantity']) ?></td>

                            <td>
                                ₱<?= number_format(
                                    (float) $sale['total_price'],
                                    2
                                ) ?>
                            </td>

                            <td><?= esc($sale['created_at']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</main>

</body>
</html>