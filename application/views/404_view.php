<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>404 Not Found</title>
        <link rel="shortcut icon" href="<?=base_url();?>img/shortcut.png">
        <style type="text/css">
            body{padding: 0px;margin: 0px;}
            .error {
                width: 100%;
                height: 100%;
                margin: 0px;
                padding: 0px;
            }

            .error-content {
                width: 400px;
                height: 200px;
                position: relative;
                top: 40%;
                margin-right: auto;
                margin-left: auto;
                text-align: center;
                margin-top: 100px;
            }
        </style>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    </head>
    <body>
<div class="error-container">
    <div class="error-content bounceIn animated">
        <img width="100%" src="<?=base_url();?>img/error.jpg">
        <p class="error-text">
            Kami Tidak Menemukan Halaman yang Anda Cari
            <a class="error-button" href="javascript:history.back(-1)">Kembali</a>
        </p>
    </div>
</div>
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
