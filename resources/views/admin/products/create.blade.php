@extends('admin.layout.master')
@section('title','Meeyaar | Create Product')
@push('plugin-styles')
 
@endpush
@section('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<style>
#input{
    border:1px solid rgb(211,211,211);
    padding-left: 70px;
    padding-right: 70px;
    padding-top: 70px;
    padding-bottom: 70px;
    display: table;
    color: black;
    cursor:pointer;
     }

input[type="file"] {
    display: none;
}
</style>
@endsection
@section('content')
<div class="page-header">
  <a href="{{route('admin.products')}}" class="btn btn-success ml-auto">View All</a>
</div>
<form action="{{route('admin.product.store')}}" class="form" method="POST" enctype="multipart/form-data">
  @csrf
<div class="col-md-12 grid-margin p-0">
    <div class="card">
      <div class="card-body">
        <h3><b> Product Details </b></h3>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group row">
              <label for="Title" class="col-sm-1">Title</label>
              <div class="col-sm-11">
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" style="height:45px" placeholder="Enter title of your product">
                @error('title')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group row">
              <label for="Category" class="col-sm-1">Category</label>
              <div class="col-sm-11">
                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" style="height:45px" >
                  <option value="" readonly selected>Select Category</option>
                  @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
                @error('category')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
              @error('category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group row">
              <label for="About" class="col-sm-1">About this product</label>
              <div class="col-sm-3">
                <input type="text" name="who" class="form-control  @error('who') is-invalid @enderror" style="height:45px;" placeholder="Who made it?">
                @error('who')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="col-sm-3">
                <select name="what" id="what" class="form-control @error('what') is-invalid @enderror @if(session('what_error')) is-invalid @endif" style="height:45px;">
                  <option value="" readonly>What is it?</option>
                </select>
                @error('what')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div> 
              <div class="col-sm-3">
                <input type="text" name="when" class="form-control @error('when') is-invalid @enderror" style="height:45px;" placeholder="When was it made?">
                @error('when')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <div class="col-sm-2">
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" style="height:45px;" placeholder="What's its price?">
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group row">
              <label for="Type" class="col-sm-1">Type</label>
              <div class="col-sm-2">
                <input type="radio" class="@error('type') is-invalid @enderror" style="height:1em;width:1em " name="type" value="physical" checked>
                <label for="Physical" class="" style="font-size:20px">Physical</label>
              </div>
              <div class="col-sm-2">
                <input type="radio" class="@error('type') is-invalid @enderror" style="height:1em;width:1em" name="type" value="digital">
                <label for="Physical" class="" style="font-size:20px">Digital</label>
              </div>
            </div>
            @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="col-md-12">
            <div class="form-group row">
              <label for="Description" class="col-sm-1">Description</label>
              <div class="col-sm-11">
                <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" rows="6"></textarea>
                @error('description')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="col-md-12 grid-margin mt-4 p-0">
  <div class="card">
    <div class="card-body">
      <h3><b> Images </b></h3>
        <div class="form-group row">
          <div class="col-sm-6">
            <label for="Title" class="mt-4"><b> Before You Start </b>
              <ul>
                <li class="w-50">Adjust your phone or camera settings to record high resolution picture - aim 1920 x 1080px.</li>
                <br>
                <li class="w-50">Match the aspect ratio of your pictures with your primary photo,or consider making it square.</li>
                <br>
                <li id="image-list" class="w-50" style="list-style-type: none;"></li>
              </ul>
            </label>
          </div>
          <div class="col-sm-6">
            <label id="input" class="mt-3">
                <i class="fa fa-play-circle-o fa-5x ml-3"></i>
                <h4 class="mt-3">Add a Image</h4>
                  <input class="@error('images') is-invalid @enderror" type="file" size="60" id="input_image" accept="image/*">
                  @error('images')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <span class="invalid-feedback image_error" role="alert" style="display: none">
                    <strong>Image resolutions should be 1920 x 1080.</strong>
                </span>
            </label> 
          </div>
        </div>
    </div>
  </div>
</div>
  <div class="col-md-12 grid-margin mt-3 p-0">
      <div class="card">
        <div class="card-body">
          <h3><b> Video </b></h3>
          <h5 class="text-default">Bring your product to life with a 5 to 15 second video--it could help you drive more sales.The video won't feature sound,so let your product do the talking!</h5>
          
          <div class="form-group row">
              <div class="col-sm-6">
                <label for="Title" class="mr-5 mt-4"><b> Before You Start </b>
                  <ul>
                    <li class="w-50">Adjust your phone or camera settings to record high resolution video - aim 1080px or higher.</li>
                    <br>
                    <li class="w-50">Match the aspect ratio of your video with your primary photo,or consider making it square.</li>
                    <br>
                    <li class="w-50">Keep your camera steady by using a tripod or filming on a level surface.</li>
                  </ul>
                </label>
              </div>
              <div class="col-sm-6">
                <label id="input" class="mt-3">
                    <i class="fa fa-play-circle-o fa-5x ml-3"></i>
                    <h4 class="mt-3">Add a video</h4>
                  <input class="@error('video') is-invalid @enderror" type="file" name="video" accept="video/*">
                  @error('video')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </label> 
              </div>
          </div>
          <div class="form-group">
                <button type="submit" class="btn btn-primary btn-md">Create</button> 
          </div>
        </div>
      </div>
  </div>
</form>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function()
  {
    var count =1;
    function readURL(input) 
    {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {

            var image = new Image();
            image.src = e.target.result;

            image.onload = function() {
                if(this.width == '1920' && this.height == '1080')
                {
                    $('#image-list').append('<img src="'+e.target.result+'" class="ml-2 mt-2 selected_image '+count+'" accept="image/*" width="100px" title="Remove Image" style="cursor:pointer">');     
                    $('.form').append('<input type="hidden" name="images[]" value="'+e.target.result+'" class="'+count+'">');
                    count++;
                }
                else
                {
                  $('.image_error').css('display','inline');
                }
            };
          }

          reader.readAsDataURL(input.files[0]);
      }
    }

    $('#input_image').on('change',function()
    {
      readURL(this);
    });
    $('#input_image').on('click',function()
    {
      $('.image_error').css('display','none');
    });

    $('#image-list').on('click','.selected_image',function()
    {
      var class_list=$(this).attr('class');
      var classArr = class_list.split(/\s+/);
      var image_count=classArr[classArr.length - 1];
      var image_class='.'+image_count;
      $(image_class).remove();
      $(this).remove();
    });

    $('#category').on('change',function()
    {
      if($(this).val() != '')
      {
      $('.subcategory').remove();
      $.ajax({
        type: 'GET',
        url: '/admin/products/get_subcategories/'+$(this).val(),
        data: {
            
        },
        success: function(data){
           var i;
           for(i=0;i<data.length;i++)
           {
              $('#what').append('<option value="'+data[i]['id']+'" class="subcategory">'+data[i]['name']+'</option>');
           }
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
      });
      }
      else
      {
        $('.subcategory').remove();
      }
    });
  });
</script>
@endsection