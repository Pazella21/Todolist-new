<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffdce0; /* Warna pink background luar */
        }
        .login-card {
            background-color: white;
            border-radius: 2rem;
        }
        .btn-primary {
            background-color: #ff7a7a;
        }
        .btn-primary:hover {
            background-color: #ff5c5c;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="login-card flex flex-col md:flex-row overflow-hidden shadow-xl max-w-4xl w-full p-6 space-y-6 md:space-y-0">
        
        <div class="md:w-1/2 flex items-center justify-center bg-[#ffeef0] rounded-3xl overflow-hidden">
            <img src="{{ asset('images/logo.jpg') }}" alt="logo" class="w-full h-full object-cover">
        </div>

        <div class="md:w-1/2 flex flex-col justify-center px-8 lg:px-16">
            <h2 class="text-3xl font-bold text-[#d46a6a] text-center mb-8">Login</h2>

            @if (session('failed'))
                <div class="text-red-500 text-sm mb-2"> {{session('failed')}}</div>
                @endif
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-300">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="text-sm font-semibold text-gray-600">Password</label>
                    </div>
                    <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-300">
                    <div class="text-right mt-1">
                        <a href="{{route('password.request')}}" class="text-xs text-gray-400 hover:underline">forgot password?</a>
                       
                </div>
                    <div class="text-right mt-1">
                    <a href="/register" class="text-xs text-gray-400 hover:underline">Register</a>
                    </div>

                <button type="submit" class="w-full btn-primary text-white font-bold py-3 rounded-lg transition duration-300 mt-4 shadow-md">
                    Log in
                </button>
            </form>

            <div class="mt-8">
                <div class="relative flex py-5 items-center">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="flex-shrink mx-4 text-gray-400 text-xs">or continue with</span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>

                <div class="flex justify-center space-x-6 mt-2">
                    <a href="{{route('google.login')}}" class="w-10 h-10 border border-gray-200 rounded-full flex items-center justify-center hover:bg-gray-50">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
                    </a>
                    <!-- <a href="#" class="w-10 h-10 border border-gray-200 rounded-full flex items-center justify-center hover:bg-gray-50">
                        <i class="fab fa-facebook-f text-blue-600"></i>
                    </a> -->
                    
                    </a>
                </div>
            </div>

            
        </div>
    </div>

</body>
</html>