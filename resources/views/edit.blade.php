<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Protfolio</title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/modals/">
    
    <!-- bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- bootstrap CSS end -->
    
    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    {{-- tailwind --}}
    
    <script src="https://kit.fontawesome.com/55da33b8b0.js" crossorigin="anonymous"></script>
    
    <!-- Custom styles for this template -->
    <link href="{{asset('customcss/edit.css')}}" rel="stylesheet">
    <link href="{{ asset('customcss/navbar.css') }}" rel="stylesheet">

    @vite('resources/css/app.css')
  
  </head>

<body>

{{-- alerts  --}}
  @if ($errors->any())
  <script>
    @foreach ($errors->all() as $error)
    toastr.error('Failed', '{{ $error }}');
    @endforeach
  </script>
@endif

@if(session()->has('success'))
<script>
  toastr.success('Success', '{{ session()->get('success') }}');
</script>
@endif
{{-- alerts end --}}

{{-- All section start --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" aria-label="Tenth navbar example">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample08" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div style="height: 70px;" class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
      <ul class="navbar-nav">
        <li style="margin-right: 50vw;" class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Views: {{$views->views}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/')}}">View Website</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/')}}">Fork On Github</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Edit</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#all-sec">Manage All Section</a></li>
            <li><a class="dropdown-item" href="#navbar">Navbar</a></li>
            <li><a class="dropdown-item" href="#hero">Hero Section</a></li>
            <li><a class="dropdown-item" href="#about">About Section</a></li>
            <li><a class="dropdown-item" href="#services">Services Section</a></li>
            <li><a class="dropdown-item" href="#work">Work Section</a></li>
            <li><a class="dropdown-item" href="#contact">Contact Us Section</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="modal modal-signin position-static d-block py-2" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
      <h1 class="main-heading  mt-20 mb-3 center" id="all-sec">Manage All Sections</h1>
      <div style="width: 150%;left: -25%;" class="modal-content rounded-4 shadow">
        
        <div class="modal-body p-5 pt-4">
          <form method="POST" action="{{url('/manage_sections')}}">@csrf
            
            {{-- create section --}}
            {{-- <div class="input-group mb-3" id="1">
              <span class="input-group-text dark">Name</span>
              <input id="name" type="text" value="name" class="form-control">
              <select name='status' id="status" class="form-select" aria-label="Default select example">
                <option value="1">Show</option>
                <option value="2">Hide</option>
              </select>
              <i class="fa fa-plus ml-2 p-2" id="add_section" style="font-size:36px;border:1px dotted black;cursor:pointer;"></i>
            </div> --}}
            {{-- create section end --}}


            <div id="sections">
              @foreach($sections as $section)
              <input id="name" name="id[]" type="hidden" value="{{$section->id}}" class="form-control">
              <div class="input-group mb-3">
                <span class="input-group-text dark">Name</span>
                <input disabled id="name" name="name[]" type="text" value="{{$section->name}}" class="form-control">
                <select name='status[]' id="status" class="form-select">
                  @if($section->status==1)
                  <option value=1 selected>Show</option>
                  <option value=2 >Hide</option>
                  @else
                  <option value="1">Show</option>
                  <option value="2" selected>Hide</option>
                  @endif
                </select>
              </div>
                {{-- <div class="input-group mb-3">
                  <span class="input-group-text dark">Order</span>
                  <input disabled id="order" type="text" value="{{$nav->order}}" class="form-control">
                  <span class="input-group-text dark">Display</span>
                  <input disabled id="display" type="text" value="{{$nav->heading}}" class="form-control">
                  <span class="input-group-text dark">link</span>
                  <input disabled type="text" id="link" value="{{$nav->link}}" class="form-control">
                  <button class="btn btn-outline-secondary" onclick="delete_nav(this.id)" type="button" id="{{$nav->id}}">remove</button>
                </div> --}}
              @endforeach
            </div>
            
            <button class="w-100 btn btn-lg rounded-3 btn-primary" type="submit">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <hr class="w-[80%] my-10 mx-24">
{{-- All section end --}}

{{-- navbar section start --}}

