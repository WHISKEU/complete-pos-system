<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SimplePOS | Customer Accounts</title>
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

    <main class="accounts-container">
        <div class="accounts-header">
            <h1>Customer Accounts</h1>

            <a class="add-button" href="<?= site_url('customers/new') ?>">
                + Add New Customer
            </a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <p class="success-message">
                <?= esc(session()->getFlashdata('success')) ?>
            </p>
        <?php endif; ?>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?= esc($customer['full_name']) ?></td>
                            <td><?= esc($customer['email']) ?></td>
                            <td><?= esc($customer['phone']) ?></td>
                            <td>
                                <a
                                    class="edit-button"
                                    href="<?= site_url(
                                        'customers/' . $customer['id'] . '/edit'
                                    ) ?>"
                                >
                                    Edit
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>