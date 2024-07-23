<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left mt-2">
                        <h5>Rkive Budget Record</h5>
                    </div>
                    <div class="card-header-right mb-2">
                        <x-button name="{{ $isOpen ? 'Create' : 'Close' }}"
                            class="w-100 {{ $isOpen ? 'btn-primary' : 'btn-secondary' }}"
                            wire:click="{{ $isOpen ? 'closeModal' : 'create' }}" />
                    </div>
                </div>
                @if ($isOpen)
                    <div class="card-body text-center" style="display: block;">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <input type="text" class="form-control" placeholder="Search..."
                                    wire:model.live="search">
                            </div>
                        </div>
                        @if ($budgets->isEmpty())
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
                                                <th colspan="6">
                                                    <b>Plan</b>
                                                </th>

                                                <th colspan="5">
                                                    <b>Approvals</b>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="sortable">Name</th>
                                                <th class="sortable">Amount</th>
                                                <th class="sortable">Department</th>
                                                <th class="sortable">Description</th>
                                                <th class="sortable">Category</th>
                                                <th class="sortable">Start</th>
                                                <th class="sortable">End</th>

                                                <th class="sortable">Status</th>
                                                <th class="sortable">Approver</th>
                                                <th class="sortable">Date</th>
                                                <th class="sortable">Amount</th>
                                                <th class="sortable">Notes</th>

                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @foreach ($budgets as $bdgt)
                                            <tbody wire:key="{{ $bdgt->id }}">
                                                <tr>
                                                    <td>{{ $bdgt->budget_name }}</td>
                                                    <td>{{ $bdgt->budget_amount }}</td>
                                                    <td>
                                                        @foreach ($departments as $department)
                                                            @if ($department->department_code == $bdgt->budget_department)
                                                                {{ $department->department_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $bdgt->budget_description }}</td>
                                                    <td>
                                                        @foreach ($categories as $category)
                                                            @if ($category->category_code == $bdgt->budget_category)
                                                                {{ $category->category_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $bdgt->budget_startDate }}</td>
                                                    <td>{{ $bdgt->budget_endDate }}</td>
                                                    <td>
                                                        @foreach ($status as $stat)
                                                            @if ($stat->status_code == $bdgt->budget_status)
                                                                {{ $stat->status_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($users as $user)
                                                            @if ($user->username == $bdgt->budget_approvedBy)
                                                                {{ $user->first_name . ' ' . $user->last_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $bdgt->budget_approvedDate }}</td>
                                                    <td>{{ $bdgt->budget_approvedAmount }}</td>
                                                    <td>{{ $bdgt->budget_notes }}</td>

                                                    <td>
                                                        <ul class="action">
                                                            <li class="edit"> <a
                                                                    wire:click="edit({{ $bdgt->id }})"><i
                                                                        class="icon-pencil-alt"></i></a>
                                                            </li>
                                                            <li class="delete"><a
                                                                    wire:click="delete({{ $bdgt->id }})"><i
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
                        <form wire:submit.prevent="{{ $budgetId ? 'update' : 'store' }}">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <x-input-text label="Name" name="budget_name" wire:model="budget_name" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-select label="Department" name="budget_department" :options="$departments"
                                                valueId="department_code" valueName="department_name"
                                                wire:model="budget_department" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-select label="Category" name="budget_category" :options="$categories"
                                                valueId="category_code" valueName="category_name"
                                                wire:model="budget_category" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-input-number label="Amount" name="budget_amount"
                                                wire:model="budget_amount" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-date-old label="Start Date" name="budget_startDate"
                                                wire:model="budget_startDate" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-date-old label="End Date" name="budget_endDate"
                                                wire:model="budget_endDate" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-text-area label="Description" name="budget_description"
                                                wire:model="budget_description" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <x-select label="Status" name="budget_status" :options="$status"
                                                valueId="status_code" valueName="status_name"
                                                wire:model="budget_status" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-users label="Approver" name="budget_approvedBy" :options="$users"
                                                valueId="username" wire:model="budget_approvedBy" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-number label="Approved Amount" name="budget_approvedAmount"
                                                wire:model="budget_approvedAmount" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-date-old label="Approved Date" name="budget_approvedDate"
                                                wire:model="budget_approvedDate" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-text-area label="Notes" name="budget_notes"
                                                wire:model="budget_notes" />
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