<div class="modal modal-signin position-static d-block py-2" tabindex="-1" role="dialog" >
    <h1 class="main-heading   mb-0 center" id="navbar">Navbar</h1>

    
    <div class="modal-dialog" role="document">
      <div style="width: 150%;left: -25%;" class="modal-content rounded-4 shadow">
        
        <div class="modal-body p-5 pt-4">
          <form method="POST" action="{{url('/navbar_heading')}}" enctype="multipart/form-data">@csrf
          
          @php
            $fav_icon = 'uploads/herosection/'.$nav_heading->fav_icon;
          @endphp
          <h2 class="fw-bold mt-3 center">Current Favicon</h2>
          <img style="height:25vh;margin-left:40%;" src="{{asset($fav_icon)}}" class="img-fluid mt-3 mb-3" alt="current image">
            
          <div class="input-group mb-3">
            <input type="file" name='fav_icon' value="{{$nav_heading->fav_icon}}" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
          </div>
          
          <hr>
            <div class="input-group mb-3 mt-3">
              <span class="input-group-text" id="inputGroup-sizing-default">Edit Top Heading</span>
              <input type="text" value="{{$nav_heading->heading}}" name='top_heading' class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            
            <h2 style="font-size: 2rem;" class="center m-3">Edit Navbar Links</h2>
            
            <div class="input-group mb-3" id="1">
              <span class="input-group-text dark">Order</span>
              <input id="order" type="text" value="1" class="form-control">
              <span class="input-group-text dark">Display</span>
              <input id="display" type="text" value="display" class="form-control">
              <button style="background-color: rgb(168, 160, 160);color: azure;" class="btn btn-outline-secondary dropdown-toggle dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">Link</button>
              <ul class="dropdown-menu">
                @foreach($sections as $sec)
                  <li><a class="dropdown-item nav-links" value="{{$sec->name}}" onclick="SetLink(this.value)">link to {{$sec->name}}</a></li>
                @endforeach
              </ul>
              <input type="text" id="link" value="link" class="form-control">
              <i class="fa fa-plus ml-2 p-2" id="add_nav" style="font-size:36px;border:1px dotted black;cursor:pointer;"></i>
            </div>
            <div id="navs">
              @foreach($nav_section as $nav)
                <div class="input-group mb-3">
                  <span class="input-group-text dark">Order</span>
                  <input disabled id="order" type="text" value="{{$nav->order}}" class="form-control">
                  <span class="input-group-text dark">Display</span>
                  <input disabled id="display" type="text" value="{{$nav->heading}}" class="form-control">
                  <span class="input-group-text dark">link</span>
                  <input disabled type="text" id="link" value="{{$nav->link}}" class="form-control">
                  <button class="btn btn-outline-secondary" onclick="delete_nav(this.id)" type="button" id="{{$nav->id}}">remove</button>
                </div>
              @endforeach
            </div>
            
            <button class="w-100 btn btn-lg rounded-3 btn-primary" type="submit">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <hr class="w-[80%] my-10 mx-24">
{{-- navbar section end --}}

{{-- hero section start --}}

<div class="modal modal-signin position-static d-block py-2" tabindex="-1" role="dialog" >
  <h1 class="main-heading   mb-0 center" id="hero">Hero Section</h1>
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      
      @php
      $hero_file = 'uploads/herosection/'.$hero_section->file;
      @endphp

<h2 class="fw-bold mt-3 center">Current image</h2>
<img style="height:25vh" src="{{asset($hero_file)}}" class="img-fluid mt-3 mb-3" alt="current image">

      <div class="modal-body p-5 pt-0">
        <form method="POST" action="{{url('/heroedit')}}" enctype="multipart/form-data">@csrf
          <div class="input-group mb-3">
            <input type="file" name='hero_image' value="{{$hero_section->file}}" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
          </div>
          
          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Edit Main Heading</span>
            <input type="text" value="{{$hero_section->heading}}" name='main_heading' class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
          
          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Edit Subheading Skills</span>
            <input type="text" name='sub_heading' class="form-control" value="{{$hero_section->sub_heading}}" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            <span>Seperate Skills with comma(',')</span>
          </div>
          
          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<hr class="w-[80%] my-10 mx-24">
{{-- hero section end --}}

{{-- about section start --}}

<div class="modal modal-signin position-static d-block py-2" tabindex="-1" role="dialog" >
  <h1 class="main-heading   mb-0 center" id="about">About Section</h1>
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      
      @php
      $about_file = 'uploads/aboutsection/'.$about_section->about_file;
      @endphp

