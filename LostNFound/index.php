<?php
require_once 'config/db.php';
include 'partials/navbar.php';

// Get latest listings
$stmt = $pdo->prepare("
    SELECT l.*, c.name as category_name, u.name as user_name 
    FROM listings l 
    JOIN categories c ON l.category_id = c.id 
    JOIN users u ON l.user_id = u.id 
    WHERE l.status != 'returned'
    ORDER BY l.created_at DESC 
    LIMIT 8
");
$stmt->execute();
$latest_items = $stmt->fetchAll();

// Get statistics
$stmt = $pdo->query("SELECT COUNT(*) as total_items FROM listings");
$total_items = $stmt->fetch()['total_items'];

$stmt = $pdo->query("SELECT COUNT(*) as returned_items FROM listings WHERE status = 'returned'");
$returned_items = $stmt->fetch()['returned_items'];

$stmt = $pdo->query("SELECT COUNT(*) as total_users FROM users");
$total_users = $stmt->fetch()['total_users'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lost & Found - Reuniting People with Their Belongings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse-slow {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Enhanced Hero Section -->
    <section class="relative bg-gradient-to-br from-purple-600 via-blue-600 to-purple-800 text-white overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-10 -right-10 w-80 h-80 bg-white/5 rounded-full animate-pulse-slow"></div>
            <div class="absolute top-1/2 -left-20 w-60 h-60 bg-white/5 rounded-full animate-float"></div>
            <div class="absolute bottom-10 right-1/4 w-40 h-40 bg-white/5 rounded-full animate-pulse-slow"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left animate-fadeInUp">
                    <h1 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight">
                        Reunite with Your
                        <span class="text-gradient bg-gradient-to-r from-yellow-400 to-pink-400 bg-clip-text text-transparent">
                            Lost Belongings
                        </span>
                    </h1>
                    <p class="text-xl lg:text-2xl mb-8 text-gray-100 leading-relaxed">
                        Join thousands of people using our platform to find lost items and help others reunite with their belongings.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="laporan.php" class="btn-primary text-lg px-8 py-4 transform hover:scale-105 transition-all duration-300">
                                <i class="fas fa-plus mr-2"></i>Report Lost Item
                            </a>
                        <?php else: ?>
                            <a href="register.php" class="btn-primary text-lg px-8 py-4 transform hover:scale-105 transition-all duration-300">
                                <i class="fas fa-rocket mr-2"></i>Get Started Free
                            </a>
                        <?php endif; ?>
                        <a href="cari.php" class="btn-secondary text-lg px-8 py-4 bg-white/20 border-white/30 text-white hover:bg-white/30 transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-search mr-2"></i>Browse Items
                        </a>
                    </div>
                </div>
                <div class="relative animate-fadeInUp">
                    <div class="animate-float">
                        <div class="w-full h-96 bg-white/10 rounded-2xl backdrop-blur-sm border border-white/20 p-8 flex items-center justify-center shadow-2xl">
                            <div class="text-center">
                                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse-slow">
                                    <i class="fas fa-search text-4xl text-white"></i>
                                </div>
                                <h3 class="text-2xl font-semibold mb-2">Find Your Items</h3>
                                <p class="text-gray-200">Search through thousands of found items</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Stats Section -->
        <div class="relative bg-white/10 backdrop-blur-sm border-t border-white/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                    <div class="transform hover:scale-105 transition-all duration-300">
                        <div class="text-3xl lg:text-4xl font-bold mb-2"><?php echo number_format($total_items); ?>+</div>
                        <div class="text-gray-200">Items Reported</div>
                    </div>
                    <div class="transform hover:scale-105 transition-all duration-300">
                        <div class="text-3xl lg:text-4xl font-bold mb-2"><?php echo number_format($returned_items); ?>+</div>
                        <div class="text-gray-200">Successfully Returned</div>
                    </div>
                    <div class="transform hover:scale-105 transition-all duration-300">
                        <div class="text-3xl lg:text-4xl font-bold mb-2"><?php echo number_format($total_users); ?>+</div>
                        <div class="text-gray-200">Community Members</div>
                    </div>
                    <div class="transform hover:scale-105 transition-all duration-300">
                        <div class="text-3xl lg:text-4xl font-bold mb-2">24/7</div>
                        <div class="text-gray-200">Always Available</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-4">Browse by Category</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Find items quickly by browsing through our organized categories
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                <a href="cari.php?category_id=1" class="group bg-gradient-to-br from-blue-50 to-purple-50 p-6 rounded-xl border border-gray-200 hover:border-purple-300 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-mobile-alt text-2xl text-white"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Electronics</h3>
                        <p class="text-sm text-gray-600">Phones, laptops, tablets</p>
                    </div>
                </a>

                <a href="cari.php?category_id=2" class="group bg-gradient-to-br from-green-50 to-teal-50 p-6 rounded-xl border border-gray-200 hover:border-green-300 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-file-alt text-2xl text-white"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Documents</h3>
                        <p class="text-sm text-gray-600">IDs, passports, cards</p>
                    </div>
                </a>

                <a href="cari.php?category_id=3" class="group bg-gradient-to-br from-yellow-50 to-orange-50 p-6 rounded-xl border border-gray-200 hover:border-yellow-300 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-tshirt text-2xl text-white"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Clothing</h3>
                        <p class="text-sm text-gray-600">Jackets, bags, accessories</p>
                    </div>
                </a>

                <a href="cari.php?category_id=4" class="group bg-gradient-to-br from-pink-50 to-red-50 p-6 rounded-xl border border-gray-200 hover:border-pink-300 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-red-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-car text-2xl text-white"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Vehicles</h3>
                        <p class="text-sm text-gray-600">Cars, bikes, keys</p>
                    </div>
                </a>

                <a href="cari.php?category_id=5" class="group bg-gradient-to-br from-indigo-50 to-purple-50 p-6 rounded-xl border border-gray-200 hover:border-indigo-300 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-paw text-2xl text-white"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Pets</h3>
                        <p class="text-sm text-gray-600">Dogs, cats, others</p>
                    </div>
                </a>

                <a href="cari.php?category_id=6" class="group bg-gradient-to-br from-gray-50 to-slate-50 p-6 rounded-xl border border-gray-200 hover:border-gray-300 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-gray-500 to-slate-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-gem text-2xl text-white"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Jewelry</h3>
                        <p class="text-sm text-gray-600">Rings, watches, necklaces</p>
                    </div>
                </a>

                <a href="cari.php?category_id=7" class="group bg-gradient-to-br from-emerald-50 to-green-50 p-6 rounded-xl border border-gray-200 hover:border-emerald-300 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-football-ball text-2xl text-white"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Sports</h3>
                        <p class="text-sm text-gray-600">Equipment, gear, balls</p>
                    </div>
                </a>

                <a href="cari.php" class="group bg-gradient-to-br from-violet-50 to-purple-50 p-6 rounded-xl border border-gray-200 hover:border-violet-300 transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-violet-500 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-ellipsis-h text-2xl text-white"></i>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">Others</h3>
                        <p class="text-sm text-gray-600">View all categories</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-20 bg-gradient-to-br from-purple-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-4">How It Works</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Our simple three-step process helps you find lost items or return found items to their rightful owners.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center group">
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-plus text-3xl text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center text-sm font-bold text-gray-800">1</div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Report an Item</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Lost something? Found something? Create a detailed report with photos, description, and location to help others identify your item.
                    </p>
                </div>

                <div class="text-center group">
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-search text-3xl text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center text-sm font-bold text-gray-800">2</div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Search & Browse</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Use our advanced search filters to find items by category, location, date, and keywords. Browse through recent reports from your area.
                    </p>
                </div>

                <div class="text-center group">
                    <div class="relative">
                        <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-handshake text-3xl text-white"></i>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center text-sm font-bold text-gray-800">3</div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Connect & Reunite</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Found a match? Contact the owner or finder directly through our secure messaging system to arrange the return.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Reports Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-4">Recent Reports</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Browse the latest lost and found items reported by our community members.
                </p>
            </div>

            <?php if (count($latest_items) > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    <?php foreach ($latest_items as $item): ?>
                        <div class="card overflow-hidden group hover:-translate-y-2 transition-all duration-300 hover:shadow-xl">
                            <div class="aspect-w-16 aspect-h-12 bg-gray-200 relative">
                                <?php if ($item['image_path']): ?>
                                    <img src="<?php echo htmlspecialchars($item['image_path']); ?>"
                                        alt="<?php echo htmlspecialchars($item['title']); ?>"
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                <?php else: ?>
                                    <div class="w-full h-48 bg-gradient-to-br from-purple-100 to-blue-100 flex items-center justify-center">
                                        <i class="fas fa-image text-4xl text-gray-400"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="absolute top-2 left-2">
                                    <span class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-white/90 backdrop-blur-sm <?php echo $item['status'] == 'lost' ? 'text-red-800' : 'text-green-800'; ?>">
                                        <i class="fas <?php echo $item['status'] == 'lost' ? 'fa-exclamation-circle' : 'fa-check-circle'; ?> mr-1"></i>
                                        <?php echo ucfirst($item['status']); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs text-gray-500">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        <?php echo date('M j', strtotime($item['created_at'])); ?>
                                    </span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                    <?php echo htmlspecialchars($item['title']); ?>
                                </h3>
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                    <?php echo htmlspecialchars(substr($item['description'], 0, 100)) . (strlen($item['description']) > 100 ? '...' : ''); ?>
                                </p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-xs text-gray-500">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        <?php echo htmlspecialchars(substr($item['location'], 0, 20)) . (strlen($item['location']) > 20 ? '...' : ''); ?>
                                    </div>
                                    <a href="detail.php?id=<?php echo $item['id']; ?>" class="text-purple-600 hover:text-purple-700 font-medium text-sm transform hover:scale-105 transition-all duration-200">
                                        Detail <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="text-center">
                    <a href="cari.php" class="btn-primary text-lg px-8 py-3 transform hover:scale-105 transition-all duration-300">
                        <i class="fas fa-eye mr-2"></i>View All Items
                    </a>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-inbox text-4xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Items Yet</h3>
                    <p class="text-gray-600 mb-6">Be the first to report a lost or found item in your community.</p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="laporan.php" class="btn-primary">
                            <i class="fas fa-plus mr-2"></i>Report First Item
                        </a>
                    <?php else: ?>
                        <a href="register.php" class="btn-primary">
                            <i class="fas fa-rocket mr-2"></i>Get Started
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-4">Success Stories</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Real stories from community members who successfully reunited with their belongings
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 italic">
                        "I lost my iPhone at the mall and thought I'd never see it again. Within 2 hours of posting, someone had found it and contacted me. Amazing service!"
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center text-white font-semibold mr-4">
                            SA
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Sarah Ahmed</div>
                            <div class="text-sm text-gray-500">Jakarta</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 italic">
                        "Found a wallet with important documents. Used this platform to track down the owner. The reunion was so heartwarming!"
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-teal-500 rounded-full flex items-center justify-center text-white font-semibold mr-4">
                            MR
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Michael Rodriguez</div>
                            <div class="text-sm text-gray-500">Bandung</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 italic">
                        "My daughter's stuffed animal went missing at the park. Someone posted it here and we got it back the same day. She was so happy!"
                    </p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-red-500 rounded-full flex items-center justify-center text-white font-semibold mr-4">
                            LW
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Lisa Wang</div>
                            <div class="text-sm text-gray-500">Surabaya</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Safety Tips Section -->
    <section class="py-20 bg-gradient-to-br from-purple-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-4">Safety Tips</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Stay safe when meeting to return or collect lost items. Follow these simple guidelines.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-store text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Meet in Public Places</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Always arrange to meet in well-lit, public areas like cafes, malls, or police stations.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-user-friends text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Bring a Friend</h3>
                    <p class="text-gray-600 leading-relaxed">
                        For extra security, bring someone with you when exchanging items with strangers.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Verify Ownership</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Ask for details or proof of ownership before handing over valuable items to ensure safety.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- FAQ Section -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
                <p class="text-xl text-gray-600">
                    Get answers to common questions about using our platform
                </p>
            </div>

            <div class="space-y-6">
                <div class="bg-gray-50 rounded-lg p-6">
                    <button class="w-full text-left flex items-center justify-between" onclick="toggleFAQ(1)">
                        <h3 class="text-lg font-semibold text-gray-900">How do I report a lost or found item?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="mt-4 hidden" id="faq-content-1">
                        <p class="text-gray-600">
                            Simply click on "Buat Laporan" in the navigation menu, fill out the form with detailed information about the item including photos, description, location, and date. The more details you provide, the better chance of reuniting with the item.
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-6">
                    <button class="w-full text-left flex items-center justify-between" onclick="toggleFAQ(2)">
                        <h3 class="text-lg font-semibold text-gray-900">Is my personal information safe?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="mt-4 hidden" id="faq-content-2">
                        <p class="text-gray-600">
                            Yes, we take privacy seriously. Your contact information is only shared when you choose to connect with someone about an item. We use secure methods to protect your data and never share it with third parties.
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-6">
                    <button class="w-full text-left flex items-center justify-between" onclick="toggleFAQ(3)">
                        <h3 class="text-lg font-semibold text-gray-900">How does the matching system work?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="mt-4 hidden" id="faq-content-3">
                        <p class="text-gray-600">
                            Our system allows you to search through all reported items using filters like category, location, date, and keywords. When you find a potential match, you can contact the owner or finder directly through our messaging system.
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-6">
                    <button class="w-full text-left flex items-center justify-between" onclick="toggleFAQ(4)">
                        <h3 class="text-lg font-semibold text-gray-900">Is there a fee to use the service?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="mt-4 hidden" id="faq-content-4">
                        <p class="text-gray-600">
                            No, our service is completely free to use. We believe in helping people reunite with their belongings without any barriers. You can report items, search, and contact others at no cost.
                        </p>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-6">
                    <button class="w-full text-left flex items-center justify-between" onclick="toggleFAQ(5)">
                        <h3 class="text-lg font-semibold text-gray-900">What should I do when I find a match?</h3>
                        <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="faq-icon-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="mt-4 hidden" id="faq-content-5">
                        <p class="text-gray-600">
                            When you find a potential match, use the "Hubungi" button to send a message. Provide proof of ownership if claiming an item, or ask for verification if you found something. Always meet in safe, public locations for exchanges.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function toggleFAQ(id) {
            const content = document.getElementById(`faq-content-${id}`);
            const icon = document.getElementById(`faq-icon-${id}`);

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>

    <?php include 'partials/footer.php'; ?>
</body>

</html>