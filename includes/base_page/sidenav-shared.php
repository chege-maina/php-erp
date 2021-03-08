<?php
function genSideBar()
{
  echo <<<EOD
  <div class="navbar-vertical-content scrollbar">
  <ul class="navbar-nav flex-column">
    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#home" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
      <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-home"></span></span><span class="nav-link-text"> Home</span>
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
    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-coins"></span></span><span class="nav-link-text"> Products</span>
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
  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-warehouse"></span></span><span class="nav-link-text"> Warehouse</span>
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
  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-dolly-flatbed"></span></span><span class="nav-link-text"> Procurement</span>
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
  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-users"></span></span><span class="nav-link-text"> Suppliers</span>
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
  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-money-check-alt"></span></span><span class="nav-link-text"> Accounts</span>
  </div>
</a>
<ul class="nav collapse" id="e-commerce" data-parent="#navbarVerticalCollapse">

  <li class="nav-item"><a class="nav-link" href="../sales_invoice/create_invoice.php">Create Invoice</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../sales_invoice/sales_invoice_listing.php">Sale Invoice Listing</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../Accounts/purchase_bill.php">Post Purchase Bill</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../Accounts/generate_remittance.php">Remittance Advice</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../Accounts/approve_remittance.php">Approve Remittance Advice</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../Accounts/pay_bill.php">Make Payment</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../Accounts/paybill_listing.php">Paybill Listing</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../Accounts/receive_payment.php">Receive Payment</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../Accounts/receipts_listing.php">Receipts Listing</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../Accounts/generate_receipt_advice.php">Receipt Advice</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../Accounts/approve_receipt_advice.php">Approve Receipt Advice</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../Accounts/purchase_bill_listing.php">Purchase Listing</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../Accounts/remittance_listing.php">Remittance Listing</a>
  </li>
</ul>
</li>
<!-- Customers -->
<li class="nav-item"><a class="nav-link dropdown-indicator" href="#e-custo" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="e-commerce">
  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-user-friends"></span></span><span class="nav-link-text"> Customers</span>
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
  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-tasks"></span></span><span class="nav-link-text"> Customer Relations</span>
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
<div class="navbar-vertical-divider">
  <hr class="navbar-vertical-hr my-2" />
</div>
<ul class="navbar-nav flex-column">
  <li class="nav-item"><a class="nav-link" href="../widgets.html">
    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-poll"></span></span><span class="nav-link-text"> Widgets</span>
    </div>
  </a>
</li>
<li class="nav-item"><a class="nav-link dropdown-indicator" href="#components" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="components">
  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-puzzle-piece"></span></span><span class="nav-link-text"> Components</span>
  </div>
</a>
<ul class="nav collapse" id="components" data-parent="#navbarVerticalCollapse">
  <li class="nav-item"><a class="nav-link" href="../components/accordion.html">Accordion</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/alerts.html">Alerts</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/avatar.html">Avatar</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/background.html">Background</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/badges.html">Badges</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/breadcrumb.html">Breadcrumb</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/bulk-select.html">Bulk select</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/buttons.html">Buttons</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/cards.html">Cards</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/carousel.html">Carousel</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/close-button.html">Close button</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/collapse.html">Collapse</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/cookie-notice.html">Cookie notice</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/dropdowns.html">Dropdowns</a>
  </li>
  <li class="nav-item"><a class="nav-link nav-link-disable" href="../components/fancyscroll.html">Fancyscroll</a>
  </li>
  <li class="nav-item"><a class="nav-link nav-link-disable" href="../components/fancytab.html">Fancytab</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/figures.html">Figures</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/hoverbox.html">Hoverbox</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/images.html">Images</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/list-group.html">List group</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/modals.html">Modals</a>
  </li>
  <li class="nav-item"><a class="nav-link dropdown-indicator" href="#components-navbar" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="components-navbar">Navbar</a>
    <ul class="nav collapse" id="components-navbar" data-parent="#components">
      <li class="nav-item"><a class="nav-link" href="../components/navbar/default.html">Default</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="../components/navbar/vertical.html">Vertical</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="../components/navbar/darken-on-scroll.html">Darken on scroll</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="../components/navbar/top.html">Top</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="../components/navbar/combo.html">Combo</a>
      </li>
    </ul>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/navs.html">Navs</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/page-headers.html">Page headers</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/pagination.html">Pagination</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/popovers.html">Popovers</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/progress.html">Progress</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/scrollspy.html">Scrollspy</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/search.html">Search</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/sidepanel.html">Sidepanel</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/spinners.html">Spinners</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/tables.html">Tables</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/tabs.html">Tabs</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/toasts.html">Toasts</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/tooltips.html">Tooltips</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../components/typography.html">Typography</a>
  </li>
</ul>
</li>
<li class="nav-item"><a class="nav-link dropdown-indicator" href="#forms" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="forms">
  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-align-left"></span></span><span class="nav-link-text"> Forms</span>
  </div>
</a>
<ul class="nav collapse" id="forms" data-parent="#navbarVerticalCollapse">
  <li class="nav-item"><a class="nav-link" href="../forms/checks.html">Checks</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../forms/file.html">File</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../forms/form-control.html">Form control</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../forms/input-group.html">Input group</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../forms/layout.html">Layout</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../forms/overview.html">Overview</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../forms/range.html">Range</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../forms/select.html">Select</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../forms/validation.html">Validation</a>
  </li>
</ul>
</li>
<li class="nav-item"><a class="nav-link dropdown-indicator" href="#utilities" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="utilities">
  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-fire"></span></span><span class="nav-link-text"> Utilities</span>
  </div>
</a>
<ul class="nav collapse" id="utilities" data-parent="#navbarVerticalCollapse">
  <li class="nav-item"><a class="nav-link" href="../utilities/borders.html">Borders</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/clearfix.html">Clearfix</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/colored-links.html">Colored links</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/colors.html">Colors</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/display.html">Display</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/embed.html">Embed</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/flex.html">Flex</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/float.html">Float</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/grid.html">Grid</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/position.html">Position</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/sizing.html">Sizing</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/spacing.html">Spacing</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/stretched-link.html">Stretched link</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/text-truncation.html">Text truncation</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/vertical-align.html">Vertical align</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../utilities/visibility.html">Visibility</a>
  </li>
</ul>
</li>
<li class="nav-item"><a class="nav-link dropdown-indicator" href="#plugins" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="plugins">
  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-plug"></span></span><span class="nav-link-text"> Plugins</span>
  </div>
</a>
<ul class="nav collapse" id="plugins" data-parent="#navbarVerticalCollapse">
  <li class="nav-item"><a class="nav-link" href="../plugins/anchor.html">Anchor</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/countup.html">Countup</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/choices.html">Choices</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/date-picker.html">Date picker</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/draggable.html">Draggable</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/dropzone.html">Dropzone</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/echarts.html">Echarts</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/emoji-button.html">Emoji button</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/fontawesome.html">Fontawesome</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/fullcalendar.html">Fullcalendar</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/glightbox.html">Glightbox</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/progressbar.html">Progressbar</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/inline-player.html">Inline player</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/list.html">List</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/lottie.html">Lottie</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/typed-text.html">Typed text</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/tinymce.html">Tinymce</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/swiper.html">Swiper</a>
  </li>
  <li class="nav-item"><a class="nav-link" href="../plugins/rater.html">Rater</a>
  </li>
  <li class="nav-item"><a class="nav-link dropdown-indicator" href="#plugins-map" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="plugins-map">Map</a>
    <ul class="nav collapse" id="plugins-map" data-parent="#plugins">
      <li class="nav-item"><a class="nav-link" href="../plugins/map/leaflet-map.html">Leaflet map</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="../plugins/map/google-map.html">Google map</a>
      </li>
    </ul>
  </li>
</ul>
</li>
</ul>
<div class="navbar-vertical-divider">
  <hr class="navbar-vertical-hr my-2" />
</div>
<ul class="navbar-nav flex-column">
  <li class="nav-item"><a class="nav-link dropdown-indicator" href="#documentation" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="documentation">
    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-book"></span></span><span class="nav-link-text"> Documentation</span>
    </div>
  </a>
  <ul class="nav collapse" id="documentation" data-parent="#navbarVerticalCollapse">
    <li class="nav-item"><a class="nav-link" href="../documentation/getting-started.html">Getting started</a>
    </li>
    <li class="nav-item"><a class="nav-link" href="../documentation/file-structure.html">File structure</a>
    </li>
    <li class="nav-item"><a class="nav-link" href="../documentation/customization.html">Customization</a>
    </li>
    <li class="nav-item"><a class="nav-link" href="../documentation/dark-mode.html">Dark mode</a>
    </li>
    <li class="nav-item"><a class="nav-link" href="../documentation/fluid-layout.html">Fluid layout</a>
    </li>
    <li class="nav-item"><a class="nav-link" href="../documentation/gulp.html">Gulp</a>
    </li>
    <li class="nav-item"><a class="nav-link" href="../documentation/RTL.html">RTL</a>
    </li>
    <li class="nav-item"><a class="nav-link" href="../documentation/plugins.html">Plugins</a>
    </li>
    <li class="nav-item"><a class="nav-link" href="../documentation/design-file.html">Design file</a>
    </li>
  </ul>
</li>
<li class="nav-item"><a class="nav-link" href="../changelog.html">
  <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-code-branch"></span></span><span class="nav-link-text"> Changelog</span>
  </div>
</a>
</li>
</ul>
<div class="settings">
  <div class="navbar-vertical-divider">
    <hr class="navbar-vertical-hr my-3" />
  </div><a class="btn btn-sm d-block w-100 btn-purchase" href="https://themes.getbootstrap.com/product/falcon-admin-dashboard-webapp-template/" target="_blank">Purchase</a>
</div>
</div>
EOD;
}
