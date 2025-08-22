<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
</head>

<body class="overflow-x-hidden">
    <header class="h-16 w-full bg-neutral-50 border-b-2 border-neutral-300 items-center pt-3 px-6">
        <nav class="flex items-center justify-between">
            <div class="flex items-center justify-between">
                <a href="/" class="text-2xl font-bold text-zinc-900 md:mt-1">Lost & Found</a>
                <ul class="hidden md:flex md:gap-2 md:mt-2 md:ml-4">
                    <li><a href="#" class="text-xl px-2">Home</a></li>
                    <li><a href="#" class="text-xl px-2">Report</a></li>
                    <li><a href="#" class="text-xl px-2">Lost Item</a></li>
                </ul>
            </div>
            <div>
                <button class="text-xl bg-amber-500 px-4 md:mt-1" href="#"><a href="/login">Login</a></button>
            </div>
        </nav>
    </header>