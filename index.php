<!DOCTYPE html>
<html>
<head dir="ltr" lang="en">
    <meta charset="UTF-8" />
    <meta id="extViewportMeta" name="viewport" content="width=device-width, initial-scale=1" />

    <title>Admin</title>
    <link href="https://fonts.googleapis.com/css?family=NTR|PT+Sans:400,700|PT+Serif" rel="stylesheet" type="text/css" />
    <link href="/mgui/css/styles.css" rel="stylesheet" type="text/css" />
    <link href="css/app.css" rel="stylesheet" type="text/css" />
</head>
<body>

    <?php
        $allowance = 9440;
        $earnings  = 17914;
        $estTax    = number_format($earnings * 25 / 100);

        $allowance = number_format($allowance);
        $earnings  = number_format($earnings);
    ?>

    <header role="banner">
        <a href="/" class="brand">mgInvoice</a>
    </header>

    <nav class="nav--side" role="navigation">
        <a href="">Home</a>
        <a href="">Invoices</a>
    </nav>

    <main role="main">
        <div class="tabs">
            <ul class="row">
                <li data-tab="tabcontent-1" class="active">Tab 1</li>
                <li data-tab="tabcontent-2">Tab 2</li>
                <li data-tab="tabcontent-3">Tab 3</li>
                <li data-tab="tabcontent-4">Tab 4</li>
                <li data-tab="tabcontent-5">Tab 5</li>
            </ul>
            <div class="content pad-m">
                <section id="tabcontent-1" hidden class="active">
                    <div class="row">
                        <div class="col span-3">
                            <strong>Allowance this tax year:</strong>
                            <div class="h-xl">£<?php echo $allowance; ?></div>
                        </div>

                        <div class="col span-3">
                            <strong>Earnings this tax year:</strong>
                            <div class="h-xl">£<?php echo $earnings; ?></div>
                        </div>

                        <div class="col span-3">
                            <strong>Estimated tax this year:</strong>
                            <div class="h-xl">£<?php echo $estTax; ?></div>
                        </div>
                    </div>

                    <div>
                        <strong>Earnings this tax year</strong>
                    </div>

                    <div class="progress--circle">
                        <?php
                            // find the percentage based on svg's use of 192px
                            $personalAllowance = 10000;
                            $completePercentage = 3333 / $personalAllowance * 100; 
                            $svgPath = 192 - (192 / 100 * $completePercentage);
                        ?>
                        <svg width="170px" height="170px" viewBox="5 5 70 70">
                            <path class="ip-loader-circlebg" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"></path>
                            <path id="ip-loader-circle" class="ip-loader-circle" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z" style="stroke-dashoffset: 192px; stroke-dasharray: 192px;"></path>
                            <strong><?php echo $completePercentage; ?>%</strong>
                        </svg>
                    </div>

                </section>
                <section id="tabcontent-2" hidden><p>2</p></section>
                <section id="tabcontent-3" hidden><p>3</p></section>
                <section id="tabcontent-4" hidden><p>4</p></section>
                <section id="tabcontent-5" hidden><p>5</p></section>
            </div><!-- /content -->
        </div>
    </main>

    <script>
        xx = document.getElementById('ip-loader-circle');

        function drawPath(val){
            xx.style.strokeDashoffset = val + "px"
        }

        setTimeout( function(){
            drawPath(<?php echo $svgPath; ?>); 
        }, 50 );
    </script>

</body>
</html>