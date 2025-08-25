<?php
require_once 'config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$error = '';
$success = '';

// Get categories
$stmt = $pdo->query("SELECT * FROM categories ORDER BY name");
$categories = $stmt->fetchAll();

// Get latest reports for sidebar
$stmt = $pdo->prepare("
    SELECT l.*, c.name as category_name 
    FROM listings l 
    JOIN categories c ON l.category_id = c.id 
    WHERE l.status != 'returned'
    ORDER BY l.created_at DESC 
    LIMIT 5
");
$stmt->execute();
$latest_reports = $stmt->fetchAll();

if ($_POST) {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $category_id = $_POST['category_id'] ?? '';
    $location = trim($_POST['location'] ?? '');
    $date_lost_found = $_POST['date_lost_found'] ?? '';
    $status = $_POST['status'] ?? 'lost';
    $contact_name = trim($_POST['contact_name'] ?? '');
    $contact_email = trim($_POST['contact_email'] ?? '');
    $contact_phone = trim($_POST['contact_phone'] ?? '');
    
    // Validation
    if (empty($title) || empty($description) || empty($category_id) || empty($location) || empty($date_lost_found)) {
        $error = 'Please fill all required fields.';
    } else {
        $image_path = null;
        
        // Handle file upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
            $max_size = 2 * 1024 * 1024; // 2MB
            
            if (!in_array($_FILES['image']['type'], $allowed_types)) {
                $error = 'Only JPG and PNG images are allowed.';
            } elseif ($_FILES['image']['size'] > $max_size) {
                $error = 'Image size must be less than 2MB.';
            } else {
                // Create uploads directory if it doesn't exist
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }
                
                $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $file_extension;
                $image_path = 'uploads/' . $filename;
                
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                    $error = 'Failed to upload image.';
                    $image_path = null;
                }
            }
        }
        
        if (empty($error)) {
            try {
                $stmt = $pdo->prepare("INSERT INTO listings (user_id, category_id, title, description, location, date_lost_found, status, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                
                if ($stmt->execute([$_SESSION['user_id'], $category_id, $title, $description, $location, $date_lost_found, $status, $image_path])) {
                    $success = 'Report submitted successfully! Your item has been posted.';
                    
                    // Log the action
                    $listing_id = $pdo->lastInsertId();
                    $stmt = $pdo->prepare("INSERT INTO audit_logs (user_id, action, table_name, record_id) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$_SESSION['user_id'], 'create_listing', 'listings', $listing_id]);
                } else {
                    $error = 'Failed to submit report. Please try again.';
                }
            } catch (Exception $e) {
                $error = 'Database error occurred. Please try again.';
            }
        }
    }
}

