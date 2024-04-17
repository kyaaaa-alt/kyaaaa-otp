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

                <label for="phone">Whatsapp</label>
                <input type="text" id="whatsapp" name="whatsapp" required>

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
        $('form[name="register"]').on('submit', function(e) {
            e.preventDefault();
            if ($('#name').val() == '' || $('#email').val() == '' || $('#username').val() == '' || $('#password').val() == '') {
                Swal.fire({
                    icon: 'error',
                    text: 'Semua Input Harus Diisi',
                })
                return
            }
            Swal.fire({
                title: 'Loading...',
                didOpen: () => {
                    Swal.showLoading()
                }
            })
            $.ajax({
                url: '<?= base_url('submit') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registrasi Berhasil',
                            text: response.message
                        }).then((result) => {
                            location.href = '<?= base_url('verify') ?>'
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: 'Registrasi Gagal',
                        })
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        text: 'Registrasi Gagal',
                    })
                }
            })
        })
    </script>
</body>
</html>
