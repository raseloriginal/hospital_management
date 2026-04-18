<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Setup Database - Hospital Management System</title>
  <!-- Load Tailwind CSS from CDN because local paths might be broken before setup -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f0fdf4; /* Background green-50 */
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen">

  <div class="w-full max-w-lg bg-white rounded-xl shadow-xl overflow-hidden border border-green-100">
    <div class="bg-gradient-to-r from-emerald-600 to-green-500 py-6 px-8 text-center">
      <h1 class="text-3xl font-bold text-white mb-2">System Setup</h1>
      <p class="text-emerald-50 opacity-90 text-sm">Configure your database to get started</p>
    </div>

    <div class="px-8 py-8">
      <?php if(!empty($data['error'])) : ?>
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-md">
          <div class="flex items-center">
            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            <p class="font-medium text-sm"><?php echo $data['error']; ?></p>
          </div>
        </div>
      <?php endif; ?>

      <form action="<?php echo $data['app_url']; ?>/install/process" method="POST" class="space-y-5">
        
        <!-- App URL -->
        <div>
          <label for="app_url" class="block text-sm font-medium text-gray-700 mb-1">Application URL</label>
          <input type="text" name="app_url" id="app_url" value="<?php echo htmlspecialchars($data['app_url']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors" required>
          <p class="text-xs text-gray-500 mt-1">The base URL where the application is accessed.</p>
        </div>

        <hr class="border-gray-200">

        <!-- DB Host -->
        <div>
          <label for="db_host" class="block text-sm font-medium text-gray-700 mb-1">Database Host</label>
          <input type="text" name="db_host" id="db_host" value="<?php echo htmlspecialchars($data['db_host']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors" required>
        </div>

        <!-- DB Name -->
        <div>
          <label for="db_name" class="block text-sm font-medium text-gray-700 mb-1">Database Name</label>
          <input type="text" name="db_name" id="db_name" value="<?php echo htmlspecialchars($data['db_name']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors" required>
          <p class="text-xs text-gray-500 mt-1">If it doesn't exist, the system will attempt to create it.</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
          <!-- DB User -->
          <div>
            <label for="db_user" class="block text-sm font-medium text-gray-700 mb-1">Database User</label>
            <input type="text" name="db_user" id="db_user" value="<?php echo htmlspecialchars($data['db_user']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors" required>
          </div>

          <!-- DB Pass -->
          <div>
            <label for="db_pass" class="block text-sm font-medium text-gray-700 mb-1">Database Password</label>
            <input type="password" name="db_pass" id="db_pass" value="<?php echo htmlspecialchars($data['db_pass']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
          </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
          <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors">
            Install & Setup Database
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </form>
      
      <div class="mt-6 text-center text-sm text-gray-500">
        <p>Default admin login after setup:</p>
        <p class="font-medium text-gray-700 mt-1">admin@healthcare.com / admin123</p>
      </div>

    </div>
  </div>

</body>
</html>
