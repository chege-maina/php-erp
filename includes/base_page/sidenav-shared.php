<!-- 
// function genSideBar()
// {
//   echo <<<EOD
//-->
<div class="navbar-vertical-content scrollbar">
  <ul class="navbar-nav flex-column">
    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#home" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-home" style="color:#b5651d;"></span></span><span class="nav-link-text"> Home</span>
        </div>
      </a>
      <ul class="nav collapse" id="home" data-parent="#navbarVerticalCollapse">
        <li class="nav-item"><a class="nav-link" href="../index.html">Dashboard</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../home/dashboard-alt.html">Dashboard alt</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../home/feed.html">Feed</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../home/landing.html">Landing</a>
        </li>
      </ul>
    </li>
    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#pages" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="pages">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-coins" style="color:blue;"></span></span><span class="nav-link-text"> Products</span>
        </div>
      </a>
      <ul class="nav collapse" id="pages" data-parent="#navbarVerticalCollapse">
        <li class="nav-item"><a class="nav-link" href="../products/add-product-ui.php">Add New Product</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../products/product-listing-ui.php">Products Listing</a>
        </li>
      </ul>
    </li>
    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#purchase_rqn" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="purchase_rqn">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-warehouse" style="color:orange;"></span></span><span class="nav-link-text"> Warehouse</span>
        </div>
      </a>
      <ul class="nav collapse" id="purchase_rqn" data-parent="#navbarVerticalCollapse">
        <li class="nav-item"><a class="nav-link" href="../purchase_requisitions/warehouse_add_pr.php">Create Requisition</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../purchase_requisitions/manage_requisitions_ui.php">Manage Requisitions</a>
        </li>
        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#receive" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="authentication-basic">Receive Products</a>
          <ul class="nav collapse" id="receive" data-parent="#authentication">
            <li class="nav-item"><a class="nav-link" href="../purchase_requisitions/manage_received_goods.php">Receive From Supplier</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="../purchase_requisitions/receive_transfer_item.php">Receive From Transfer</a>
            </li>
          </ul>
        </li>
        <li class="nav-item"><a class="nav-link" href="../warehouse/approve_receipt_note.php">Approve Receipt</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../purchase_requisitions/goods_transfer.php">Request Transfer</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../purchase_requisitions/manage_transfer.php">Manage Transfer Requests</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../purchase_requisitions/release_transfer.php">Release Transfer Items</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../purchase_requisitions/manage_requisitions_ui.php">Return Goods</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../warehouse/receipt_listing_ui.php">Receipt List</a>
        </li>
      </ul>
    </li>
    <!-- Purchase order -->
    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#email" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="email">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-dolly-flatbed" style="color:red;"></span></span><span class="nav-link-text"> Procurement</span>
        </div>
      </a>
      <ul class="nav collapse" id="email" data-parent="#navbarVerticalCollapse">
        <li class="nav-item"><a class="nav-link" href="../purchase_orders/select_po.php">Create Purchase Order</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../purchase_orders/manage_purchase_order.php">Manage Purchase Order</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../purchase_orders/transfer_approval.php">Approve Transfer</a>
        </li>
      </ul>
    </li>
    <!-- Suppliers -->
    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#supply" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="email">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users" style="color:#90B494;"></span></span><span class="nav-link-text"> Suppliers</span>
        </div>
      </a>
      <ul class="nav collapse" id="supply" data-parent="#navbarVerticalCollapse">
        <li class="nav-item"><a class="nav-link" href="../supplier/create.php">Add New Supplier</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../supplier/supplier_listing_ui.php">Manage Supplier</a>
        </li>
      </ul>
    </li>
    <!-- Accounts -->
    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#e-commerce" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="e-commerce">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-money-check-alt" style="color:green;"></span></span><span class="nav-link-text"> Accounts</span>
        </div>
      </a>
      <ul class="nav collapse" id="e-commerce" data-parent="#navbarVerticalCollapse">


        <li class="nav-item"><a class="nav-link" href="../Accounts/purchase_bill.php">Post Purchase Bill</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/remittance_listing.php">Remittance Listing</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/generate_remittance.php">Remittance Advice</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/approve_remittance.php">Approve Remittance Advice</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/pay_bill.php">Make Payment</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/paybill_listing.php">Paybill Listing</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../sales_invoice/create_invoice.php">Create Invoice</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../sales_invoice/sales_invoice_listing.php">Sale Invoice Listing</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/generate_receipt_advice.php">Receipt Advice</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/receive_payment.php">Receive Payment</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/receipts_listing.php">Receipts Listing</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/approve_receipt_advice.php">Approve Receipt Advice</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/purchase_bill_listing.php">Purchase Listing</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/voucher_processing.php">Voucher Processing</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/voucher_listing.php">Voucher Listing</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/asset_description.php">Asset Description</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/opening_balance.php">Opening Balance</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/chart_of_accounts.php">Edit Chart of Accounts</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/add_ledger_ui.php">Add Ledger</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/ledger_listing_ui.php">Ledger Listing</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../Accounts/product_accounts.php">Accounts Mapping</a>
        </li>
      </ul>
    </li>
    <!-- Customers -->
    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#e-custo" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="e-commerce">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-user-friends" style="color:purple;"></span></span><span class="nav-link-text"> Customers</span>
        </div>
      </a>
      <ul class="nav collapse" id="e-custo" data-parent="#navbarVerticalCollapse">
        <li class="nav-item"><a class="nav-link" href="../customer/create.php">Add New Customer</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../customer/customer_listing_ui.php">Manage</a>
        </li>
      </ul>
    </li>

    <!-- Customer Relations Management -->
    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#e-quote" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="e-commerce">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-tasks" style="color:#9b870c;"></span></span><span class="nav-link-text"> Customer Relations</span>
        </div>
      </a>
      <ul class="nav collapse" id="e-quote" data-parent="#navbarVerticalCollapse">
        <li class="nav-item"><a class="nav-link" href="../sales_quotation/create_quotation.php">Create New Quotation</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../sales_quotation/manage_quotation.php">Manage Quotations</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../sales_order/create_from_quotations.php">Sales Order From Quotation</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../sales_order/create_sales_order.php">Sales Order From Scratch</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../sales_order/manage_sales.php">Manage Sales Order</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../sales_order/dir_create_sales_order.php">Director Sales</a>
        </li>
      </ul>
    </li>

    <!-- Payroll-->
    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#e-payroll" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="e-commerce">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-user-friends" style="color:purple;"></span></span><span class="nav-link-text"> Payroll</span>
        </div>
      </a>
      <ul class="nav collapse" id="e-payroll" data-parent="#navbarVerticalCollapse">
        <li class="nav-item"><a class="nav-link" href="../payroll/create_employee.php">Employee Settings</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/benefits.php">Define Benefits</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/deductions.php">Define Deductions</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/employee_listing_ui.php">Employee Listing</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/employee_attendance.php">Employee Attendance</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/attendance_listing_ui.php">Attendance Listing</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/emp_benefit.php">Earnings and Deductions</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/advance_salary.php">Advance Salary</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/advance_listing_ui.php">Advance Listing</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/expense_mngt.php">Company Loans</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/loans_deduct_ui.php">Company Loans Listings</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/loans_deduct_ui.php">Listing of Loans</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/payroll_muster.php">Payroll Master</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/assign_leave.php">Leave Assignement</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/leave_app.php">Employee Leave Application</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/leave_assignlisting_ui.php">Manage Leave Assignment</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="../payroll/leave_listing_ui.php">Manage Leave Application</a>
        </li>
        <li class="nav-item"><a class="nav-link dropdown-indicator" href="#e-company" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="authentication-basic">Company Settings</a>
          <ul class="nav collapse" id="e-company" data-parent="#authentication">
            <li class="nav-item"><a class="nav-link" href="../payroll/create_shift.php">Create Shift</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="../payroll/nhif.php">Define NHIF Rates</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="../payroll/nhif_listing_ui.php">NHIF LIsting</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="../payroll/paye.php">Define P.A.Y.E Rates</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="../payroll/paye_listing_ui.php">P.A.Y.E LIsting</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="../payroll/shift_listing_ui.php">Shifts Listing</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="../payroll/create_branch.php">Create Branch</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="../payroll/branch_listing_ui.php">Branch Listing</a>
            </li>
          </ul>
        </li>

      </ul>
    </li>


    <!-- Customer Relations Management -->
    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#e-pos" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="e-commerce">
        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-store" style="color:#Fb870c;"></span></span><span class="nav-link-text">Ultimate POS</span>
        </div>
      </a>
      <ul class="nav collapse" id="e-pos" data-parent="#navbarVerticalCollapse">
        <li class="nav-item"><a class="nav-link" href="../pos/pos.php">POS</a>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">POS Listing</a>
        </li>
      </ul>
    </li>


    <!-- End of Qubes Working  -->

    <ul class="nav collapse" id="authentication" data-parent="#navbarVerticalCollapse">
      <li class="nav-item"><a class="nav-link dropdown-indicator" href="#authentication-basic" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="authentication-basic">Basic</a>
        <ul class="nav collapse" id="authentication-basic" data-parent="#authentication">
          <li class="nav-item"><a class="nav-link" href="../authentication/basic/login.html">Login</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/basic/logout.html">Logout</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/basic/register.html">Register</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/basic/forgot-password.html">Forgot password</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/basic/reset-password.html">Reset password</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/basic/confirm-mail.html">Confirm mail</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/basic/lock-screen.html">Lock screen</a>
          </li>
        </ul>
      </li>
      <li class="nav-item"><a class="nav-link dropdown-indicator" href="#authentication-card" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="authentication-card">Card</a>
        <ul class="nav collapse" id="authentication-card" data-parent="#authentication">
          <li class="nav-item"><a class="nav-link" href="../authentication/card/login.html">Login</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/card/logout.html">Logout</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/card/register.html">Register</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/card/forgot-password.html">Forgot password</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/card/reset-password.html">Reset password</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/card/confirm-mail.html">Confirm mail</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/card/lock-screen.html">Lock screen</a>
          </li>
        </ul>
      </li>
      <li class="nav-item"><a class="nav-link dropdown-indicator" href="#authentication-split" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="authentication-split">Split</a>
        <ul class="nav collapse" id="authentication-split" data-parent="#authentication">
          <li class="nav-item"><a class="nav-link" href="../authentication/split/login.html">Login</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/split/logout.html">Logout</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/split/register.html">Register</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/split/forgot-password.html">Forgot password</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/split/reset-password.html">Reset password</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/split/confirm-mail.html">Confirm mail</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../authentication/split/lock-screen.html">Lock screen</a>
          </li>
        </ul>
      </li>
      <li class="nav-item"><a class="nav-link" href="../authentication/wizard.html">Wizard</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="#!" data-toggle="modal" data-target="#authentication-modal">In modal</a>
      </li>
    </ul>
    </li>

  </ul>
  <!--
  <div class="navbar-vertical-divider">
    <hr class="navbar-vertical-hr my-2" />
  </div>
-->
</div>
<!--
EOD;
}
-->
