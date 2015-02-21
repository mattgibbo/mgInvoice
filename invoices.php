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
<html style="height:100%">
<head>
    <title><?php echo $pageTitle ?> - mgInvoice</title>

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" id="extViewportMeta">

    <link rel="shortcut icon" href="/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=NTR|PT+Sans:400,700|PT+Serif" rel="stylesheet" type="text/css" />
    <link href="/mgui/css/styles.css" rel="stylesheet" type="text/css" />
    <link href="css/app.css" rel="stylesheet" type="text/css" />
    <script src="https://fontastic.s3.amazonaws.com/B48mNnSACaSSUbqtKQMaZ6/icons.js"></script>
</head>
<body>

    <div class="content wrap">
        <nav class="nav--side">
            <a href="/">
                <svg class="icon"><use xlink:href="#icon-home"></use></svg>
                Home
            </a>
            <a href="/clients.php">
                <svg class="icon"><use xlink:href="#icon-group-full"></use></svg>
                Clients
            </a>
            <a href="/invoices.php" class="active">
                <svg class="icon"><use xlink:href="#icon-browser-window"></use></svg>
                Invoices
            </a>
        </nav>

        <aside class="sidebar pad-s ts-l">
            <ul class="nav mar-h">
                <li class="ts-l tw-b">Invoices</li>
                <li>Create new invoice</li>
                <li>View and manage invoices</li>
                <li>Due invoices</li>
            </ul>
        </aside>

        <main class="pad-m" role="main">
            <?php
                // Connect to localhost and set error mode
                // @todo: use database settings from the install form
                $db = new PDO('mysql:host=localhost;dbname=mgInvoice', 'root', 'root');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                if ('' === $_GET['cmd']) {

                } else {
                    $sth = $db->prepare('SELECT name, billRateAmount FROM mgi_clients WHERE clientId = :id;');
                    $sth->bindValue(':id', $_GET['client'], PDO::PARAM_INT);
                    $sth->execute();
                    
                    if ($row = $sth->fetch()) {
                        $clientName = $row['name'];
                        $billRate = $row['billRateAmount'];
                    }

                    // Get default date values for previous period
                    $todayYear = date('Y');
                    $todayMonth = date('m');
                    $todayDay = date('d');

                    if ($todayDay > 15) {
                        $lastMonth = $todayMonth - 1;
                        $startDate = date('Y-m-d', strtotime($todayYear . '-' . $lastMonth . '-16'));
                        $endDate = date('Y-m-t', strtotime($todayYear . '-' . $lastMonth . '-01'));
                    } else {
                        $startDate = date('Y-m-d', strtotime($todayYear . '-' . $todayMonth . '-01'));
                        $endDate = date('Y-m-d', strtotime($todayYear . '-' . $todayMonth . '-15'));
                    }

                    if($_POST['saveInvoice']) {
                        foreach($_POST['row'] as $row) {
                            echo $row['name'] , ': ' , $row['total'] , '<br />';
                        }
                    }
                }
            ?>
            <h1 class="h-m ls-1 tw-l h-section--2"><?php echo $pageTitle . ' for ' . $clientName ?></h1>

            <?php
                if ('' == $_GET['cmd']) {
                    $sth = $db->prepare('SELECT name, billRateAmount FROM mgi_clients');
                    $sth->execute();
                    
                    if ($row = $sth->fetch()) {
                        do {
                            echo $row['name'] . '<br />';
                        } while ($row = $sth->fetch());
                    }
                    die();
                } else {
            ?>
            <form method="post">
                <input type="hidden" name="saveInvoice" value="Y" />

                <div class="row cols-4 mar-v-b ta-c">
                    <div class="col">
                        <label class="mar-h-r-s tw-b va-m">Reference</label>
                        <input type="text" name="" class="frm-inp-txt va-m" />
                    </div>

                    <div class="col">
                        <label class="mar-h-r-s tw-b va-m">Start Date</label>
                        <input type="date" name="" value="<?php echo $startDate; ?>" class="frm-inp-txt va-m" />
                    </div>

                    <div class="col">
                        <label class="mar-h-r-s tw-b va-m">End Date</label>
                        <input type="date" name="" value="<?php echo $endDate; ?>" class="frm-inp-txt va-m" />
                    </div>

                    <div class="col">
                        <label class="mar-h-r-s tw-b va-m">Invoice Date</label>
                        <input type="date" name="" value="<?php echo date('Y-m-d'); ?>" class="frm-inp-txt va-m" />
                    </div>
                </div>

                <table id="invoiceItems">
                    <thead>
                        <tr>
                            <th class="span-4">
                                Item Name
                            </th>
                            <th class="span-4">
                                Description
                            </th>
                            <th>
                                Unit Cost
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th class="span-2">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr class="dis-n" id="cloneMe">
                            <td>
                                <input type="text" name="row[x][name]" autocomplete="false" class="frm-inp-txt-- w-full" id="name" />
                            </td>
                            <td>
                                <input type="text" name="row[x][desc]" autocomplete="false" class="frm-inp-txt-- w-full" id="desc" />
                            </td>
                            <td>
                                <input type="text" name="row[x][rate]" autocomplete="false" value="<?php echo $billRate ?>" class="frm-inp-txt-- w-full rate" id="rate" />
                            </td>
                            <td>
                                <input type="text" name="row[x][qty]" autocomplete="false" value="0" class="frm-inp-txt-- w-full qty" id="qty" />
                            </td>
                            <td class="ta-c">
                                <span class="total ts-xl">0.00</span>
                                <input type="hidden" name="row[0][total]" id="total" />
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="mar-v-t-s mar-h-r-s flt-r ts-xl">
                    Grand Total:
                    <span class="grand-total tw-xb tc-main">0.00</span>
                </div>

                <div class="mar-v">
                    <button type="submit" class="btn btn-i"><i aria-hidden="true" class="fa fa-save"></i> Save Invoice</button>
                    <button type="button" class="btn" onclick="createRow()"><i aria-hidden="true" class="fa fa-plus"></i> Add Item</button>
                </div>

            </form>
            <?php } ?>
        </main>

    </div>

    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script>
        jQuery(document).ready(function(){
            createRow();
            
            $('#invoiceItems').on('focus', 'input', function(){
                $('input.h-section').removeClass('h-section')
                $(this).addClass('h-section');
            });

            $('#invoiceItems').on('keyup', '.qty', function(){
                var parent = $(this).closest('.table-row');
                var itemRate = parent.find('.rate').val();
                var itemTotal = (itemRate * $(this).val()).toFixed(2);

                parent.find('.total').text(itemTotal).next().val(itemTotal);

                updateGrandTotal();
            });

            $('#invoiceItems').on('blur', '.rate', function(){
                var rateVal = $(this).val();

                if(2 === rateVal.length) {
                    $(this).val(rateVal + '.00');
                }
            });

            function updateGrandTotal() {
                var grandTotal = 0;

                $('.total').each(function(){
                    if('0.00' != $(this).text()) {
                        grandTotal = grandTotal + parseFloat($(this).next().val());
                    }
                });

                $('.grand-total').text(grandTotal.toFixed(2));
            }
        });

        function createRow() {
            var rowCount = $('.table-row').length;

            $('#cloneMe').clone().removeClass('dis-n').addClass('table-row').appendTo($('tbody'));
            $('.table-row:last input').each(function(){
                $(this).attr('name', 'row[' + rowCount + '][' + $(this).attr('id') + ']').removeAttr('id');
            });
        }
    </script>

</body>
</html>