<main class="max-w-screen mx-auto p-6 flex flex-col items-center">
    <div class="text-center my-10">
        <div class="mx-auto w-12 h-12 bg-blue-100 text-blue-600 flex items-center justify-center rounded-full text-2xl">+</div>
        <h2 class="text-2xl font-semibold mt-4">Report a Lost or Found Item</h2>
        <p class="text-gray-500 mt-2">Help people with their belongings by providing details.</p>
    </div>

    <!-- Toggle -->
    <div class="flex justify-center items-center space-x-4 mb-8">
        <button class="w-40 py-2 border rounded-lg text-blue-600 border-blue-500 bg-blue-50">Lost Item</button>
        <button class="w-40 py-2 border rounded-lg text-green-600 border-green-500 bg-green-50">Found Item</button>
    </div>

    <!-- Form -->
    <form action="submit.php" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-xl p-6 space-y-6 w-8/10">

        <!-- Item Details -->
        <div>
            <h3 class="font-semibold text-lg mb-4 ">Item Details</h3>
            <label class="block text-sm mb-1">Item Title</label>
            <input type="text" name="title" class="w-full border rounded-lg p-2" placeholder="e.g., iPhone 13, Black">

            <label class="block text-sm mt-4 mb-1">Category</label>
            <select name="category" class="w-full border rounded-lg p-2">
                <option>Electronics</option>
                <option>Clothing</option>
                <option>Documents</option>
                <option>Others</option>
            </select>

            <label class="block text-sm mt-4 mb-1">Description</label>
            <textarea name="description" class="w-full border rounded-lg p-2" rows="3"
                placeholder="Provide detailed description..."></textarea>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm mb-1">Date</label>
                    <input type="date" name="date" class="w-full border rounded-lg p-2">
                </div>
                <div>
                    <label class="block text-sm mb-1">Location</label>
                    <input type="text" name="location" class="w-full border rounded-lg p-2" placeholder="Where was it lost/found?">
                </div>
            </div>
        </div>

        <!-- Photos -->
        <div>
            <h3 class="font-semibold text-lg mb-4">Photos</h3>
            <input type="file" name="photos[]" multiple class="w-full border rounded-lg p-2">
            <p class="text-xs text-gray-500 mt-1">Max 5 images.</p>
        </div>

        <!-- Contact Information -->
        <div>
            <h3 class="font-semibold text-lg mb-4">Contact Information</h3>
            <label class="block text-sm mb-1">Full Name</label>
            <input type="text" name="name" class="w-full border rounded-lg p-2">

            <label class="block text-sm mt-4 mb-1">Email Address</label>
            <input type="email" name="email" class="w-full border rounded-lg p-2">

            <label class="block text-sm mt-4 mb-1">Phone Number</label>
            <input type="text" name="phone" class="w-full border rounded-lg p-2">

            <label class="block text-sm mt-4 mb-1">Preferred Contact Method</label>
            <select name="contact_method" class="w-full border rounded-lg p-2">
                <option>Email</option>
                <option>Phone</option>
            </select>
        </div>

        <!-- Submit -->
        <div class="text-center">
            <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-xl shadow hover:bg-green-600">
                ✅ Submit Report
            </button>
        </div>

        <p class="text-xs text-gray-500 text-center">Your report will be reviewed and published within 24 hours.</p>
    </form>
</main>