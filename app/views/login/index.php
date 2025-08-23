<style>
    body {
        height: 100vh;
        background-color: white;
    }

    /* costum css for button */
    .cta-button {
        padding: 10px 20px;
        background: #f8f9ff;
        border: 2px solid transparent;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        text-decoration: none;
        color: #2f3640;
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
    }

    .cta-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
        transition: left 0.5s;
    }

    .cta-button:hover::before {
        left: 100%;
    }

    .cta-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        text-decoration: none;
    }

    .cta-button.back {
        border-color: #5AC8FA;
        color: #5AC8FA;
    }

    .cta-button.back:hover {
        background: #5AC8FA;
        color: white;
    }
</style>

<body class="flex flex-col items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-sm mx-auto">
        <div class="text-left">
            <a href="#" class="cta-button back">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 320 512" class="mr-2 h-4 w-2 text-current" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"></path>
                </svg>
                <p class="font-medium relative z-10">Back to the website</p>
            </a>
        </div>


        <div class="bg-white p-6 rounded-lg">
            <h1 class="text-3xl font-bold text-zinc-950 dark:text mb-2">Masuk</h1>
            <p class="text-sm text-zinc-950 dark:text-zinc-400 mb-6">Masukan email dan kata sandi untuk masuk!</p>

            <form action="#" method="post" class="mb-4">
                <input type="hidden" name="provider" value="google">
                <button type="submit" class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-zinc-950 bg-gray-100 rounded-md transition-colors hover:bg-gray-200">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" x="0px" y="0px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" class="h-5 w-5 mr-2" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                    </svg>
                    Masuk dengan Google
                </button>
            </form>

            <div class="flex items-center my-4">
                <div class="flex-grow border-t border-zinc-200 dark:border-zinc-700"></div>
                <span class="mx-4 text-zinc-400 text-sm">or</span>
                <div class="flex-grow border-t border-zinc-200 dark:border-zinc-700"></div>
            </div>

            <form action="#" method="post" novalidate>
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-zinc-950">Email</label>
                        <input id="email" name="email" placeholder="name@example.com" type="email" autocomplete="email" class="mt-1 block w-full px-4 py-3 text-sm rounded-md border border-zinc-200 bg-white text-zinc-950 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-zinc-950">Password</label>
                        <input id="password" name="password" placeholder="Password" type="password" autocomplete="current-password" class="mt-1 block w-full px-4 py-3 text-sm rounded-md border border-zinc-200 bg-white text-zinc-950 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <button type="submit" class="w-full py-3 px-4 text-sm font-medium text-white bg-blue-600 rounded-md transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Masuk
                    </button>

                </div>
            </form>

            <div class="mt-4 text-sm space-y-2">
                <p><a href="/forgot_password" class="font-medium text-zinc-950 dark hover:underline">Lupa password?</a></p>
            </div>
        </div>
    </div>
</body>