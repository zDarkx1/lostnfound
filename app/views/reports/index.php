<main class="p-6  min-h-screen">
    <section>

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl md:text-4xl font-semibold text-sky-950 mb-2">Reports & Items</h1>
                <p class="text-lg text-sky-900">Manage lost and found items in your area</p>
            </div>
            <button class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow flex items-center space-x-2">
                <span>+ New Report</span>
            </button>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow p-4 grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <!-- Search -->
            <div class="flex items-center border rounded-lg px-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.414l4.387 4.387a1 1 0 01-1.414 1.414l-4.387-4.387zM8 14a6 6 0 100-12 6 6 0 000 12z" clip-rule="evenodd" />
                </svg>
                <input type="text" placeholder="Search items..." class="flex-1 outline-none px-2 py-2 text-sm" name="search" />
            </div>

            <!-- Category -->
            <select class="w-full border rounded-lg px-3 py-2 text-sm">
                <option>All Categories</option>
                <option>Electronics</option>
                <option>Clothing</option>
                <option>Documents</option>
            </select>

            <!-- Status -->
            <select class="w-full border rounded-lg px-3 py-2 text-sm">
                <option>All Status</option>
                <option>Lost</option>
                <option>Found</option>
                <option>Reunited</option>
            </select>

            <!-- Date Range -->
            <div class="flex items-center border rounded-lg px-3">
                <input type="date" class="flex-1 outline-none py-2 text-sm" />
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl shadow p-4 flex flex-col">
                <p class="text-lg text-gray-500">Total Reports</p>
                <p class="text-2xl font-bold text-blue-700">1,247</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 flex flex-col">
                <p class="text-lg text-gray-500">Lost Items</p>
                <p class="text-2xl font-bold text-red-500">832</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 flex flex-col">
                <p class="text-lg text-gray-500">Found Items</p>
                <p class="text-2xl font-bold text-green-500">415</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4 flex flex-col">
                <p class="text-lg text-gray-500">Reunited</p>
                <p class="text-2xl font-bold text-purple-500">298</p>
            </div>
        </div>
    </section>
    <section>
        <h1 class="text-3xl font-bold my-4">Browse Reports</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">

            <?php foreach ($data['items'] as $reports): ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-2xl hover:shadow-sky-500/25 transition">
                    <img src="https://placehold.co/400x200" class="w-full h-40 object-cover">
                    <div class="p-3">
                        <h4 class="font-bold tracking-wider text-xl mb-2"><?= htmlspecialchars($reports['title']) ?></h4>
                        <p class="text-md text-gray-600"> <i class="fas fa-map-marker-alt mr-1 mb-2"></i><?= htmlspecialchars($reports['location']) ?> - <?= htmlspecialchars($reports['date']) ?></p>
                        <p class="text-sm text-gray-500"><i class="fas fa-info ml-[1px] mr-[6px]"></i><?= htmlspecialchars($reports['description']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        </div>
    </section>
</main>