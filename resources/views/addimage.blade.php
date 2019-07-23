<form action="upload" method="POST" enctype="multipart/form-data">
  @csrf

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

  Name:<br>
  <input type="text" name="name">
  <br>
  Image:<br>
  <input type="file" name="image">
  <br><br>
  <input type="submit" value="Submit">
</form> 

<div id="image">
 @foreach($images as $key => $img)
  <img src="{{asset('/images/'.$img->image)}}" height="200" width="200">
 @endforeach
</div>