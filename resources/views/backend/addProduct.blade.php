@extends('layouts.backend.app')
@section('content')
<style>
    .ck-content p {
        height: 250px;
    }
</style>
<div class="row mt-4">
    <div class="container">
        <p class="h4 text-center card-header p-2 mt-4"><strong>Product Section</strong> </p>
        <div class="tab-content clearfix text-left mt-4">
            <div class="col-md-8 offset-md-2">
                <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label for=""> <strong>Product Title*</strong></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter the title" required>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for=""> <strong>Product SKU*</strong></label>
                                <input type="text" class="form-control @error('SKU') is-invalid @enderror" name="SKU" placeholder="Ex.. P-001" required>
                                @error('SKU')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for=""> <strong>Select Product Category</strong></label>
                                <select name="category_id" id="category" class="form-control" required>
                                    <option value="">Choose Category</option>
                                    @foreach(App\Category::orderBy('id','desc')->get() as $category)
                                    <option value="{{$category->id}}">{{$category->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> <strong>Select Sub Category*</strong></label>
                                    <select name="sub_category_id" id="sub_category_id" class="form-control">
                                        <option value="">Choose sub category</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for=""> <strong>Select Sub Sub Category</strong></label>
                                    <select name="sub_sub_category_id" id="sub_sub_category_id" class="form-control">
                                        <option value="">Choose sub category</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for=""> <strong>Price*</strong></label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Enter the price" required>
                                @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for=""> <strong>Fabric*</strong></label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" name="fabric" placeholder="Enter Fabric type" required>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <strong>
                            <p>Available Dimensions:</p>
                        </strong>
                        <p>Note: add mutiful items after one item use ( , (comma) ) sign</p>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for=""> <strong>Width*</strong></label>
                                <input type="text" data-role="tagsinput" class="form-control @error('width') is-invalid @enderror" name="width" placeholder="exp. item1, item2" required>

                            </div>
                            <div class="col-md-6">
                                <label for=""> <strong>Height*</strong></label>
                                <input type="text" data-role="tagsinput" class="form-control @error('height') is-invalid @enderror" name="height" placeholder="exp. item1, item2" required>

                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for=""> <strong>Color*</strong></label>
                                <input type="text" class="form-control @error('color') is-invalid @enderror" name="color" placeholder="exp. color1, color1" data-role="tagsinput" required>
                                @error('color')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for=""> <strong>Size</strong></label>
                                <input type="text" class="form-control @error('size') is-invalid @enderror" name="size" placeholder="exp. size1, size2" data-role="tagsinput" required>
                                @error('size')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="col-md-12">
                                <label for=""> <strong>Customization Status*</strong></label>
                                <select name="custom_status" id="" required class="form-control">
                                    <option value="">Choose one</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for=""> <strong>Product Details*</strong></label>
                        <textarea name="product_details" id="" cols="30" rows="10" class="form-control ckeditor"></textarea>
                    </div>
                    <div class="form-group">
                        <label for=""> <strong>Images*</strong></label>
                        <div class="input-group control-group increment">
                            <div class="input-group-btn">
                                <button class="btn btn-success" type="button" style="padding-bottom: 8px;"><i class="fa fa-plus text-white"></i></button>
                            </div>
                            <input type="file" name="file[]" class="form-control @error('file') is-invalid @enderror" required>
                            @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="clone d-none">
                            <div class="control-group input-group" style="margin-top:10px">
                                <div class="input-group-btn">
                                    <button class="btn btn-danger bc text-white" type="button" style="padding-bottom: 8px;"><i class="fa fa-trash text-white"></i></button>

                                </div>
                                <input type="file" name="file[]" class="form-control @error('file') is-invalid @enderror">
                                @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark text-white mt-2">Save information <i class="fa fa-save"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
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