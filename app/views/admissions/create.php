<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="flex items-center space-x-3 mb-8">
        <a href="<?php echo URLROOT; ?>/wards/index" class="w-8 h-8 flex items-center justify-center bg-slate-200 text-slate-600 rounded hover:bg-slate-300 transition-colors">
            <i class="fas fa-arrow-left text-xs"></i>
        </a>
        <div>
            <h2 class="text-xl font-black text-slate-800 uppercase tracking-tight">Clinical Admission</h2>
            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Inpatient Registration & Bed Assignment</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white border border-slate-300 shadow-sm overflow-hidden">
        <div class="p-3 border-b border-slate-300 bg-[#217346] text-white flex justify-between items-center">
            <h3 class="text-[10px] font-black uppercase tracking-widest">Medical Admission Form</h3>
            <span class="text-[9px] font-bold opacity-75">RECORD ID: ADM-AUTO</span>
        </div>
        
        <form action="<?php echo URLROOT; ?>/admissions/create" method="POST" class="p-8 space-y-6">
            <input type="hidden" name="bed_id" value="<?php echo $data['bed_id']; ?>">

            <!-- Bed Info (Read Only) -->
            <div class="p-4 bg-slate-50 border border-slate-200 rounded-sm">
                <div class="flex justify-between items-center text-[10px] font-black uppercase tracking-widest text-slate-400 mb-1">
                    <span>Target Clinical Resource</span>
                    <span class="text-rose-600">Reserved for Patient</span>
                </div>
                <div class="text-lg font-black text-slate-800 uppercase">
                    BED #<?php echo $data['bed_id']; ?> 
                    <span class="text-[10px] text-slate-400 font-medium ml-2">— Assigned via Ward Occupancy Map</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Field: Patient Selection -->
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Patient Identity</label>
                    <select name="patient_id" class="w-full bg-slate-50 border border-slate-300 px-3 py-2 text-xs font-bold text-slate-700 outline-none focus:border-[#217346] transition-colors <?php echo (!empty($data['patient_id_err'])) ? 'border-red-500' : ''; ?>">
                        <option value="">-- SELECT PATIENT (MRN) --</option>
                        <?php foreach($data['patients'] as $patient) : ?>
                            <option value="<?php echo $patient->id; ?>" <?php echo ($data['patient_id'] == $patient->id) ? 'selected' : ''; ?>>
                                <?php echo $patient->patient_id; ?> - <?php echo strtoupper($patient->name); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-[9px] text-red-500 font-bold"><?php echo $data['patient_id_err']; ?></span>
                </div>

                <!-- Data Field: Admission Date -->
                <div class="space-y-1">
                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Admission Timestamp</label>
                    <input type="datetime-local" name="admission_date" value="<?php echo $data['admission_date']; ?>" class="w-full bg-slate-50 border border-slate-300 px-3 py-2 text-xs font-bold text-slate-700 outline-none focus:border-[#217346] transition-colors <?php echo (!empty($data['admission_date_err'])) ? 'border-red-500' : ''; ?>">
                    <span class="text-[9px] text-red-500 font-bold"><?php echo $data['admission_date_err']; ?></span>
                </div>
            </div>

            <!-- Warning/Alert -->
            <div class="bg-amber-50 border border-amber-200 p-3 flex items-start space-x-3">
                <i class="fas fa-exclamation-triangle text-amber-600 mt-0.5"></i>
                <div class="text-[9px] text-amber-800 leading-normal font-medium uppercase tracking-tight">
                    Confirming this admission will lock the clinical resource (Bed #<?php echo $data['bed_id']; ?>) to this patient record. bed status will be automatically synchronized across the command center dashboard.
                </div>
            </div>

            <!-- Actions -->
            <div class="pt-4 border-t border-slate-200 flex justify-end space-x-4">
                <a href="<?php echo URLROOT; ?>/wards/index" class="px-6 py-2 border border-slate-300 text-slate-500 text-[10px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Cancel</a>
                <button type="submit" class="px-8 py-2 bg-[#217346] text-white text-[10px] font-black uppercase tracking-widest hover:bg-slate-800 transition-all shadow-[0_4px_10px_rgba(33,115,70,0.2)]">Execute Admission</button>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
