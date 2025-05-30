<style>
    /* Main Dropdown Button */
    .dropdown-btn {
        padding: 6px 8px 6px 16px;
        color: #337AB7;
        display: block;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        outline: none;
        font-size: 14px;
        transition: background-color 0.2s ease;
    }

    /* Active Main Dropdown Button */
    .dropdown-btn.active {
        font-weight: bold;
        background-color: #337AB7;
        color: #ffffff;

    }

    /* Dropdown Container */
    .dropdown-container {
        display: none;
        padding-left: 8px;

    }

    .dropdown-container.show {
        display: block !important;
    }

    /* Dropdown List */
    .dropdown-container ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    /* Submenu Items */
    .dropdown-container ul li a {
        display: block;
        padding: 4px 16px;
        margin-block: 6px;
        color: #337AB7;
        text-decoration: none;
        font-size: 13px;
        transition: background-color 0.2s ease, color 0.2s ease;

    }

    /* Hover on submenu links */
    .dropdown-container ul li a:hover {
        background-color: #d9e6f2;
        color: #23527c;
        text-decoration: none;
    }

    /* Active submenu link */
    .dropdown-container ul li a.active {
        background-color: #5b9bd5;
        /* Light blue */
        color: #ffffff !important;
        font-weight: bold;
        border-radius: 4px 0 0 4px;
        /* Rounded on left side only */
    }

    /* Dropdown arrow icon */
    .fa-caret-down {
        float: right;
        padding-right: 8px;
    }

    /* Top-level nav active state */
    .nav>li>a.active {
       
        /* Light blue */
        color: #ffffff !important;
        background-color: #337AB7 !important;
        font-weight: bold;
    }



