
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/css.css'); ?>" rel="stylesheet">

    <style>
        body {
            padding-top: 20px;
        }
        .starter-template {
            padding: 40px 15px;
            text-align: center;
        }

        body {
            padding-bottom: 40px;
            color: #5a5a5a;
        }


        /* CUSTOMIZE THE NAVBAR
        -------------------------------------------------- */

        /* Special class on .container surrounding .navbar, used for positioning it into place. */
        .navbar-wrapper {
            top: 0;
            right: 0;
            left: 0;
            z-index: 20;
        }

        /* Flip around the padding for proper display in narrow viewports */
        .navbar-wrapper > .container {
            padding-right: 0;
            padding-left: 0;
        }
        .navbar-wrapper .navbar {
            padding-right: 15px;
            padding-left: 15px;
        }
        .navbar-wrapper .navbar .container {
            width: auto;
        }
        @media (min-width: 768px) {
            /* Navbar positioning foo */
            .navbar-wrapper {
                margin-top: 20px;
            }
            .navbar-wrapper .container {
                padding-right: 15px;
                padding-left: 15px;
            }
            .navbar-wrapper .navbar {
                padding-right: 0;
                padding-left: 0;
            }

            /* The navbar becomes detached from the top, so we round the corners */
            .navbar-wrapper .navbar {
                border-radius: 4px;
            }

        }


    </style>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url('assets/js/ie-emulation-modes-warning.js'); ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

   <?php $this->load->view('modular/navbar'); ?>

<div class="container">
