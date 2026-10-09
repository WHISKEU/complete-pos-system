<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SimplePOS | User Accounts</title>
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

    <main class="accounts-container">
        <div class="accounts-header">
            <h1>User Accounts</h1>

            <a class="add-button" href="<?= site_url('users/new') ?>">
                + Add New User
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
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $user): ?>
                        <?php
                            $avatar = $user['avatar'] ?? '';

                            if (
                                $avatar !== ''
                                && is_file(
                                    FCPATH . 'uploads/avatars/' . $avatar
                                )
                            ) {
                                $avatarUrl = base_url(
                                    'uploads/avatars/' . $avatar
                                );
                            } else {
                                $avatarUrl = base_url(
                                    'uploads/avatars/default-avatar.svg'
                                );
                            }
                        ?>

                        <tr>
                            <td>
                                <img
                                    class="user-avatar"
                                    src="<?= esc($avatarUrl, 'attr') ?>"
                                    alt="<?= esc(
                                        $user['full_name'],
                                        'attr'
                                    ) ?> avatar"
                                >
                            </td>

                            <td><?= esc($user['username']) ?></td>
                            <td><?= esc($user['full_name']) ?></td>
                            <td><?= esc($user['created_at']) ?></td>

                            <td>
                                <a
                                    class="edit-button"
                                    href="<?= site_url(
                                        'users/' . $user['id'] . '/edit'
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