</style>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

            <!-- System Management -->
            <li>
                <a href="{{ route('home') }}" class="mainlinks {{ request()->routeIs('home') ? 'active' : '' }}">
                    <i class="fa fa-dashboard fa-fw"></i> @lang('Company_Admin/dashboard.Dashboard')
                </a>
            </li>
           
            <!-- Safety Guidelines -->
            <li>
                <button
                    class="dropdown-btn {{ request()->is('viewMethods') || request()->is('healthAndSafety') ? 'active' : '' }}">
                    <i class="fa fa-heart"></i> Method & Safety Guideline <i class="fa fa-caret-down"></i>
                </button>
                <div
                    class="dropdown-container {{ request()->is('viewMethods') || request()->is('healthAndSafety') ? 'show' : '' }}">
                    <ul>
                        <li><a href="{{ route('methodsindex') }}">@lang('common.Methods Management')</a></li>
                        <li><a href="{{ route('healthAndSafety') }}">@lang('common.Health And Safety Management')</a></li>
                    </ul>
                </div>
            </li>

            <!-- Company Setup -->
            <li>
                <button
                    class="dropdown-btn {{ request()->is('floor*') || request()->is('area*')|| request()->is('task*') || request()->is('element*') ? 'active' : '' }}">
                    <i class="fa fa-cogs"></i> Company Setup <i class="fa fa-caret-down"></i>
                </button>
                <div
                    class="dropdown-container {{ request()->is('floor*') || request()->is('area*') || request()->is('task*') || request()->is('element*') ? 'show' : '' }}">
                    <ul>
                        <li><a href="{{ route('floor.index') }}">@lang('common.Floors Management')</a></li>
                        <li><a href="{{ route('area.index') }}">@lang('common.Areas Management')</a></li>
                        <li><a href="{{ route('element.index') }}">@lang('common.Elements Management')</a></li>
                         <li><a href="{{ route('task.index') }}">@lang('common.Tasks Management')</a></li>
                    </ul>
                </div>
            </li>

            <!-- Human Resources -->
            <li>
                <button
                    class="dropdown-btn {{ request()->is('staff*') || request()->is('staffType*') || request()->is('employ_agency*') || request()->is('shift*') ? 'active' : '' }}">
                    <i class="fa fa-users"></i> Human Resources <i class="fa fa-caret-down"></i>
                </button>
                <div
                    class="dropdown-container {{ request()->is('staff*') || request()->is('staffType*') || request()->is('employ_agency*') || request()->is('shift*') ? 'show' : '' }}">
                    <ul>
                        <li><a href="{{ route('staff.index') }}">@lang('common.Staff Management')</a></li>
                        <li><a href="{{ route('staffType.index') }}">@lang('common.Staff Roles Management')</a></li>
                        <li><a href="{{ route('employ_agency.index') }}">@lang('common.Employment Agencies Management')</a></li>
                        <li><a href="{{ route('shift.index') }}">@lang('common.Shift Management')</a></li>
                    </ul>
                </div>
            </li>

            <!-- Project Management -->
            <li>
                <button
                    class="dropdown-btn {{ request()->is('project*')  || request()->is('projectcostestimate*') ? 'active' : '' }}">
                    <i class="fa fa-industry"></i> @lang('common.Projects') <i class="fa fa-caret-down"></i>
                </button>
                <div
                    class="dropdown-container {{ request()->is('project*') || request()->is('projectcostestimate*') ? 'show' : '' }}">
                    <ul>
                        <li><a href="{{ route('project.index') }}">@lang('common.Projects Management')</a></li>
                       
                        <li><a href="{{ route('projectcostestimate.index') }}">@lang('common.Projects Cost Estimate')</a></li>
                    </ul>
                </div>
            </li>

            <!-- Materials & Procurement -->
            <li>
                <button
                    class="dropdown-btn {{ request()->is('materialCategory*') || request()->is('materialType*') || request()->is('material*') || request()->is('supplier*') ? 'active' : '' }}">
                    <i class="fa fa-shopping-basket"></i> Materials & Procurement <i class="fa fa-caret-down"></i>
                </button>
                <div
                    class="dropdown-container {{ request()->is('materialCategory*') || request()->is('materialType*') || request()->is('material*') || request()->is('supplier*') ? 'show' : '' }}">
                    <ul>
                        <li><a href="{{ route('materialCategory.index') }}">@lang('Company_Admin/dashboard.Material') @lang('common.Category')</a>
                        </li>
                        <li><a href="{{ route('materialType.index') }}">@lang('Company_Admin/dashboard.Material') @lang('Company_Admin/dashboard.Types')</a></li>
                        <li><a href="{{ route('material.index') }}">@lang('common.Materials')</a></li>
                        <li><a href="{{ route('supplier.index') }}">@lang('common.Suppliers')</a></li>
                    </ul>
                </div>
            </li>

            <!-- Customers -->
            <li>
                <button
                    class="dropdown-btn {{ request()->is('customer*') || request()->is('quotations*') ? 'active' : '' }}">
                    <i class="fa fa-user"></i> Customers <i class="fa fa-caret-down"></i>
                </button>
                <div
                    class="dropdown-container {{ request()->is('customer*') || request()->is('quotations*') ? 'show' : '' }}">
                    <ul>
                        <li><a href="{{ route('customer.index') }}">@lang('common.Customers Management')</a></li>
                        <li><a href="{{ route('quotations.index') }}">@lang('Company_Admin/dashboard.Quotation')s @lang('Company_Admin/dashboard.Management')</a></li>
                    </ul>
                </div>
            </li>

            <!-- Reports -->
            <li>
                <button
                    class="dropdown-btn {{ request()->is('inspection*') || request()->is('workerReport*') || request()->is('worker-over-time-report*') || request()->is('erp-report*') || request()->is('expiry-report*') ? 'active' : '' }}">
                    <i class="fa fa-file"></i> @lang('common.Reports Management') <i class="fa fa-caret-down"></i>
                </button>
                <div
                    class="dropdown-container {{ request()->is('inspection*') || request()->is('workerReport*') || request()->is('worker-over-time-report*') || request()->is('erp-report*') || request()->is('expiry-report*') ? 'show' : '' }}">
                    <ul>
                        <li><a href="{{ route('inspection.index') }}">@lang('common.Antal inspec')</a></li>
                        <li><a href="{{ route('workerReport.index') }}">@lang('common.Worker report')</a></li>
                        <li><a href="{{ route('worker-over-time-report.index') }}">@lang('common.Worker overtime')</a></li>
                        <li><a href="{{ route('erp-report.index') }}">@lang('common.ERP Report')</a></li>
                        <li><a href="{{ route('expiry-report.index') }}">@lang('common.Expiry Report')</a></li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>


<script>
    const dropdowns = document.querySelectorAll(".dropdown-btn");

    dropdowns.forEach((btn) => {
        btn.addEventListener("click", function() {
            const wasActive = this.classList.contains("active");

            // Close all dropdowns
            dropdowns.forEach((btn) => {
                btn.classList.remove("active");
                btn.nextElementSibling.classList.remove("show");
            });

            // Toggle current
            if (!wasActive) {
                this.classList.add("active");
                this.nextElementSibling.classList.add("show");
            }
        });
    });
</script>
