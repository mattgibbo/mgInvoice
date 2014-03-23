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

    <section class="pad-l">
        <h1 class="h-l ls-1 tc-alt"><i aria-hidden="true" class="fa fa-coffee tc-main"></i> mgInvoice Install</h1>
        <p class="ts-m breadcrumb pad-l rounded span-4">Installing mgInvoice is simple, just fill in the form below and you'll be good to go!</p>

        <form>
            <div class="frm-row row">
                <label class="frm-label col span-1">Business Name:</label>
                <input type="text" placeholder="Enter your business name here" class="frm-inp-txt va-m col span-3" />
                
            </div>
            <div class="frm-helper dis-ib mar-v-b off-1 ts-xs">This will be the default billing name, you can change this in the settings later.</div>

            <div class="frm-row row">
                <label class="frm-label col span-1">Your Name:</label>
                <input type="text" placeholder="Enter your own name here" class="frm-inp-txt va-m col span-3" />
            </div>

            <div class="frm-row row">
                <label class="frm-label col span-1">Email Address</label>
                <input type="text" placeholder="" class="frm-inp-txt va-m col span-3" />
            </div>

            <div class="frm-row row">
                <label class="frm-label col span-1">Address:</label>
                <input type="text" placeholder="" class="frm-inp-txt va-m col span-3" />
            </div>

            <div class="frm-row row">
                <input type="text" placeholder="" class="frm-inp-txt va-m col off-1 span-3" />
            </div>

            <div class="frm-row row">
                <label class="frm-label col span-1">City</label>
                <input type="text" placeholder="" class="frm-inp-txt va-m col span-3" />
            </div>

            <div class="frm-row row">
                <label class="frm-label col span-1">County</label>
                <input type="text" placeholder="" class="frm-inp-txt va-m col span-3" />
            </div>

            <div class="frm-row row">
                <label class="frm-label col span-1">Country</label>
                <select class="frm-inp-txt va-m col span-2">
                    <option value="uk">United Kingdom</option>
                </select>
            </div>

            <div class="frm-row row">
                <label class="frm-label col span-1">Billing Cycle</label>
                <select class="frm-inp-txt va-m col span-1">
                    <option value="0">Manual</option>
                    <option value="1">Weekly</option>
                    <option value="2" selected>Fortnightly</option>
                    <option value="4">Monthly</option>
                    <option value="13">Quarterly</option>
                    <option value="26">Half Yearly</option>
                    <option value="52">Yearly</option>
                </select>
            </div>
            <div class="frm-helper dis-ib mar-v-b off-1 ts-xs">This will be the default billing cycle, you can also set a cycle for each client.</div>

            <div class="frm-row row">
                <label class="frm-label col span-1">Tax Year</label>

                <div class="col span-2">
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
                <div class="col off-1 span-2">
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

            <button type="submit" class="btn btn-i mar-v-t span-4 ts-l">Start processing your invoices &nbsp;<i aria-hidden="true" class="fa fa-chevron-right"></i></button>
        </form>
    </section>

</body>
</html>