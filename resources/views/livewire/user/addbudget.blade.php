<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left mt-2">
                        <h5>Rkive Request Record</h5>
                    </div>
                    <div class="card-header-right mb-2">
                        <x-button name="{{ $isOpen ? 'Create' : 'Close' }}"
                            class="w-100 {{ $isOpen ? 'btn-primary' : 'btn-secondary' }}"
                            wire:click="{{ $isOpen ? 'closeModal' : 'create' }}" />
                    </div>
                </div>
                @if ($isOpen)
                    <div class="card-body text-center" style="display: block;">

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-3">
                                <input type="text" class="form-control" placeholder="Search..."
                                    wire:model.live="search">
                            </div>
                        </div>
                        @if ($requests->isEmpty())
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('assets/images/void.svg') }}"
                                        style="min-height:200px; max-height:200px" alt=""><br> <br>
                                    <span>No Record Found</span>
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <div class="table-container">
                                    <table class="table">
                                        <thead class="text-center">
                                            <tr>
                                                <th colspan="4">
                                                    <b>Plan</b>
                                                </th>

                                                <th colspan="4">
                                                    <b>Request</b>
                                                </th>

                                                <th colspan="5">
                                                    <b>Approvals</b>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="sortable">Name</th>
                                                <th class="sortable">Amount</th>
                                                <th class="sortable">Category</th>
                                                <th class="sortable">Description</th>

                                                <th class="sortable">Budget Code</th>
                                                <th class="sortable">Actual Spending</th>
                                                <th class="sortable">Variance</th>
                                                <th class="sortable">Reason</th>

                                                <th class="sortable">Status</th>
                                                <th class="sortable">Approver</th>
                                                <th class="sortable">Date</th>
                                                <th class="sortable">Amount</th>
                                                <th class="sortable">Notes</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @foreach ($requests as $item)
                                            <tbody wire:key="{{ $item->id }}">
                                                <tr>
                                                    <td>{{ $item->request_name }}</td>
                                                    <td>{{ $item->request_amount }}</td>
                                                    <td>
                                                        @foreach ($categories as $category)
                                                        @if ($category->category_code == $item->request_category)
                                                        {{ $category->category_name }}
                                                        @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $item->request_description }}</td>
                                                    <td>{{ $item->request_budget_code }}</td>
                                                    <td>{{ $item->request_actualSpending }}</td>
                                                    <td>{{ $item->request_variance }}</td>
                                                    <td>{{ $item->request_varianceReason }}</td>
                                                    <td>
                                                        @foreach ($status as $stat)
                                                            @if ($stat->status_code == $item->request_status)
                                                                {{ $stat->status_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($users as $user)
                                                        @if ($user->username == $item->request_approvedBy)
                                                                {{ $user->first_name . ' ' . $user->last_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $item->request_approvedDate }}</td>
                                                    <td>{{ $item->request_approvedAmount }}</td>
                                                    <td>{{ $item->request_notes }}</td>

                                                    <td>
                                                        <ul class="action">
                                                            <li class="edit"> <a
                                                                    wire:click="edit({{ $item->id }})"><i
                                                                        class="icon-pencil-alt"></i></a>
                                                            </li>
                                                            <li class="delete"><a
                                                                    wire:click="delete({{ $item->id }})"><i
                                                                        class="icon-trash"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="card-body">
                        <form wire:submit.prevent="{{ $requestId ? 'update' : 'store' }}">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <x-input-text label="Name" name="request_name"
                                                wire:model="request_name" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-select label="Department" name="request_department" :options="$departments"
                                                valueId="department_code" valueName="department_name"
                                                wire:model="request_department" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-select label="Category" name="request_category" :options="$categories"
                                                valueId="category_code" valueName="category_name"
                                                wire:model="request_category" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-number label="Amount" name="request_amount"
                                                wire:model="request_amount" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-select label="Budget Code" name="request_budget_code" :options="$budgets"
                                                valueId="id" valueName="budget_name"
                                                wire:model="request_budget_code" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-text-area label="Description" name="request_description"
                                                wire:model="request_description" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <x-input-number label="Actual Spent" name="request_actualSpending"
                                                wire:model="request_actualSpending" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-number label="Variance" name="request_variance"
                                                wire:model="request_variance" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-text-area label="Variance Reason" name="request_varianceReason"
                                                wire:model="request_varianceReason" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-checkbox label="Agree to terms and conditions" name="terms"
                                                wire:model="terms" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-button type="submit" class="w-100 btn-outline-primary"
                                                name="Save" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


