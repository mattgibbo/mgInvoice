<?php

    switch ($_GET['cmd']) {
        case 'new':
            $pageTitle = 'Create a new client';
            break;
        default:
            $pageTitle = 'Clients';
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
            <strong class="h-l ls-1"><i aria-hidden="true" class="fa fa-coffee tc-main"></i> mgInvoice</strong>
        </div>
    </header>

    <section class="wrapper">
        <h1 class="h-m mar-v-b"><?php echo $pageTitle ?></h1>

        <div class="row h-section--2">
            <div class="col span-6">

                <h2 class="h-xs ff-alt h-section--2">Client Details</h2>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Company Name</label>
                    <input type="text" name="inpBusiness" class="frm-inp-txt col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Contact Name</label>
                    <input type="text" name="inpBusiness" class="frm-inp-txt col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Contact Email</label>
                    <input type="text" name="inpEmail" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Address</label>
                    <input type="text" name="inpAddress1" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <input type="text" name="inpAddress2" class="frm-inp-txt va-m col off-3 span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">City</label>
                    <input type="text" name="inpCity" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">County</label>
                    <input type="text" name="inpCounty" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Post Code</label>
                    <input type="text" name="inpPostCode" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Country</label>
                    <select name="inpCountry" class="frm-inp-txt va-m col span-4">
                        <option value="uk">United States of America</option>
                    </select>
                </div>

            </div>

            <div class="col span-6">

                <h2 class="h-xs ff-alt h-section--2">Billing Contact</h2>
                <p>This will be the details of who the invoices are sent to, not necessarily the company owner or individual.</p>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Name</label>
                    <input type="text" name="inpBusiness" class="frm-inp-txt col span-8" />
                </div>

                <div class="frm-row row" id="emailAddress">
                    <label class="frm-label col span-3" id="emailLabel">Email Address</label>
                    <input type="text" name="inpBusiness" class="frm-inp-txt col span-8" />
                </div>

                <div class="frm-row row mar-v-b">
                    <button type="button" class="btn off-3" id="addCC"><i aria-hidden="true" class="fa fa-plus"></i> Add a CC email address</button>
                </div>

                <h2 class="h-xs ff-alt h-section--2">Payment Details</h2>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Billing Rate</label>
                    <input type="text" name="inpBillingRateType" placeholder="0.00" class="frm-inp-txt col span-2" />
                    <select name="inpBillingCycle" class="frm-inp-txt col span-3">
                        <option value="1">Flat Rate</option>
                        <option value="2" selected="selected">Hourly</option>
                        <option value="4">Monthly</option>
                        <option value="13">Quarterly</option>
                        <option value="26">Half Yearly</option>
                        <option value="52">Yearly</option>
                    </select>
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Billing Cycle</label>
                    <select name="inpBillingCycle" class="frm-inp-txt va-m col span-3">
                        <option value="0">Manual</option>
                        <option value="1">Weekly</option>
                        <option value="2" selected="selected">Fortnightly</option>
                        <option value="4">Monthly</option>
                        <option value="13">Quarterly</option>
                        <option value="26">Half Yearly</option>
                        <option value="52">Yearly</option>
                    </select>
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Payment Method</label>
                    <select name="inpBillingMethod" class="frm-inp-txt va-m col span-3">
                        <option value="BankTransfer">Bank Transfer</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque" selected="selected">Cheque</option>
                        <option value="PayPal">PayPal</option>
                    </select>
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Currency</label>
                    <select name="inpBillingMethod" class="frm-inp-txt va-m col span-3">
                        <option value="GBP">GBP (&pound;)</option>
                        <option value="USD" selected="selected">USD ($)</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="frm-row ta-c">
            <button type="submit" class="btn btn-i">Add new client</button>
        </div>

    </section>

    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script>
        jQuery(document).ready(function(){

            $('#addCC').click(function(){
                $('#emailAddress').clone().removeAttr('id').insertAfter('#emailAddress').children('label').text('CC Email Address').next().attr('name', 'CCemail[]');
            });

        });
    </script>

</body>
</html>