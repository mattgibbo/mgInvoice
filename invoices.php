<?php

    switch ($_GET['cmd']) {
        case 'new':
            $pageTitle = 'Create a new invoice';
            break;
        default:
            $pageTitle = 'Invoices';
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $pageTitle ?> - mgInvoice</title>

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" id="extViewportMeta">

    <link rel="shortcut icon" href="/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900|Open+Sans:300,400italic,400,600" rel="stylesheet" type="text/css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" type="text/css" />

    <style>
        select {
            background: #FFF url("../images/select.png") right center no-repeat;
            cursor: pointer;
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            appearance: none;
            margin-bottom: 4px;
            padding-right: 25px;
            text-indent: 0.01px;
            text-overflow: '';
            -webkit-padding-end: 30px;
        }
        select::-ms-expand { display: none; }
    </style>
</head>
<body>

    <header>
        <div class="wrapper tc-white">
            <span class="flt-r mar-v-t">Installing mgInvoice is simple, just fill in the form below and you'll be good to go!</span>
            <h1 class="h-l ls-1"><i aria-hidden="true" class="fa fa-coffee tc-main"></i> mgInvoice Install</h1>
        </div>
    </header>

    <section class="wrapper">
        <h1 class="h-m h-section--2"><?php echo $pageTitle ?></h1>
    </section>

</body>
</html>