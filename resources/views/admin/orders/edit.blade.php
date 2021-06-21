@extends('adminlte::page')

@section('title', 'Add New Order')

@section('plugins.Select2', true)

@push('js')
    <script>
        $(document).ready(function () {
            $('#customer_id').select2();
            $('#product_id').select2();
            $('#customer_id').select2();
            $('#payment_method').select2();
            $('[data-toggle="tooltip"]').tooltip();
        });

        function increaseQty() {
            let qty = Number(document.getElementById('quantity').value);
            document.getElementById('quantity').value = qty + 1;
        }

        function decreaseQty() {
            let qty = Number(document.getElementById('quantity').value);
            if (qty <= 1) return;
            document.getElementById('quantity').value = qty - 1;
        }

        function updateQuantity(id, quantity) {
            document.getElementById('op_id').value = id;
            document.getElementById('op_quantity').value = quantity;

            $('#updateModal').modal('show');
        }

    </script>
@endpush

@section('content')

    <x-delete/>
    <x-alert/>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold" style="font-size:1.4rem">Order Details</h3>
            <div class="card-tools">

                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-info d-print-none">
                    <i class="fas fa-fw fa-arrow-left mr-1"></i>
                    <span>Go Back</span>
                </a>
            </div>
        </div>
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="flex-1">
                    <span class="mr-3">Customer: <b>{{ $customer ? $customer->name : "Unknown Customer" }}</b></span>

                    @if($order->status != "Complete")
                        <button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal"
                                data-target="#assignCustomerModal">
                            @if($customer) Edit @else Assign Customer @endif
                        </button>
                    @endif

                    @if(!$customer)


                    @endif
                </div>
                <div>
                    @if($order->status != "Complete")
                        @if($customer)
                            <form method="POST" action="{{ route('admin.orders.customers.remove', $order->id) }}">
                                @method('PUT') @csrf

                                <button type="submit" class="btn btn-danger btn-sm">
                                    Remove Customer from Order
                                </button>
                            </form>
                        @else
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#createCustomer">
                                Create New Customer and Assign
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        @if($order->status != "Complete")
            <div class="card-body pb-0">
                <form method="post" action="{{ route('admin.orders.add', $order->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">

                        <div class="form-group col-12 col-md-7">
                            <label for="product_id">Product</label>
                            <select
                                name="product_id" id="product_id"
                                class="form-control @error('product_id') is-invalid @enderror"
                            >
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} /
                                        Rs. {{ $product->on_sale ? $product->sale_price : $product->price }}</option>
                                @endforeach
                            </select>

                            @error('product_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-12 col-md-3">
                            <label for="quantity">Quantity</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text" onclick="decreaseQty()">
                                        <i class="fa fa-minus fa-fw"></i>
                                    </button>
                                </div>

                                <input
                                    type="text"
                                    name="quantity" id="quantity"
                                    value="{{ old('quantity') ?? 1 }}"
                                    style="text-align: center;font-weight: bold"
                                    class="form-control @error('quantity') is-invalid @enderror"
                                >

                                <div class="input-group-prepend">
                                    <button type="button" class="input-group-text" onclick="increaseQty()">
                                        <i class="fa fa-plus fa-fw"></i>
                                    </button>
                                </div>

                            </div>
                            @error('quantity')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>


                        <div class="col-sm-12 col-md-2 pt-4">
                            <input type="submit" class="btn btn-primary btn-flat text-bold btn-block mt-2" value="Add">
                        </div>

                    </div>

                </form>
            </div>
        @endif

        @if(count($orderProducts) > 0)
        <div class="card-body p-0">
            <table class="table table-bordered border-top-0">
                <thead class="thead-dark border-top-0">
                <th>S.N.</th>
                <th style="width:35%">Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
                @if($order->status != "Complete")
                    <th>Remove</th>
                @endif
                </thead>
                <tbody>
                @foreach($orderProducts as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>
                            {{ $item->quantity }}

                            @if($order->status != "Complete")
                                <button
                                    type="button"
                                    class="btn btn-primary btn-xs mr-2 float-right"
                                    onclick="updateQuantity({{ $item->id }}, {{ $item->quantity }})"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Update Quantity"
                                >
                                    <i class="fas fa-fw fa-edit"></i>
                                </button>
                            @endif

                        </td>
                        <td>Rs. {{ $item->unit_price }}</td>
                        <td>Rs. {{ $item->unit_price * $item->quantity }}</td>
                        @if($order->status != "Complete")
                            <td>
                                <a href="#" onclick="confirmDelete({{ $item->id }})" class="btn btn-danger btn-sm">
                                    <i class="fas fa-fw fa-trash mr-1"></i>
                                    <span>Remove</span>
                                </a>

                                <form id="delete-form-{{ $item->id }}"
                                      action="{{ route('admin.orders.remove', [ 'order' => $order->id, 'orderProduct' => $item->id]) }}"
                                      method="post">
                                    @csrf @method('DELETE')
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach

                <tr>
                    <td colspan="4" style="text-align: right;border-top-width: 3px">Subtotal</td>
                    <td colspan="2" style="border-top-width: 3px">Rs. {{ $order->sub_total }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;">Discount</td>
                    <td colspan="2">
                        Rs. {{ $order->discount }}

                        @if($order->status != "Complete")
                            <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                    data-target="#discountModal">
                                Edit
                            </button>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;border-top: 3px solid #999"><b>Total</b></td>
                    <td colspan="2" style="border-top: 3px solid #999"><b
                            style="font-size:1.5em">Rs. {{ $order->total }}</b></td>
                </tr>
                </tbody>
            </table>

            @if($order->status != "Complete")
                <div class="p-4">
                    <button type="button" class="btn btn-primary btn-lg float-right" data-toggle="modal"
                            data-target="#finalModal">
                        Complete Order
                    </button>
                    <div class="clearfix"></div>
                </div>
            @else
                <div class="alert alert-primary mb-0 d-print-none"
                     style="border-top-left-radius: 0;border-top-right-radius: 0">Order has been marked as complete.
                </div>
            @endif

            @endif
        </div>
</div>

<!-- Assign Customer Model -->
<div class="modal fade" id="assignCustomerModal" tabindex="-1" role="dialog"
     aria-labelledby="assignCustomerModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.orders.customers.assign', $order->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Customer to Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    @if($customer)
                        <h4>Current: {{ $customer->name }}</h4>
                    @endif
                    <div class="form-group">
                        <label for="customer_id">Choose Customer</label>
                        <select
                            name="customer_id" id="customer_id"
                            class="form-control @error('customer_id') is-invalid @enderror"
                        >
                            <option value="">Unknown Customer</option>
                            @foreach($customers as $item)
                                <option value="{{ $item->id }}"
                                        @if($customer && $customer->id == $item->id) selected @endif>{{ $item->name }}</option>
                            @endforeach
                        </select>

                        @error('customer_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- // customer -->

<!-- Create Customer Modal -->

<div class="modal fade" id="createCustomer" tabindex="-1" role="dialog"
     aria-labelledby="createCustomerLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.orders.customers.create', $order->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Customer and Assign</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            name="name" id="name"
                            value="{{ old('name') ?? '' }}"
                            class="form-control @error('name') is-invalid @enderror"
                            autofocus
                        >
                        @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input
                            type="text"
                            name="address" id="address"
                            value="{{ old('address') ?? '' }}"
                            class="form-control @error('address') is-invalid @enderror"
                        >
                        @error('address')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Contact Number</label>
                        <input
                            type="text"
                            name="phone" id="phone"
                            value="{{ old('phone') ?? '' }}"
                            class="form-control @error('phone') is-invalid @enderror"
                        >
                        @error('phone')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="reg_number">Registration Number</label>
                        <input
                            type="number"
                            name="reg_number" id="reg_number"
                            value="{{ old('reg_number') ?? '' }}"
                            class="form-control @error('reg_number') is-invalid @enderror"
                        >
                        @error('reg_number')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="remark">Remarks</label>
                        <textarea
                            name="remark" id="remark"
                            class="form-control @error('remark') is-invalid @enderror"
                        >{{ old('remark') ?? '' }}</textarea>
                        @error('remark')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create and Assign Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- // create customer -->

<!-- Update Modal -->
<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.orders.quantity', $order->id) }}">
                @csrf
                @method('PUT')
                <input id="op_id" name="order_product_id" type="hidden" value="0">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Quantity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="op_quantity">Quantity</label>
                        <input
                            type="number"
                            class="form-control"
                            name="quantity" id="op_quantity"
                        >
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Quantity</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Discount Model -->
<div class="modal fade" id="discountModal" tabindex="-1" role="dialog" aria-labelledby="discountModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.orders.discount', $order->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Discount</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="discount">Amount</label>
                        <input
                            type="number"
                            class="form-control"
                            name="discount" id="discount"
                            value="{{ $order->discount }}"
                        >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Discount</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Final Model -->
<!-- Discount Model -->
<div class="modal fade" id="finalModal" tabindex="-1" role="dialog" aria-labelledby="finalModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.orders.final', $order->id) }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Finalize Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td style="width: 75%;text-align: right">Subtotal</td>
                            <td>Rs. {{ $order->sub_total }}</td>
                        </tr>
                        <tr>
                            <td style="width: 75%;text-align: right">Discount</td>
                            <td>Rs. {{ $order->discount }}</td>
                        </tr>
                        <tr>
                            <td style="width: 75%;text-align: right"><b>Total</b></td>
                            <td style="font-size: 1.3em;font-weight: bold">Rs. {{ $order->total }}</td>
                        </tr>

                        </tbody>
                    </table>

                    <div class="form-group row">
                        <div class="form-group col-12 col-md-6">
                            <label for="payment_method">Payment Method</label>
                            <select
                                name="payment_method" id="payment_method"
                                class="form-control @error('payment_method') is-invalid @enderror"
                            >
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Card">Credit Card/Debit Cart</option>
                                <option value="Electronic">Electronic Payment (eSewa, Khalti, IME Pay, Connect IPS
                                    ...)
                                </option>
                            </select>
                            @error('payment_method')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="payment_amount">Payment Amount</label>
                            <input type="text"
                                   name="payment_amount" id="payment_amount"
                                   value="{{ old('payment_amount') ?? '' }}"
                                   class="form-control @error('payment_amount') is-invalid @enderror"
                            />

                            @error('payment_amount')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="remarks">Additional Notes (optional)</label>
                        <textarea
                            name="remarks" id="remarks"
                            class="form-control @error('remarks') is-invalid @enderror"
                        >{{ old('remarks') ?? '' }}</textarea>

                        @error('remarks')
                        <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Complete Order</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
