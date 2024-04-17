<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="<?= base_url('assets/global/') ?>sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('assets/global/') ?>qrious.js"></script>
    <?= view('components/styles') ?>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h2>Whatsapp</h2>
        </div>
        <div class="card-body">
            <div class="text-center">
                <div id="connected" style="display: none">
                    <h1 style="font-size: 100px;" class="text-primary"><i class="fa fa-check-circle"></i> </h1>
                    <h5><span class="badge bg-primary text-white font-weight-light">Notifikasi Whatsapp Online!</span></h5>
                </div>
                <div id="mb-10 mx-auto">
                    <h5><span class="badge bg-primary text-white font-weight-light" id="state">Loading...</span></h5>
                    <canvas id="qr" style="display: hidden;"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/global/') ?>jquery-3.7.1.min.js"></script>
    <script src="<?= base_url('assets/global/') ?>sweetalert2.min.js"></script>
    <script>
        const getQR = setInterval(() => {
            $('#qr').hide();
            $('#connected').hide();
            fetch('<?= base_url("qr") ?>', {
                Method: 'GET',
            })
                .then((response) => response.json())
                .then((result) => {
                    if (result.message == 'Disabled') {
                        if (getQR) clearInterval(getQR);
                        $('#qr').hide();
                        $('#state').html('Disabled');
                        $('#connected').hide();
                        $('#qr').hide();
                        $('#state').html(result.message);
                        if (getQR) clearInterval(getQR);
                    } else {
                        $('#state').html('Loading...');
                    }
                    if (!result.error) {
                        if (result.message == 'connected') {
                            $('#qr').hide();
                            $('#state').hide();
                            $('#connected').show();
                            if (getQR) clearInterval(getQR);
                        }
                        if (result.message == 'loading') {
                            $('#qr').hide();
                            $('#state').html('Loading...');
                            $('#connected').hide();
                        }
                        if (result.message == 'QR String fetched successfully') {
                            $('#qr').show();
                            var qrcode = new QRious({
                                element: document.getElementById('qr'),
                                level: 'H',
                                size: 250,
                                value: result.qr
                            });
                            qrcode.set({
                                level: 'H',
                                size: 250,
                                value: result.qr
                            });
                            $('#state').html('Scan Whatsapp QR');
                            $('#connected').hide();
                        }
                    } else {
                        if (result.message == 'Server not running') {
                            if (getQR) clearInterval(getQR);
                            $('#qr').hide();
                            $('#state').html('Server not running');
                            $('#connected').hide();
                        }
                        if (result.message == 'Disabled') {
                            if (getQR) clearInterval(getQR);
                            $('#qr').hide();
                            $('#state').html('Disabled');
                            $('#connected').hide();
                        }
                        $('#qr').hide();
                        $('#state').html(result.message);
                    }
                })
        }, 3500);
    </script>
</body>
</html>