<h2 class="fw-bold mt-3 center">Current image</h2>

<div style="display: grid;place-items: center;">
  <img style="height:25vh;width:50%;" src="{{asset($about_file)}}" class="img-fluid mt-3 mb-3" alt="current image">
</div>

      <div class="modal-body p-5 pt-0">
        <form method="POST" action="{{url('/aboutedit')}}" enctype="multipart/form-data">@csrf
          <div class="input-group mb-3">
            <input type="file" name='about_image' value="{{$about_section->file}}" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
          </div>
          
          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Edit Name</span>
            <input type="text" value="{{$about_section->name}}" name='name' class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>
          
          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Edit Profile</span>
            <input type="text" value="{{$about_section->profile}}" name='profile' class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>

          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Edit Email</span>
            <input type="text" value="{{$about_section->email}}" name='email' class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>

          <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Edit Phone</span>
            <input type="text" value="{{$about_section->phone}}" name='phone' class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
          </div>

          <div class="input-group mb-3" id="1">
            <span class="input-group-text dark">Name</span>
            <input id="skill-name" type="text" value="display" class="form-control">
            <span class="input-group-text dark">Percent(%)</span>
            <input type="text" id="skill-percent" value="10" class="form-control">
            <i class="fa fa-plus ml-2 p-2" id="add_skill" style="font-size:36px;border:1px dotted black;cursor:pointer;"></i>
          </div>
          <label for="customRange1" class="form-label">Percent(%)</label>
          <input type="range" min="10" value="10" max="100" onchange="show_value(this.value);" class="form-range" id="customRange1">
          <div id="skills">
            @foreach($skills as $skill)
            <div class="input-group mb-3">
              <span class="input-group-text dark">Name</span>
              <input disabled type="text" value="{{$skill->name}}" class="form-control">
              <span class="input-group-text dark">Percent</span>
              <input type="text" disabled id="link" value="{{$skill->percent}}" class="form-control">
              <button onclick="delete_skill(this.id)" class="btn btn-outline-secondary" type="button" id="{{$skill->id}}">remove</button>
            </div>
            @endforeach
          </div>

          
          <span class="mb-1">About Me</span>
          <textarea class="mb-3" name='about_me' id="editor">{{$about_section->about_me}}</textarea>
          
          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<hr class="w-[80%] my-10 mx-24">
{{-- about section end --}}

{{-- Services --}}
<h3 id="services" class="text-center font-semibold text-3xl mt-4">Services Section</h3>
<div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 pt-6 gap-8" >
  @foreach($services as $service)
  <div class="rounded border-gray-300 dark:border-gray-700">
    <form action="edit-service" method="post">@csrf
      <input type="hidden" name="id" value="{{$service->id}}">
      <div class="service-box p-3 h-auto">
        <div class="service-ico">
          <span class="ico-circle"><i class="{{$service->icon}}"></i></span>
          <input type="text" name="icon" class="mx-20 mt-3 block w-56 rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        value="{{$service->icon}}">
        </div>
        <div class="service-content">
          {{-- <h2 class="s-title">{{$service->heading}}</h2> --}}
          <input type="text" name="heading" class="mx-20 mt-3 block w-56 rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        value="{{$service->heading}}">
        <textarea type="text" name="text" id="services-text" class="my-3  block w-full rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        >{{$service->text}}</textarea>
        </div>
        <button class="m-3 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium text-gray-700 shadow-sm hover:bg-grey-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all top-0 float-right" type="submit">edit</button>

        <a class="m-3 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium text-gray-700 shadow-sm hover:bg-grey-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all top-0 float-right" href="{{url('delete-service'.'/'.$service->id)}}">remove</a>
      </div>
    </form>
  </div>
  @endforeach

  <div class="rounded border-gray-300 dark:border-gray-700 border-2 p-3 bg-slate-300">
      <form class="" action="save-services" method="post">@csrf
        <i id="service-display" class="fa-solid fa-exclamation text-center font-bold float-right border-dashed border-2 p-2 text-xl mr-44"></i>
        <label for="services-icon" class="p-1 text-center font-normal text-lg">Icon (add <a href="https://fontawesome.com/icons" target="_blank" rel="noopener noreferrer">font awesome</a> or <a href="https://icons.getbootstrap.com/" target="_blank" rel="noopener noreferrer">Bootstrapp</a> icon classes)</label>
        <input type="text" name="icon" id="services-icon" class="block w-full rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        placeholder="paste icon classes here">
        <label for="heading" class="p-1 text-center font-normal text-lg">Heading</label>
        <input type="text" name="heading" id="services-heading" class="block w-full rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        placeholder="Service name here">
        <label for="text" class="p-1 text-center font-normal text-lg">Text</label>
        <textarea type="text" name="text" id="services-text" class="block w-full rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        value=" "></textarea>
        
        <button type="submit" class="m-3 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-grey-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all float-right">Add</button>
      </form>
    </div>
  </div>
  <hr class="w-[80%] my-10 mx-24">
{{-- Service section end --}}

