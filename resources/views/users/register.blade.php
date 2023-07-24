<x-layout>
    <div class="d-flex justify-content-center">
        <div class="card p-3 d-flex gap-3" style="width: 36rem;">
            <a href="/">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
            
            <div>
                <h2 class="card-title"><strong>Register</strong></h2>
                <p class="card-subtitle mb-2 text-body-secondary">Create an account</p>
            </div>

            <form method="POST" action="/auth/register">
                @csrf
                
                <div class="mb-3">
                    <label for="username" class="form-label m-1">Username</label>
                    <input type="text" class="form-control" name="username" value="{{ old("username") }}" placeholder="Enter your username">

                    @error('username')
                        <p class="text-danger">{{ $message }}</p>                        
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="first_name" class="form-label m-1">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="{{ old("first_name") }}" placeholder="Enter your first name">

                    @error('first_name')
                        <p class="text-danger">{{ $message }}</p>                        
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label m-1">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{ old("last_name") }}" placeholder="Enter your first name">

                    @error('last_name')
                        <p class="text-danger">{{ $message }}</p>                        
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label m-1">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old("email") }}" placeholder="Enter your email">

                    @error('email')
                        <p class="text-danger">{{ $message }}</p>                        
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label m-1">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password">

                    @error('password')
                        <p class="text-danger">{{ $message }}</p>                        
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password2" class="form-label m-1">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Enter your password again">

                    @error('password')
                        <p class="text-danger">{{ $message }}</p>                        
                    @enderror
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-block mb-3" type="submit">Sign Up</button>
                </div>
            </form>

            <div>
                <p class="m-0">Already have an account? <a href="{{ route("login") }}" class="link">Login</a></p>
            </div>
        </div>
    </div>
</x-layout>