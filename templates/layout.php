<html lang="<?php echo $lang ?>">
<head>
    <title><?php echo $messages["title"]; ?></title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="LDAP Tool Box" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/self-service-password.css" />
    <link href="images/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="images/favicon.ico" rel="shortcut icon" />
    <?php if (isset($background_image)) { ?>
        <style>
            html, body {
                background: url("<?php echo $background_image ?>") no-repeat center fixed;
                background-size: cover;
            }
        </style>
    <?php } ?>
</head>
<body>
<div class="container">
    <div class="panel panel-success">
        <div class="panel-body">
            <?php if ( $show_menu ) { ?>
                <?php require __DIR__ . "/menu.php"; ?>
            <?php } else { ?>
                <div class="title alert alert-success text-center"><h1><?php echo $messages["title"]; ?></h1></div>
            <?php } ?>

            <?php if ( $logo ) { ?>
                <a href="index.php" alt="Home">
                    <img src="<?php echo $logo; ?>" alt="Logo" class="logo img-responsive center-block" />
                </a>
            <?php } ?>

            <?php
            if ( count($dependency_check_results) > 0 ) {
                foreach($dependency_check_results as $result) {
                    ?>
                    <div class="result alert alert-<?php echo get_criticity($result) ?>">
                        <p><i class="fa fa-fw <?php echo get_fa_class($result) ?>" aria-hidden="true"></i> <?php echo $messages[$result]; ?></p>
                    </div>
                    <?php
                }
            } else {
                require __DIR__ . "/../pages/$action.php";
            }
            ?>
        </div>
    </div>
</div>

<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        // Menu links popovers
        $('[data-toggle="menu-popover"]').popover({
            trigger: 'hover',
            placement: 'bottom',
            container: 'body' // Allows the popover to be larger than the menu button
        });
    });
</script>
</body>
</html>