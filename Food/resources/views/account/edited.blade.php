<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
        crossorigin="anonymous"
    >
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="{{ route('account.admin') }}" class="btn btn-dark mt-3">Back</a>
                </div>
                <div class="card border-0 shadow-lg my-3">
                    <div class="card-header bg-dark">
                        <h3 class="text-white text-center">Edit Account</h3>
                    </div>
                    
                    <form 
                        action="{{ route('account.updated', $user->id ?? '') }}" 
                        method="POST"
                    >
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    value="{{ old('name', $user->name ?? '') }}" 
                                    required
                                >
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    value="{{ old('email', $user->email ?? '') }}" 
                                    required
                                >
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Leave blank if unchanged)</label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="form-control @error('password') is-invalid @enderror"
                                >
                                @error('password')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    class="form-control"
                                >
                            </div>

                           
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" 
        crossorigin="anonymous"
    ></script>
</body>
</html>
