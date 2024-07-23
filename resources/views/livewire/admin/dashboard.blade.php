<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @if ($groupedBudgets->isEmpty())
                <div class="col-sm-12">
                    <div class="card small-widget mb-sm-0">
                        <div class="card-body primary"> <span class="f-light fs-14">No Budget
                                Found</span>

                            <div class="bg-gradient">
                                <i data-feather="slack" style="font-size: 30px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @foreach ($groupedBudgets as $departmentCode => $departmentBudgets)
                    @php
                        $department = $departments->where('department_code', $departmentCode)->first();
                        $departmentName = $department ? $department->department_name : 'Unknown Department';
                    @endphp
                    <div class="col-md-6 col-xl-4">
                        <div class="card small-widget mb-sm-0">
                            <div class="card-body primary"> <span class="f-light">{{ $departmentName }}</span>
                                <div class="d-flex align-items-end gap-1"><span class="font-primary f-12 f-w-500">
                                        <h4>{{ $departmentBudgets->sum('budget_approvedAmount') }}
                                    </span>
                                </div>
                                <div class="bg-gradient">
                                    <i data-feather="slack" class="font-primary" style="font-size: 30px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="row g-sm-3 height-equal-2 widget-charts mt-3">
            @if ($groupedBudgetRequests->isEmpty())
                <div class="col-sm-12">
                    <div class="card small-widget mb-sm-0">
                        <div class="card-body primary"> <span class="f-light fs-14">No Budget
                                Request Found</span>
                            <div class="bg-gradient">
                                <i data-feather="slack" style="font-size: 30px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @foreach ($groupedBudgetRequests as $departmentCode => $departmentBudgets)
                    @php
                        $department = $departments->where('department_code', $departmentCode)->first();
                        $departmentName = $department ? $department->department_name : 'Unknown Department';
                    @endphp
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-header card-no-border pb-0">
                                <div class="header-top">
                                    <h5>{{ $departmentName }}</h5>
                                </div>
                            </div>
                            <div class="card-body py-lg-3">
                                <ul class="user-list">
                                    <li>
                                        <div class="user-icon primary">
                                            <div class="user-box"><i class="icon-wallet fs-4 font-primary"
                                                    style="margin-left: 10px"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">Budget</h5><span
                                                class="font-primary d-flex align-items-center"><i
                                                    class="icon-arrow-up icon-rotate me-1"> </i><span
                                                    class="f-w-500">{{ $departmentBudgets->sum('request_approvedAmount') }}</span></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="user-icon success">
                                            <div class="user-box"><i class="icon-alert fs-4 font-success"
                                                    style="margin-left: 10px"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">Variance</h5><span
                                                class="font-danger d-flex align-items-center"><i
                                                    class="icon-arrow-down icon-rotate me-1"></i><span
                                                    class="f-w-500">{{ $departmentBudgets->sum('request_variance') }}</span></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
</div>
<!-- closing div for container-fluid -->
