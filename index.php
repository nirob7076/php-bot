<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickHost - Deploy in Seconds</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; background-color: #000; color: #fff; } </style>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="border-b border-gray-800 p-6 flex justify-between items-center">
        <div class="text-2xl font-bold tracking-wider">▲ QuickHost</div>
        <div>
            <a href="#" class="text-gray-400 hover:text-white mx-4 transition">Features</a>
            <a href="#" class="text-gray-400 hover:text-white mx-4 transition">Documentation</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center p-6">
        <div class="max-w-2xl w-full bg-gray-900 border border-gray-800 rounded-2xl p-10 shadow-2xl">
            <h1 class="text-4xl font-bold mb-4 text-center">Deploy your project instantly</h1>
            <p class="text-gray-400 text-center mb-10">ইউজারনেম দিন এবং আপনার ২টি ফাইল (যেমন: HTML ও CSS) আপলোড করুন। আপনার সাইট ২৪ ঘণ্টার জন্য লাইভ থাকবে এবং এরপর স্বয়ংক্রিয়ভাবে মুছে যাবে।</p>

            <form action="upload.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <!-- Username Field -->
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-300">আপনার প্রজেক্ট / ইউজারনেম</label>
                    <input type="text" name="username" required placeholder="e.g. rahim_project" class="w-full px-4 py-3 bg-black border border-gray-700 rounded-lg focus:outline-none focus:border-white text-white placeholder-gray-600 transition">
                </div>

                <!-- File 1 (HTML/PHP) -->
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-300">প্রথম ফাইল (index.html বা index.php)</label>
                    <input type="file" name="file1" required class="w-full px-4 py-2 bg-black border border-gray-700 rounded-lg text-gray-400 focus:outline-none cursor-pointer">
                </div>

                <!-- File 2 (CSS/JS) -->
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-300">দ্বিতীয় ফাইল (style.css বা script.js)</label>
                    <input type="file" name="file2" required class="w-full px-4 py-2 bg-black border border-gray-700 rounded-lg text-gray-400 focus:outline-none cursor-pointer">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-white text-black font-bold py-3 rounded-lg hover:bg-gray-200 transition duration-300 mt-4">
                    Deploy to QuickHost 🚀
                </button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-800 text-center p-6 text-gray-500 text-sm">
        &copy; 2026 QuickHost Ltd. Powered by PHP & SQLite.
    </footer>

</body>
</html>
