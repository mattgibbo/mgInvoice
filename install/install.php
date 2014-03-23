<!DOCTYPE html>
<html>
<head>
    <title>mgInvoice Install</title>

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" id="extViewportMeta">

    <link rel="shortcut icon" href="/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,900|Open+Sans:300,400italic,400,600" rel="stylesheet" type="text/css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
    <link href="../css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <header class="pad-xl mar-v-b tc-white">
        <div class="wrapper">
            <span class="flt-r mar-v-t">Installing mgInvoice is simple, just fill in the form below and you'll be good to go!</span>
            <h1 class="h-l ls-1"><i aria-hidden="true" class="fa fa-coffee tc-main"></i> mgInvoice Install</h1>
        </div>
    </header>

    <form class="wrapper">
        <div class="row h-section--2">

            <div class="mar-v col span-6 pad-xl">

                <h2 class="h-s h-section--2">Personal Details</h2>
                <div class="frm-row row">
                    <label class="frm-label col span-3">Business Name:</label>
                    <input type="text" placeholder="Enter your business name here" class="frm-inp-txt col span-8" />
                </div>

                <div class="frm-helper dis-ib mar-v-b off-3 span-8 ts-xs">This will be the default billing name, you can change this in the settings later.</div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Your Name:</label>
                    <input type="text" placeholder="Enter your own name here" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Email Address</label>
                    <input type="text" placeholder="" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Address:</label>
                    <input type="text" placeholder="" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <input type="text" placeholder="" class="frm-inp-txt va-m col off-3 span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">City</label>
                    <input type="text" placeholder="" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">County</label>
                    <input type="text" placeholder="" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Country</label>
                    <select class="frm-inp-txt va-m col span-3">
                        <option value="uk">United Kingdom</option>
                    </select>
                </div>

            </div>

            <div class="mar-v col span-6">

                <h2 class="h-s h-section--2">Billing Information</h2>
                
                <div class="mar-v-b">Thse will be the default settings for billing cycle and payment method, however, you will also be able to set an individual billing cycle and payment method for each client/project that you create.</div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Billing Cycle</label>
                    <select class="frm-inp-txt va-m col span-3">
                        <option value="0">Manual</option>
                        <option value="1">Weekly</option>
                        <option value="2" selected>Fortnightly</option>
                        <option value="4">Monthly</option>
                        <option value="13">Quarterly</option>
                        <option value="26">Half Yearly</option>
                        <option value="52">Yearly</option>
                    </select>
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Payment Method</label>
                    <select class="frm-inp-txt va-m col span-3">
                        <option value="0">Bank Transfer</option>
                        <option value="1">Cash</option>
                        <option value="2" selected>Cheque</option>
                        <option value="4">PayPal</option>
                    </select>
                </div>

                <h2 class="h-s h-section--2 mar-v-t">Tax Details</h2>

                <div class="mar-v-b"><i aria-hidden="true" class="fa fa-exclamation-circle tc-error"></i> Make sure you're registered for tax at <a href="http://www.hmrc.gov.uk/" class="tw-b">http://www.hmrc.gov.uk/</a></div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Tax Year</label>

                    <div class="col span-8">
                        <label class="frm-label span-2 va-m">Starts</label>
                        
                        <select class="frm-inp-txt va-m">
                            <?php
                                for($i=1; $i<=31; $i++) {
                                    echo '<option value="' . $i . '"' . ((6 === $i) ? ' selected="selected"' : '') . '>' . $i . '</option>';
                                }
                            ?>
                        </select>

                        <select class="frm-inp-txt va-m">
                            <?php
                                for($i=1; $i<=12; $i++) {
                                    echo '<option value="' . $i . '"' . ((4 === $i) ? ' selected="selected"' : '') . '>' . date('F', mktime(0, 0, 0, $i+1, 0, 0, 0)) . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="frm-row row">
                    <div class="col off-3 span-8">
                        <label class="frm-label span-2 va-m">Ends</label>

                        <select class="frm-inp-txt va-m">
                            <?php
                                for($i=1; $i<=31; $i++) {
                                    echo '<option value="' . $i . '"' . ((5 === $i) ? ' selected="selected"' : '') . '>' . $i . '</option>';
                                }
                            ?>
                        </select>

                        <select class="frm-inp-txt va-m">
                            <?php
                                for($i=1; $i<=12; $i++) {
                                    echo '<option value="' . $i . '"' . ((4 === $i) ? ' selected="selected"' : '') . '>' . date('F', mktime(0, 0, 0, $i+1, 0, 0, 0)) . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>

            </div>

        </div>

        <div class="mar-v-t ta-c">
            <button type="submit" class="btn btn-i ts-l">Start processing your invoices &nbsp;<i aria-hidden="true" class="fa fa-chevron-right"></i></button>
        </div>
    </form>

</body>
</html>