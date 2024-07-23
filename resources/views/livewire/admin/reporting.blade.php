<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <!-- Section 1 -->
            <div class="card">
                <div class="card-header">
                    <h5>Generate Report</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <x-select label="Report Type" name="reportType" :options="$types" valueId="type_code"
                                valueName="type_name" wire:model.live="reportType" wire:change="resetSearch" />
                        </div>
                        <div class="col-md-6">
                            <x-select label="Department" name="report_department" :options="$departments"
                                valueId="department_code" valueName="department_name" wire:model.live="reportDepartment"
                                wire:change="resetReport" />
                        </div>
                        <div class="col-md-6">
                            <x-select label="Status" name="report_status" :options="$status" valueId="status_code"
                                valueName="status_name" wire:model.live="reportStatus" wire:change="resetReport" />
                        </div>
                        <div class="col-md-6">
                            <x-select label="Category" name="report_category" :options="$categories" valueId="category_code"
                                valueName="category_name" wire:model.live="reportCategory" wire:change="resetReport" />
                        </div>
                    </div>

                    <hr>

                    <div class="card-body text-center">
                        @if (empty($results))
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('assets/images/svg/void.svg') }}"
                                        style="min-height:200px; max-height:200px" alt=""><br> <br>
                                    <span>No Record Found</span>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            @if ($reportType == 'T1')
                                                <th scope="col">Plan Name</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Description</th>
                                            @elseif($reportType == 'T2')
                                                <th scope="col">Plan Name</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Budget Code</th>
                                            @elseif ($reportType == 'T3')
                                                <th scope="col">Name</th>
                                                <th scope="col">Info</th>
                                                <th scope="col">Amount</th>
                                            @elseif ($reportType == 'T4')
                                                <th scope="col">Name</th>
                                                <th scope="col">Info</th>
                                                <th scope="col">Amount</th>
                                            @elseif ($reportType == 'T5')
                                                <th scope="col">Name</th>
                                                <th scope="col">Info</th>
                                                <th scope="col">Amount</th>
                                            @elseif ($reportType == 'T6')
                                                <th scope="col">Name</th>
                                                <th scope="col">Info</th>
                                                <th scope="col">Amount</th>
                                            @elseif ($reportType == 'T7')
                                                <th scope="col">Name</th>
                                                <th scope="col">Info</th>
                                                <th scope="col">Amount</th>
                                            @elseif ($reportType == 'T8')
                                                <th scope="col">Name</th>
                                                <th scope="col">Info</th>
                                                <th scope="col">Amount</th>
                                            @elseif ($reportType == 'T9')
                                                <th scope="col">Name</th>
                                                <th scope="col">Info</th>
                                                <th scope="col">Revenue</th>
                                            @elseif ($reportType == 'R1')
                                                <th scope="col">Plan Name</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Description</th>
                                            @elseif($reportType == 'R2')
                                                <th scope="col">Plan Name</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Budget Code</th>
                                            @elseif($reportType == 'TR1')
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Amount</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @dd($results) --}}
                                        @foreach ($results as $item)
                                            @if ($reportType == 'T1')
                                                <tr wire:key="{{ $item->id }}">
                                                    <td>{{ $item->budget_name }}</td>
                                                    <td>{{ $item->budget_amount }}</td>
                                                    <td>{{ $item->budget_description }}</td>
                                                </tr>
                                            @elseif($reportType == 'T2')
                                                <tr wire:key="{{ $item->request_code }}">
                                                    <td>{{ $item->request_name }}</td>
                                                    <td>{{ $item->request_amount }}</td>
                                                    <td>{{ $item->request_description }}</td>
                                                    <td>{{ $item->request_budget_code }}</td>
                                                </tr>
                                            @elseif ($reportType == 'T3')
                                                @foreach ($item as $group)
                                                    <tr wire:key="{{ $group->cashflow_info }}">
                                                        <td>{{ $group->cashflow_info }}</td>
                                                        <td>{{ $group->cashflow_name }}</td>
                                                        <td>{{ $group->cashflow_amount }}</td>
                                                    </tr>
                                                @endforeach
                                            @elseif ($reportType == 'T4')
                                                @foreach ($item as $group)
                                                    <tr wire:key="{{ $group->income_info }}">
                                                        <td>{{ $group->income_info }}</td>
                                                        <td>{{ $group->income_name }}</td>
                                                        <td>{{ $group->income_amount }}</td>
                                                    </tr>
                                                @endforeach
                                            @elseif ($reportType == 'T5')
                                                @foreach ($item as $group)
                                                    <tr wire:key="{{ $group->balance_info }}">
                                                        <td>{{ $group->balance_info }}</td>
                                                        <td>{{ $group->balance_name }}</td>
                                                        <td>{{ $group->balance_amount }}</td>
                                                    </tr>
                                                @endforeach
                                            @elseif ($reportType == 'T6')
                                                @foreach ($item as $group)
                                                    <tr wire:key="{{ $group->payable_info }}">
                                                        <td>{{ $group->payable_info }}</td>
                                                        <td>{{ $group->payable_name }}</td>
                                                        <td>{{ $group->payable_amount }}</td>
                                                    </tr>
                                                @endforeach
                                            @elseif ($reportType == 'T7')
                                                @foreach ($item as $group)
                                                    <tr wire:key="{{ $group->recievable_info }}">
                                                        <td>{{ $group->recievable_info }}</td>
                                                        <td>{{ $group->recievable_name }}</td>
                                                        <td>{{ $group->recievable_amount }}</td>
                                                    </tr>
                                                @endforeach
                                            @elseif ($reportType == 'T8')
                                                @foreach ($item as $group)
                                                    <tr wire:key="{{ $group->turnover_info }}">
                                                        <td>{{ $group->turnover_info }}</td>
                                                        <td>{{ $group->turnover_product_name }}</td>
                                                        <td>{{ $group->turnover_cost_of_goods_sold }}</td>
                                                    </tr>
                                                @endforeach
                                            @elseif ($reportType == 'T9')
                                                @foreach ($item as $group)
                                                    <tr wire:key="{{ $group->sales_info }}">
                                                        <td>{{ $group->sales_info }}</td>
                                                        <td>{{ $group->sales_product_name }}</td>
                                                        <td>{{ $group->sales_revenue }}</td>
                                                    </tr>
                                                @endforeach
                                            @elseif ($reportType == 'R1')
                                                <tr wire:key="{{ $item->id }}">
                                                    <td>{{ $item->budget_name }}</td>
                                                    <td>{{ $item->budget_amount }}</td>
                                                    <td>{{ $item->budget_justification }}</td>
                                                </tr>
                                            @elseif($reportType == 'R2')
                                                <tr wire:key="{{ $item->request_code }}">
                                                    <td>{{ $item->request_name }}</td>
                                                    <td>{{ $item->request_amount }}</td>
                                                    <td>{{ $item->request_justification }}</td>
                                                    <td>{{ $item->request_projectDetails }}</td>
                                                </tr>
                                            @elseif($reportType == 'TR1')
                                                <tr wire:key="{{ $item->ReportID }}">
                                                    <td>{{ $item->RequestID }}</td>
                                                    <td>{{ $item->TravelerName }}</td>
                                                    <td>{{ $item->Date }}</td>
                                                    <td>{{ $item->TotalExpenses }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5>Preview</h5>
                </div>
                <div class="card-body">
                    <div class="row>
                        <div class="col-md-12 text-center">
                        <x-select label="Report" name="report_name" :options="$planName" valueId="{{ $id }}"
                            valueName="{{ $name }}" wire:model.live="reportName" />
                    </div>

                    <div class="col-md-12">
                        <iframe srcdoc="{{ $view }}" width="100%" height="600px"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