{{-- Work --}}
<h3 id="work" class="text-center font-semibold text-3xl mt-4">Work Section</h3>
<div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 pt-6 gap-8" >
  @foreach($works as $work)
  @php
  $img = 'uploads/herosection/'.$work->file;
  @endphp
  <div class="rounded border-gray-300 dark:border-gray-700">
    <form action="edit-work" method="post" enctype="multipart/form-data">@csrf
      <input type="hidden" name="id" value="{{$work->id}}">
      <div class="service-box p-3 h-auto">
        <div class="service-ico">
          <span class="ico-circle"><img class="w-20 h-20 rounded-full" src="{{$img}}" alt=""></span>
          
          <input style="display: none" name='file' id="file_input" type="file">
          <label class="ml-5 mb-1 rounded-md border border-gray-500 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2" for="file_input">change file</label>

        </div>


        <label for="heading" class="p-1 text-center font-normal text-lg">Heading</label>
        <input type="text" name="heading" class="block w-full rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        value="{{$work->heading}}">
        <label for="cat" class="p-1 text-center font-normal text-lg">Category</label>
        <input type="text" id="cat" name="category" class="block w-full rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        value="{{$work->category}}">
        <label for="work-link" class="p-1 text-center font-normal text-lg">link</label>
        <input type="text" id="work-link" name="link" class="block w-full rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        value="{{$work->link}}">
        <label for="work-date" class="p-1 text-center font-normal text-lg">date</label>
        <input type="text" id="work-date" name="date" class="block w-full rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        value="{{$work->date}}">

        <button class="m-3 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium text-gray-700 shadow-sm hover:bg-grey-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all top-0 float-right" type="submit">edit</button>

        <a class="m-3 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium text-gray-700 shadow-sm hover:bg-grey-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all top-0 float-right" href="{{url('delete-work'.'/'.$work->id)}}">remove</a>
      </div>
    </form>
  </div>
  @endforeach

  <div class="rounded border-gray-300 dark:border-gray-700 border-2 p-3 bg-slate-300">

    <h3 class="text-center font-semibold text-3xl mt-2">Add Work</h3>
      <form class="" action="save-work" method="post" enctype="multipart/form-data">@csrf
        
        <label class="block">
          <span class="sr-only">Choose profile photo</span>
          <input type="file" name="file" class="block w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-violet-50 file:text-violet-700
            hover:file:bg-violet-100
          "/>
        </label>


        <label for="heading" class="p-1 text-center font-normal text-lg">Heading</label>
        <input type="text" name="heading" class="block w-full rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        placeholder="Designed chat page at facebook">
        <label for="cat" class="p-1 text-center font-normal text-lg">Category</label>
        <input type="text" id="cat" name="category" class="block w-full rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        placeholder="Web Design">
        <label for="work-link" class="p-1 text-center font-normal text-lg">link</label>
        <input type="text" id="work-link" name="link" class="block w-full rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        placeholder="www.mywork.com">
        <label for="work-date" class="p-1 text-center font-normal text-lg">date</label>
        <input type="text" id="work-date" name="date" class="block w-full rounded-md border-gray-300 pl-3 pr-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        placeholder="18 Sep. 2018">
        
        <button type="submit" class="m-3 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-grey-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all float-right">Add</button>
      </form>
    </div>
  </div>
  <hr class="w-[80%] my-10 mx-24">
{{-- Work section end --}}


