@extends('layouts.app')

@section('content')

<section class="widget profile-section">
        <div class="container-fluid">
            <h1 class="widget-title">Profile</h1>
            <form class="general-form user-info-form user">
                <div class="row">
                    <div class="col-md-3 pr-4">
                        <aside class="pb-5">
                        <img class="img-fluid img-thumbnail" src="{{url('')}}/uploads/avatars/{{$user->avatar}}" alt="profile-img"> 
                        </aside>
                        <div class="profile-img-wrapper ml-xl-auto justify-content-center align-items-center">
                            <div class="img-text d-flex flex-wrap justify-content-center align-items-center flex-column">
                                <i class="fa fa-images"></i>
                                <h3 class="text-center d-none d-md-block">Drag & drop or click here</h3>
                            </div>
                            <input type="file" name="file" id="profile-img-in" class="file-upload">
                            <div class="img-preview">
                                <img src="" alt="profile-img">
                            </div>
                            <div class="img-overlay text-center justify-content-center flex-column">
                                <h3 class="img-name"></h3>
                                <h4 class="mt-5 d-none d-md-block">Drag & drop or click here to replace</h4>
                            </div>
                            <span class="remove-img btn"><i class="fa fa-times mr-1"></i> Remove image</span>
                        </div>
                        
                    </div>
                    <div class="col-md-9">
                        <section class="top-section">
                            <h1>{{$user->name}}</h1>
                            <h3 class="departments-label">Accounting</h3>
                            <div class="ranking">
                                <h3 class="title">Rankings</h3>
                                <span class="rank">8,9</span>
                            </div>
                        </section>
                        <section class="bottom-section">
                            <h3 class="title">User Information</h3>

                                <div class="container-fluid">
                                    <div class="row">
                                        <!-- Name -->
                                        <div class="col-12 col-lg-12 p-0">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="name">Name:</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <span class="static-labels">{{$user->name}}</span>
                                                        <div class="edit-form">
                                                            <input type="text" name="name" id="name" class="form-control" aria-describedby="name" placeholder="Enter a name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Address -->
                                        <div class="col-12 col-lg-12 p-0">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="address">Address:</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <span class="static-labels">{{$user->address}}</span>
                                                        <div class="edit-form">
                                                            <textarea name="address" id="address" class="form-control textAreaHeight" aria-describedby="address"
                                                                placeholder="Enter an address"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Phone -->
                                        <div class="col-12 col-lg-12 p-0">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="phone">Phone:</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <span class="static-labels">{{$user->mobile}}</span>
                                                        <div class="edit-form">
                                                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="Enter a phone number">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                        <!-- Gender -->
                                        <div class="col-12 col-lg-12 p-0">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="gender">Gender:</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <span class="static-labels">{{$user->gender}}</span>
                                                        <div class="edit-form">
                                                            <select name="gender" id="gender" class="form-control">
                                                                <option value="" class="form-control">Select Gender</option>
                                                                <option value="1" class="form-control">Male</option>
                                                                <option value="2" class="form-control">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Departments  -->
                                        <div class="col-12 col-lg-12 p-0 department-form-group">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="departments">Departments:</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <span class="static-labels">HR</span>
                                                        <div class="edit-form">
                                                            <select name="departments" id="departments" class="form-control">
                                                                <option value="" class="form-control">Select Department</option>
                                                                <option value="1" class="form-control">HR</option>
                                                                <option value="2" class="form-control">Accounting</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Username -->
                                        <div class="col-12 col-lg-12 p-0">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label for="email">Email:</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <span class="static-labels">{{$user->email}}</span>
                                                        <div class="edit-form">
                                                            <input type="text" name="email" id="email" class="form-control" placeholder="email">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Upload a file -->
                                        <div class="col-12 col-lg-12 p-0">
                                            <div class="form-group mb-0">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label class="static-labels" for="file-upload">Uploaded files:</label>
                                                        <label class="edit-form" for="file-upload">Upload a file:</label>

                                                    </div>
                                                    <div class="col-md-10">
                                                        <ul class="unstyled-list static-labels">
                                                            <li><a href="#">Contract</a></li>
                                                            <li><a href="#">CV</a></li>
                                                        </ul>
                                                    
                                                        <div class="edit-form">
                                                            <input type="file" name="file-upload" id="file-upload" class="form-control">
                                                            <input type="text" name="file" id="file" class="form-control" placeholder="No file entered">
                                                            <span class="general-btn btn upload-file">Upload</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="d-none btn general-btn download-file edit-form" href="#">Download</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="edit-form">
                                    <button type="submit" class="general-btn btn save">Save</button>
                                    <span class="general-btn btn cancel">Cancel</span>
                                </div>
                            <span id="editBtn" class="btn general-btn edit mt-5">Edit Profile</span>
                        </section>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('scripts')
<script src="{{ asset('assist/scripts/modules/profile.js')}}"></script>

@endsection
