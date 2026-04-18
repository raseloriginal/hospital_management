<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Staff Resource Addition</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Entry: New Medical Professional Row</p>
    </div>
    <a href="<?php echo URLROOT; ?>/doctors/index" class="text-slate-500 hover:text-[#217346] text-xs font-bold uppercase tracking-widest transition-colors flex items-center">
        <i class="fas fa-list mr-2"></i> Personnel Directory
    </a>
</div>

<div class="bg-white border border-slate-300 shadow-sm overflow-hidden max-w-5xl">
    <div class="p-3 border-b border-slate-300 bg-[#217346] text-white">
        <h3 class="text-[11px] font-black uppercase tracking-widest">Professional Credential Entry Form</h3>
    </div>
    <div class="p-6">
        <form action="<?php echo URLROOT; ?>/doctors/add" method="post" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Name -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Row Key: DOCTOR NAME *</label>
                    <input type="text" name="name" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold uppercase <?php echo (!empty($data['name_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['name']; ?>" placeholder="DR. NAME">
                    <span class="text-[10px] text-red-600 font-bold mt-1"><?php echo $data['name_err']; ?></span>
                </div>

                <!-- Email -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Index: EMAIL (LOGIN ID) *</label>
                    <input type="email" name="email" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-mono <?php echo (!empty($data['email_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['email']; ?>" placeholder="email@hospital.com">
                    <span class="text-[10px] text-red-600 font-bold mt-1"><?php echo $data['email_err']; ?></span>
                </div>

                <!-- Department -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Category: DEPARTMENT *</label>
                    <input type="text" name="department" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold uppercase <?php echo (!empty($data['department_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['department']; ?>">
                </div>

                <!-- Specialization -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Sub-Category: SPECIALTY</label>
                    <input type="text" name="specialization" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold uppercase" value="<?php echo $data['specialization']; ?>">
                </div>

                <!-- Consultation Fee -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Rate: CONSULT FEE (৳)</label>
                    <input type="number" name="consultation_fee" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-sm font-mono font-bold" value="<?php echo $data['consultation_fee']; ?>">
                </div>

                <!-- Experience -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Metric: EXPERIENCE (YEARS)</label>
                    <input type="number" name="experience" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold" value="<?php echo $data['experience']; ?>">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-100">
                <!-- Qualification -->
                <div class="flex flex-col text-xs">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Details: EDUCATIONAL QUALIFICATIONS</label>
                    <textarea name="qualification" rows="2" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all italic"><?php echo $data['qualification']; ?></textarea>
                </div>
                <!-- Schedule -->
                <div class="flex flex-col text-xs">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Worksheet: DUTY SCHEDULE (E.G. SAT-THU 9AM-5PM)</label>
                    <textarea name="schedule" rows="2" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all font-bold"><?php echo $data['schedule']; ?></textarea>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200">
                <div class="flex items-center space-x-4">
                    <button type="submit" class="bg-[#217346] hover:bg-slate-800 text-white px-8 py-2 rounded-sm font-black text-xs transition-all uppercase tracking-widest shadow-[4px_4px_0px_rgba(33,115,70,0.1)]">
                        <i class="fas fa-save mr-2"></i> UPDATE REGISTRY
                    </button>
                    <p class="text-[9px] text-slate-400 italic">Note: Default password 'doctor123' will be assigned for initial login.</p>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
