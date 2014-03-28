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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet" type="text/css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <link href="/css/styles.css" rel="stylesheet" type="text/css" />

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

        input[type="text"] {
            background-color: #F5F5F5;
            border-bottom: 1px dashed #CCC;
            padding: .5em;
        }
    </style>
</head>
<body>

    <header>
        <div class="tc-white">
            <span class="flt-r mar-v-t">Installing mgInvoice is simple, just fill in the form below and you'll be good to go!</span>
            <span class="h-l ls-1"><i aria-hidden="true" class="fa fa-coffee tc-main"></i> mgInvoice</span>
        </div>
    </header>

    <div class="row">
        <aside class="col span-2 pad-l" style="background:#30363E;color:#FFF;">
            <ul class="mar-v-s">
                <li class="mar-v-s ts-l tw-b">Invoices</li>
                <li><i aria-hidden="true" class="fa fa-file tc-main va-0 mar-h-r-s"></i> New Invoice</li>
                <li><i aria-hidden="true" class="fa fa-eye tc-main va-0 mar-h-r-s"></i> View Invoices</li>
                <li><i aria-hidden="true" class="fa fa-clock-o tc-main va-0 mar-h-r-s"></i> Due Invoices</li>
            </ul>
        </aside>

        <section class="col span-10">
            <?php
                // Connect to localhost and set error mode
                // @todo: use database settings from the install form
                $db = new PDO('mysql:host=localhost;dbname=mginvoice', 'root', '');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sth = $db->prepare('SELECT name, billRateAmount FROM mgi_clients WHERE clientId=:id;');
                $sth->bindValue(':id', $_GET['client'], PDO::PARAM_INT);
                $sth->execute();
                
                if ($row = $sth->fetch()) {
                    $clientName = $row['name'];
                    $billRate = $row['billRateAmount'];
                }

                if($_POST['saveInvoice']) {
                    foreach($_POST['row'] as $row) {
                        echo $row['name'] , ': ' , $row['total'] , '<br />';
                    }
                }
            ?>
            <h1 class="h-m ls-1 tw-l h-section--2"><?php echo $pageTitle . ' for ' . $clientName ?></h1>

            <form method="post">
                <input type="hidden" name="saveInvoice" value="Y" />

                <div class="row mar-v-b">
                    <div class="col span-3">
                        <label class="mar-h-r-s tw-b va-m">Reference</label>
                        <input type="text" name="" class="frm-inp-txt va-m" />
                    </div>

                    <div class="col span-3">
                        <label class="mar-h-r-s tw-b va-m">Start Date</label>
                        <input type="text" name="" class="frm-inp-txt va-m" />
                    </div>

                    <div class="col span-3">
                        <label class="mar-h-r-s tw-b va-m">End Date</label>
                        <input type="text" name="" class="frm-inp-txt va-m" />
                    </div>

                    <div class="col span-3">
                        <label class="mar-h-r-s tw-b va-m">Invoice Date</label>
                        <input type="text" name="" value="<?php echo date('Y-m-d') ?>" class="frm-inp-txt va-m" />
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
                            <th class="span-1">
                                Unit Cost
                            </th>
                            <th class="span-1">
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
                            <td>
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
        </section>

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