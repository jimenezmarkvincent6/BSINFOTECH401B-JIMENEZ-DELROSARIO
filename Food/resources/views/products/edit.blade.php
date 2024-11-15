<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </head>
  <body>
    
       <div class="container">
             <div class="row justify-content-center ">
                <div class="col-md-10 d-flex justify-content-end">
                  <a href="{{ route('products.index') }}" class="btn btn-dark mt-3">Back</a>
                </div>
             </div>
          <div class="row d-flex justify-content-center">
            <div class="col-md-10">
              <div class="card borde-0 shadow-lg my-2">
                <div class="card-header bg-dark">
                  <h3 class = "text-white text-center">Edit Product</h3>
                </div>
                <form enctype = "multipart/form-data" action="{{ route('products.update', $product->id) }}" method="post">
                      @method('put')
                      @csrf
                      <div class="card-body">
                          <div class="mb-2">
                              <label for="name" class="form-label h6">Name</label>
                              <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name', $product->name) }}">
                              @error('name')
                                  <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                          </div>
                          <div class="mb-2">
                              <label for="price" class="form-label h6">Price</label>
                              <input type="text" class="form-control @error('price') is-invalid @enderror" placeholder="Price" name="price" value="{{ old('price', $product->price) }}">
                              @error('price')
                                  <p class="invalid-feedback">{{ $message }}</p>
                              @enderror
                          </div>
                          <div class="mb-2">
                              <label for="description" class="form-label h6">Description</label>
                              <textarea placeholder="Description" class="form-control" name="description" cols="80" rows="5">{{ old('description' , $product->description) }}</textarea>
                          </div>
                          <div class="mb-2">
                              <label for="image" class="form-label h6">Image</label>
                              <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                <div class= "text-center">
                                    @if ($product -> image != "")
                                        <img class="w-50 my-2 text-center" src="{{ asset('upload/products/'. $product->image) }}" alt="">
                                    @endif
                                </div>
                          </div>
                          <div class="d-grid">
                              <button class="btn btn-lg btn-primary">Update</button>
                          </div>
                      </div>
                  </form>
              </div>
            </div>
          </div>
      </div>
  </body>
</html>