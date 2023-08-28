<h1>Create Post</h1>

@if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

<form method="GET" action="{{ route('apartments.store') }}">
@csrf

<div class="mb-3">
    <label for="user_id" class="form-label">user_id</label>
    <input type="number" class="form-control" id="user_id" name="user_id" value="{{old('user_id')}}">
  </div>

<div class="mb-3">
  <label for="title" class="form-label">Title</label>
  <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
</div>

<div class="mb-3">
    <label for="description" class="form-label">description</label>
    <textarea type="text" class="form-control" id="description" name="description" rows="3" value="{{old('description')}}"></textarea>
</div>

<div class="mb-3">
  <label for="price" class="form-label">price</label>
  <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}">
</div>

<div class="mb-3">
    <label for="latitude" class="form-label">Latitude</label>
    <input type="text" class="form-control" id="latitude" name="latitude" value="{{old('latitude')}}">
</div>

<div class="mb-3">
    <label for="longitude" class="form-label">Longitude</label>
    <input type="text" class="form-control" id="longitude" name="longitude" value="{{old('longitude')}}">
</div>

<div class="mb-3">
    <label for="size" class="form-label">size</label>
    <input type="number" class="form-control" id="size" name="size" value="{{old('size')}}">
</div>

<div class="mb-3">
    <label for="rooms" class="form-label">rooms</label>
    <input type="number" class="form-control" id="rooms" name="rooms" value="{{old('rooms')}}">
</div>

<div class="mb-3">
    <label for="beds" class="form-label">beds</label>
    <input type="number" class="form-control" id="beds" name="beds" value="{{old('beds')}}">
</div>

<div class="mb-3">
    <label for="bathrooms" class="form-label">bathrooms</label>
    <input type="number" class="form-control" id="bathrooms" name="bathrooms" value="{{old('bathrooms')}}">
</div>

<div class="mb-3">
    <label for="visibility" class="form-label">visibility</label>
    <input type="text" class="form-control" id="visibility" name="visibility" value="{{old('visibility')}}">
</div>

<div class="mb-3">
    <label for="cover" class="form-label">cover</label>
    <input type="text" class="form-control" id="cover" name="cover" value="{{old('cover')}}">
</div>

<button type="submit">invia</button>
</form>