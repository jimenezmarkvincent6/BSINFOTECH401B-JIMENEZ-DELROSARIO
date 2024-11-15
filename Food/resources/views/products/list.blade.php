<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <style>
      .card-img-top {
        height: 100px;
        object-fit: cover;
      }
      .card {
        height: 100%;
        width: 200px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
      }
      .card:hover {
        transform: scale(1.05);
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      }
      .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
      }
      .card-title, .card-text {
        font-size: 0.9em;
      }
      .card-text.description {
        font-size: 0.5em;
        color: #6c757d;
      }
      .text-muted {
        font-size: 0.75em;
      }
      .container-bg {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
      }
      .header-title {
        background-color: #343a40;
        color: #fff;
        padding: 15px;
        text-align: center;
        font-size: 1.5em;
        border-radius: 8px 8px 0 0;
        margin-top: -20px;
        margin-left: -20px;
        margin-right: -20px;
      }
    </style>
  </head>
  <body>
        <div class="bg-dark">
            <h1 class="text-white text-center">MIDWAY</h1> 
        </div>

        <div class="container my-4 container-bg">
            <div class="header-title">SILOG MEALS</div>
        
            <div class="row justify-content-center mt-3">
                <div class="col-md-10 d-flex justify-content-end">
                    <a href="{{ route('products.create') }}" class="btn btn-dark mb-3">Add Product</a>
                </div>
            </div>
            <div class="row justify-content-center">
                @if(Session::has('success'))
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    </div>
                @endif

                @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                        <div class="col-auto mb-4 d-flex align-items-stretch">
                            <div class="card shadow-sm">
                                @if ($product->image != "")
                                <img src="{{ asset('upload/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">₱{{ $product->price }}</p>
                                    <p class="card-text description">{{ $product->description }}</p>
                                    <p class="card-text text-muted">Created on: {{ \Carbon\Carbon::parse($product->created_at)->format('d M, Y') }}</p>
                                    <div class="mt-auto d-flex justify-content-between">
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-dark btn-sm">Edit</a>
                                        <button onclick="deleteProduct({{ $product->id }})" class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                    <form id="delete-product-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                <div class="col-md-12">
                    <p class="text-center">No products available.</p>
                </div>
                @endif
            </div>
        </div>
        <script>
            function deleteProduct(id) {
                if (confirm("Are you sure you want to delete the product?")) {
                    document.getElementById("delete-product-form-" + id).submit();
                }
            }
        </script>
  </body>
</html>