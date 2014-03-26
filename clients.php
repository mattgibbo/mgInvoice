<?php

    switch ($_GET['cmd']) {
        case 'new':
            $pageTitle = 'Create a new client';
            break;
        default:
            $pageTitle = 'Clients';
    }

    $pageTitleSuccess = 'successfully added';

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
        <?php
            // Connect to localhost and set error mode
            // @todo: use database settings from the install form
            $db = new PDO('mysql:host=localhost;dbname=mginvoice', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if($_POST['addClient']) {
                // Explode the name into an array for displaying later
                $name = explode(' ', $_POST['inpBusiness']);

                // Prepare insert statement
                $sth = $db->prepare('INSERT INTO mgi_clients (
                                      name,
                                      address1,
                                      address2,
                                      city,
                                      county,
                                      postCode,
                                      country,
                                      billRateAmount,
                                      billRateType,
                                      billCycle,
                                      billMethod,
                                      billCurrency
                                     ) VALUES (
                                      :busName,
                                      :address1,
                                      :address2,
                                      :city,
                                      :county,
                                      :postCode,
                                      :country,
                                      :billRateAmount,
                                      :billRateType,
                                      :billCycle,
                                      :billMethod,
                                      :billCurrency
                                     );'
                                   );

                // Bind values to statement
                $sth->bindValue(':busName', $_POST['inpBusiness'], PDO::PARAM_STR);
                $sth->bindValue(':address1', $_POST['inpAddress1'], PDO::PARAM_STR);
                $sth->bindValue(':address2', $_POST['inpAddress2'], PDO::PARAM_STR);
                $sth->bindValue(':city', $_POST['inpCity'], PDO::PARAM_STR);
                $sth->bindValue(':county', $_POST['inpCounty'], PDO::PARAM_STR);
                $sth->bindValue(':postCode', $_POST['inpPostCode'], PDO::PARAM_STR);
                $sth->bindValue(':country', $_POST['inpCountry'], PDO::PARAM_STR);
                $sth->bindValue(':billRateAmount', $_POST['inpBillingRateAmount'], PDO::PARAM_STR); // Use PARAM_STR because it's saved as a float
                $sth->bindValue(':billRateType', $_POST['inpBillingRateType'], PDO::PARAM_STR);
                $sth->bindValue(':billCycle', $_POST['inpBillingCycle'], PDO::PARAM_INT);
                $sth->bindValue(':billMethod', $_POST['inpBillingMethod'], PDO::PARAM_STR);
                $sth->bindValue(':billCurrency', $_POST['inpBillingCurrency'], PDO::PARAM_STR);

                // Execute statement
                $sth->execute();

                // Set new client ID
                $clientId = $db->lastInsertId();

                // Add Main Contact
                $sth = $db->prepare('INSERT INTO mgi_clients_contacts (
                                      clientId,
                                      contactName,
                                      contactEmail
                                     ) VALUES (
                                      :clientId,
                                      :contactName,
                                      :contactEmail
                                     );'
                                   );

                $sth->bindValue(':clientId', $clientId, PDO::PARAM_INT);
                $sth->bindValue(':contactName', $_POST['inpContactName'], PDO::PARAM_STR);
                $sth->bindValue(':contactEmail', $_POST['inpContactEmail'], PDO::PARAM_STR);

                // Execute statement
                $sth->execute();
                
                // Add Main Billing Contact
                $sth = $db->prepare('INSERT INTO mgi_clients_contacts (
                                      clientId,
                                      contactName,
                                      contactEmail,
                                      contactType
                                     ) VALUES (
                                      :clientId,
                                      :contactName,
                                      :contactEmail,
                                      "billing"
                                     );'
                                   );
                
                // Bind values to statement
                $sth->bindValue(':clientId', $clientId, PDO::PARAM_INT);
                $sth->bindValue(':contactName', $_POST['inpBillContactName'], PDO::PARAM_STR);
                $sth->bindValue(':contactEmail', $_POST['inpBillContactEmail'], PDO::PARAM_STR);

                // Execute statement
                $sth->execute();

                foreach($_POST['CCemail'] as $ccEmail) {                
                    // Add Billing CC Contact(s)
                    $sth = $db->prepare('INSERT INTO mgi_clients_contacts (
                                          clientId,
                                          contactName,
                                          contactEmail,
                                          contactType
                                         ) VALUES (
                                          :clientId,
                                          "N/A",
                                          :contactEmail,
                                          "billingCC"
                                         );'
                                       );
                    
                    // Bind values to statement
                    $sth->bindValue(':clientId', $clientId, PDO::PARAM_INT);
                    $sth->bindValue(':contactEmail', $ccEmail, PDO::PARAM_STR);

                    // Execute statement
                    $sth->execute();
                }
        ?>

        <h1 class="h-m h-section--2"><?php echo $name[0] . ' ' . $pageTitleSuccess ?></h1>
        <p>Congratulations, you have successfully added your latest client, pay day is on the way! Would you like to <a href="/invoices/new/<?php echo $clientId ?>" class="tw-b">create an invoice for this client</a> now?</p>

        <?php } else { ?>
    
        <span class="msg"></span>

        <h1 class="h-m mar-v-b"><?php echo $pageTitle ?></h1>

        <form method="post" class="wrapper">
            <input type="hidden" name="addClient" value="Y" />

            <div class="row h-section--2">
                <div class="col span-6">

                    <h2 class="h-xs ff-alt h-section--2">Client Details</h2>

                    <div class="frm-row row">
                        <label class="frm-label col span-3">Company Name</label>
                        <input type="text" name="inpBusiness" class="frm-inp-txt col span-8" />
                    </div>

                    <div class="frm-row row">
                        <label class="frm-label col span-3">Contact Name</label>
                        <input type="text" name="inpContactName" class="frm-inp-txt col span-8" />
                    </div>

                    <div class="frm-row row">
                        <label class="frm-label col span-3">Contact Email</label>
                        <input type="text" name="inpContactEmail" class="frm-inp-txt va-m col span-8" />
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
                            <option value="USA">United States of America</option>
                        </select>
                    </div>

                </div>

                <div class="col span-6">

                    <h2 class="h-xs ff-alt h-section--2">Billing Contact</h2>
                    <p>This will be the details of who the invoices are sent to, not necessarily the company owner or individual.</p>

                    <div class="frm-row row">
                        <label class="frm-label col span-3">Name</label>
                        <input type="text" name="inpBillContactName" class="frm-inp-txt col span-8" />
                    </div>

                    <div class="frm-row row" id="emailAddress">
                        <label class="frm-label col span-3" id="emailLabel">Email Address</label>
                        <input type="text" name="inpBillContactEmail" class="frm-inp-txt col span-8" />
                    </div>

                    <div class="frm-row row mar-v-b" id="addCC">
                        <button type="button" class="btn off-3" id="addCCButton"><i aria-hidden="true" class="fa fa-plus"></i> Add a CC email address</button>
                    </div>

                    <h2 class="h-xs ff-alt h-section--2">Payment Details</h2>

                    <div class="frm-row row">
                        <label class="frm-label col span-3">Billing Rate</label>
                        <input type="text" name="inpBillingRateAmount" placeholder="0.00" class="frm-inp-txt col span-2" />
                        <select name="inpBillingRateType" class="frm-inp-txt col span-3">
                            <?php
                                foreach ($db->query('SELECT * FROM mgi_billing_types ORDER BY id ASC;') as $row) { // Ordering by id, but may change to type later
                                    echo '<option value="' , $row['id'] , '"' , (('Yearly' === $row['type']) ? ' selected="selected"' : '') ,  '>' , $row['type'] , "</option>\n";
                                }
                            ?>
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
                            <?php
                                foreach ($db->query('SELECT * FROM mgi_billing_methods ORDER BY id ASC;') as $row) { // Ordering by id, but may change to type later
                                    echo '<option value="' , $row['id'] , '"' , (('Cheque' === $row['method']) ? ' selected="selected"' : '') ,  '>' , $row['method'] , "</option>\n";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="frm-row row">
                        <label class="frm-label col span-3">Currency</label>
                        <select name="inpBillingCurrency" class="frm-inp-txt va-m col span-3">
                            <option value="GBP">GBP (&pound;)</option>
                            <option value="USD" selected="selected">USD ($)</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="frm-row ta-c">
                <button type="submit" class="btn btn-i">Add new client</button>
            </div>

        </form>

        <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
        <script>
            jQuery(document).ready(function(){

                $('#addCCButton').click(function(){
                    $('#emailAddress').clone().removeAttr('id').insertBefore('#addCC').children('label').text('CC Email Address').next().attr('name', 'CCemail[]').val('');
                });

            });
        </script>

        <?php } ?>

    </section>
</body>
</html>