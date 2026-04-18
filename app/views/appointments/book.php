<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Clinical Appointment Dispatch</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Entry: New Consultation Row</p>
    </div>
    <a href="<?php echo URLROOT; ?>/appointments/index" class="text-slate-500 hover:text-[#217346] text-xs font-bold uppercase tracking-widest transition-colors flex items-center">
        <i class="fas fa-list mr-2"></i> Queue Worksheet
    </a>
</div>

<div class="bg-white border border-slate-300 shadow-sm overflow-hidden max-w-4xl">
    <div class="p-3 border-b border-slate-300 bg-[#217346] text-white">
        <h3 class="text-[11px] font-black uppercase tracking-widest">Patient Scheduling Form</h3>
    </div>
    <div class="p-6">
        <form action="<?php echo URLROOT; ?>/appointments/book" method="post" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Patient Selection -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Row Source: SELECT PATIENT *</label>
                    <select name="patient_id" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold uppercase <?php echo (!empty($data['patient_err'])) ? 'border-red-500' : ''; ?>">
                        <option value="">-- SELECT FROM DATABASE --</option>
                        <?php foreach($data['patients'] as $patient) : ?>
                            <option value="<?php echo $patient->id; ?>" <?php echo ($data['patient_id'] == $patient->id) ? 'selected' : ''; ?>>
                                <?php echo $patient->patient_id; ?> | <?php echo $patient->name; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-[10px] text-red-600 font-bold mt-1 uppercase italic"><?php echo $data['patient_err']; ?></span>
                </div>

                <!-- Doctor Selection -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Resource: ASSIGNED PHYSICIAN *</label>
                    <select name="doctor_id" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold uppercase <?php echo (!empty($data['doctor_err'])) ? 'border-red-500' : ''; ?>">
                        <option value="">-- ASSIGN STAFF --</option>
                        <?php foreach($data['doctors'] as $doctor) : ?>
                            <option value="<?php echo $doctor->id; ?>" <?php echo ($data['doctor_id'] == $doctor->id) ? 'selected' : ''; ?>>
                                DR. <?php echo $doctor->name; ?> (<?php echo $doctor->specialization; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span class="text-[10px] text-red-600 font-bold mt-1 uppercase italic"><?php echo $data['doctor_err']; ?></span>
                </div>

                <!-- Date -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Metric: BOOKING DATE *</label>
                    <input type="date" name="appointment_date" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold <?php echo (!empty($data['date_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['appointment_date']; ?>">
                    <span class="text-[10px] text-red-600 font-bold mt-1 uppercase italic"><?php echo $data['date_err']; ?></span>
                </div>

                <!-- Time -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Metric: BOOKING TIME *</label>
                    <input type="time" name="appointment_time" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold <?php echo (!empty($data['time_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['appointment_time']; ?>">
                    <span class="text-[10px] text-red-600 font-bold mt-1 uppercase italic"><?php echo $data['time_err']; ?></span>
                </div>
            </div>

            <!-- Reason -->
            <div class="flex flex-col">
                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Annotation: REASON FOR CONSULTATION</label>
                <textarea name="reason" rows="2" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs italic placeholder:text-slate-300" placeholder="ENTER CLINICAL SYMPTOMS OR NOTES..."><?php echo $data['reason']; ?></textarea>
            </div>

            <div class="pt-6 border-t border-slate-200">
                <button type="submit" class="bg-[#217346] hover:bg-slate-800 text-white px-10 py-2 rounded-sm font-black text-xs transition-all uppercase tracking-widest shadow-[4px_4px_0px_rgba(33,115,70,0.1)]">
                    <i class="fas fa-calendar-check mr-2"></i> EXECUTE BOOKING
                </button>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
