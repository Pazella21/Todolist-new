<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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
            <h2 class="text-3xl font-bold text-[#d46a6a] text-center mb-8">Register</h2>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Name</label>
                    <input type="text" name="name" 
                        class="w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-pink-300" 
                        placeholder="Full name" 
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" 
                        class="w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-pink-300" 
                        placeholder="email@example.com"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-600 block mb-1">Password</label>
                    <input type="password" name="password" 
                        class="w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-md focus:outline-none focus:ring-2 focus:ring-pink-300">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-600 block mb-1">Retype Password</label>
                    <input type="password" name="confirm_password" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-300">
                </div>

                <button type="submit" class="w-full btn-primary text-white font-bold py-3 rounded-lg transition duration-300 mt-4 shadow-md">
                    Register
                </button>
            </form>

            <div class="text-center mt-6">
                <a href="{{ url('/login') }}" class="text-sm text-gray-600 hover:text-pink-500 transition">
                    I already have a membership
                </a>
            </div>
            
        </div>
    </div>

</body>
</html>