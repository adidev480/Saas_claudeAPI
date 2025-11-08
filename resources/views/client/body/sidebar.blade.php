<div class="sidenav-menu">

    <!-- Brand Logo -->
    <a href="index.html" class="logo">
        <span class="logo-light">
            <span class="logo-lg"><img src="{{ asset('backend/assets/images/logo.png') }}" alt="logo"></span>
            <span class="logo-sm"><img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="small logo"></span>
        </span>

        <span class="logo-dark">
            <span class="logo-lg"><img src="{{ asset('backend/assets/images/logo-dark.png') }}" alt="dark logo"></span>
            <span class="logo-sm"><img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="small logo"></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-sm-hover">
        <i class="ri-circle-line align-middle"></i>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-fullsidebar">
        <i class="ti ti-x align-middle"></i>
    </button>

    <div data-simplebar>

        <!--- Sidenav Menu -->
        <ul class="side-nav">
            <li class="side-nav-title">
                Menu
            </li>

            <li class="side-nav-item">
                <a href="index.html" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                    <span class="menu-text"> Dashboard </span>
                    <span class="badge bg-danger rounded-pill">9+</span>
                </a>
            </li>

    

            <li class="side-nav-item">
                <a href="{{ route('user.all.projects') }}" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-message"></i></span>
                    <span class="menu-text"> Projects </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="apps-calendar.html" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-calendar"></i></span>
                    <span class="menu-text"> Calendar </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="apps-email.html" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-mailbox"></i></span>
                    <span class="menu-text"> Email </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarInvoice" aria-expanded="false" aria-controls="sidebarInvoice" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-invoice"></i></span>
                    <span class="menu-text"> Invoice</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarInvoice">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="apps-invoices.html" class="side-nav-link">
                                <span class="menu-text">Invoices</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="apps-invoice-details.html" class="side-nav-link">
                                <span class="menu-text">View Invoice</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="apps-invoice-create.html" class="side-nav-link">
                                <span class="menu-text">Create Invoice</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-title mt-2">
                Custom
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <span class="menu-icon"><i class="ti ti-package"></i></span>
                    <span class="menu-text"> Pages </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="sub-menu">
                        <li class="side-nav-item">
                            <a href="pages-starter.html" class="side-nav-link">
                                <span class="menu-text">Starter Page</span>
                            </a>
                        </li>
                            
                        
                    </ul>
                </div>
            </li>

                
        </ul>

        <!-- Help Box -->
        <div class="help-box text-center">
            <h5 class="fw-semibold fs-16">Your Plan Details</h5>
        
            <p class="mb-3 text-muted">
    Plan : <strong>{{ Auth::user()->plan->name }}</strong> <br>
    Tokens Avaiable: <br> 
    {{ Auth::user()->plan->token_limit - Auth::user()->token_used }} / {{ Auth::user()->plan->token_limit }} <br>

    Template Allowed: <br> {{ Auth::user()->projects->count() }} / {{ Auth::user()->plan->template_limit }}

            </p>
          
            <a href="{{ route('plans.upgrade') }}" class="btn btn-danger btn-sm">Upgrade</a>

        </div>

        <div class="clearfix"></div>
    </div>
</div>