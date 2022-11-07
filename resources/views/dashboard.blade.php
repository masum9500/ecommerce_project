@extends('frontend.main_master')
@section('content')


<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br>
                <img class="card-img-top" style="border-radius: 50%;" src="{{ (!empty($user->profile_photo_path)) ? url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" height="100%" width="100%"><br><br>

                <ul class="list-group list-group-flush">
                    <a href="{{ route('dashboard')}}" class="btn btn-primary btn-block btn-sm">Home</a>
                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-block btn-sm">Profile Update</a>
                    <a href="{{ route('change.password') }}" class="btn btn-primary btn-block btn-sm">Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-block btn-sm">Logout</a>
                </ul>
            </div>
            <div class="col-md-2">
                
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi...</span><strong>{{ Auth::user()->name }}</strong> Welcome To Easy Shop</h3>
                </div>
            </div>
        </div>
    </div>   
</div>


@endsection