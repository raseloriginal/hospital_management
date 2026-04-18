<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="min-h-screen flex items-center justify-center bg-slate-100 p-6">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-blue-600 p-8 text-white text-center">
            <div class="inline-block bg-white/20 p-3 rounded-xl mb-4">
                <i class="fas fa-hospital text-3xl"></i>
            </div>
            <h1 class="text-3xl font-bold">HealthCare Pro</h1>
            <p class="text-blue-100 mt-2">Hospital Management System</p>
        </div>
        
        <div class="p-8">
            <?php flash('register_success'); ?>
            
            <form action="<?php echo URLROOT; ?>/users/login" method="post">
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="email" id="email" 
                               class="w-full pl-10 pr-4 py-3 rounded-lg border <?php echo (!empty($data['email_err'])) ? 'border-red-500 bg-red-50' : 'border-slate-200 focus:border-blue-500'; ?> outline-none transition-all"
                               placeholder="admin@healthcare.com" value="<?php echo $data['email']; ?>">
                    </div>
                    <span class="text-xs text-red-500 mt-1"><?php echo $data['email_err']; ?></span>
                </div>

                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-semibold text-slate-700">Password</label>
                        <a href="#" class="text-xs text-blue-600 hover:underline">Forgot password?</a>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password" id="password" 
                               class="w-full pl-10 pr-4 py-3 rounded-lg border <?php echo (!empty($data['password_err'])) ? 'border-red-500 bg-red-50' : 'border-slate-200 focus:border-blue-500'; ?> outline-none transition-all"
                               placeholder="••••••••" value="<?php echo $data['password']; ?>">
                    </div>
                    <span class="text-xs text-red-500 mt-1"><?php echo $data['password_err']; ?></span>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-lg shadow-blue-200 transition-all transform active:scale-[0.98]">
                    Sign In
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-sm text-slate-500">Contact IT Support for access credentials</p>
                <div class="flex justify-center space-x-4 mt-4">
                    <span class="text-xs px-2 py-1 bg-slate-100 rounded text-slate-600">Admin</span>
                    <span class="text-xs px-2 py-1 bg-slate-100 rounded text-slate-600">Doctor</span>
                    <span class="text-xs px-2 py-1 bg-slate-100 rounded text-slate-600">Staff</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
