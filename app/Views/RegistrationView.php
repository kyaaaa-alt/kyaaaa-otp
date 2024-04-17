<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <?= view('components/styles') ?>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h2>Register</h2>
        </div>
        <div class="card-body">
            <form>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Username</label>
                <input type="username" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </form>
        </div>
        <div class="card-footer">
            <button>Save</button>
        </div>
    </div>
</body>
</html>
