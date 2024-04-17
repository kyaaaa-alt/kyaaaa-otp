<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="<?= base_url('assets/global/') ?>sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <?= view('components/styles') ?>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h2>Registration</h2>
        </div>
        <form name="register">
            <div class="card-body">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="phone">Username</label>
                    <input type="username" id="username" name="username" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>

            </div>
            <div class="card-footer">
                <button type="submit">Register</button>
            </div>
        </form>
    </div>
    <script src="<?= base_url('assets/global/') ?>jquery-3.7.1.min.js"></script>
    <script src="<?= base_url('assets/global/') ?>sweetalert2.min.js"></script>
    <script>
        
    </script>
</body>
</html>
