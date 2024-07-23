<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left mt-2">
                        <h5>Rkive Recievable Record</h5>
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
                        @if ($recievable->isEmpty())
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
                                                    <b>Recievable</b>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="sortable">Info</th>
                                                <th class="sortable">Product</th>
                                                <th class="sortable">Revenue</th>
                                                <th class="sortable">Department</th>
                                                <th class="sortable">Category</th>
                                                <th class="sortable">Due Date</th>
                                                <th class="sortable">Invoice Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @foreach ($recievable as $item)
                                            <tbody wire:key="{{ $item->id }}">
                                                <tr>
                                                    <td>{{ $item->recievable_info }}</td>
                                                    <td>{{ $item->recievable_name }}</td>
                                                    <td>{{ $item->recievable_amount }}</td>
                                                    <td>
                                                        @foreach ($departments as $department)
                                                            @if ($department->department_code == $item->recievable_department)
                                                                {{ $department->department_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($categories as $category)
                                                            @if ($category->plan_category_code == $item->recievable_category)
                                                                {{ $category->plan_category_name }}
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $item->recievable_due_date }}</td>
                                                    <td>{{ $item->recievable_invoice_date }}</td>
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
                        <form wire:submit.prevent="{{ $recievableId ? 'update' : 'store' }}">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <x-input-text label="Info" name="recievable_info" wire:model="recievable_info" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-input-text label="Name" name="recievable_name" wire:model="recievable_name" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-select label="Department" name="recievable_department" :options="$departments"
                                                valueId="department_code" valueName="department_name"
                                                wire:model="recievable_department" />
                                        </div>
                                        <div class="col-md-3">
                                            <x-select label="Category" name="recievable_category" :options="$categories"
                                                valueId="plan_category_code" valueName="plan_category_name" optvalue="category_code"
                                                wire:model="recievable_category" />
                                        </div>
                                        <div class="col-md-3">
                                            <x-input-number label="Amount" name="recievable_amount" wire:model="recievable_amount" />
                                        </div>
                                        <div class="col-md-3">
                                            <x-input-number label="Due Date" name="recievable_due_date" wire:model="recievable_due_date" />
                                        </div>
                                        <div class="col-md-3">
                                            <x-date-old label="Invoice Date" name="recievable_invoice_date" wire:model="recievable_invoice_date" />
                                        </div>
                                        <div class="col-md-6">
                                            <x-input-checkbox label="Agree to terms and conditions" name="terms"
                                                wire:model="terms" />
                                        </div>
                                        <div class="col-md-12">
                                            <x-button type="submit" class="w-100 btn-outline-primary" name="Save" />
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
