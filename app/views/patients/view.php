<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-6 flex items-center justify-between border-b pb-4 border-slate-300">
    <div class="flex items-center">
        <a href="<?php echo URLROOT; ?>/patients/index" class="mr-4 text-slate-500 hover:text-[#217346] transition-colors">
            <i class="fas fa-chevron-left"></i>
        </a>
        <div>
            <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Patient Individual Data Sheet</h2>
            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Master Record: <?php echo $data['patient']->patient_id; ?></p>
        </div>
    </div>
    <div class="flex space-x-2">
        <a href="<?php echo URLROOT; ?>/patients/edit/<?php echo $data['patient']->id; ?>" class="bg-[#217346] hover:bg-slate-800 text-white px-4 py-1.5 rounded-sm font-bold text-xs transition-all uppercase">
            <i class="fas fa-edit mr-2"></i> Edit Record
        </a>
        <button onclick="window.print()" class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 px-4 py-1.5 rounded-sm font-bold text-xs transition-all uppercase">
            <i class="fas fa-print mr-2 text-[#217346]"></i> Generate Report
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
    <!-- Bio Data Section -->
    <div class="lg:col-span-1 space-y-4">
        <div class="bg-white border border-slate-300 shadow-sm p-4 text-center">
            <div class="w-20 h-20 rounded-sm bg-slate-50 text-[#217346] flex items-center justify-center text-3xl font-black mx-auto mb-4 border border-slate-200">
                <?php echo substr($data['patient']->name, 0, 1); ?>
            </div>
            <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight"><?php echo $data['patient']->name; ?></h3>
            <p class="text-[10px] font-bold text-[#217346] border inline-block px-2 py-0.5 border-[#217346] mt-2 italic"><?php echo $data['patient']->patient_id; ?></p>
        </div>

        <div class="bg-white border border-slate-300 shadow-sm">
            <div class="bg-slate-50 px-3 py-1.5 border-b border-slate-300">
                <h4 class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Specifications</h4>
            </div>
            <table class="excel-table w-full border-none">
                <tr class="text-[11px]">
                    <td class="bg-slate-50/50 font-bold w-1/3">BLOOD</td>
                    <td class="font-black text-red-700"><?php echo $data['patient']->blood_group ?: 'N/A'; ?></td>
                </tr>
                <tr class="text-[11px]">
                    <td class="bg-slate-50/50 font-bold">GENDER</td>
                    <td class="font-bold"><?php echo $data['patient']->gender; ?></td>
                </tr>
                <tr class="text-[11px]">
                    <td class="bg-slate-50/50 font-bold">DOB</td>
                    <td class="font-mono"><?php echo date('d-m-Y', strtotime($data['patient']->dob)); ?></td>
                </tr>
                <tr class="text-[11px]">
                    <td class="bg-slate-50/50 font-bold">PHONE</td>
                    <td class="font-mono"><?php echo $data['patient']->phone; ?></td>
                </tr>
                <tr class="text-[11px]">
                    <td class="bg-slate-50/50 font-bold">EMERGENCY</td>
                    <td class="text-amber-800 font-bold italic"><?php echo $data['patient']->emergency_contact ?: 'NONE'; ?></td>
                </tr>
            </table>
        </div>

        <div class="bg-white border border-slate-300 shadow-sm p-4">
            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Residential Address</h4>
            <p class="text-xs text-slate-600 italic leading-relaxed"><?php echo $data['patient']->address ?: 'Data not entered.'; ?></p>
        </div>
    </div>

    <!-- Clinical Timeline Section -->
    <div class="lg:col-span-3">
        <div class="bg-white border border-slate-300 shadow-sm min-h-[500px] flex flex-col">
            <div class="p-3 border-b border-slate-300 bg-slate-800 flex justify-between items-center text-white">
                <h3 class="text-[10px] font-black uppercase tracking-widest">Clinical Event Timeline</h3>
                <span class="text-[9px] font-bold opacity-75 italic">Unified Medical Records Flow</span>
            </div>
            
            <div class="p-8 flex-1 overflow-y-auto max-h-[600px] relative">
                <!-- Timeline Central Line -->
                <div class="absolute left-1/2 top-0 bottom-0 w-0.5 bg-slate-200 -translate-x-1/2 hidden md:block"></div>

                <div class="space-y-12">
                    <?php 
                        // Aggregating and Sorting Timeline Events
                        $timeline = [];
                        foreach($data['history'] as $apt) $timeline[] = ['type' => 'appointment', 'date' => $apt->appointment_date . ' ' . $apt->appointment_time, 'data' => $apt];
                        foreach($data['admissions'] as $adm) {
                            $timeline[] = ['type' => 'admission', 'date' => $adm->admission_date, 'data' => $adm];
                            if($adm->discharge_date) $timeline[] = ['type' => 'discharge', 'date' => $adm->discharge_date, 'data' => $adm];
                        }
                        foreach($data['labs'] as $lab) $timeline[] = ['type' => 'lab', 'date' => $lab->created_at, 'data' => $lab];

                        // Sort by date DESC
                        usort($timeline, function($a, $b) { return strtotime($b['date']) - strtotime($a['date']); });
                    ?>

                    <?php foreach($timeline as $index => $event) : ?>
                    <div class="relative flex flex-col md:flex-row items-center md:items-start group">
                        <!-- Dot -->
                        <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 w-4 h-4 rounded-full border-2 border-white z-10 
                                    <?php echo ($event['type'] == 'admission') ? 'bg-rose-500' : (($event['type'] == 'discharge') ? 'bg-blue-500' : (($event['type'] == 'lab') ? 'bg-amber-500' : 'bg-[#217346]')); ?>"></div>
                        
                        <!-- Content Side (Alternating or Single Side) -->
                        <div class="w-full md:w-[45%] <?php echo ($index % 2 == 0) ? 'md:mr-auto md:text-right md:pr-8' : 'md:ml-auto md:pl-8'; ?>">
                            <div class="bg-slate-50 border border-slate-200 p-4 rounded-sm shadow-sm group-hover:border-slate-400 transition-colors">
                                <div class="flex items-center <?php echo ($index % 2 == 0) ? 'md:justify-end' : 'justify-start'; ?> space-x-2 mb-2">
                                    <span class="text-[9px] font-black uppercase text-slate-400"><?php echo date('M d, Y | h:i A', strtotime($event['date'])); ?></span>
                                </div>
                                
                                <?php if($event['type'] == 'appointment') : ?>
                                    <h5 class="text-xs font-black text-slate-800 uppercase tracking-tight">Outpatient Consultation</h5>
                                    <p class="text-[10px] text-[#217346] font-bold">DR. <?php echo $event['data']->doctor_name; ?></p>
                                    <div class="mt-2 flex items-center <?php echo ($index % 2 == 0) ? 'md:justify-end' : 'justify-start'; ?> space-x-2">
                                        <span class="bg-emerald-50 text-emerald-600 px-1.5 py-0.5 border border-emerald-200 text-[8px] font-black uppercase"><?php echo $event['data']->status; ?></span>
                                    </div>

                                <?php elseif($event['type'] == 'admission') : ?>
                                    <h5 class="text-xs font-black text-rose-600 uppercase tracking-tight uppercase">Inpatient Admission</h5>
                                    <p class="text-[10px] text-slate-500 font-bold uppercase"><?php echo $event['data']->ward_name; ?> - Bed <?php echo $event['data']->bed_number; ?></p>
                                    <div class="mt-2 flex items-center <?php echo ($index % 2 == 0) ? 'md:justify-end' : 'justify-start'; ?>">
                                        <span class="bg-rose-50 text-rose-700 px-1.5 py-0.5 border border-rose-200 text-[8px] font-black uppercase tracking-widest animate-pulse">Critical: Admitted</span>
                                    </div>

                                <?php elseif($event['type'] == 'discharge') : ?>
                                    <h5 class="text-xs font-black text-blue-600 uppercase tracking-tight uppercase">Patient Discharged</h5>
                                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest italic">Discharge Process Completed</p>

                                <?php elseif($event['type'] == 'lab') : ?>
                                    <h5 class="text-xs font-black text-amber-600 uppercase tracking-tight">Diagnostic: <?php echo $event['data']->test_name; ?></h5>
                                    <p class="text-[10px] text-slate-500 font-bold">REQ ID: LAB-<?php echo str_pad($event['data']->id, 3, '0', STR_PAD_LEFT); ?></p>
                                    <div class="mt-2 flex items-center <?php echo ($index % 2 == 0) ? 'md:justify-end' : 'justify-start'; ?>">
                                        <span class="bg-amber-50 text-amber-700 px-1.5 py-0.5 border border-amber-200 text-[8px] font-black uppercase"><?php echo $event['data']->status; ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <?php if(empty($timeline)) : ?>
                        <div class="text-center py-20">
                            <i class="fas fa-history text-4xl text-slate-100 mb-4"></i>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">No Clinical Records Found for this MRN</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
