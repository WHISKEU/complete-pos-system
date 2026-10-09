<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SimplePOS | Login</title>

    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

    <main class="form-container">
        <h1>SimplePOS Login</h1>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('login') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="username">Username</label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="<?= esc(old('username'), 'attr') ?>"
                    required
                >

                <div class="error">
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
                >

                <div class="error">
                    <?= validation_show_error('password') ?>
                </div>
            </div>

            <button type="submit">Log In</button>
        </form>
    </main>

</body>
</html>