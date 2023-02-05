<?php

use App\Banner;
use App\Logo;
use App\Silder;

$logos = Logo::all();
$backend = Logo::where('place', 'Admin Panel')->orderBy('id', 'desc')->first();
$frontend = Logo::where('place', 'Homepage')->orderBy('id', 'desc')->first();
$sliders = Silder::orderBy('id', 'desc')->get();
$banners = Banner::orderBy('id', 'desc')->get();
?>
@extends('layouts.backend.app')
@section('content')
<div class="row">
   <p class="h4"><strong> Website Logo's:</strong> </p>
   <div class="tab-content clearfix text-left mt-4">
      <div class="tab-pane active" id="1b">
         <div class="col-md-12">
            <form action="{{route('store.logo')}}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-4">
                        <label for="" class="text-left"><strong>Place *</strong></label> <br>
                        <select name="place" id="a" class="form-control" required>
                           <option value=""><strong>Choose one</strong></option>
                           <option value="Homepage"><strong>Homepage logo</strong></option>
                           <option value="Admin Panel"><strong>For Admin panel</strong></option>
                        </select>
                     </div>
                     <div class="col-md-8">
                        <label for="" class="text-left"><strong>Image *</strong></label> <br>
                        <input type="file" name="logo" id="" required>
                     </div>
                     <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-dark"> <strong>save information</strong> <i class="fa fa-save"></i> </button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
      @if(!empty($logos))
      <div class="col-md-12 mt-4 bg-white text-black ">
         <div class="row mt-2 mb-2 p-4">
            @if($backend)
            <div class="col-md-6 text-center ">
               <label for="" class="">
                  <strong> Backend logo</strong>
               </label> <br>
               <img src="{{$backend->logo}}" width="30%" />
               <form action="{{route('delete.logo',$backend->id)}}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger btn-sm text-white"><i class="fa fa-trash"></i></button>
               </form>
            </div>
            @endif

            @if($frontend)
            <div class="col-md-6 text-center ">
               <label for="" class="">
                  <strong> Home Page Logo</strong>
               </label> <br>
               <img src="{{$frontend->logo}}" width="30%" />
               <form action="{{route('delete.logo',$frontend->id)}}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger btn-sm text-white"><i class="fa fa-trash"></i></button>
               </form>
            </div>
            @endif
         </div>
      </div>
      @endif
      <hr>

   </div>

   <!-- slider -->
   <p class="h4"><strong> Sliders Section:</strong> </p>
   <div class="tab-content clearfix text-left mt-4">

      <div class="tab-pane active" id="1b">
         <div class="col-md-12">
            <form action="{{route('store.slider')}}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-4">
                        <label for="" class="text-left"><strong>Slider Title* </strong></label> <br>
                        <input type="text" name="title" class="form-control" style="border:1px solid #cdcd" required>
                     </div>
                     <div class="col-md-8">
                        <label for="" class="text-left"><strong> Image *</strong></label> <br>
                        <input type="file" name="image" id="" required>
                     </div>
                     <div class="col-md-6 mt-4">
                        <label for="" class="text-lefts"><strong>Redirect Links</strong></label> <br>
                        <input type="text" name="link" class="form-control" style="border:1px solid #cdcd" placeholder="https:\\www.example.com">
                     </div>
                     <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-dark"> <strong>Save information</strong> <i class="fa fa-save"></i> </button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="container-fluid">
      <!-- ============================================================== -->
      <!-- Start Page Content -->
      <!-- ============================================================== -->
      <div class="row">
         <div class="col-sm-12">
            <div class="white-box">
               <h3 class="box-title">All Sliders</h3>
               <div class="table-responsive">
                  <table class="table text-nowrap" id="myTable">
                     <thead>
                        <tr>
                           <th class="border-top-0">#</th>
                           <th class="border-top-0">Tittle</th>
                           <th class="border-top-0">links</th>
                           <th class="border-top-0">Image</th>
                           <th class="border-top-0">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @foreach($sliders as $slider)
                        <tr>
                           <td>{{$i++}}</td>
                           <td>{{$slider->title}}</td>
                           <td><a target="_blank" href="{{$slider->link}}">{{$slider->link}}</a></td>
                           <td><a href="{{$slider->image}}" target="_blank"> <img src="{{asset($slider->image)}}" alt="" width="50" height="30"></a></td>
                           <td>
                              <a class="btn btn-sm btn-dark text-white m-2" data-bs-toggle="modal" data-bs-target="#slider{{$slider->id}}"><i class="fa fa-edit"></i></a>

                              <div class="modal fade" id="slider{{$slider->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Edit Slider</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body">
                                          <form action="{{route('slider.update',$slider->id)}}" method="post" enctype="multipart/form-data">
                                             <div class="col-md-12">
                                                @csrf
                                                @method('patch')
                                                <div class="form-group">
                                                   <div class="col-md-12 ">
                                                      <div class="col-md-12">
                                                         <label for="" class="text-left"><strong>Slider Title* </strong></label> <br>
                                                         <input type="text" name="title" class="form-control" style="border:1px solid #cdcd" value="{{$slider->title}}">
                                                      </div>
                                                      <div class="col-md-12">
                                                         <label for="" class="text-left"><strong> Image *</strong></label> <br>
                                                         <input type="file" name="image" id="" value="{{$slider->image}}">
                                                      </div>
                                                      <div class="col-md-12 mt-4">
                                                         <label for="" class="text-lefts"><strong>Redirect Links</strong></label> <br>
                                                         <input type="text" name="link" class="form-control" style="border:1px solid #cdcd" value="{{$slider->link}}">
                                                      </div>

                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-12 m-2">
                                                <button type="submit" class="btn btn-primary">Update changes</button>
                                             </div>
                                          </form>

                                       </div>

                                    </div>
                                 </div>
                              </div>
                              <form action="{{route('slider.delete',$slider->id)}}" method="post">
                                 @csrf
                                 @method('delete')
                                 <button type="submit" class="btn btn-sm btn-danger text-white m-2"><i class="fa fa-trash"></i></button>
                              </form>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <!-- ============================================================== -->
      <!-- End PAge Content -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Right sidebar -->
      <!-- ============================================================== -->
      <!-- .right-sidebar -->
      <!-- ============================================================== -->
      <!-- End Right sidebar -->
      <!-- ============================================================== -->
   </div>

   <p class="h4"><strong>Banner Section:</strong> </p>
   <div class="tab-content clearfix text-left mt-4">

      <div class="tab-pane active" id="1b">
         <div class="col-md-12">
            <form action="{{route('banner.store')}}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-4">
                        <label for="" class="text-left"><strong>Banner Title* </strong></label> <br>
                        <input type="text" name="title" class="form-control" style="border:1px solid #cdcd" placeholder="Enter title" required>
                     </div>
                     <div class="col-md-4">
                        <label for="" class="text-left"><strong>Link* </strong></label> <br>
                        <input type="text" name="link" class="form-control" style="border:1px solid #cdcd" placeholder="Enter the Link" required>
                     </div>
                     <div class="col-md-4">
                        <label for="" class="text-left"><strong> Image *</strong></label> <br>
                        <input type="file" name="image" id="" required>
                     </div>
                     <div class="col-md-12 mt-4">
                        <button type="submit" class="btn btn-dark"> <strong>Save Banner</strong> <i class="fa fa-save"></i> </button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>

   <div class="container-fluid">
      <!-- ============================================================== -->
      <!-- Start Page Content -->
      <!-- ============================================================== -->
      <div class="row">
         <div class="col-sm-12">
            <div class="white-box">
               <h3 class="box-title">All Banngers</h3>
               <div class="table-responsive">
                  <table class="table text-nowrap" id="myTable2">
                     <thead>
                        <tr>
                           <th class="border-top-0">#</th>
                           <th class="border-top-0">Tittle</th>
                           <th class="border-top-0">link</th>
                           <th class="border-top-0">Image</th>
                           <th class="border-top-0">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @foreach($banners as $banner)
                        <tr>
                           <td>{{$i++}}</td>
                           <td>{{$banner->title}}</td>
                           <td><a href="{{$banner->link}}">{{$banner->link}}</a></td>
                           <td><a href="{{$banner->image}}" target="_blank"> <img src="{{asset($banner->image)}}" alt="" width="50" height="30"></a></td>
                           <td>
                              <a class="btn btn-sm btn-dark text-white m-2" data-bs-toggle="modal" data-bs-target="#banner{{$banner->id}}"><i class="fa fa-edit"></i></a>

                              <div class="modal fade" id="banner{{$banner->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Edit Banner</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body">
                                          <form action="{{route('update.banner',$banner->id)}}" method="post" enctype="multipart/form-data">
                                             @csrf
                                             @method('patch')
                                             <div class="col-md-12">
                                                <div class="form-group">
                                                   <div class="col-md-12 ">
                                                      <div class="col-md-12">
                                                         <label for="" class="text-left"><strong> Title* </strong></label> <br>
                                                         <input type="text" name="title" class="form-control" style="border:1px solid #cdcd" value="{{$banner->title}}">
                                                      </div>
                                                      <div class="col-md-12">
                                                         <label for="" class="text-left"><strong> Link* </strong></label> <br>
                                                         <input type="text" name="link" class="form-control" style="border:1px solid #cdcd" value="{{$banner->link}}">
                                                      </div>
                                                      <div class="col-md-12">
                                                         <label for="" class="text-left"><strong> Image *</strong></label> <br>
                                                         <input type="file" name="image" id="" value="{{$banner->image}}">
                                                      </div>


                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-12 m-2">
                                                <button type="submit" class="btn btn-primary">Update changes</button>
                                             </div>
                                          </form>

                                       </div>

                                    </div>
                                 </div>
                              </div>
                              <form action="{{route('delete.banner',$banner->id)}}" method="post">
                                 @csrf
                                 @method('delete')
                                 <button type="submit" class="btn btn-sm btn-danger text-white m-2"><i class="fa fa-trash"></i></button>
                              </form>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <!-- ============================================================== -->
      <!-- End PAge Content -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Right sidebar -->
      <!-- ============================================================== -->
      <!-- .right-sidebar -->
      <!-- ============================================================== -->
      <!-- End Right sidebar -->
      <!-- ============================================================== -->
   </div>

</div>
@endsection
@section('script')
<script>
   $(document).ready(function() {
      $('#myTable2').DataTable();
   });
</script>
@endsection