<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    @vite(['resources/css/app.css', 'resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-gray-200 font-sans">
    
    <div class="flex items-center justify-center min-h-screen py-6 px-4" style="background-image: url('https://assets.nflxext.com/ffe/siteui/vlv3/826348c2-cdcb-42a0-bc11-a788478ba5a2/56eb4a2f-2136-4e15-9960-84d26f3bed98/PE-es-20240729-POP_SIGNUP_TWO_WEEKS-perspective_WEB_bb462c08-8ad2-4990-a192-8b2d3b4d1e01_large.jpg'); background-size: cover; background-position: center;">
            <div class="w-full max-w-3xl h-100 text-center bg-white border border-gray-200 rounded-lg sm:p-14">
                <h5 class="mb-2 text-3xl font-bold text-gray-900">Verify your email address</h5>
                <div class="container mx-auto"> 
                    <img src="https://img.icons8.com/?size=200&id=LPcVDft9Isqt&format=png&color=000000" class="mx-auto" />
                </div>        
                <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Check your email & clic the link to activate your account.</p>
                <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit">    
                            <a class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300">Resend email</a>
                        </button>
                    </form>  
                    @if(Auth::check())
                        <a href="{{ route('logout') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-red-700 bg-white rounded-lg">
                        Return to site
                        @include('components.icons.arrow') 
                        </a>
                    @endif  
                </div>
            </div>
    </div>
</body>
</html>

