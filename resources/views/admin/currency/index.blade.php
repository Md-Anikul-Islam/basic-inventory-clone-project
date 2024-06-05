@extends('admin.app')
@section('admin_content')

{{-- CKEditor CDN --}}
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Resource</a></li>
                    <li class="breadcrumb-item active">Currency!</li>
                </ol>
            </div>
            <h4 class="page-title">Resource!</h4>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addNewModalId">Add New</button>
            </div>
        </div>
        <div class="card-body">
            <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                <thead>
                <tr>
                    <th>S/N</th>
                    <th>Our Currency Name</th>
                    <th>Our Currency Rate</th>
                    <th>Compare Currency Name</th>
                    <th>Compare Currency Rate</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($currency as $key=>$currencyData)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$currencyData->name}}</td>
                        <td>{{$currencyData->rate}}</td>
                        <td>{{$currencyData->compare_name}}</td>
                        <td>{{$currencyData->compare_rate}}</td>
                        <td>{{$currencyData->status == 1 ? 'Active' : 'Inactive'}}</td>
                        <td style="width: 100px;">
                            <div class="d-flex justify-content-end gap-1">
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$currencyData->id}}">Edit</button>
                                <a href="{{route('currency.destroy',$currencyData->id)}}" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#danger-header-modal{{$currencyData->id}}">Delete</a>
                            </div>
                        </td>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editNewModalId{{$currencyData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$currencyData->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="editNewModalLabel{{$currencyData->id}}">Edit</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{route('currency.update',$currencyData->id)}}">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-2">
                                                        <label for="name" class="form-label">Our Currency Name</label>
                                                        <input type="text" id="name" name="name" value="{{$currencyData->name}}"
                                                               class="form-control" placeholder="Enter Currency Name" required>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="rate" class="form-label">Our Currency Rate</label>
                                                        <input type="text" id="rate" name="rate" value="{{$currencyData->rate}}"
                                                               class="form-control" placeholder="Enter Currency Rate" required>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="compare_name" class="form-label">Compare Currency Name</label>
                                                        <input type="text" id="compare_name" name="compare_name"  value="{{$currencyData->compare_name}}"
                                                               class="form-control" placeholder="Enter Compare Currency Name" required>
                                                    </div>

                                                    <div class="mb-2">
                                                        <label for="compare_rate" class="form-label">Compare Currency Rate</label>
                                                        <input type="text" id="compare_rate" name="compare_rate" value="{{$currencyData->compare_rate}}"
                                                               class="form-control" placeholder="Enter Compare Currency Rate" required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="example-select" class="form-label">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="1" {{ $currencyData->status == 1 ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ $currencyData->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button class="btn btn-primary" type="submit">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Modal -->
                        <div id="danger-header-modal{{$currencyData->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="danger-header-modalLabel{{$currencyData->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header modal-colored-header bg-danger">
                                        <h4 class="modal-title" id="danger-header-modalLabe{{$currencyData->id}}l">Delete</h4>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="mt-0">Are You Went to Delete this ? </h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <a href="{{route('currency.destroy',$currencyData->id)}}" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addNewModalId" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addNewModalLabel">Add</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('currency.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-2">
                                <label for="name" class="form-label">Our Currency Name</label>
                                <input type="text" id="name" name="name"
                                       class="form-control" placeholder="Enter Currency Name" required>
                            </div>
                            <div class="mb-2">
                                <label for="rate" class="form-label">Our Currency Rate</label>
                                <input type="text" id="rate" name="rate"
                                       class="form-control" placeholder="Enter Currency Rate" required>
                            </div>

                            <div class="mb-2">
                                <label for="compare_name" class="form-label">Compare Currency Name</label>
                                <input type="text" id="compare_name" name="compare_name"
                                       class="form-control" placeholder="Enter Compare Currency Name" required>
                            </div>

                            <div class="mb-2">
                                <label for="compare_rate" class="form-label">Compare Currency Rate</label>
                                <input type="text" id="compare_rate" name="compare_rate"
                                       class="form-control" placeholder="Enter Compare Currency Rate" required>
                            </div>

                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
