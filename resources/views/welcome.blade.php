@extends('layouts.frontend.app')
@section('content')
<div id="content" class="site-content" role="main">
 @include('layouts.frontend.slider')
 @include('layouts.frontend.category')
 @include('layouts.frontend.products')

 @include('layouts.frontend.banner')

</div><!-- #content -->

@endsection