{{-- contact section --}}

<div id="contact">
  <h3 class="text-3xl mt-3 font-medium leading-6 text-gray-900 center">Contact Us Section</h3>
  <p class="mt-1 text-sm text-gray-600 center">This information will be displayed publicly so be careful what you share.</p>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        {{-- social links --}}
        @php
        $facebook = $social_links->where('name', 'facebook')->first();
        $instagram = $social_links->where('name', 'instagram')->first();
        $linkedin = $social_links->where('name', 'linkedin')->first();
        $twitter = $social_links->where('name', 'twitter')->first();
        @endphp
          <div class="mt-5">
            <h2 class="text-lg font-medium center">Social Links</h2>

            <div class="mt-3">
              <form action="update-social" method="post">@csrf
                <label class="block text-sm font-medium text-gray-700 center">Facebook</label>
                <input type="hidden" value="facebook" name='name'>
                <div class="mt-1 flex items-center">
                  <span class="inline-block h-10 w-10 overflow-hidden rounded-full bg-gray-100">
                    <i class="bi bi-facebook text-3xl text-center "></i>
                  </span>

                <div>
                  <div class="ml-4 relative mt-1 rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                      <span class="text-gray-500 sm:text-sm">Link</span>
                    </div>
                    <input type="text" name="link" id="link" class="block w-full rounded-md border-gray-300 pl-10 pr-20 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{$facebook->link}}">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                      <select id="facebook-status" name="status" class="h-full rounded-md border-transparent bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @if($facebook->status == 0)
                        <option value="0" selected>Show</option>
                        <option value="1">Hide</option>
                        @else
                        <option value="0">Show</option>
                        <option selected value="1">Hide</option>
                        @endif
                      </select>
                    </div>
                  </div>
                </div>
                <button type="submit" class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Change</button>
              </div>
            </form>
          </div>
            
            <div class="mt-3">
              <form action="update-social" method="post">@csrf
              <label class="block text-sm font-medium text-gray-700 center">Instagram</label>
              <input type="hidden" value="instagram" name='name'>
              <div class="mt-1 flex items-center">
                <span class="inline-block h-10 w-10 overflow-hidden rounded-full bg-gray-100">
                  <i class="bi bi-instagram text-3xl text-center "></i>
                </span>
                <div>
                  <div class="ml-4 relative mt-1 rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                      <span class="text-gray-500 sm:text-sm">Link</span>
                    </div>
                    <input type="text" name="link" id="link" class="block w-full rounded-md border-gray-300 pl-10 pr-20 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{$instagram->link}}">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                      <select id="facebook-status" name="status" class="h-full rounded-md border-transparent bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @if($instagram->status == 0)
                        <option value="0" selected>Show</option>
                        <option value="1">Hide</option>
                        @else
                        <option value="0">Show</option>
                        <option selected value="1">Hide</option>
                        @endif
                      </select>
                    </div>
                  </div>
                  
                </div>

                <button type="submit" class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Change</button>
                </div>
              </form>
            </div>
            
            <div class="mt-3">
              <form action="update-social" method="post">@csrf
              <label class="block text-sm font-medium text-gray-700 center">Twitter</label>
              <input type="hidden" value="twitter" name='name'>
              <div class="mt-1 flex items-center">
                <span class="inline-block h-10 w-10 overflow-hidden rounded-full bg-gray-100">
                  <i class="bi bi-twitter text-3xl text-center "></i>
                </span>
                
                <div>
                  <div class="ml-4 relative mt-1 rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                      <span class="text-gray-500 sm:text-sm">Link</span>
                    </div>
                    <input type="text" name="link" id="link" class="block w-full rounded-md border-gray-300 pl-10 pr-20 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{$twitter->link}}">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                      <select id="facebook-status" name="status" class="h-full rounded-md border-transparent bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @if($twitter->status == 0)
                        <option value="0" selected>Show</option>
                        <option value="1">Hide</option>
                        @else
                        <option value="0">Show</option>
                        <option selected value="1">Hide</option>
                        @endif
                      </select>
                      </div>
                    </div>
                  
                </div>

                <button type="submit" class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Change</button>
                </div>
              </form>
            </div>
            
            <div class="mt-3">
              <form action="update-social" method="post">@csrf
              <label class="block text-sm font-medium text-gray-700 center">Linkedin</label>
              <input type="hidden" value="linkedin" name='name'>
              <div class="mt-1 flex items-center">
                <span class="inline-block h-10 w-10 overflow-hidden rounded-full bg-gray-100">
                  <i class="bi bi-linkedin text-3xl text-center "></i>
                </span>
                
                <div>
                  <div class="ml-4 relative mt-1 rounded-md shadow-sm">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-2">
                      <span class="text-gray-500 sm:text-sm">Link</span>
                    </div>
                    <input type="text" name="link" id="link" class="block w-full rounded-md border-gray-300 pl-10 pr-20 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{$linkedin->link}}">
                    <div class="absolute inset-y-0 right-0 flex items-center">
                      <select id="facebook-status" name="status" class="h-full rounded-md border-transparent bg-transparent py-0 pl-2 pr-7 text-gray-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @if($linkedin->status == 0)
                        <option value="0" selected>Show</option>
                        <option value="1">Hide</option>
                        @else
                        <option value="0">Show</option>
                        <option selected value="1">Hide</option>
                        @endif
                      </select>
                    </div>
                  </div>
                </div>

                </select>
                <button type="submit" class="ml-5 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm font-medium leading-4 text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Change</button>
                </div>
              </form>
            </div>

          </div>
        {{-- social links end --}}
      </div>
    </div>
    <div class="mt-5 md:col-span-2 md:mt-0">
      <form action="save-contact" method="POST">@csrf
        <div class="shadow sm:overflow-hidden sm:rounded-md">
          <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">

                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="address" id="address" class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{$contact_section->address}}">
                </div>
                
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="email" id="email" class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{$contact_section->email}}">
                </div>

                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="phone" id="phone" class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{$contact_section->phone}}">
                </div>

              </div>
            </div>

            <div>
              <label for="about" class="block text-sm font-medium text-gray-700">Get In Touch Text</label>
              <div class="mt-1">
                <textarea id="about" name="get_in_touch_text" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" >{{$contact_section->get_in_touch_text}}</textarea>
              </div>
            </div>
            
          </div>

          <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="hidden sm:block" aria-hidden="true">
  <div class="py-5">
    <div class="border-t border-gray-200"></div>
  </div>
