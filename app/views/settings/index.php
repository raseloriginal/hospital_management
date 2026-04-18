<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-6">
    <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">System Configuration</h2>
    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Admin Control Panel > Settings</p>
</div>

<?php flash('settings_message'); ?>

<div class="bg-white border border-slate-300 shadow-sm overflow-hidden mb-8">
    <form action="<?php echo URLROOT; ?>/settings/update" method="post" enctype="multipart/form-data">
        <!-- Tabs Header -->
        <div class="flex border-b border-slate-300 bg-slate-50" id="settingsTabs">
            <button type="button" onclick="openTab(event, 'general')" class="tab-btn active px-6 py-3 text-[11px] font-bold uppercase tracking-tight border-r border-slate-300 hover:bg-white transition-all">
                <i class="fas fa-hospital mr-2"></i> General Info
            </button>
            <button type="button" onclick="openTab(event, 'branding')" class="tab-btn px-6 py-3 text-[11px] font-bold uppercase tracking-tight border-r border-slate-300 hover:bg-white transition-all">
                <i class="fas fa-palette mr-2"></i> Branding
            </button>
            <button type="button" onclick="openTab(event, 'contact')" class="tab-btn px-6 py-3 text-[11px] font-bold uppercase tracking-tight border-r border-slate-300 hover:bg-white transition-all">
                <i class="fas fa-address-book mr-2"></i> Contact Info
            </button>
            <button type="button" onclick="openTab(event, 'social')" class="tab-btn px-6 py-3 text-[11px] font-bold uppercase tracking-tight border-r border-slate-300 hover:bg-white transition-all">
                <i class="fas fa-share-alt mr-2"></i> Social Links
            </button>
            <button type="button" onclick="openTab(event, 'system')" class="tab-btn px-6 py-3 text-[11px] font-bold uppercase tracking-tight hover:bg-white transition-all">
                <i class="fas fa-cog mr-2"></i> System Config
            </button>
        </div>

        <!-- Tab Content -->
        <div class="p-8">
            <!-- General Tab -->
            <div id="general" class="tab-content">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Hospital Name</label>
                        <input type="text" name="hospital_name" value="<?php echo $data['settings']->hospital_name; ?>" class="w-full border border-slate-300 px-3 py-2 text-[12px] focus:border-[#217346] outline-none rounded-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Hospital Tagline</label>
                        <input type="text" name="hospital_tagline" value="<?php echo $data['settings']->hospital_tagline; ?>" class="w-full border border-slate-300 px-3 py-2 text-[12px] focus:border-[#217346] outline-none rounded-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Footer Copyright Text</label>
                        <input type="text" name="footer_text" value="<?php echo $data['settings']->footer_text; ?>" class="w-full border border-slate-300 px-3 py-2 text-[12px] focus:border-[#217346] outline-none rounded-sm">
                    </div>
                </div>
            </div>

            <!-- Branding Tab -->
            <div id="branding" class="tab-content hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex items-start space-x-6">
                        <div class="w-24 h-24 border border-slate-300 flex items-center justify-center bg-slate-50 rounded-sm">
                            <img src="<?php echo URLROOT; ?>/public/img/<?php echo $data['settings']->logo_path; ?>" class="max-w-full max-h-full p-2" alt="Logo Preview">
                        </div>
                        <div class="flex-1">
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Hospital Logo</label>
                            <input type="file" name="logo" class="w-full text-[11px] file:mr-4 file:py-1 file:px-4 file:rounded-sm file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-[#217346] file:text-white hover:file:bg-[#1a5c38]">
                            <p class="mt-1 text-[9px] text-slate-400 italic font-medium">Recommended size: 200x50px (PNG/JPG)</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-6">
                        <div class="w-16 h-16 border border-slate-300 flex items-center justify-center bg-slate-50 rounded-sm">
                            <img src="<?php echo URLROOT; ?>/public/img/<?php echo $data['settings']->favicon_path; ?>" class="w-8 h-8" alt="Favicon Preview">
                        </div>
                        <div class="flex-1">
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Site Favicon</label>
                            <input type="file" name="favicon" class="w-full text-[11px] file:mr-4 file:py-1 file:px-4 file:rounded-sm file:border-0 file:text-[10px] file:font-bold file:uppercase file:bg-[#217346] file:text-white hover:file:bg-[#1a5c38]">
                            <p class="mt-1 text-[9px] text-slate-400 italic font-medium">Recommended size: 32x32px (ICO/PNG)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Tab -->
            <div id="contact" class="tab-content hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Official Email</label>
                        <input type="email" name="hospital_email" value="<?php echo $data['settings']->hospital_email; ?>" class="w-full border border-slate-300 px-3 py-2 text-[12px] focus:border-[#217346] outline-none rounded-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Phone Number</label>
                        <input type="text" name="hospital_phone" value="<?php echo $data['settings']->hospital_phone; ?>" class="w-full border border-slate-300 px-3 py-2 text-[12px] focus:border-[#217346] outline-none rounded-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Full Address</label>
                        <textarea name="hospital_address" rows="3" class="w-full border border-slate-300 px-3 py-2 text-[12px] focus:border-[#217346] outline-none rounded-sm"><?php echo $data['settings']->hospital_address; ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Social Tab -->
            <div id="social" class="tab-content hidden">
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-blue-600 text-white flex items-center justify-center rounded-sm">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <div class="flex-1">
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Facebook URL</label>
                            <input type="text" name="facebook_url" value="<?php echo $data['settings']->facebook_url; ?>" class="w-full border border-slate-300 px-3 py-2 text-[12px] focus:border-[#217346] outline-none rounded-sm">
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-sky-400 text-white flex items-center justify-center rounded-sm">
                            <i class="fab fa-twitter"></i>
                        </div>
                        <div class="flex-1">
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Twitter URL</label>
                            <input type="text" name="twitter_url" value="<?php echo $data['settings']->twitter_url; ?>" class="w-full border border-slate-300 px-3 py-2 text-[12px] focus:border-[#217346] outline-none rounded-sm">
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-blue-800 text-white flex items-center justify-center rounded-sm">
                            <i class="fab fa-linkedin-in"></i>
                        </div>
                        <div class="flex-1">
                            <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">LinkedIn URL</label>
                            <input type="text" name="linkedin_url" value="<?php echo $data['settings']->linkedin_url; ?>" class="w-full border border-slate-300 px-3 py-2 text-[12px] focus:border-[#217346] outline-none rounded-sm">
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Tab -->
            <div id="system" class="tab-content hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Currency Symbol</label>
                        <input type="text" name="currency_symbol" value="<?php echo $data['settings']->currency_symbol; ?>" class="w-full border border-slate-300 px-3 py-2 text-[12px] focus:border-[#217346] outline-none rounded-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase mb-1">Primary Theme Color</label>
                        <div class="flex space-x-2">
                            <input type="color" name="primary_color" value="<?php echo $data['settings']->primary_color; ?>" class="w-12 h-10 border border-slate-300 rounded-sm">
                            <input type="text" value="<?php echo $data['settings']->primary_color; ?>" readonly class="flex-1 border border-slate-300 px-3 py-2 text-[12px] bg-slate-50 rounded-sm">
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-sm">
                            <p class="text-[10px] font-bold text-emerald-800 uppercase mb-1">Environment Information</p>
                            <div class="grid grid-cols-3 gap-4 text-[11px]">
                                <div><span class="text-emerald-600 font-bold">App Version:</span> <?php echo APPVERSION; ?></div>
                                <div><span class="text-emerald-600 font-bold">PHP Version:</span> <?php echo PHP_VERSION; ?></div>
                                <div><span class="text-emerald-600 font-bold">Database:</span> MySQL 8.0+</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="p-4 border-t border-slate-300 bg-slate-50 flex justify-end">
            <button type="submit" class="bg-[#217346] hover:bg-[#1a5c38] text-white px-8 py-2 rounded-sm font-bold shadow-sm transition-all text-xs uppercase">
                <i class="fas fa-save mr-2"></i> Save All Changes
            </button>
        </div>
    </form>
</div>

<style>
    .tab-btn.active {
        background-color: white;
        border-bottom: 2px solid #217346;
        color: #217346;
    }
</style>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.add("hidden");
        }
        tablinks = document.getElementsByClassName("tab-btn");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }
        document.getElementById(tabName).classList.remove("hidden");
        evt.currentTarget.classList.add("active");
    }
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
