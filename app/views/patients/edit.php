<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Modify Master Patient Record</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Editing Data for MRN: <?php echo $data['id']; ?></p>
    </div>
    <a href="<?php echo URLROOT; ?>/patients/index" class="text-slate-500 hover:text-[#217346] text-xs font-bold uppercase tracking-widest transition-colors flex items-center">
        <i class="fas fa-list mr-2"></i> View Database
    </a>
</div>

<div class="bg-white border border-slate-300 shadow-sm overflow-hidden max-w-4xl">
    <div class="p-3 border-b border-slate-300 bg-[#217346] text-white flex justify-between">
        <h3 class="text-[11px] font-black uppercase tracking-widest">Row Modification Form</h3>
        <span class="text-[9px] font-bold opacity-75 italic">TRANSACTION ID: <?php echo uniqid(); ?></span>
    </div>
    <div class="p-6">
        <form action="<?php echo URLROOT; ?>/patients/edit/<?php echo $data['id']; ?>" method="post" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <!-- Name -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Key Field: FULL NAME *</label>
                    <input type="text" name="name" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold uppercase <?php echo (!empty($data['name_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['name']; ?>">
                    <span class="text-[10px] text-red-600 font-bold mt-1 italic"><?php echo $data['name_err']; ?></span>
                </div>

                <!-- Phone -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Field Attribute: CONTACT NO *</label>
                    <input type="text" name="phone" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-sm font-mono <?php echo (!empty($data['phone_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['phone']; ?>">
                    <span class="text-[10px] text-red-600 font-bold mt-1 italic"><?php echo $data['phone_err']; ?></span>
                </div>

                <!-- DOB -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Temporal Data: DATE OF BIRTH *</label>
                    <input type="date" name="dob" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold <?php echo (!empty($data['dob_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['dob']; ?>">
                    <span class="text-[10px] text-red-600 font-bold mt-1 italic"><?php echo $data['dob_err']; ?></span>
                </div>

                <!-- Gender -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Category: GENDER *</label>
                    <select name="gender" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold uppercase">
                        <option value="Male" <?php echo ($data['gender'] == 'Male') ? 'selected' : ''; ?>>MALE</option>
                        <option value="Female" <?php echo ($data['gender'] == 'Female') ? 'selected' : ''; ?>>FEMALE</option>
                        <option value="Other" <?php echo ($data['gender'] == 'Other') ? 'selected' : ''; ?>>OTHER</option>
                    </select>
                </div>

                <!-- Blood Group -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Biological: BLOOD GROUP</label>
                    <select name="blood_group" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-sm font-black text-red-700">
                        <option value="">N/A</option>
                        <?php foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg) : ?>
                            <option value="<?php echo $bg; ?>" <?php echo ($data['blood_group'] == $bg) ? 'selected' : ''; ?>><?php echo $bg; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Emergency Contact -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Fail-Safe: EMERGENCY CONTACT</label>
                    <input type="text" name="emergency_contact" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold" value="<?php echo $data['emergency_contact']; ?>">
                </div>
            </div>

            <!-- Address -->
            <div class="flex flex-col">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Metadata: PERMANENT ADDRESS</label>
                <textarea name="address" rows="2" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs italic"><?php echo $data['address']; ?></textarea>
            </div>

            <div class="pt-4 border-t border-slate-200">
                <button type="submit" class="bg-[#217346] hover:bg-slate-800 text-white px-8 py-2 rounded-sm font-black text-xs transition-all uppercase tracking-widest shadow-[4px_4px_0px_rgba(33,115,70,0.1)]">
                    <i class="fas fa-save mr-2"></i> OVERWRITE TRANSACTION
                </button>
                <a href="<?php echo URLROOT; ?>/patients/index" class="ml-4 text-xs font-bold text-slate-500 hover:text-red-600 transition-all uppercase">Discard Changes</a>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
