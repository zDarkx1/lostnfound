<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Custom background pattern */
        .background-pattern {
            background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23FFFFFF" fill-opacity="0.04"%3E%3Cpath d="M36 34.5L25.5 35.5L24.5 36.5L35 37.5L36 34.5ZM18.5 28.5L13 29.5L12 30.5L17.5 31.5L18.5 28.5ZM4.5 22.5L-1 23.5L-2 24.5L3.5 25.5L4.5 22.5ZM55.5 22.5L50 23.5L49 24.5L54.5 25.5L55.5 22.5ZM40.5 44.5L35 45.5L34 46.5L39.5 47.5L40.5 44.5ZM26.5 50.5L21 51.5L20 52.5L25.5 53.5L26.5 50.5ZM12.5 56.5L7 57.5L6 58.5L11.5 59.5L12.5 56.5ZM48.5 56.5L43 57.5L42 58.5L47.5 59.5L48.5 56.5ZM24 9.5L18.5 10.5L17.5 11.5L23 12.5L24 9.5ZM4 15.5L-1.5 16.5L-2.5 17.5L3 18.5L4 15.5ZM56 15.5L50.5 16.5L49.5 17.5L55 18.5L56 15.5ZM41 9.5L35.5 10.5L34.5 11.5L40 12.5L41 9.5Z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="flex max-w-6xl mx-auto rounded-xl shadow-lg overflow-hidden w-full m-4 lg:m-0">
        <div class="w-full lg:w-1/2 p-8 lg:p-16 bg-white flex flex-col justify-center">
            <a href="#" class="text-gray-400 text-sm mb-8 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to dashboard
            </a>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Sign In</h1>
            <p class="text-gray-500 mb-8">Enter your email and password to sign in!</p>

            <form action="#" method="POST">
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email*</label>
                    <input type="email" id="email" name="email" class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password*</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                        <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="flex items-center justify-between mb-6 text-sm">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                        <label for="remember-me" class="ml-2 block text-gray-900">Keep me logged in</label>
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white rounded-lg py-3 font-semibold text-lg hover:bg-blue-700 transition-colors duration-200 shadow-md">
                    Sign In
                </button>
            </form>
            <p class="mt-6 text-center text-sm text-gray-500">
                Don't have an account?
                <a href="#" class="font-semibold text-blue-600 hover:text-blue-500">Sign Up</a>
            </p>
        </div>

        <div class="hidden lg:flex w-1/2 relative p-16 bg-blue-900 background-pattern flex-col justify-center items-center">
            <div class="text-white text-center">
                <div class="flex items-center justify-center mb-4">
                    <svg class="w-12 h-12 mr-2" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="10" height="40" rx="5" fill="currentColor" />
                        <rect x="17" y="24" width="10" height="20" rx="5" fill="currentColor" />
                        <rect x="34" y="10" width="10" height="34" rx="5" fill="currentColor" />
                    </svg>
                    <h2 class="text-4xl font-bold">LostnFound</h2>
                </div>
            </div>
        </div>
    </div>
</body>

</html>