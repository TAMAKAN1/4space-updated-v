@extends('layouts.backend.app')
@section('content')
<div class="row mt-4">
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <center>
                <h3 class="card-header p-2 mt-4 bg-dark  text-white">Your Profile</h3>
                <div class="card p-4 " style="border:2px solid #000">
                    <p><strong>Name: </strong> {{auth()->user()->name}}</p>
                    <p><strong>E-Mail: </strong> {{auth()->user()->email}}</p>
                    <p><strong>Phone: </strong> {{auth()->user()->phone ?? 'not add yet'}}</p>
                    <a href="" class="btn btn-dark text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Information</a>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">Edit Profile</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('update.profile',auth()->user()->id) }}">
                                        @csrf
                                        @method('patch')
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{auth()->user()->name}}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                            <div class="col-md-6">
                                                <input id="phone" type="number" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{auth()->user()->phone}}" required autocomplete="phone" autofocus>

                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{auth()->user()->email}}" required autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-dark text-white"><i class="fa fa-upload"></i>Update information</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </center>

        </div>
    </div>
</div>
@endsection