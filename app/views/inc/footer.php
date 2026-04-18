<?php if(isLoggedIn()) : ?>
            </main>
            <!-- Footer -->
            <footer class="bg-white border-t border-slate-200 py-4 px-8 text-center text-sm text-slate-500">
                <p>&copy; <?php echo date('Y'); ?> <?php echo $sysSettings->hospital_name; ?>. Developed for professional healthcare management.</p>
            </footer>
        </div>
    </div>
<?php else : ?>
    <!-- Guest Footer -->
    <footer class="bg-slate-900 text-white py-20" id="contact">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-2">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="bg-[#217346] p-2 rounded-md">
                        <i class="fas fa-hospital text-white"></i>
                    </div>
                    <span class="text-xl font-black tracking-tight uppercase"><?php echo $sysSettings->hospital_name; ?></span>
                </div>
                <p class="text-slate-400 text-sm leading-relaxed mb-6 max-w-md">
                    Providing world-class medical services with a commitment to excellence and compassionate care. Our state-of-the-art facility is equipped with the latest technology to ensure the best outcomes for our patients.
                </p>
                <div class="flex space-x-4">
                    <a href="<?php echo $sysSettings->facebook_url; ?>" class="w-10 h-10 rounded-full border border-slate-700 flex items-center justify-center hover:bg-[#217346] hover:border-[#217346] transition-all"><i class="fab fa-facebook-f"></i></a>
                    <a href="<?php echo $sysSettings->twitter_url; ?>" class="w-10 h-10 rounded-full border border-slate-700 flex items-center justify-center hover:bg-[#217346] hover:border-[#217346] transition-all"><i class="fab fa-twitter"></i></a>
                    <a href="<?php echo $sysSettings->linkedin_url; ?>" class="w-10 h-10 rounded-full border border-slate-700 flex items-center justify-center hover:bg-[#217346] hover:border-[#217346] transition-all"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div>
                <h4 class="text-xs font-black uppercase tracking-widest text-[#217346] mb-6">Contact Info</h4>
                <ul class="space-y-4 text-sm text-slate-400">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-[#217346]"></i>
                        <span><?php echo $sysSettings->hospital_address; ?></span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-3 text-[#217346]"></i>
                        <span><?php echo $sysSettings->hospital_phone; ?></span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-[#217346]"></i>
                        <span><?php echo $sysSettings->hospital_email; ?></span>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="text-xs font-black uppercase tracking-widest text-[#217346] mb-6">Quick Links</h4>
                <ul class="space-y-3 text-sm text-slate-400">
                    <li><a href="<?php echo URLROOT; ?>/users/login" class="hover:text-white transition-colors uppercase font-bold text-[10px]">Staff Portal Login</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Our Specialists</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Emergency Services</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 mt-20 pt-8 border-t border-slate-800 text-center text-[10px] uppercase font-bold text-slate-500 tracking-widest">
            <p>&copy; <?php echo date('Y'); ?> <?php echo $sysSettings->hospital_name; ?>. All Rights Reserved.</p>
        </div>
    </footer>
<?php endif; ?>

    <!-- Custom JS -->
    <script src="<?php echo URLROOT; ?>/public/js/main.js"></script>
</body>
</html>
