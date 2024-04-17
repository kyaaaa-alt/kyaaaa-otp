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
            <h2>Verifikasi</h2>
        </div>
        <form name="verify">
            <div class="card-body">
                <p>Name : <?= esc($user->name) ?></p>
                <p>Status : <?= esc($user->status) == 1 ? 'Verified' : 'Unverified' ?></p>
                <?php if (esc($user->status) == 0) { ?>
                <label for="name">OTP</label>
                <input type="text" id="otp" name="otp" required>
                <?php } ?>
            </div>
            <?php if (esc($user->status) == 0) { ?>
            <div class="card-footer">
                <button type="submit">Verify</button>
            </div>
            <?php } else { ?>

            <div class="card-footer">
                <a type="button" href="<?= base_url('destroy') ?>">Destroy Session</a>
            </div>

            <?php } ?>
        </form>
    </div>
    <script src="<?= base_url('assets/global/') ?>jquery-3.7.1.min.js"></script>
    <script src="<?= base_url('assets/global/') ?>sweetalert2.min.js"></script>
    <script>
        $('form[name="verify"]').on('submit', function(e) {
            e.preventDefault();
            if ($('#otp').val() == '') {
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
                url: '<?= base_url('verify') ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        }).then((result) => {
                            location.reload()
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            text: 'OTP Salah/Kadaluarsa',
                        })
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        text: 'OTP Salah/Kadaluarsa',
                    })
                }
            })
        })
    </script>
</body>
</html>
