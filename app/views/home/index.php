<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo APP_URL ?>asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo APP_URL ?>asset/css/font-awesome.min.css"/>

    <title>Form Submission</title>
</head>
<body>
<div class="container">

    <h2 class="text-center">Data Submission Form</h2>
    <hr>
    <a href="<?php  echo APP_URL ?>home/see_report">See Report</a>

    <form action="" id="form-data">

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter Amount">
                </div>
                <div class="form-group">
                    <label>Buyer</label>
                    <input type="text" class="form-control" name="buyer" id="buyer" placeholder="Enter Buyer">
                </div>
                <div class="form-group">
                    <label>Receipt Id</label>
                    <input type="text" class="form-control" name="receipt_id" id="receipt_id"
                           placeholder="Enter Receipt ID">
                </div>


            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Buyer Email</label>
                    <input type="text" class="form-control" name="buyer_email" id="buyer_email"
                           placeholder="Buyer Email">
                </div>
                <div class="form-group">
                    <label>Note</label>
                    <textarea id="note" cols="30" name="note" rows="2" class="form-control"
                              placeholder="Enter your note here"></textarea>
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control" id="city" placeholder="Enter City">
                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Buyer Phone Number">
                </div>

                <div class="form-group">
                    <label>Entry By</label>
                    <input type="text" name="entry_by" class="form-control" id="entry_by" placeholder="Entry By">
                </div>

            </div>
        </div>
        <div class="ro">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Items</label>
                    <input type="text" class="form-control item-data" name="items[]" id="items" placeholder="Items">
                    <span><i class="fa fa-plus" style="cursor:pointer;" id="addMoreItem"></i></span>
                </div>

            </div>
        </div>
        <button type="button" class="btn btn-sm btn-primary" id="submitBtn">Submit</button>

        <div id="error-message" class="message"></div>
        <div id="success-message" class="message"></div>
    </form>

    <input type="hidden" id="app_url" value="<?php echo APP_URL; ?>">
</div>

<script src="<?php echo APP_URL; ?>asset/js/jquery-3.2.1.min.js"
"></script>
<script src="<?php echo APP_URL; ?>asset/js/popper.min.js"></script>
<script src="<?php echo APP_URL; ?>asset/js/bootstrap.min.js"></script>
<script src="<?php echo APP_URL; ?>asset/js/main.js"></script>
</body>
</html>