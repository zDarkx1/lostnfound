<main class="h-full w-full">

    <!-- ✅ Hero Banner -->
    <div class="h-screen w-screen flex flex-col items-center p-6">
        <div class="h-3/4 w-full md:w-6/7 bg-neutral-50 mt-12 rounded-2xl md:flex gap-2 shadow-md">

            <!-- Left text block -->
            <div class="h-1/2 md:h-full md:w-1/2 flex flex-col justify-between">
                <div class="p-6">
                    <h1 class="text-2xl md:text-3xl font-bold text-zinc-900 mb-4">
                        Find what you lost. Return what you found.
                    </h1>
                    <p class="text-lg md7:text-xl text-zinc-700">
                        Lost something? Let us help you find it. Found something? Return it to its owner.
                        <strong>LostnFound</strong> is a community-driven platform that connects people who have lost items with those who have found them.
                    </p>
                </div>

                <!-- CTA buttons -->
                <div class="p-6 flex gap-4">
                    <a href="/items/search"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Start Searching
                    </a>
                    <a href="/report"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                        Report Item
                    </a>
                </div>
            </div>

            <!-- Right image block -->
            <div class="h-1/2 md:h-full md:w-1/2 p-6">
                <!-- TODO: Replace with real hero/banner image -->
                <img src="https://placehold.co/600x400"
                    alt="Hero banner"
                    class="rounded-lg h-full w-full object-cover">
            </div>
        </div>
    </div>

    <section class="h-full w-full bg-zinc-50">

    </section>
    <!-- ✅ Quick Search -->
    <div class="border-t border-neutral-300 h-[50dvh] w-screen bg-zinc-50 p-6">
        <div class="h-full w-full md:w-6/7 bg-white shadow-md rounded-lg mb-8 mx-auto my-6 pt-2 px-8 relative">
            <h2 class="text-5xl m-6 font-bold">Quick Search</h2>

            <!-- Searchbar -->
            <div class="flex items-center">
                <input type="text"
                    placeholder="Search for lost or found items..."
                    class="flex-1 p-5 border border-gray-300 rounded-s-lg text-xl
                              focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 transition">
                <button class="px-6 py-[1.35rem] bg-blue-500 font-semibold text-white rounded-e-lg text-lg hover:bg-sky-700 transition">
                    Search
                </button>
            </div>

            <!-- Quick tags -->
            <h3 class="text-xl font-semibold mt-3">Quick Tags</h3>
            <div class="flex flex-wrap gap-2 mt-3">

                <button class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Wallet</button>
                <button class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Phone</button>
                <button class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Keys</button>
                <button class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Pets</button>
                <button class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Documents</button>
            </div>
        </div>

        <!-- How it Works section -->
        <div class="p-6 bg-white w-full md:w-6/7 mx-auto mt-8 rounded-lg shadow-md flex flex-col md:flex-row gap-6">
            <div class="flex-1">
                <h3 class="text-4xl font-semibold mb-2">How it works</h3>
                <ol class="list-decimal list-inside text-gray-700 text-lg space-y-1">
                    <li>Describe your item clearly</li>
                    <li>Pin last seen location</li>
                    <li>Upload photos for verification</li>
                    <li>Submit and track responses</li>
                </ol>
                <a href="/report" class="text-blue-600 mt-2 inline-block">Takes 2–3 minutes →</a>
            </div>

            <!-- Map placeholder -->
            <div class="flex-1">
                <!-- TODO: Replace with embedded Google Maps -->
                <img src="https://placehold.co/400x300?text=Map"
                    class="w-full h-full rounded-lg object-cover">
            </div>
        </div>

        <!-- Browse Recent Reports -->
        <div class="p-6 w-full md:w-6/7 mx-auto mt-8 bg-white rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl md:text-3xl font-bold">Browse recent reports</h3>
                <a href="/items" class="text-md text-blue-600 hover:underline ">View all</a>
            </div>

            <!-- Item cards grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <?php if (!empty($data['items'])): ?>
                    <?php foreach ($data['items'] as $item): ?>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-2xl hover:shadow-sky-500/25 transition">
                            <img src="https://placehold.co/400x200" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h4 class="font-bold tracking-wider text-xl mb-2"><?= htmlspecialchars($item['title']) ?></h4>
                                <p class="text-md text-gray-600"> <i class="fas fa-map-marker-alt mr-1 mb-2"></i><?= htmlspecialchars($item['location']) ?> - <?= htmlspecialchars($item['date']) ?></p>
                                <p class="text-sm text-gray-500"><i class="fas fa-info ml-[1px] mr-[6px]"></i><?= htmlspecialchars($item['description']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>

    </div>
</main>