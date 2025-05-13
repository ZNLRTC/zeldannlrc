<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>

        <!-- Begin page -->

        <div class="wrapper">

            <?php include 'admin_leftsidebar.php'?>

            

            <div class="content-page">

                <div class="content">

                    <!-- Topbar Start -->

                    

                    

                    <!-- Start Content-->

                    <div class="container-fluid">

                        <?php include 'admin_topbar.php'?>



                        <!-- start page title -->

                        <div class="row">

                            <div class="col-12">

                                <div class="page-title-box">

                                    <div class="page-title-right">

                                        <ol class="breadcrumb m-0">

                                        <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>admin/dashboard">Dashboard</a></li>

                                            <li class="breadcrumb-item active">Settings</li>

                                        </ol>

                                    </div>

                                    <h4 class="page-title">Settings</h4>

                                </div>

                            </div>

                        </div>

                        <!-- end page title -->



                        <div class="row">

                            <div class="col-12">

                                <div class="card">

                                    <div class="card-body">



                                        <!-- Checkout Steps -->

                                        <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">

                                            <li class="nav-item">

                                                <a href="#billing-information" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">

                                                    <i class="dripicons-document-new font-18"></i>

                                                    <span class="d-none d-lg-block">Documents</span>

                                                </a>

                                            </li>

                                            <li class="nav-item">

                                                <a href="#shipping-informations" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0">

                                                    <!--  <i class="mdi mdi-truck-fast font-18"></i>

                                                    <span class="d-none d-lg-block">Shipping Info</span> -->

                                                </a>

                                            </li>

                                            <li class="nav-item">

                                                <a href="#payment-informations" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">

                                                     <!--<i class="mdi mdi-cash-multiple font-18"></i>

                                                    <span class="d-none d-lg-block">Payment Info</span> -->

                                                </a>

                                            </li>

                                        </ul>



                                        <!-- Steps Information -->

                                        <div class="tab-content">



                                            <!-- Billing Content-->

                                            <div class="tab-pane show active" id="billing-information">

                                                <div class="row">

                                                    <div class="col-lg-6">

                                                        <h4 class="mt-2">Applicant's Document</h4>



                                                        <p class="text-muted mb-4">Fill the form below for additional documents for applicants.</p>



                                                        <form action = "<?php echo BASE_URL; ?>admin/insertDocuList" method="POST" id="adminInsertDocu">

                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <input type="hidden" name="docu-list-id">
                                                                    <div class="mb-3">

                                                                        <label id="labelDocums" for="billing-first-name" class="form-label mb-0">Document Name</label>
                                                                        <small class="text-warning d-block mb-2"><i class="fas fa-info-circle"></i> User small caps only and replace space with underscore</small>

                                                                        <input id="inputDocu" class="form-control" name="docu-list-name" type="text" placeholder="e.g. document_name" required>

                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label id="labelDocums" for="billing-first-name" class="form-label">Description</label>
                                                                        <input id="inputDocuDesc" class="form-control" name="docu-list-description" type="text" placeholder="e.g. Document Name" required>
                                                                    </div>

                                                                </div>

                                                            </div> <!-- end row -->

                                                            <button id="docuBtn" type="submit" data-action="add" class="btn btn-success" disabled="true">Add</button>

                                                           

                                                            

                                                        </form>

                                                    </div>

                                                    <div class="col-lg-6">

                                                        <div class="border p-3 mt-4 mt-lg-0 rounded">

                                                            <h4 class="header-title mb-3">Documents List</h4>

            

                                                            <div class="row">

                                                           <table id="documentsList" class="table dt-responsive nowrap w-100">

                                                            <thead>

                                                                    <th>#</th>

                                                                    <th>Document Type</th>

                                                                    <th>Action</th>

                                                            </thead>

                                                        </table>  

                                                            </div>

                                                            <!-- end table-responsive -->

                                                        </div> <!-- end .border-->

            

                                                    </div> <!-- end col -->            

                                                </div> <!-- end row-->

                                            </div>

                                            <!-- End Billing Information Content-->



                                            <!-- Shipping Content-->

                                            <div class="tab-pane" id="shipping-information">

                                                <div class="row">

                                                    <div class="col-lg-8">

                                                        <h4 class="mt-2">Saved Address</h4>



                                                        <p class="text-muted mb-3">Fill the form below in order to

                                                            send you the order's invoice.</p>



                                                        <div class="row">

                                                            <div class="col-md-6">

                                                                <div class="border p-3 rounded mb-3 mb-md-0">

                                                                    <address class="mb-0 address-lg">

                                                                        <div class="form-check">

                                                                            <input type="radio" id="customRadio1" name="customRadio" class="form-check-input" checked="">

                                                                            <label class="form-check-label font-16 fw-bold" for="customRadio1">Home</label>

                                                                        </div>

                                                                        <br>

                                                                        <span class="fw-semibold">Stanley Jones</span> <br>

                                                                        795 Folsom Ave, Suite 600<br>

                                                                        San Francisco, CA 94107<br>

                                                                        <abbr title="Phone">P:</abbr> (123) 456-7890 <br>

                                                                    </address>

                                                                </div>

                                                            </div>

                                                            <div class="col-md-6">

                                                                <div class="border p-3 rounded">

                                                                    <address class="mb-0 address-lg">

                                                                        <div class="form-check">

                                                                            <input type="radio" id="customRadio2" name="customRadio" class="form-check-input">

                                                                            <label class="form-check-label font-16 fw-bold" for="customRadio2">Office</label>

                                                                        </div>

                                                                        <br>

                                                                        <span class="fw-semibold">Stanley Jones</span> <br>

                                                                        795 Folsom Ave, Suite 600<br>

                                                                        San Francisco, CA 94107<br>

                                                                        <abbr title="Phone">P:</abbr> (123) 456-7890 <br>

                                                                    </address>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <!-- end row-->



                                                        <h4 class="mt-4">Add New Address</h4>



                                                        <p class="text-muted mb-4">Fill the form below so we can

                                                            send you the order's invoice.</p>



                                                        <form>

                                                            <div class="row">

                                                                <div class="col-md-6">

                                                                    <div class="mb-3">

                                                                        <label for="new-adr-first-name" class="form-label">First Name</label>

                                                                        <input class="form-control" type="text" placeholder="Enter your first name" id="new-adr-first-name">

                                                                    </div>

                                                                </div>

                                                                <div class="col-md-6">

                                                                    <div class="mb-3">

                                                                        <label for="new-adr-last-name" class="form-label">Last Name</label>

                                                                        <input class="form-control" type="text" placeholder="Enter your last name" id="new-adr-last-name">

                                                                    </div>

                                                                </div>

                                                            </div> <!-- end row -->

                                                            <div class="row">

                                                                <div class="col-md-6">

                                                                    <div class="mb-3">

                                                                        <label for="new-adr-email-address" class="form-label">Email Address <span class="text-danger">*</span></label>

                                                                        <input class="form-control" type="email" placeholder="Enter your email" id="new-adr-email-address">

                                                                    </div>

                                                                </div>

                                                                <div class="col-md-6">

                                                                    <div class="mb-3">

                                                                        <label for="new-adr-phone" class="form-label">Phone <span class="text-danger">*</span></label>

                                                                        <input class="form-control" type="text" placeholder="(xx) xxx xxxx xxx" id="new-adr-phone">

                                                                    </div>

                                                                </div>

                                                            </div> <!-- end row -->

                                                            <div class="row">

                                                                <div class="col-12">

                                                                    <div class="mb-3">

                                                                        <label for="new-adr-address" class="form-label">Address</label>

                                                                        <input class="form-control" type="text" placeholder="Enter full address" id="new-adr-address">

                                                                    </div>

                                                                </div>

                                                            </div> <!-- end row -->

                                                            <div class="row">

                                                                <div class="col-md-4">

                                                                    <div class="mb-3">

                                                                        <label for="new-adr-town-city" class="form-label">Town / City</label>

                                                                        <input class="form-control" type="text" placeholder="Enter your city name" id="new-adr-town-city">

                                                                    </div>

                                                                </div>

                                                                <div class="col-md-4">

                                                                    <div class="mb-3">

                                                                        <label for="new-adr-state" class="form-label">State</label>

                                                                        <input class="form-control" type="text" placeholder="Enter your state" id="new-adr-state">

                                                                    </div>

                                                                </div>

                                                                <div class="col-md-4">

                                                                    <div class="mb-3">

                                                                        <label for="new-adr-zip-postal" class="form-label">Zip / Postal Code</label>

                                                                        <input class="form-control" type="text" placeholder="Enter your zip code" id="new-adr-zip-postal">

                                                                    </div>

                                                                </div>

                                                            </div> <!-- end row -->

                                                            



                                                            <h4 class="mt-4">Shipping Method</h4>



                                                            <p class="text-muted mb-3">Fill the form below in order to

                                                                send you the order's invoice.</p>



                                                            <div class="row">

                                                                <div class="col-md-6">

                                                                    <div class="border p-3 rounded mb-3 mb-md-0">

                                                                        <div class="form-check">

                                                                            <input type="radio" id="shippingMethodRadio1" name="shippingOptions" class="form-check-input" checked="">

                                                                            <label class="form-check-label font-16 fw-bold" for="shippingMethodRadio1">Standard Delivery - FREE</label>

                                                                        </div>

                                                                        <p class="mb-0 ps-3 pt-1">Estimated 5-7 days shipping (Duties and tax may be due upon delivery)</p>

                                                                    </div>

                                                                </div>

                                                                <div class="col-md-6">

                                                                    <div class="border p-3 rounded">

                                                                        <div class="form-check">

                                                                            <input type="radio" id="shippingMethodRadio2" name="shippingOptions" class="form-check-input">

                                                                            <label class="form-check-label font-16 fw-bold" for="shippingMethodRadio2">Fast Delivery - $25</label>

                                                                        </div>

                                                                        <p class="mb-0 ps-3 pt-1">Estimated 1-2 days shipping (Duties and tax may be due upon delivery)</p>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <!-- end row-->



                                                            <div class="row mt-4">

                                                                <div class="col-sm-6">

                                                                    <a href="apps-ecommerce-shopping-cart.html" class="btn text-muted d-none d-sm-inline-block btn-link fw-semibold">

                                                                        <i class="mdi mdi-arrow-left"></i> Back to Shopping Cart </a>

                                                                </div> <!-- end col -->

                                                                <div class="col-sm-6">

                                                                    <div class="text-sm-end">

                                                                        <a href="apps-ecommerce-checkout.html" class="btn btn-danger">

                                                                            <i class="mdi mdi-cash-multiple me-1"></i> Continue to Payment </a>

                                                                    </div>

                                                                </div> <!-- end col -->

                                                            </div> <!-- end row -->

                                                        </form>

                                                    </div>

                                                    <div class="col-lg-4">

                                                        <div class="border p-3 mt-4 mt-lg-0 rounded">

                                                            <h4 class="header-title mb-3">Order Summary</h4>

            

                                                            <div class="table-responsive">

                                                                <table class="table table-centered mb-0">

                                                                    <tbody>

                                                                        <tr>

                                                                            <td>

                                                                                <img src="assets/images/products/product-1.jpg" alt="contact-img" title="contact-img" class="rounded me-2" height="48">

                                                                                <p class="m-0 d-inline-block align-middle">

                                                                                    <a href="apps-ecommerce-products-details.html" class="text-body fw-semibold">Amazing Modern Chair</a>

                                                                                    <br>

                                                                                    <small>5 x $148.66</small>

                                                                                </p>

                                                                            </td>

                                                                            <td class="text-end">

                                                                                $743.30

                                                                            </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <td>

                                                                                <img src="assets/images/products/product-2.jpg" alt="contact-img" title="contact-img" class="rounded me-2" height="48">

                                                                                <p class="m-0 d-inline-block align-middle">

                                                                                    <a href="apps-ecommerce-products-details.html" class="text-body fw-semibold">Designer Awesome Chair</a>

                                                                                    <br>

                                                                                    <small>2 x $99.00</small>

                                                                                </p>

                                                                            </td>

                                                                            <td class="text-end">

                                                                                $198.00

                                                                            </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <td>

                                                                                <img src="assets/images/products/product-3.jpg" alt="contact-img" title="contact-img" class="rounded me-2" height="48">

                                                                                <p class="m-0 d-inline-block align-middle">

                                                                                    <a href="apps-ecommerce-products-details.html" class="text-body fw-semibold">Biblio Plastic Armchair</a>

                                                                                    <br>

                                                                                    <small>1 x $129.99</small>

                                                                                </p>

                                                                            </td>

                                                                            <td class="text-end">

                                                                                $129.99

                                                                            </td>

                                                                        </tr>

                                                                        <tr class="text-end">

                                                                            <td>

                                                                                <h6 class="m-0">Sub Total:</h6>

                                                                            </td>

                                                                            <td class="text-end">

                                                                                $1071.29

                                                                            </td>

                                                                        </tr>

                                                                        <tr class="text-end">

                                                                            <td>

                                                                                <h6 class="m-0">Shipping:</h6>

                                                                            </td>

                                                                            <td class="text-end">

                                                                                FREE

                                                                            </td>

                                                                        </tr>

                                                                        <tr class="text-end">

                                                                            <td>

                                                                                <h5 class="m-0">Total:</h5>

                                                                            </td>

                                                                            <td class="text-end fw-semibold">

                                                                                $1071.29

                                                                            </td>

                                                                        </tr>

                                                                    </tbody>

                                                                </table>

                                                            </div>

                                                            <!-- end table-responsive -->

                                                        </div> <!-- end .border-->

            

                                                    </div> <!-- end col -->            

                                                </div> <!-- end row-->

                                            </div>

                                            <!-- End Shipping Information Content-->



                                            <!-- Payment Content-->

                                            <div class="tab-pane" id="payment-information">

                                                <div class="row">



                                                    <div class="col-lg-8">

                                                        <h4 class="mt-2">Payment Selection</h4>



                                                        <p class="text-muted mb-4">Fill the form below in order to

                                                            send you the order's invoice.</p>



                                                        <!-- Pay with Paypal box-->

                                                        <div class="border p-3 mb-3 rounded">

                                                            <div class="row">

                                                                <div class="col-sm-8">

                                                                    <div class="form-check">

                                                                        <input type="radio" id="BillingOptRadio2" name="billingOptions" class="form-check-input">

                                                                        <label class="form-check-label font-16 fw-bold" for="BillingOptRadio2">Pay with Paypal</label>

                                                                    </div>

                                                                    <p class="mb-0 ps-3 pt-1">You will be redirected to PayPal website to complete your purchase securely.</p>

                                                                </div>

                                                                <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">

                                                                    <img src="assets/images/payments/paypal.png" height="25" alt="paypal-img">

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <!-- end Pay with Paypal box-->



                                                        <!-- Credit/Debit Card box-->

                                                        <div class="border p-3 mb-3 rounded">

                                                            <div class="row">

                                                                <div class="col-sm-8">

                                                                    <div class="form-check">

                                                                        <input type="radio" id="BillingOptRadio1" name="billingOptions" class="form-check-input" checked="">

                                                                        <label class="form-check-label font-16 fw-bold" for="BillingOptRadio1">Credit / Debit Card</label>

                                                                    </div>

                                                                    <p class="mb-0 ps-3 pt-1">Safe money transfer using your bank account. We support Mastercard, Visa, Discover and Stripe.</p>

                                                                </div>

                                                                <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">

                                                                    <img src="assets/images/payments/master.png" height="24" alt="master-card-img">

                                                                    <img src="assets/images/payments/discover.png" height="24" alt="discover-card-img">

                                                                    <img src="assets/images/payments/visa.png" height="24" alt="visa-card-img">

                                                                    <img src="assets/images/payments/stripe.png" height="24" alt="stripe-card-img">

                                                                </div>

                                                            </div> <!-- end row -->

                                                            <div class="row mt-4">

                                                                <div class="col-md-12">

                                                                    <div class="mb-3">

                                                                        <label for="card-number" class="form-label">Card Number</label>

                                                                        <input type="text" id="card-number" class="form-control" data-toggle="input-mask" data-mask-format="0000 0000 0000 0000" placeholder="4242 4242 4242 4242">

                                                                    </div>

                                                                </div>

                                                            </div> <!-- end row -->

                                                            <div class="row">

                                                                <div class="col-md-6">

                                                                    <div class="mb-3">

                                                                        <label for="card-name-on" class="form-label">Name on card</label>

                                                                        <input type="text" id="card-name-on" class="form-control" placeholder="Master Shreyu">

                                                                    </div>

                                                                </div>

                                                                <div class="col-md-3">

                                                                    <div class="mb-3">

                                                                        <label for="card-expiry-date" class="form-label">Expiry date</label>

                                                                        <input type="text" id="card-expiry-date" class="form-control" data-toggle="input-mask" data-mask-format="00/00" placeholder="MM/YY">

                                                                    </div>

                                                                </div>

                                                                <div class="col-md-3">

                                                                    <div class="mb-3">

                                                                        <label for="card-cvv" class="form-label">CVV code</label>

                                                                        <input type="text" id="card-cvv" class="form-control" data-toggle="input-mask" data-mask-format="000" placeholder="012">

                                                                    </div>

                                                                </div>

                                                            </div> <!-- end row -->

                                                        </div>

                                                        <!-- end Credit/Debit Card box-->



                                                        <!-- Pay with Payoneer box-->

                                                        <div class="border p-3 mb-3 rounded">

                                                            <div class="row">

                                                                <div class="col-sm-8">

                                                                    <div class="form-check">

                                                                        <input type="radio" id="BillingOptRadio3" name="billingOptions" class="form-check-input">

                                                                        <label class="form-check-label font-16 fw-bold" for="BillingOptRadio3">Pay with Payoneer</label>

                                                                    </div>

                                                                    <p class="mb-0 ps-3 pt-1">You will be redirected to Payoneer website to complete your purchase securely.</p>

                                                                </div>

                                                                <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">

                                                                    <img src="assets/images/payments/payoneer.png" height="30" alt="paypal-img">

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <!-- end Pay with Payoneer box-->



                                                        <!-- Cash on Delivery box-->

                                                        <div class="border p-3 mb-3 rounded">

                                                            <div class="row">

                                                                <div class="col-sm-8">

                                                                    <div class="form-check">

                                                                        <input type="radio" id="BillingOptRadio4" name="billingOptions" class="form-check-input">

                                                                        <label class="form-check-label font-16 fw-bold" for="BillingOptRadio4">Cash on Delivery</label>

                                                                    </div>

                                                                    <p class="mb-0 ps-3 pt-1">Pay with cash when your order is delivered.</p>

                                                                </div>

                                                                <div class="col-sm-4 text-sm-end mt-3 mt-sm-0">

                                                                    <img src="assets/images/payments/cod.png" height="22" alt="paypal-img">

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <!-- end Cash on Delivery box-->



                                                        <div class="row mt-4">

                                                            <div class="col-sm-6">

                                                                <a href="apps-ecommerce-shopping-cart.html" class="btn text-muted d-none d-sm-inline-block btn-link fw-semibold">

                                                                    <i class="mdi mdi-arrow-left"></i> Back to Shopping Cart </a>

                                                            </div> <!-- end col -->

                                                            <div class="col-sm-6">

                                                                <div class="text-sm-end">

                                                                    <a href="apps-ecommerce-checkout.html" class="btn btn-danger">

                                                                        <i class="mdi mdi-cash-multiple me-1"></i> Complete Order </a>

                                                                </div>

                                                            </div> <!-- end col -->

                                                        </div> <!-- end row-->



                                                    </div> <!-- end col -->



                                                    <div class="col-lg-4">

                                                        <div class="border p-3 mt-4 mt-lg-0 rounded">

                                                            <h4 class="header-title mb-3">Order Summary</h4>

            

                                                            <div class="table-responsive">

                                                                <table class="table table-centered mb-0">

                                                                    <tbody>

                                                                        <tr>

                                                                            <td>

                                                                                <img src="assets/images/products/product-1.jpg" alt="contact-img" title="contact-img" class="rounded me-2" height="48">

                                                                                <p class="m-0 d-inline-block align-middle">

                                                                                    <a href="apps-ecommerce-products-details.html" class="text-body fw-semibold">Amazing Modern Chair</a>

                                                                                    <br>

                                                                                    <small>5 x $148.66</small>

                                                                                </p>

                                                                            </td>

                                                                            <td class="text-end">

                                                                                $743.30

                                                                            </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <td>

                                                                                <img src="assets/images/products/product-2.jpg" alt="contact-img" title="contact-img" class="rounded me-2" height="48">

                                                                                <p class="m-0 d-inline-block align-middle">

                                                                                    <a href="apps-ecommerce-products-details.html" class="text-body fw-semibold">Designer Awesome Chair</a>

                                                                                    <br>

                                                                                    <small>2 x $99.00</small>

                                                                                </p>

                                                                            </td>

                                                                            <td class="text-end">

                                                                                $198.00

                                                                            </td>

                                                                        </tr>

                                                                        <tr>

                                                                            <td>

                                                                                <img src="assets/images/products/product-3.jpg" alt="contact-img" title="contact-img" class="rounded me-2" height="48">

                                                                                <p class="m-0 d-inline-block align-middle">

                                                                                    <a href="apps-ecommerce-products-details.html" class="text-body fw-semibold">Biblio Plastic Armchair</a>

                                                                                    <br>

                                                                                    <small>1 x $129.99</small>

                                                                                </p>

                                                                            </td>

                                                                            <td class="text-end">

                                                                                $129.99

                                                                            </td>

                                                                        </tr>

                                                                        <tr class="text-end">

                                                                            <td>

                                                                                <h6 class="m-0">Sub Total:</h6>

                                                                            </td>

                                                                            <td class="text-end">

                                                                                $1071.29

                                                                            </td>

                                                                        </tr>

                                                                        <tr class="text-end">

                                                                            <td>

                                                                                <h6 class="m-0">Shipping:</h6>

                                                                            </td>

                                                                            <td class="text-end">

                                                                                FREE

                                                                            </td>

                                                                        </tr>

                                                                        <tr class="text-end">

                                                                            <td>

                                                                                <h5 class="m-0">Total:</h5>

                                                                            </td>

                                                                            <td class="text-end fw-semibold">

                                                                                $1071.29

                                                                            </td>

                                                                        </tr>

                                                                    </tbody>

                                                                </table>

                                                            </div>

                                                            <!-- end table-responsive -->

                                                        </div> <!-- end .border-->

            

                                                    </div> <!-- end col -->            

                                                </div> <!-- end row-->

                                            </div>

                                            <!-- End Payment Information Content-->



                                        </div> <!-- end tab content-->



                                    </div> <!-- end card-body-->

                                </div> <!-- end card-->

                            </div> <!-- end col -->

                        </div>

                        <!-- end row-->



                    </div> <!-- container -->



                </div> <!-- content -->