include 'partials/navbar.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report an Item - Lost & Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .image-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .drop-zone {
            transition: all 0.3s ease;
        }
        .drop-zone:hover {
            border-color: #8B5CF6;
            background-color: rgba(139, 92, 246, 0.05);
        }
        .drop-zone.dragover {
            border-color: #8B5CF6;
            background-color: rgba(139, 92, 246, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-purple-600 via-blue-600 to-purple-800 text-white py-16">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="mb-6">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-plus text-3xl text-white"></i>
                </div>
            </div>
            <h1 class="text-3xl lg:text-5xl font-bold mb-4">Report an Item</h1>
            <p class="text-xl text-gray-100 max-w-2xl mx-auto">
                Help us reunite lost items with their owners by providing detailed information about what you've lost or found
            </p>
        </div>
    </section>

    <div class="min-h-screen py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Main Form -->
                <div class="lg:col-span-2">
                    <div class="card p-8">
                        <?php if ($error): ?>
                            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($success): ?>
                            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <?php echo htmlspecialchars($success); ?>
                                </div>
                                <div class="mt-2">
                                    <a href="index.php" class="font-medium text-green-800 hover:text-green-900">
                                        <i class="fas fa-arrow-left mr-1"></i>Return to homepage
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form method="POST" enctype="multipart/form-data" class="space-y-6" id="reportForm">
                            <!-- Item Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Item Status *</label>
                                <div class="flex space-x-4">
                                    <div class="flex items-center">
                                        <input id="lost" name="status" type="radio" value="lost" 
                                               <?php echo (!isset($_POST['status']) || $_POST['status'] == 'lost') ? 'checked' : ''; ?>
                                               class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300">
                                        <label for="lost" class="ml-2 text-sm text-gray-900 flex items-center">
                                            <i class="fas fa-exclamation-circle text-red-500 mr-1"></i>Lost
                                        </label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="found" name="status" type="radio" value="found" 
                                               <?php echo (isset($_POST['status']) && $_POST['status'] == 'found') ? 'checked' : ''; ?>
                                               class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                                        <label for="found" class="ml-2 text-sm text-gray-900 flex items-center">
                                            <i class="fas fa-check-circle text-green-500 mr-1"></i>Found
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Two Column Layout -->
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                
                                <!-- Left Column - Form Fields -->
                                <div class="space-y-6">
                                    <!-- Item Name -->
                                    <div>
                                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-tag mr-1"></i>Item Name *
                                        </label>
                                        <input id="title" name="title" type="text" required 
                                               class="form-input" placeholder="e.g., iPhone 14 Pro, Blue Backpack, etc."
                                               value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>">
                                    </div>

                                    <!-- Category and Date -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-list mr-1"></i>Category *
                                            </label>
                                            <select id="category_id" name="category_id" required class="form-select">
                                                <option value="">Select category</option>
                                                <?php foreach ($categories as $category): ?>
                                                    <option value="<?php echo $category['id']; ?>" 
                                                            <?php echo (isset($_POST['category_id']) && $_POST['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($category['name']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div>
                                            <label for="date_lost_found" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-calendar-alt mr-1"></i>Date *
                                            </label>
                                            <input id="date_lost_found" name="date_lost_found" type="date" required 
                                                   class="form-input" 
                                                   value="<?php echo htmlspecialchars($_POST['date_lost_found'] ?? ''); ?>">
                                        </div>
                                    </div>

                                    <!-- Location -->
                                    <div>
                                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-map-marker-alt mr-1"></i>Location *
                                        </label>
                                        <input id="location" name="location" type="text" required 
                                               class="form-input" placeholder="Where was it lost/found?"
                                               value="<?php echo htmlspecialchars($_POST['location'] ?? ''); ?>">
                                    </div>

                                    <!-- Description -->
                                    <div>
                                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-align-left mr-1"></i>Description *
                                        </label>
                                        <textarea id="description" name="description" rows="4" required 
                                                  class="form-textarea" 
                                                  placeholder="Provide a detailed description including color, brand, size, distinctive features, etc."><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                                    </div>
                                </div>

                                <!-- Right Column - Image Upload -->
                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            <i class="fas fa-camera mr-1"></i>Upload Images
                                        </label>
                                        <div class="drop-zone mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors" id="dropZone">
                                            <div class="space-y-1 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-purple-500">
                                                        <span>Upload a file</span>
                                                        <input id="image" name="image" type="file" class="sr-only" accept="image/jpeg,image/jpg,image/png" onchange="previewImage(event)">
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                                            </div>
                                        </div>
                                        
                                        <!-- Image Preview -->
                                        <div id="imagePreview" class="mt-4 hidden">
                                            <div class="text-sm font-medium text-gray-700 mb-2">Preview:</div>
                                            <div class="relative inline-block">
                                                <img id="previewImg" class="image-preview" src="" alt="Preview">
                                                <button type="button" onclick="removeImage()" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 transition-colors">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Contact Information -->
                                    <div class="border-t pt-6">
                                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                                            <i class="fas fa-user mr-2"></i>Your Contact Information
                                        </h3>
                                        <div class="space-y-4">
                                            <div>
                                                <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-2">Your Name *</label>
                                                <input id="contact_name" name="contact_name" type="text" required 
                                                       class="form-input" placeholder="Full name"
                                                       value="<?php echo htmlspecialchars($_POST['contact_name'] ?? $_SESSION['user_name'] ?? ''); ?>">
                                            </div>
                                            <div>
                                                <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email *</label>
                                                <input id="contact_email" name="contact_email" type="email" required 
                                                       class="form-input" placeholder="your@email.com"
                                                       value="<?php echo htmlspecialchars($_POST['contact_email'] ?? $_SESSION['user_email'] ?? ''); ?>">
                                            </div>
                                            <div>
                                                <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number (Optional)</label>
                                                <input id="contact_phone" name="contact_phone" type="tel" 
                                                       class="form-input" placeholder="+62 812-3456-7890"
                                                       value="<?php echo htmlspecialchars($_POST['contact_phone'] ?? ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Terms -->
                            <div class="flex items-center pt-6 border-t">
                                <input id="terms" name="terms" type="checkbox" required 
                                       class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                <label for="terms" class="ml-2 block text-sm text-gray-900">
                                    I agree to the <a href="#" class="text-purple-600 hover:text-purple-500">Terms of Service</a> 
                                    and <a href="#" class="text-purple-600 hover:text-purple-500">Privacy Policy</a>. 
                                    I understand that my contact information will be shared with potential claimants.
                                </label>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-6">
                                <button type="submit" class="btn-primary flex-1 py-3 transform hover:scale-105 transition-all duration-300">
                                    <i class="fas fa-paper-plane mr-2"></i>Submit Report
                                </button>
                                <button type="button" class="btn-secondary flex-1 py-3" onclick="saveDraft()">
                                    <i class="fas fa-save mr-2"></i>Save as Draft
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Tips Section -->
                    <div class="card p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>Helpful Tips
                        </h3>
                        <div class="space-y-3 text-sm text-gray-600">
                            <div class="flex items-start">
                                <i class="fas fa-camera text-purple-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Use clear, well-lit photos from multiple angles</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-red-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Be specific about the location where the item was lost/found</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-info-circle text-blue-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Include distinctive features, brands, or serial numbers</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-clock text-green-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Post as soon as possible for better chances of recovery</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-shield-alt text-indigo-500 mr-2 mt-1 flex-shrink-0"></i>
                                <span>Meet in safe, public locations for item exchanges</span>
                            </div>
                        </div>
                    </div>

                    <!-- Latest Reports -->
                    <div class="card p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-clock text-blue-500 mr-2"></i>Latest Reports
                        </h3>
                        <?php if (count($latest_reports) > 0): ?>
                            <div class="space-y-3">
                                <?php foreach ($latest_reports as $report): ?>
                                    <div class="border-l-4 <?php echo $report['status'] == 'lost' ? 'border-red-400' : 'border-green-400'; ?> pl-3 py-2">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-xs font-medium <?php echo $report['status'] == 'lost' ? 'text-red-600' : 'text-green-600'; ?>">
                                                <i class="fas <?php echo $report['status'] == 'lost' ? 'fa-exclamation-circle' : 'fa-check-circle'; ?> mr-1"></i>
                                                <?php echo ucfirst($report['status']); ?>
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                <?php echo date('M j', strtotime($report['created_at'])); ?>
                                            </span>
                                        </div>
                                        <h4 class="text-sm font-medium text-gray-900 mb-1">
                                            <?php echo htmlspecialchars(substr($report['title'], 0, 30)) . (strlen($report['title']) > 30 ? '...' : ''); ?>
                                        </h4>
                                        <p class="text-xs text-gray-600">
                                            <i class="fas fa-map-marker-alt mr-1"></i>
                                            <?php echo htmlspecialchars(substr($report['location'], 0, 25)) . (strlen($report['location']) > 25 ? '...' : ''); ?>
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="mt-4">
                                <a href="cari.php" class="text-sm text-purple-600 hover:text-purple-700">
                                    View all reports <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        <?php else: ?>
                            <p class="text-sm text-gray-500">No reports yet. Be the first!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Image preview functionality
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    function removeImage() {
        document.getElementById('image').value = '';
        document.getElementById('imagePreview').classList.add('hidden');
        document.getElementById('previewImg').src = '';
    }

    // Drag and drop functionality
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('image');

    dropZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', function(e) {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            previewImage({ target: { files: files } });
        }
    });

    // Save draft functionality
    function saveDraft() {
        const formData = new FormData(document.getElementById('reportForm'));
        localStorage.setItem('reportDraft', JSON.stringify(Object.fromEntries(formData)));
        
        // Show notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
        notification.innerHTML = '<i class="fas fa-save mr-2"></i>Draft saved successfully!';
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Load draft on page load
    window.addEventListener('load', function() {
        const draft = localStorage.getItem('reportDraft');
        if (draft && confirm('Would you like to restore your saved draft?')) {
            const draftData = JSON.parse(draft);
            Object.keys(draftData).forEach(key => {
                const element = document.querySelector(`[name="${key}"]`);
                if (element && element.type !== 'file') {
                    if (element.type === 'radio' || element.type === 'checkbox') {
                        element.checked = element.value === draftData[key] || draftData[key] === 'on';
                    } else {
                        element.value = draftData[key];
                    }
                }
            });
        }
    });

    // Form validation
    document.getElementById('reportForm').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Please fill in all required fields.');
        }
    });
    </script>

    <?php include 'partials/footer.php'; ?>
</body>
</html>