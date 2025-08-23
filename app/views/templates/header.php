<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title><?php echo $data['title']; ?></title>
</head>

<body class="overflow-x-hidden">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Logo / Title -->
                <div class="flex-shrink-0 flex items-center space-x-2">
                    <img src="/public/images/logo.png" alt="Lost & Found" class="h-8 w-8">
                    <span class="text-xl font-bold text-gray-800">Lost & Found</span>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex md:text-xl space-x-6">
                    <a href="/lostnfound/public" class="text-gray-700 hover:text-sky-700 transition">Home</a>
                    <a href="/items" class="text-gray-700 hover:text-sky-700 transition">Items</a>
                    <a href="/report" class="text-gray-700 hover:text-sky-700 transition">Report</a>
                    <a href="/about" class="text-gray-700 hover:text-sky-700 transition">About</a>
                </nav>

                <!-- Right Side: User/Login -->
                <div class="hidden md:flex items-center space-x-4">
                    <?php if (isset($_SESSION['user'])): ?>
                        <span class="text-gray-700">Hello, <?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                        <a href="/logout" class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600 transition">Logout</a>
                    <?php else: ?>
                        <a href="/login" class="px-4 py-2 text-lg rounded bg-blue-600 text-white hover:bg-sky-500 transition">Login</a>
                    <?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobileMenuBtn" class="text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
                        <!-- Hamburger icon -->
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div id="mobileMenu" class="md:hidden hidden px-4 pb-4 space-y-2 bg-white border-t">
            <a href="/" class="block text-gray-700 hover:text-blue-600 transition">Home</a>
            <a href="/items" class="block text-gray-700 hover:text-blue-600 transition">Items</a>
            <a href="/report" class="block text-gray-700 hover:text-blue-600 transition">Report</a>
            <a href="/about" class="block text-gray-700 hover:text-blue-600 transition">About</a>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="/logout" class="block text-red-500">Logout</a>
            <?php else: ?>
                <a href="/login" class="block text-blue-600">Login</a>
            <?php endif; ?>
        </div>
    </header>

    <script>
        // mobile menu
        document.getElementById('mobileMenuBtn').addEventListener('click', () => {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    </script>