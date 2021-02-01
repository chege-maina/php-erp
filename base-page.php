<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Falcon | Dashboard &amp; Web App Templat</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicons/favicon.ico">
    <link rel="manifest" href="../assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="../assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="../assets/js/config.js"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="../assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="../assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <script>
      var isRTL = JSON.parse(localStorage.getItem('isRTL'));
      if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        linkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        linkRTL.setAttribute('disabled', true);
      }
    </script>
  </head>


  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
      <div class="container" data-layout="container">
        <script>
          var isFluid = JSON.parse(localStorage.getItem('isFluid'));
          if (isFluid) {
            var container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
          }
        </script>
        <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
          <script>
            var navbarStyle = localStorage.getItem("navbarStyle");
            if (navbarStyle && navbarStyle !== 'transparent') {
              document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
            }
          </script>
          <div class="d-flex align-items-center">
            <div class="toggle-icon-wrapper">

              <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-toggle="tooltip" data-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

            </div><a class="navbar-brand" href="../index.html">
              <div class="d-flex align-items-center py-3"><img class="mr-2" src="../assets/img/illustrations/falcon.png" alt="" width="40" /><span class="font-sans-serif">falcon</span>
              </div>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
            <div class="navbar-vertical-content scrollbar">
              <ul class="navbar-nav flex-column">
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#home" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="home">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-chart-pie"></span></span><span class="nav-link-text"> Home</span>
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
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#pages" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="pages">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-copy"></span></span><span class="nav-link-text"> Pages</span>
                    </div>
                  </a>
                  <ul class="nav collapse show" id="pages" data-parent="#navbarVerticalCollapse">
                    <li class="nav-item"><a class="nav-link active" href="../pages/activity.html">Activity</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/associations.html">Associations</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/billing.html">Billing</a>
                    </li>
                    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#pages-errors" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="pages-errors">Errors</a>
                      <ul class="nav collapse" id="pages-errors" data-parent="#pages">
                        <li class="nav-item"><a class="nav-link" href="../pages/errors/404.html">404</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="../pages/errors/500.html">500</a>
                        </li>
                      </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/event-create.html">Event create</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/event-detail.html">Event detail</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/events.html">Events</a>
                    </li>
                    <li class="nav-item"><a class="nav-link dropdown-indicator" href="#pages-faq" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="pages-faq">
                        <div class="d-flex align-items-center">Faq<span class="badge rounded-pill ml-2 badge-soft-success">New</span>
                        </div>
                      </a>
                      <ul class="nav collapse" id="pages-faq" data-parent="#pages">
                        <li class="nav-item"><a class="nav-link" href="../pages/faq/faq-basic.html">Faq basic</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="../pages/faq/faq-alt.html">Faq alt</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="../pages/faq/faq-accordion.html">Faq accordion</a>
                        </li>
                      </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/invite-people.html">Invite people</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/invoice.html">Invoice</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/notifications.html">Notifications</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/people.html">People</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/pricing.html">Pricing</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/pricing-alt.html">Pricing alt</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/privacy-policy.html">
                        <div class="d-flex align-items-center">Privacy policy<span class="badge rounded-pill ml-2 badge-soft-success">New</span>
                        </div>
                      </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/profile.html">Profile</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/settings.html">Settings</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../pages/starter.html">Starter</a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="../chat.html">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-comments"></span></span><span class="nav-link-text"> Chat</span>
                    </div>
                  </a>
                </li>
                <li class="nav-item"><a class="nav-link" href="../kanban.html">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fab fa-trello"></span></span><span class="nav-link-text"> Kanban</span>
                    </div>
                  </a>
                </li>
                <li class="nav-item"><a class="nav-link" href="../calendar.html">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-calendar-alt"></span></span><span class="nav-link-text"> Calendar</span>
                    </div>
                  </a>
                </li>
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#email" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="email">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-envelope-open"></span></span><span class="nav-link-text"> Email</span>
                    </div>
                  </a>
                  <ul class="nav collapse" id="email" data-parent="#navbarVerticalCollapse">
                    <li class="nav-item"><a class="nav-link" href="../email/inbox.html">Inbox</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../email/email-detail.html">Email detail</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../email/compose.html">Compose</a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#authentication" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="authentication">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-unlock-alt"></span></span><span class="nav-link-text"> Authentication</span>
                    </div>
                  </a>
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
                <li class="nav-item"><a class="nav-link dropdown-indicator" href="#e-commerce" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="e-commerce">
                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-cart-plus"></span></span><span class="nav-link-text"> E commerce</span>
                    </div>
                  </a>
                  <ul class="nav collapse" id="e-commerce" data-parent="#navbarVerticalCollapse">
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/checkout.html">Checkout</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/customer-details.html">Customer details</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/customers.html">Customers</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/order-details.html">Order details</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/orders.html">Orders</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/product-details.html">Product details</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/product-grid.html">Product grid</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/product-list.html">Product list</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../e-commerce/shopping-cart.html">Shopping cart</a>
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
          </div>
        </nav>
        <div class="content">
          <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand">

            <button class="btn navbar-toggler-humburger-icon navbar-toggler mr-1 mr-sm-3" type="button" data-toggle="collapse" data-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
            <a class="navbar-brand mr-1 mr-sm-3" href="../index.html">
              <div class="d-flex align-items-center"><img class="mr-2" src="../assets/img/illustrations/falcon.png" alt="" width="40" /><span class="font-sans-serif">falcon</span>
              </div>
            </a>
            <ul class="navbar-nav align-items-center d-none d-lg-block">
              <li class="nav-item">
                <div class="search-box" data-list='{"valueNames":["title"]}'>
                  <form class="position-relative" data-toggle="search" data-display="static">
                    <input class="form-control search-input fuzzy-search" type="search" placeholder="Search..." aria-label="Search" />
                    <span class="fas fa-search search-box-icon"></span>

                  </form>
                  <button class="btn-close position-absolute right-0 top-50 translate-middle shadow-none p-1 mr-1 fs--2" type="button" data-dismiss="search"></button>
                  <div class="dropdown-menu border font-base left-0 mt-2 py-0 overflow-hidden w-100">
                    <div class="scrollbar list py-3" style="max-height: 24rem;">
                      <h6 class="dropdown-header fw-medium text-uppercase px-card fs--2 pt-0 pb-2">Recently Browsed</h6><a class="dropdown-item fs--1 px-card py-1 hover-primary" href="../pages/events.html">
                        <div class="d-flex align-items-center">
                          <span class="fas fa-circle mr-2 text-300 fs--2"></span>

                          <div class="fw-normal title">Pages <span class="fas fa-chevron-right mx-1 text-500 fs--2" data-fa-transform="shrink-2"></span> Events</div>
                        </div>
                      </a>
                      <a class="dropdown-item fs--1 px-card py-1 hover-primary" href="../e-commerce/customers.html">
                        <div class="d-flex align-items-center">
                          <span class="fas fa-circle mr-2 text-300 fs--2"></span>

                          <div class="fw-normal title">E-commerce <span class="fas fa-chevron-right mx-1 text-500 fs--2" data-fa-transform="shrink-2"></span> Customers</div>
                        </div>
                      </a>

                      <hr class="bg-200" />
                      <h6 class="dropdown-header fw-medium text-uppercase px-card fs--2 pt-0 pb-2">Suggested Filter</h6><a class="dropdown-item px-card py-1 fs-0" href="../e-commerce/customers.html">
                        <div class="d-flex align-items-center"><span class="badge fw-medium text-decoration-none mr-2 badge-soft-warning">customers:</span>
                          <div class="flex-1 fs--1 title">All customers list</div>
                        </div>
                      </a>
                      <a class="dropdown-item px-card py-1 fs-0" href="../pages/events.html">
                        <div class="d-flex align-items-center"><span class="badge fw-medium text-decoration-none mr-2 badge-soft-success">events:</span>
                          <div class="flex-1 fs--1 title">Latest events in current month</div>
                        </div>
                      </a>
                      <a class="dropdown-item px-card py-1 fs-0" href="../e-commerce/product-grid.html">
                        <div class="d-flex align-items-center"><span class="badge fw-medium text-decoration-none mr-2 badge-soft-info">products:</span>
                          <div class="flex-1 fs--1 title">Most popular products</div>
                        </div>
                      </a>

                      <hr class="bg-200" />
                      <h6 class="dropdown-header fw-medium text-uppercase px-card fs--2 pt-0 pb-2">Files</h6><a class="dropdown-item px-card py-2" href="#!">
                        <div class="d-flex align-items-center">
                          <div class="file-thumbnail mr-2"><img class="border h-100 w-100 fit-cover rounded-3" src="../assets/img/products/3-thumb.png" alt="" /></div>
                          <div class="flex-1">
                            <h6 class="mb-0 title">iPhone</h6>
                            <p class="fs--2 mb-0"><span class="fw-semi-bold">Antony</span><span class="fw-medium text-600 ml-2">27 Sep at 10:30 AM</span></p>
                          </div>
                        </div>
                      </a>
                      <a class="dropdown-item px-card py-2" href="#!">
                        <div class="d-flex align-items-center">
                          <div class="file-thumbnail mr-2"><img class="img-fluid" src="../assets/img/icons/zip.png" alt="" /></div>
                          <div class="flex-1">
                            <h6 class="mb-0 title">Falcon v1.8.2</h6>
                            <p class="fs--2 mb-0"><span class="fw-semi-bold">John</span><span class="fw-medium text-600 ml-2">30 Sep at 12:30 PM</span></p>
                          </div>
                        </div>
                      </a>

                      <hr class="bg-200" />
                      <h6 class="dropdown-header fw-medium text-uppercase px-card fs--2 pt-0 pb-2">Members</h6><a class="dropdown-item px-card py-2" href="../pages/profile.html">
                        <div class="d-flex align-items-center">
                          <div class="avatar avatar-l status-online mr-2">
                            <img class="rounded-circle" src="../assets/img/team/1.jpg" alt="" />

                          </div>
                          <div class="flex-1">
                            <h6 class="mb-0 title">Anna Karinina</h6>
                            <p class="fs--2 mb-0">Technext Limited</p>
                          </div>
                        </div>
                      </a>
                      <a class="dropdown-item px-card py-2" href="../pages/profile.html">
                        <div class="d-flex align-items-center">
                          <div class="avatar avatar-l mr-2">
                            <img class="rounded-circle" src="../assets/img/team/2.jpg" alt="" />

                          </div>
                          <div class="flex-1">
                            <h6 class="mb-0 title">Antony Hopkins</h6>
                            <p class="fs--2 mb-0">Brain Trust</p>
                          </div>
                        </div>
                      </a>
                      <a class="dropdown-item px-card py-2" href="../pages/profile.html">
                        <div class="d-flex align-items-center">
                          <div class="avatar avatar-l mr-2">
                            <img class="rounded-circle" src="../assets/img/team/3.jpg" alt="" />

                          </div>
                          <div class="flex-1">
                            <h6 class="mb-0 title">Emma Watson</h6>
                            <p class="fs--2 mb-0">Google</p>
                          </div>
                        </div>
                      </a>

                    </div>
                  </div>
                </div>
              </li>
            </ul>
            <ul class="navbar-nav navbar-nav-icons ml-auto flex-row align-items-center">
              <li class="nav-item"><a class="nav-link settings-popover" href="#settings-modal" data-toggle="modal"><span class="ripple"></span><span class="fa-spin position-absolute all-0 d-flex flex-center"><span class="icon-spin position-absolute all-0 d-flex flex-center">
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.7369 12.3941L19.1989 12.1065C18.4459 11.7041 18.0843 10.8487 18.0843 9.99495C18.0843 9.14118 18.4459 8.28582 19.1989 7.88336L19.7369 7.59581C19.9474 7.47484 20.0316 7.23291 19.9474 7.03131C19.4842 5.57973 18.6843 4.28943 17.6738 3.20075C17.5053 3.03946 17.2527 2.99914 17.0422 3.12011L16.393 3.46714C15.6883 3.84379 14.8377 3.74529 14.1476 3.3427C14.0988 3.31422 14.0496 3.28621 14.0002 3.25868C13.2568 2.84453 12.7055 2.10629 12.7055 1.25525V0.70081C12.7055 0.499202 12.5371 0.297594 12.2845 0.257272C10.7266 -0.105622 9.16879 -0.0653007 7.69516 0.257272C7.44254 0.297594 7.31623 0.499202 7.31623 0.70081V1.23474C7.31623 2.09575 6.74999 2.8362 5.99824 3.25599C5.95774 3.27861 5.91747 3.30159 5.87744 3.32493C5.15643 3.74527 4.26453 3.85902 3.53534 3.45302L2.93743 3.12011C2.72691 2.99914 2.47429 3.03946 2.30587 3.20075C1.29538 4.28943 0.495411 5.57973 0.0322686 7.03131C-0.051939 7.23291 0.0322686 7.47484 0.242788 7.59581L0.784376 7.8853C1.54166 8.29007 1.92694 9.13627 1.92694 9.99495C1.92694 10.8536 1.54166 11.6998 0.784375 12.1046L0.242788 12.3941C0.0322686 12.515 -0.051939 12.757 0.0322686 12.9586C0.495411 14.4102 1.29538 15.7005 2.30587 16.7891C2.47429 16.9504 2.72691 16.9907 2.93743 16.8698L3.58669 16.5227C4.29133 16.1461 5.14131 16.2457 5.8331 16.6455C5.88713 16.6767 5.94159 16.7074 5.99648 16.7375C6.75162 17.1511 7.31623 17.8941 7.31623 18.7552V19.2891C7.31623 19.4425 7.41373 19.5959 7.55309 19.696C7.64066 19.7589 7.74815 19.7843 7.85406 19.8046C9.35884 20.0925 10.8609 20.0456 12.2845 19.7729C12.5371 19.6923 12.7055 19.4907 12.7055 19.2891V18.7346C12.7055 17.8836 13.2568 17.1454 14.0002 16.7312C14.0496 16.7037 14.0988 16.6757 14.1476 16.6472C14.8377 16.2446 15.6883 16.1461 16.393 16.5227L17.0422 16.8698C17.2527 16.9907 17.5053 16.9504 17.6738 16.7891C18.7264 15.7005 19.4842 14.4102 19.9895 12.9586C20.0316 12.757 19.9474 12.515 19.7369 12.3941ZM10.0109 13.2005C8.1162 13.2005 6.64257 11.7893 6.64257 9.97478C6.64257 8.20063 8.1162 6.74905 10.0109 6.74905C11.8634 6.74905 13.3792 8.20063 13.3792 9.97478C13.3792 11.7893 11.8634 13.2005 10.0109 13.2005Z" fill="#2A7BE4"></path>
                      </svg></span></span></a></li>
              <li class="nav-item">
                <a class="nav-link px-0 notification-indicator notification-indicator-warning notification-indicator-fill icon-indicator" href="../e-commerce/shopping-cart.html"><span class="fas fa-shopping-cart" data-fa-transform="shrink-7" style="font-size: 33px;"></span><span class="notification-indicator-number">1</span></a>

              </li>
              <li class="nav-item dropdown">
                <a class="nav-link notification-indicator notification-indicator-primary px-0 icon-indicator" id="navbarDropdownNotification" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;"></span></a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-card" aria-labelledby="navbarDropdownNotification">
                  <div class="card card-notification shadow-none">
                    <div class="card-header">
                      <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                          <h6 class="card-header-title mb-0">Notifications</h6>
                        </div>
                        <div class="col-auto"><a class="card-link fw-normal" href="#">Mark all as read</a></div>
                      </div>
                    </div>
                    <div class="list-group list-group-flush fw-normal fs--1">
                      <div class="list-group-title border-bottom">NEW</div>
                      <div class="list-group-item">
                        <a class="notification notification-flush notification-unread" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-2xl mr-3">
                              <img class="rounded-circle" src="../assets/img/team/1-thumb.png" alt="" />

                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1"><strong>Emma Watson</strong> replied to your comment : "Hello world 😍"</p>
                            <span class="notification-time"><span class="mr-2" role="img" aria-label="Emoji">💬</span>Just now</span>

                          </div>
                        </a>

                      </div>
                      <div class="list-group-item">
                        <a class="notification notification-flush notification-unread" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-2xl mr-3">
                              <div class="avatar-name rounded-circle"><span>AB</span></div>
                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong> status</p>
                            <span class="notification-time"><span class="mr-2 fab fa-gratipay text-danger"></span>9hr</span>

                          </div>
                        </a>

                      </div>
                      <div class="list-group-title border-bottom">EARLIER</div>
                      <div class="list-group-item">
                        <a class="notification notification-flush" href="#!">
                          <div class="notification-avatar">
                            <div class="avatar avatar-2xl mr-3">
                              <img class="rounded-circle" src="../assets/img/icons/weather-sm.jpg" alt="" />

                            </div>
                          </div>
                          <div class="notification-body">
                            <p class="mb-1">The forecast today shows a low of 20&#8451; in California. See today's weather.</p>
                            <span class="notification-time"><span class="mr-2" role="img" aria-label="Emoji">🌤️</span>1d</span>

                          </div>
                        </a>

                      </div>
                    </div>
                    <div class="card-footer text-center border-top"><a class="card-link d-block" href="../pages/notifications.html">View all</a></div>
                  </div>
                </div>

              </li>
              <li class="nav-item dropdown"><a class="nav-link pr-0" id="navbarDropdownUser" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="avatar avatar-xl">
                    <img class="rounded-circle" src="../assets/img/team/3-thumb.png" alt="" />

                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownUser">
                  <div class="bg-white dark__bg-1000 rounded-2 py-2">
                    <a class="dropdown-item fw-bold text-warning" href="#!"><span class="fas fa-crown mr-1"></span><span>Go Pro</span></a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#!">Set status</a>
                    <a class="dropdown-item" href="../pages/profile.html">Profile &amp; account</a>
                    <a class="dropdown-item" href="#!">Feedback</a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../pages/settings.html">Settings</a>
                    <a class="dropdown-item" href="../authentication/card/logout.html">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </nav>
          <div class="card">
            <div class="card-header bg-light">
              <h5 class="mb-0">Activity log</h5>
            </div>
            <div class="card-body fs--1 p-0">
              <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-xl mr-3">
                    <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">🔍</span></div>
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>Anthony Hopkins</strong> Followed <strong>Massachusetts Institute of Technology</strong></p>
                  <span class="notification-time">Just Now</span>

                </div>
              </a>

              <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-xl mr-3">
                    <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">📌</span></div>
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>Anthony Hopkins</strong> Save a <strong>Life Event</strong></p>
                  <span class="notification-time">Yesterday</span>

                </div>
              </a>

              <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-xl mr-3">
                    <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">🏷️</span></div>
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>Rowan Atkinson</strong> Tagged <strong>Anthony Hopkins</strong> in a live video</p>
                  <span class="notification-time">December 1, 8:00 PM</span>

                </div>
              </a>

              <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-xl mr-3">
                    <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">💬</span></div>
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>Robert Downey</strong> mention <strong>Anthony Hopkins</strong> in a comment</p>
                  <span class="notification-time">November 27, 12:00 AM</span>

                </div>
              </a>

              <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-xl mr-3">
                    <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">😂</span></div>
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>Anthony Hopkins</strong> reacted to a comment of <strong>Anna Karinina</strong></p>
                  <span class="notification-time">November 20, 8:00 Am</span>

                </div>
              </a>

              <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-xl mr-3">
                    <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">🎁</span></div>
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>Jennifer Kent</strong> Congratulated <strong>Anthony Hopkins</strong></p>
                  <span class="notification-time">November 13, 5:00 Am</span>

                </div>
              </a>

              <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-xl mr-3">
                    <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">🏷️</span></div>
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>California Institute of Technology</strong> tagged <strong>Anthony Hopkins</strong> in a post.</p>
                  <span class="notification-time">November 8, 5:00 PM</span>

                </div>
              </a>

              <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-xl mr-3">
                    <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">📋️</span></div>
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>Anthony Hopkins</strong> joined <strong>Victory day cultural Program</strong> with <strong>Tony Stark</strong></p>
                  <span class="notification-time">November 01, 11:30 AM</span>

                </div>
              </a>

              <a class="notification border-x-0 border-bottom-0 border-300 rounded-top-0" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-xl mr-3">
                    <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">📅️</span></div>
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>Massachusetts Institute of Technology</strong> invited <strong>Anthony Hopkin</strong> to an event</p>
                  <span class="notification-time">October 28, 12:00 PM</span>

                </div>
              </a>

            </div>
          </div>
          <footer>
            <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">Thank you for creating with Falcon <span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2021 &copy; <a href="https://themewagon.com">Themewagon</a></p>
              </div>
              <div class="col-12 col-sm-auto text-center">
                <p class="mb-0 text-600">v3.0.0-alpha11</p>
              </div>
            </div>
          </footer>
        </div>
        <div class="modal fade modal-fixed-right modal-theme overflow-hidden" id="settings-modal" tabindex="-1" role="dialog" aria-labelledby="settings-modal-label" aria-hidden="true" data-options='{"autoShow":true,"autoShowDelay":3000,"showOnce":true}'>
          <div class="modal-dialog modal-dialog-vertical" role="document">
            <div class="modal-content border-0 vh-100 scrollbar">
              <div class="modal-header modal-header-settings bg-shape">
                <div class="z-index-1 py-1 light">
                  <h5 class="text-white" id="settings-modal-label"> <span class="fas fa-palette mr-2 fs-0"></span>Settings</h5>
                  <p class="mb-0 fs--1 text-white opacity-75"> Set your own customized style</p>
                </div>
                <button class="btn-close btn-close-white z-index-1 mt-0" type="button" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body px-card" id="themeController">
                <h5 class="fs-0">Color Scheme</h5>
                <p class="fs--1">Choose the perfect color mode for your app. </p>
                <div class="btn-group d-block w-100 btn-group-navbar-style">
                  <div class="row gx-2">
                    <div class="col-6">
                      <input class="btn-check" id="themeSwitcherLight" name="theme-color" type="radio" value="light" data-theme-control="theme" />
                      <label class="btn d-inline-block btn-navbar-style fs--1" for="themeSwitcherLight"> <span class="hover-overlay mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0" src="../assets/img/generic/falcon-mode-default.jpg" alt=""/></span><span class="label-text">Light</span></label>
                    </div>
                    <div class="col-6">
                      <input class="btn-check" id="themeSwitcherDark" name="theme-color" type="radio" value="dark" data-theme-control="theme" />
                      <label class="btn d-inline-block btn-navbar-style fs--1" for="themeSwitcherDark"> <span class="hover-overlay mb-2 rounded d-block"><img class="img-fluid img-prototype mb-0" src="../assets/img/generic/falcon-mode-dark.jpg" alt=""/></span><span class="label-text"> Dark</span></label>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="d-flex justify-content-between">
                  <div class="d-flex align-items-start"><img class="mr-2" src="../assets/img/icons/left-arrow-from-left.svg" width="20" alt="" />
                    <div class="flex-1">
                      <h5 class="fs-0">RTL Mode</h5>
                      <p class="fs--1 mb-0">Switch your language direction </p><a class="fs--1" href="../documentation/RTL.html">RTL Documentation</a>
                    </div>
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input ml-0" id="mode-rtl" type="checkbox" data-theme-control="isRTL" />
                  </div>
                </div>
                <hr />
                <div class="d-flex justify-content-between">
                  <div class="d-flex align-items-start"><img class="mr-2" src="../assets/img/icons/arrows-h.svg" width="20" alt="" />
                    <div class="flex-1">
                      <h5 class="fs-0">Fluid Layout</h5>
                      <p class="fs--1 mb-0">Toggle container layout system </p><a class="fs--1" href="../documentation/fluid-layout.html">Fluid Documentation</a>
                    </div>
                  </div>
                  <div class="form-check form-switch">
                    <input class="form-check-input ml-0" id="mode-fluid" type="checkbox" data-theme-control="isFluid" />
                  </div>
                </div>
                <hr />
                <div class="d-flex align-items-start"><img class="mr-2" src="../assets/img/icons/paragraph.svg" width="20" alt="" />
                  <div class="flex-1">
                    <h5 class="fs-0 d-flex align-items-center">Navigation Position </h5>
                    <p class="fs--1 mb-2">Select a suitable navigation system for your web application </p>
                    <div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" id="option-navbar-vertical" type="radio" name="navbar" value="vertical" data-page-url="../components/navbar/vertical.html" data-theme-control="navbarPosition" />
                        <label class="form-check-label" for="option-navbar-vertical">Vertical</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" id="option-navbar-top" type="radio" name="navbar" value="top" data-page-url="../components/navbar/top.html" data-theme-control="navbarPosition" />
                        <label class="form-check-label" for="option-navbar-top">Top</label>
                      </div>
                      <div class="form-check form-check-inline mr-0">
                        <input class="form-check-input" id="option-navbar-combo" type="radio" name="navbar" value="combo" data-page-url="../components/navbar/combo.html" data-theme-control="navbarPosition" />
                        <label class="form-check-label" for="option-navbar-combo">Combo</label>
                      </div>
                    </div>
                  </div>
                </div>
                <hr />
                <h5 class="fs-0 d-flex align-items-center">Vertical Navbar Style</h5>
                <p class="fs--1 mb-0">Switch between styles for your vertical navbar </p>
                <p> <a class="fs--1" href="../components/navbar/vertical.html#navbar-styles">See Documentation</a></p>
                <div class="btn-group d-block w-100 btn-group-navbar-style">
                  <div class="row gx-2">
                    <div class="col-6">
                      <input class="btn-check" id="navbar-style-transparent" type="radio" name="navbarStyle" value="transparent" data-theme-control="navbarStyle" />
                      <label class="btn d-block w-100 btn-navbar-style fs--1" for="navbar-style-transparent"> <img class="img-fluid img-prototype" src="../assets/img/generic/default.png" alt="" /><span class="label-text"> Transparent</span></label>
                    </div>
                    <div class="col-6">
                      <input class="btn-check" id="navbar-style-inverted" type="radio" name="navbarStyle" value="inverted" data-theme-control="navbarStyle" />
                      <label class="btn d-block w-100 btn-navbar-style fs--1" for="navbar-style-inverted"> <img class="img-fluid img-prototype" src="../assets/img/generic/inverted.png" alt="" /><span class="label-text"> Inverted</span></label>
                    </div>
                    <div class="col-6">
                      <input class="btn-check" id="navbar-style-card" type="radio" name="navbarStyle" value="card" data-theme-control="navbarStyle" />
                      <label class="btn d-block w-100 btn-navbar-style fs--1" for="navbar-style-card"> <img class="img-fluid img-prototype" src="../assets/img/generic/card.png" alt="" /><span class="label-text"> Card</span></label>
                    </div>
                    <div class="col-6">
                      <input class="btn-check" id="navbar-style-vibrant" type="radio" name="navbarStyle" value="vibrant" data-theme-control="navbarStyle" />
                      <label class="btn d-block w-100 btn-navbar-style fs--1" for="navbar-style-vibrant"> <img class="img-fluid img-prototype" src="../assets/img/generic/vibrant.png" alt="" /><span class="label-text"> Vibrant</span></label>
                    </div>
                  </div>
                </div>
                <div class="text-center mt-5"><img class="mb-4" src="../assets/img/illustrations/settings.png" alt="" width="120" />
                  <h5>Like What You See?</h5>
                  <p class="fs--1">Get Falcon now and create beautiful dashboards with hundreds of widgets.</p><a class="btn btn-primary" href="https://themes.getbootstrap.com/product/falcon-admin-dashboard-webapp-template/" target="_blank">Purchase</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="authentication-modal" tabindex="-1" role="dialog" aria-labelledby="authentication-modal-label" aria-hidden="true">
          <div class="modal-dialog mt-6" role="document">
            <div class="modal-content border-0">
              <div class="modal-header px-5 position-relative modal-shape-header bg-shape">
                <div class="position-relative z-index-1 light">
                  <h4 class="mb-0 text-white" id="authentication-modal-label">Register</h4>
                  <p class="fs--1 mb-0 text-white">Please create your free Falcon account</p>
                </div>
                <button class="btn-close btn-close-white position-absolute top-0 right-0 mt-2 mr-2" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body py-4 px-5">
                <form>
                  <div class="mb-3">
                    <label class="form-label" for="modal-auth-name">Name</label>
                    <input class="form-control" type="text" id="modal-auth-name" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="modal-auth-email">Email address</label>
                    <input class="form-control" type="email" id="modal-auth-email" />
                  </div>
                  <div class="row gx-3">
                    <div class="mb-3 col-sm-6">
                      <label class="form-label" for="modal-auth-password">Password</label>
                      <input class="form-control" type="password" id="modal-auth-password" />
                    </div>
                    <div class="mb-3 col-sm-6">
                      <label class="form-label" for="modal-auth-confirm-password">Confirm Password</label>
                      <input class="form-control" type="password" id="modal-auth-confirm-password" />
                    </div>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="modal-auth-register-checkbox" />
                    <label class="form-label" for="modal-auth-register-checkbox">I accept the <a href="#!">terms </a>and <a href="#!">privacy policy</a></label>
                  </div>
                  <div class="mb-3">
                    <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Register</button>
                  </div>
                </form>
                <div class="position-relative mt-5">
                  <hr class="bg-300" />
                  <div class="divider-content-center">or register with</div>
                </div>
                <div class="row g-2 mt-2">
                  <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100" href="#"><span class="fab fa-google-plus-g mr-2" data-fa-transform="grow-8"></span> google</a></div>
                  <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100" href="#"><span class="fab fa-facebook-square mr-2" data-fa-transform="grow-8"></span> facebook</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="../vendors/popper/popper.min.js"></script>
    <script src="../vendors/bootstrap/bootstrap.min.js"></script>
    <script src="../vendors/anchorjs/anchor.min.js"></script>
    <script src="../vendors/is/is.min.js"></script>
    <script src="../vendors/fontawesome/all.min.js"></script>
    <script src="../vendors/lodash/lodash.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="../vendors/list.js/list.min.js"></script>
    <script src="../assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
  </body>

</html>