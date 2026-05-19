<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
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
            <img src="{{ asset('images/lupa.jpg') }}" alt="logo" class="w-full h-full object-cover">
        </div>

        <div class="md:w-1/2 flex flex-col justify-center px-8 lg:px-16">
            <h2 class="text-3xl font-bold text-[#d46a6a] text-center mb-8">Forgot</h2>
            <h2 class="text-3xl font-bold text-[#d46a6a] text-center mb-8">Your Password ? </h2>
            
            
            <a class="block text-sm font-semibold text-gray-600 mb-1 ">Confirm your email for verification code OTP</a>
            @if(session('failed'))
                <p class="error">{{session('failed')}}</p>
            @endif
            <form action="{{ route('verification.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <input type="hidden" name="type" value="lupa_password">
                    <label class="block text-sm font-semibold text-gray-600 mb-1">Email</label>
                    <input type="email" name="email" placeholder="contoh@gmail.com" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-300">
                </div>

               
                   

                <button type="submit" class="w-full btn-primary text-white font-bold py-3 rounded-lg transition duration-300 mt-4 shadow-md">
                    Reset Password
                </button>
            </form>

            <div style="margin-top: 15px; text-align: center;">
                
                <a href="/login" class="text-xs text-gray-400 hover:underline">Back to Sigin</a>

              
            </div>

            
        </div>
    </div>

</body>
</html>