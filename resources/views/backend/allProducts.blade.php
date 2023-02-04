@extends('layouts.backend.app')
@section('content')
<style>
    .ck-content p {
        height: 250px;
    }
</style>
<div class="row mt-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title">All Projects</h3>
                    <div class="table-responsive">
                        <table class="table text-nowrap" id="myTable">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Date</th>
                                    <th class="border-top-0">SKU</th>
                                    <th class="border-top-0">Tittle</th>
                                    <th class="border-top-0">Category</th>
                                    <th class="border-top-0">Price</th>
                                    <th class="border-top-0">custom status</th>
                                    <th class="border-top-0">status</th>
                                    <th class="border-top-0">Image</th>
                                    <th class="border-top-0">Details</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                ?>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{ date('d F Y', strtotime($product->created_at))}}</td>
                                    <td>{{$product->SKU}}</td>
                                    <td>{{$product->title}}</td>
                                    <td>{{$product->category->category}}
                                        @if($product->sub_category)
                                        <p class="mt-2"><i class="fa fa-arrow-right"></i>{{$product->sub_category->sub_category}}</p>
                                        @endif
                                        @if($product->sub_sub_category)
                                        <p class="mt-2" style="margin-left:20px"><i class="fa fa-arrow-right"></i>{{$product->sub_sub_category->sub_sub_category}}</p>
                                        @endif
                                    </td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->custom_status}}</td>
                                    <td>

                                        @if($product->status=="in stock")
                                        <span class="badge   bg-info mt-2">
                                            <strong>{{$product->status}}</strong>
                                        </span>
                                        @else
                                        <span class="badge   bg-danger mt-2">
                                            <strong>{{$product->status}}</strong>
                                        </span>
                                        @endif

                                    </td>
                                    <td>
                                        @if($product->images)
                                        <a href="" target="_blank"> <img src="{{asset($product->images[0]->file)}}" alt="" width="80" height="50"></a>
                                        @endif
                                    </td>
                                    <td><a target="_blank" href="{{route('product.details',[$product->id,$product->title])}}" class="btn btn-dark btn-sm text-white"><i class="fa fa-eye"></i></a></td>

                                    <td>
                                        <a href="{{route('edit.product',[$product->id,$product->title])}}" class="btn btn-sm btn-dark text-white m-2"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-sm btn-danger text-white m-2" data-bs-toggle="modal" data-bs-target="#product{{$product->id}}"><i class="fa fa-trash"></i></a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="product{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLabel">Are you sur for delete?</h3>

                                                    </div>

                                                    <div class="modal-footer">

                                                        <form action="{{route('delete.product',$product->id)}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">No</button>
                                                            <button type="submit" class="btn btn-primary">Yes</button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    ClassicEditor.create(document.querySelector('textarea'))

    $(".btn-success").click(function() {
        var html = $(".clone").html();
        $(".increment").after(html);
    });
    $("body").on("click", ".btn-danger", function() {
        $(this).parents(".control-group").remove();
    });


    $('#category').change(function() {
        var id = $(this).val();
        if ($(this).val() != '') {
            $.ajax({
                url: "{{ url('/fatch-category') }}/" + id,
                method: "GET",
                success: function(result) {

                    $('#sub_category_id').html(result);
                    console.log(result);
                }
            })
        }
        $('#sub_category_id').html('<option value="">Choose sub Category</option>');
    });

    $('#sub_category_id').change(function() {
        var id = $(this).val();
        if ($(this).val() != '') {
            $.ajax({
                url: "{{ url('/fatch_subcategory') }}/" + id,
                method: "GET",
                success: function(result) {

                    $('#sub_sub_category_id').html(result);
                    console.log(result);
                }
            })
        }
        $('#sub_sub_category_id').html('<option value="">Choose sub sub Category</option>');
    });
</script>
@endsection