</div>

{{-- contact section end --}}



<!-- Custom JS for this template -->
<script src="{{asset('CustomJS/nav.js')}}"></script>
<script src="{{asset('CustomJS/skill.js')}}"></script>
<script src="{{asset('CustomJS/section.js')}}"></script>

      <script>
        function find_icon_class(class_list){
          let classes = '';
          for (let index = 0; index < class_list.length; index++) {
            element = class_list[index];
            if (element.startsWith("fa-") || element.startsWith("bi-")) {
                classes += element+' ';
            }
          }
          return classes;
        }

        $('#services-icon').change(function (e) { 
          e.preventDefault();
          let class_list=$('#service-display').attr('class').split(' ');
          let classes_to_remove = find_icon_class(class_list);
          let text = $('#services-icon').val();
          $('#service-display').removeClass( classes_to_remove ).addClass(text);
        });
        function show_value(x){
          $("#skill-percent").val(x);
        }
        $( ".nav-links" ).click(function(e) {
          let val = e.target.getAttribute("value");
          $('#link').val('#'+val);
        });

        async function set_class(new_class){
          await sleep(5000); //because element appears after some time
          var elem = document.getElementsByClassName('ck-editor')[0];
          if (elem) {
            elem.classList.add(new_class);
          }else{
            set_class();
          }
        }

        const sleep = (milliseconds) => {
          return new Promise(resolve => setTimeout(resolve, milliseconds))
        }   
        
        $( document ).ready(function() {
          // ck editor
          ClassicEditor
              .create( document.querySelector( '#editor' ), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'alignment', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
                        'link', '|',
                        'bulletedList', 'numberedList', 'todoList',
                        'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor', '|',
                        'code', 'codeBlock', '|',
                        'insertTable', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo'
                      ],
                      shouldNotGroupWhenFull: true
                    }
                  } )
                  .catch( error => {
                    console.error( error );
                  } );

          $("#navs .input-group").first().hide();
          set_class('mb-3');

                  
          });
          </script>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>


</body>
</html>
