<x-layout>
    <div class="d-flex justify-content-center">
        <div class="card p-3 d-flex gap-3" style="width: 36rem;">
            <a href="/">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
            
            <div>
                <h2 class="card-title"><strong>Login</strong></h2>
                <p class="card-subtitle mb-2 text-body-secondary">Log in to your account</p>
            </div>

            <form method="POST" action="/auth/login">
                @csrf

                {{-- <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username">
                </div> --}}
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

                @error('invalid')
                    <p class="text-danger">{{ $message }}</p>                        
                @enderror

                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-block mb-3" type="submit">Submit</button>
                </div>
            </form>

            <div>
                <p class="m-0">Don't have an account? <a href="/register" class="link">Register</a></p>
            </div>
        </div>
    </div>
</x-layout>