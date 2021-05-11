@extends('admin.layout.master')
@section('title','Meeyaar | Edit Product')
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
<form action="{{route('admin.product.update',$product->id)}}" class="form" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PATCH')
  <div class="page-header">
    <a href="{{route('admin.products')}}" class="btn btn-success ml-auto">View All</a>
  </div>
  <div class="col-md-12 grid-margin p-0">
    <div class="card">
      <div class="card-body">
        <h3><b> Product Details </b></h3>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group row">
              <label for="Title" class="col-sm-1">Title</label>
                <div class="col-sm-11">
                  <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" style="height:40px" value="{{$product->title}}">
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
                    <option value="" readonly>Select Category</option>
                    @foreach($categories as $category)
                      <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
                    @endforeach
                  </select>
                    @error('category')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group row">
              <label for="About" class="col-sm-1">About this product</label>
              <div class="col-sm-3">
                <input type="text" name="who" class="form-control @error('who') is-invalid @enderror" style="height:40px;" value="{{$product->who}}" placeholder="Who made it?">
              </div>
              @php 
                $sub_categories=App\Models\SubCategory::where('category_id',$product->category_id)->get();
              @endphp
              <div class="col-sm-3">
                <select name="what" id="what" class="form-control @error('what') is-invalid @enderror @if(session('what_error')) is-invalid @endif" style="height:45px;">
                    <option value="" readonly>What is it?</option>
                    @foreach($sub_categories as $sub)
                    <option class="subcategory" value="{{$sub->id}}" @if($sub->id == $product->subcategory[0]->id) selected @endif>{{$sub->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-3">
                <input type="text" name="when" class="form-control @error('when') is-invalid @enderror" style="height:40px;" value="{{$product->when}}" placeholder="When was it made?">
              </div>
              <div class="col-sm-2">
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" style="height:40px;" value="{{$product->price}}" placeholder="What's its price?">
              </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group row">
              <label for="Type" class="col-sm-1">Type</label>
                <div class="col-sm-2">
                  <input type="radio" class="@error('type') is-invalid @enderror" style="height:1em;width:1em " name="type" value="physical" @if($product->type == 'physical') checked @endif>
                  <label for="Physical" style="font-size:20px">Physical</label>
                </div>
                <div class="col-sm-2">
                  <input type="radio" class="@error('type') is-invalid @enderror" style="height:1em;width:1em" name="type" value="digital" @if($product->type == 'digital') checked @endif>
                  <label for="Physical" style="font-size:20px">Digital</label>
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
                <textarea type="text" name="description" class="form-control @error('description') is-invalid @enderror" rows="8">{{$product->description}}</textarea>
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
              <label for="Title" class="mt-4">
                  <ul>
                      <h4><b> Existing </b></h4>
                      @foreach($product_images as $image)
                      <a href="{{route('admin.product.remove_image',$image->id)}}"><img src="{{asset('product_images/'.$image->image)}}" class="ml-2 mt-2 selected_image" width="100px" title="Remove Image"></a>
                      @endforeach  
                      <h4 class='mt-3'><b> New </b></h4>
                      <li id="image-list" class="w-50" style="list-style-type: none;">
                      </li>
                  </ul>
              </label>
            </div>
            <div class="col-sm-6">
              <label id="input" class="mt-3">
                  <i class="fa fa-play-circle-o fa-5x ml-2"></i>
                  <h4 class="mt-3">Add New</h4>
                <input class="@error('images') is-invalid @enderror" type="file" size="60" id="input_image">
                    @error('images')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
            <div class="form-group row">
              <div class="col-sm-6">
              <video width="320" height="320" controls class="mt-n5 p-0">
                <source src="{{asset('product_videos/'.$product->title.'/'.$product_video->video)}}">
              </video>
              </div>
              <div class="col-sm-6">
                <label id="input" class="mt-3">
                    <i class="fa fa-play-circle-o fa-5x ml-3"></i>
                    <h4 class="mt-3">Change video</h4>
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
              <button type="submit" class="btn btn-primary btn-md">Update</button> 
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
    // $('#category').on('focus',function()
    // {
    //   $('#selected_category').remove();
    //   $('#selected_subcategory').remove();
    // });
    // $('#subcategory').on('focus',function()
    // {
    //   $('#selected_subcategory').remove();
    // });
  });
</script>
@endsection