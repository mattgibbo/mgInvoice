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

    <?php
        if($_POST['install']) {
            // Explode the name into an array for displaying later
            $name = explode(' ', $_POST['inpName']);

            // Connect to localhost and set error mode
            // @todo: add database settings to the install form
            $db = new PDO('mysql:host=localhost', '', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Create the database and use it
            $db->query('CREATE DATABASE IF NOT EXISTS mgInvoice');
            $db->query('USE mgInvoice');

            // Create settings table
            $db->query('CREATE TABLE IF NOT EXISTS mgi_settings (
                            settingName varchar(16) NOT NULL,
                            settingValue varchar(64) DEFAULT NULL,
                            PRIMARY KEY (settingName)
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;'
                      );

            // Prepare insert statement
            $sth = $db->prepare('INSERT INTO mgi_settings
                                 (settingName, settingValue)
                                 VALUES
                                 ("businessName", :busName),
                                 ("userName", :userName),
                                 ("email", :email),
                                 ("address1", :address1),
                                 ("address2", :address2),
                                 ("city", :city),
                                 ("county", :county),
                                 ("postCode", :postCode),
                                 ("country", :country),
                                 ("billCycle", :billCycle),
                                 ("billMethod", :billMethod),
                                 ("taxYearStartDay", :taxYearStartDay),
                                 ("taxYearStartMonth", :taxYearStartMonth),
                                 ("taxYearEndDay", :taxYearEndDay),
                                 ("taxYearEndMonth", :taxYearEndMonth);'
                               );

            // Bind values to statement
            $sth->bindValue(':busName', $_POST['inpBusiness'], PDO::PARAM_STR);
            $sth->bindValue(':userName', $_POST['inpName'], PDO::PARAM_STR);
            $sth->bindValue(':email', $_POST['inpEmail'], PDO::PARAM_STR);
            $sth->bindValue(':address1', $_POST['inpAddress1'], PDO::PARAM_STR);
            $sth->bindValue(':address2', $_POST['inpAddress2'], PDO::PARAM_STR);
            $sth->bindValue(':city', $_POST['inpCity'], PDO::PARAM_STR);
            $sth->bindValue(':county', $_POST['inpCounty'], PDO::PARAM_STR);
            $sth->bindValue(':postCode', $_POST['inpPostCode'], PDO::PARAM_STR);
            $sth->bindValue(':country', $_POST['inpCountry'], PDO::PARAM_STR);
            $sth->bindValue(':billCycle', $_POST['inpBillingCycle'], PDO::PARAM_STR);
            $sth->bindValue(':billMethod', $_POST['inpBillingMethod'], PDO::PARAM_STR);
            $sth->bindValue(':taxYearStartDay', $_POST['inpTaxYearStartDay'], PDO::PARAM_STR);
            $sth->bindValue(':taxYearStartMonth', $_POST['inpTaxYearStartMonth'], PDO::PARAM_STR);
            $sth->bindValue(':taxYearEndDay', $_POST['inpTaxYearEndDay'], PDO::PARAM_STR);
            $sth->bindValue(':taxYearEndMonth', $_POST['inpTaxYearEndMonth'], PDO::PARAM_STR);

            // Execute statement
            $sth->execute();
    ?>

    <section class="wrapper">
        <h1 class="h-m">Congratulations <?php echo $name[0]; ?>!</h1>
        <p class="ts-l">You have successfully installed <strong>mgInvoice</strong> and you're now ready to start creating and billing clients, building your bank balance and easily tracking your income for accounting and tax purposes.</p>

        <h2 class="h-s h-section--2 mar-v tw-l">Pick an option below to get started:</h2>

        <a href="" class="dis-ib pad-l ta-c tc-alt ts-l">
            <i aria-hidden="true" class="fa fa-3x fa-file-text tc-main"></i>
            <div class="mar-v-t-s">Prepare an invoice</div>
        </a>

        <a href="" class="dis-ib pad-l ta-c tc-alt ts-l">
            <i aria-hidden="true" class="fa fa-3x fa-users tc-main"></i>
            <div class="mar-v-t-s">Add some clients</div>
        </a>
    </section>

    <?php } else { ?>

    <span class="msg"></span>

    <form method="post" class="wrapper">
        <input type="hidden" name="install" value="Y" />

        <div class="row h-section--2 mar-v">

            <div class="mar-v col span-6 pad-xl">

                <h2 class="h-s h-section--2">Personal Details</h2>
                <div class="frm-row row">
                    <label class="frm-label col span-3">Business Name:</label>
                    <input type="text" name="inpBusiness" placeholder="Enter your business name here" class="frm-inp-txt col span-8" />
                </div>

                <div class="frm-helper dis-ib mar-v-b off-3 span-8 ts-xs">This will be the default billing name, you can change this in the settings later.</div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Your Name:</label>
                    <input type="text" name="inpName" placeholder="Enter your own name here" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Email Address</label>
                    <input type="text" name="inpEmail" placeholder="" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Address:</label>
                    <input type="text" name="inpAddress1" placeholder="" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <input type="text" name="inpAddress2" placeholder="" class="frm-inp-txt va-m col off-3 span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">City</label>
                    <input type="text" name="inpCity" placeholder="" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">County</label>
                    <input type="text" name="inpCounty" placeholder="" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Post Code</label>
                    <input type="text" name="inpPostCode" placeholder="" class="frm-inp-txt va-m col span-8" />
                </div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Country</label>
                    <select name="inpCountry" class="frm-inp-txt va-m col span-3">
                        <option value="uk">United Kingdom</option>
                    </select>
                </div>

            </div>

            <div class="mar-v col span-6">

                <h2 class="h-s h-section--2">Billing Information</h2>
                
                <div class="mar-v-b">These will be the default settings for billing cycle and payment method, however, you will also be able to set an individual billing cycle and payment method for each client/project that you create.</div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Billing Cycle</label>
                    <select name="inpBillingCycle" class="frm-inp-txt va-m col span-3">
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
                    <select name="inpBillingMethod" class="frm-inp-txt va-m col span-3">
                        <option value="BankTransfer">Bank Transfer</option>
                        <option value="Cash">Cash</option>
                        <option value="Cheque" selected>Cheque</option>
                        <option value="PayPal">PayPal</option>
                    </select>
                </div>

                <h2 class="h-s h-section--2 mar-v-t">Tax Details</h2>

                <div class="mar-v-b"><i aria-hidden="true" class="fa fa-exclamation-circle tc-error"></i> Make sure you're registered for tax at <a href="http://www.hmrc.gov.uk/" class="tw-b">http://www.hmrc.gov.uk/</a></div>

                <div class="frm-row row">
                    <label class="frm-label col span-3">Tax Year</label>

                    <div class="col span-8">
                        <label class="frm-label span-2 va-m">Starts</label>
                        
                        <select name="inpTaxYearStartDay" class="frm-inp-txt va-m">
                            <?php
                                for($i=1; $i<=31; $i++) {
                                    echo '<option value="' . $i . '"' . ((6 === $i) ? ' selected="selected"' : '') . '>' . $i . '</option>';
                                }
                            ?>
                        </select>

                        <select name="inpTaxYearStartMonth" class="frm-inp-txt va-m">
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

                        <select name="inpTaxYearEndDay" class="frm-inp-txt va-m">
                            <?php
                                for($i=1; $i<=31; $i++) {
                                    echo '<option value="' . $i . '"' . ((5 === $i) ? ' selected="selected"' : '') . '>' . $i . '</option>';
                                }
                            ?>
                        </select>

                        <select name="inpTaxYearEndMonth" class="frm-inp-txt va-m">
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

        <div class="ta-c">
            <button type="button" class="btn btn-i ts-l">Start processing your invoices &nbsp;<i aria-hidden="true" class="fa fa-chevron-right"></i></button>
        </div>
    </form>

    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script>
        jQuery(document).ready(function(){

            $('.btn').click(function(){
                var emptyInputs = 0;

                $('input').each(function(){
                    if('' === $(this).val() && 'inpAddress2' != $(this).attr('name')) {
                        emptyInputs++;
                        $(this).addClass('error');
                    }
                });

                if(emptyInputs < 0) {
                    $('.msg').replaceWith('<div class="error pad-l"><p class="wrapper">You missed a few! Please fill in all of the fields below before submitting the form.</p></div>');
                } else {
                    $('form').submit();
                }

            });

            $('input').focus(function(){
                $(this).removeClass('error');
            });

        });
    </script>

    <?php } ?>
</body>
</html>