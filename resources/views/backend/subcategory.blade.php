
    <option value="">Choose Sub Category</option>
    @foreach($category->sub_category as $subcategory)
    <option value="{{$subcategory->id}}">{{$subcategory->sub_category}}</option>
    @endforeach