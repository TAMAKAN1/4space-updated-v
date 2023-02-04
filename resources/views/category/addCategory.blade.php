<?php

use App\Category;
use App\Subcategory;
use App\SubSubCategory;

$categories = Category::orderBy('id', 'desc')->get();
$subcategories = Subcategory::orderBy('id', 'desc')->get();
$subsubcategories = SubSubCategory::orderBy('id', 'desc')->get();
?>
@extends('layouts.backend.app')
@section('content')
<div class="row">
    <p class="h4"><strong>Main Category:</strong> </p>
    <div class="tab-content clearfix text-left mt-4">
        <div class="col-md-6">
            <form action="{{route('store.category')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for=""> <strong>Name:</strong></label>
                    <input type="text" class="form-control @error('category') is-invalid @enderror" name="category" placeholder="Enter the category" required>
                    @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <button type="submit" class="btn btn-dark text-white mt-2">Save Category <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12 col-lg-12 col-sm-12">
    <div class="card white-box p-2">
        <div class="row">
            <div class="table-responsive">
                <table class="table text-nowrap" id="myTable">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">Name</th>
                            <th class="border-top-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @if(!empty($categories))
                        @foreach($categories as $category)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$category->category}}</td>
                            <td>
                                <a class="btn btn-dark btn-sm text-white m-2" data-bs-toggle="modal" data-bs-target="#category{{$category->id}}"><i class="fa fa-edit"></i></a>

                                <!-- Modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="category{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update.category',$category->id)}}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="col-md-12 m-2">
                                                        <div class="form-group">
                                                            <label for=""> <strong>Name:</strong></label>
                                                            <input type="text" class="form-control" name="category" value="{{$category->category}}" required>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update changes</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <a class="btn btn-danger btn-sm text-white m-2" data-bs-toggle="modal" data-bs-target="#delete_category{{$category->id}}"><i class="fa fa-trash"></i></a>
                                <div class="modal fade" id="delete_category{{$category->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Are you sure for Delete?</h5>

                                            </div>

                                            <div class="modal-footer">
                                                <form action="{{route('delete.category',$category->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-dark">yes</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        <?php
                        $i = $i + 1;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <p class="h4"><strong>Sub Category:</strong> </p>
    <div class="tab-content clearfix text-left mt-4">
        <div class="col-md-6">
            <form action="{{route('subcategory.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for=""> <strong> Select Category:</strong></label>
                    <select name="category_id" id="" class="form-control" required>
                        <option value="">Choose One</option>
                        @if($categories)
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->category}}</option>
                        @endforeach
                        @endif
                    </select>
                    <label for=""> <strong>Name:</strong></label>
                    <input type="text" class="form-control @error('sub_category') is-invalid @enderror" name="sub_category" placeholder="Enter the sub category" required>
                    @error('sub_category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label for=""> <strong>Image:</strong></label>
                    <input type="file" class="form-control" name="image" required>
                    <button type="submit" class="btn btn-dark text-white mt-2">Save Sub Category <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12 col-lg-12 col-sm-12">
    <div class="card white-box p-2">
        <div class="row">
            <div class="table-responsive">
                <table class="table text-nowrap" id="myTable2">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0"> Sub Category</th>
                            <th class="border-top-0">Under Category</th>
                            <th class="border-top-0">Image</th>
                            <th class="border-top-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @if(!empty($subcategories))
                        @foreach($subcategories as $subcategory)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$subcategory->sub_category}}</td>
                            <td>{{$subcategory->category->category}}</td>
                            <td><a target="_blank" href="{{$subcategory->image}}"><img src="{{asset($subcategory->image)}}" alt="" width="50px" height="50px"></a></td>
                            <td>
                                <a class="btn btn-dark btn-sm text-white m-2" data-bs-toggle="modal" data-bs-target="#subcategory{{$subcategory->id}}"><i class="fa fa-edit"></i></a>

                                <!-- Modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="subcategory{{$subcategory->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Sub Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('subcategory.update',$subcategory->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="col-md-12 m-2">
                                                        <div class="form-group">
                                                            <label for=""> <strong>Category:</strong></label>
                                                            <select name="category_id" id="" class="form-control" required>
                                                                <option value="">Choose One</option>
                                                                @if($categories)
                                                                @foreach($categories as $category)
                                                                <option value="{{$category->id}}" {{$subcategory->category->id==$category->id ? 'selected' : ''}}>{{$category->category}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for=""> <strong>Name:</strong></label>
                                                            <input type="text" class="form-control" name="sub_category" value="{{$subcategory->sub_category}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for=""> <strong>Image:</strong></label>
                                                            <input type="file" class="form-control" name="image" value="{{$subcategory->image}}">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update changes</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <a class="btn btn-danger btn-sm text-white m-2" data-bs-toggle="modal" data-bs-target="#delete_subcategory{{$subcategory->id}}"><i class="fa fa-trash"></i></a>
                                <div class="modal fade" id="delete_subcategory{{$subcategory->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Are you sure for Delete?</h5>

                                            </div>

                                            <div class="modal-footer">
                                                <form action="{{route('subcategory.delete',$subcategory->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-dark">yes</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        <?php
                        $i = $i + 1;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <p class="h4"><strong>Sub Sub Category:</strong> </p>
    <div class="tab-content clearfix text-left mt-4">
        <div class="col-md-6">
            <form action="{{route('add.subsubcategory')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for=""> <strong>Select Sub Category:</strong></label>
                    <select name="sub_category_id" id="" class="form-control" required>
                        <option value="">Choose One</option>
                        @if($categories)
                        @foreach($subcategories as $subcategory)
                        <option value="{{$subcategory->id}}">{{$subcategory->sub_category}}</option>
                        @endforeach
                        @endif
                    </select>
                    <label for=""> <strong>Name:</strong></label>
                    <input type="text" class="form-control @error('sub_sub_category') is-invalid @enderror" name="sub_sub_category" placeholder="Enter the  Sub sub category" required>
                    @error('sub_sub_category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label for=""> <strong>Image:</strong></label>
                    <input type="file" class="form-control" name="image" required>
                    <button type="submit" class="btn btn-dark text-white mt-2">Save Sub Sub Category <i class="fa fa-save"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-12 col-lg-12 col-sm-12">
    <div class="card white-box p-2">
        <div class="row">
            <div class="table-responsive">
                <table class="table text-nowrap" id="myTable3">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0"> Sub Sub Category</th>
                            <th class="border-top-0">Under Sub Category</th>
                            <th class="border-top-0">Image</th>
                            <th class="border-top-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @if(!empty($subsubcategories))
                        @foreach($subsubcategories as $subsubcategory)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$subsubcategory->sub_sub_category}}</td>
                            <td>{{$subsubcategory->sub_category->sub_category}}</td>
                            <td><a target="_blank" href="{{$subsubcategory->image}}"><img src="{{asset($subsubcategory->image)}}" alt="" width="50px" height="50px"></a></td>
                            <td>
                                <a class="btn btn-dark btn-sm text-white m-2" data-bs-toggle="modal" data-bs-target="#subsubcategory{{$subsubcategory->id}}"><i class="fa fa-edit"></i></a>

                                <!-- Modal -->
                                <!-- Modal -->
                                <div class="modal fade" id="subsubcategory{{$subsubcategory->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Sub Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('update.subsubcateogry',$subsubcategory->id)}}" method="post"  enctype="multipart/form-data">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="col-md-12 m-2">
                                                        <div class="form-group">
                                                            <label for=""> <strong>Sub Category:</strong></label>
                                                            <select name="sub_category_id" id="" class="form-control" required>
                                                                <option value="">Choose One</option>
                                                                @if($subcategories)
                                                                @foreach($subcategories as $subcategory)
                                                                <option value="{{$subcategory->id}}" {{$subsubcategory->sub_category->id==$subcategory->id ? 'selected' : ''}}> {{$subcategory->sub_category}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for=""> <strong>Name:</strong></label>
                                                            <input type="text" class="form-control" name="sub_sub_category" value="{{$subsubcategory->sub_sub_category}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for=""> <strong>Image:</strong></label>
                                                            <input type="file" class="form-control" name="image" value="{{$subsubcategory->image}}">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Update changes</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <a class="btn btn-danger btn-sm text-white m-2" data-bs-toggle="modal" data-bs-target="#delete_subsubcategory{{$subsubcategory->id}}"><i class="fa fa-trash"></i></a>
                                <div class="modal fade" id="delete_subsubcategory{{$subsubcategory->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Are you sure for Delete?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{route('update.subsubcategory',$subsubcategory->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">No</button>
                                                    <button type="submit" class="btn btn-dark">yes</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                        <?php
                        $i = $i + 1;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#myTable2').DataTable();
        $('#myTable3').DataTable();
    });
</script>
@endsection