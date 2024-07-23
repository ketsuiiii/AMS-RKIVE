<div class="sidebar-wrapper" sidebar-layout="stroke-svg">
    <div>
        <div class="logo-wrapper"><a href="{{ route('/') }}"><img class="img-fluid for-light"
                    src="{{ asset('assets/images/logo/rkive1.png') }}" alt=""
                    style="height: 40px; width: auto;"><img class="img-fluid for-dark"
                    src="{{ asset('assets/images/logo/rkive1.png') }}" alt=""
                    style="height: 40px; width: auto"></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('/') }}"><img class="img-fluid"
                    src="{{ asset('assets/images/logo/logo1.png') }}" alt=""
                    style="height: 35px; width: auto;"></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="{{ route('employee') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-home') }}"></use>
                            </svg><span>Dashboard</span></a></li>
                    {{-- <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="#" data-bs-original-title=""
                            title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-widget') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-widget') }}"></use>
                            </svg><span>Company</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="">
                            <li><a href="{{ route('roleForm') }}" data-bs-original-title="" title="">Roles</a>
                            </li>
                            <li><a href="{{ route('deptForm') }}" data-bs-original-title=""
                                    title="">Department</a>
                            </li>
                            <li><a href="{{ route('userForm') }}" data-bs-original-title="" title="">Users</a>
                            </li>
                        </ul>
                    </li> --}}
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="#" data-bs-original-title=""
                            title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-builders') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-builders') }}"></use>
                            </svg><span> Request</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="">
                            <li><a href="{{ route(strtolower($role) . '.new.budget') }}" data-bs-original-title=""
                                    title="">Budget Requests</a></li>
                            <li><a href="{{ route(strtolower($role) . '.new.addbudget') }}" data-bs-original-title=""
                                    title="">Add Budget Request</a></li>
                        </ul>
                    </li>
                    {{-- <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="{{route(strtolower($role).'.new.allocation') }}"
                            data-bs-original-title="" title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-editors') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-editors') }}"></use>
                            </svg><span>Budget Allocation</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                    </li> --}}
                    {{-- <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="{{route(strtolower($role).'.new.project') }}"
                            data-bs-original-title="" title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-project') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-project') }}"></use>
                            </svg><span>Project Management</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                    </li> --}}
                    {{-- <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="#" data-bs-original-title=""
                            title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-file') }}"></use>
                            </svg><span>Finance</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="">
                            <li><a href="{{route(strtolower($role).'.new.finance.budget') }}" data-bs-original-title=""
                                    title="">Budget</a></li>
                            <li><a href="{{route(strtolower($role).'.new.finance.cost') }}" data-bs-original-title=""
                                    title="">Cost</a></li>
                            <li><a href="{{route(strtolower($role).'.new.finance.expense') }}" data-bs-original-title=""
                                    title="">Expense</a></li>
                            <li><a href="{{route(strtolower($role).'.new.finance.payment') }}" data-bs-original-title=""
                                    title="">Payment</a></li>
                            <li><a href="{{route(strtolower($role).'.new.finance.pullRequests') }}" data-bs-original-title=""
                                    title="">Pull Requests</a></li>
                            <li><a href="{{route(strtolower($role).'.new.finance.approvalRequests') }}" data-bs-original-title=""
                                    title="">Approval Requests</a></li>
                        </ul>
                    </li> --}}
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="#" data-bs-original-title=""
                            title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-ui-kits') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-ui-kits') }}"></use>
                            </svg><span>Tracker</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="">
                            <li><a href="{{ route(strtolower($role) . '.new.budgetPlan') }}" data-bs-original-title=""
                                    title="">Budget</a></li>
                            <li><a href="{{ route(strtolower($role) . '.new.analytics') }}" data-bs-original-title=""
                                    title="">Analytics</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="#" data-bs-original-title=""
                            title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-button') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-button') }}"></use>
                            </svg><span>Travels</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="">
                            <li><a href="{{ route(strtolower($role) . '.new.travel') }}" data-bs-original-title=""
                                    title="">Travel Requests</a></li>
                            <li><a href="{{ route(strtolower($role) . '.new.travel-expenses') }}"
                                    data-bs-original-title="" title="">Monitor Travel expenses</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="#" data-bs-original-title=""
                            title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-bonus-kit') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-bonus-kit') }}"></use>
                            </svg><span>Ledger</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="">
                            <li><a href="{{ route('employee.old.budgets') }}" data-bs-original-title=""
                                    title="">Budgets</a></li>
                            <li><a href="{{ route('employee.old.addbudgets') }}" data-bs-original-title=""
                                    title="">Additional Budget</a></li>
                            <li><a href="{{ route('employee.old.cashflow') }}" data-bs-original-title=""
                                    title="">Cashflow</a></li>
                            <li><a href="{{ route('employee.old.balance') }}" data-bs-original-title=""
                                    title="">Balance</a></li>
                            <li><a href="{{ route('employee.old.income') }}" data-bs-original-title=""
                                    title="">Income</a></li>
                            <li><a href="{{ route('employee.old.payable') }}" data-bs-original-title=""
                                    title="">Payable</a></li>
                            <li><a href="{{ route('employee.old.recievable') }}" data-bs-original-title=""
                                    title="">Receivable</a></li>
                            <li><a href="{{ route('employee.old.turnover') }}" data-bs-original-title=""
                                    title="">Turnover</a></li>
                            <li><a href="{{ route('employee.old.sales') }}" data-bs-original-title=""
                                    title="">Sales</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="#" data-bs-original-title=""
                            title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-animation') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-animation') }}"></use>
                            </svg><span>Additional</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="">
                            <li><a href="{{ route('employee.old.report') }}" data-bs-original-title=""
                                    title="">Reporting</a>
                            </li>
                            <li><a href="{{ route('employee.old.analytics') }}" data-bs-original-title=""
                                    title="">Analytics</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="#" data-bs-original-title=""
                            title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-faq') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-faq') }}"></use>
                            </svg><span>Terms & Conditions</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                        <ul class="sidebar-submenu" style="">
                            <li><a href="{{ route('policy') }}" data-bs-original-title="" title="">Policy</a>
                            </li>
                            <li><a href="{{ route('responsibility') }}" data-bs-original-title=""
                                    title="">Responsibility</a>
                            </li>
                            <li><a href="{{ route('punishment') }}" data-bs-original-title=""
                                    title="">Punishment</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="{{ route('helpdesk') }}"
                            data-bs-original-title="" title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-task') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-task') }}"></use>
                            </svg><span>Help Desk</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="{{ route('calendar') }}"
                            data-bs-original-title="" title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-support-tickets') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-support-tickets') }}"></use>
                            </svg><span>Calendar</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active"
                            href="{{ route(strtolower($role) . '.new.incidentReport') }}" data-bs-original-title=""
                            title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-starter-kit') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-starter-kit') }}"></use>
                            </svg><span>Incident Report</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title active" href="{{ route('logs') }}"
                            data-bs-original-title="" title="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-learning') }}"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('assets/svg/icon-sprite.svg#fill-learning') }}"></use>
                            </svg><span>Logs</span>
                            <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
