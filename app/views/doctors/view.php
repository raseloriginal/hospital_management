<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-6 flex items-center justify-between border-b pb-4 border-slate-300">
    <div class="flex items-center">
        <a href="<?php echo URLROOT; ?>/doctors/index" class="mr-4 text-slate-500 hover:text-[#217346] transition-colors">
            <i class="fas fa-chevron-left"></i>
        </a>
        <div>
            <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Staff Professional Worksheet</h2>
            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Medical Registry ID: DOC-<?php echo $data['doctor']->id; ?></p>
        </div>
    </div>
    <div class="flex space-x-2">
        <a href="<?php echo URLROOT; ?>/doctors/edit/<?php echo $data['doctor']->id; ?>" class="bg-[#217346] hover:bg-slate-800 text-white px-4 py-1.5 rounded-sm font-bold text-xs transition-all uppercase">
            <i class="fas fa-edit mr-2"></i> Edit Profile
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
    <!-- Staff Bio -->
    <div class="lg:col-span-1 space-y-4">
        <div class="bg-white border border-slate-300 shadow-sm overflow-hidden">
            <div class="h-16 bg-[#217346]"></div>
            <div class="p-4 -mt-10 text-center">
                <div class="w-20 h-20 rounded-sm bg-white border border-slate-300 mx-auto mb-4 p-1 shadow-sm">
                    <img src="<?php echo URLROOT; ?>/public/img/default.png" class="w-full h-full object-cover">
                </div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-tight">DR. <?php echo $data['doctor']->name; ?></h3>
                <p class="text-[9px] font-black text-[#217346] uppercase border border-[#217346] inline-block px-2 py-0.5 mt-2"><?php echo $data['doctor']->department; ?></p>
            </div>
            
            <div class="grid grid-cols-2 border-t border-slate-300">
                <div class="p-3 border-r border-slate-300 bg-slate-50 text-center">
                    <p class="text-[9px] font-black text-slate-400 uppercase leading-none mb-1">Queue</p>
                    <p class="text-lg font-black text-slate-800"><?php echo count($data['appointments']); ?></p>
                </div>
                <div class="p-3 bg-slate-50 text-center">
                    <p class="text-[9px] font-black text-slate-400 uppercase leading-none mb-1">Exp (Y)</p>
                    <p class="text-lg font-black text-slate-800"><?php echo $data['doctor']->experience; ?>Y</p>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-300 shadow-sm">
            <div class="bg-slate-50 px-3 py-1.5 border-b border-slate-300">
                <h4 class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Professional Ledger</h4>
            </div>
            <table class="excel-table w-full border-none">
                <tr class="text-[11px]">
                    <td class="bg-slate-50/50 font-bold w-1/3">SPECIALTY</td>
                    <td class="font-bold text-[#217346] tracking-tight"><?php echo $data['doctor']->specialization; ?></td>
                </tr>
                <tr class="text-[11px]">
                    <td class="bg-slate-50/50 font-bold">DEGREE</td>
                    <td class="italic font-medium"><?php echo $data['doctor']->qualification; ?></td>
                </tr>
                <tr class="text-[11px]">
                    <td class="bg-slate-50/50 font-bold">FEE</td>
                    <td class="font-mono font-bold">৳<?php echo $data['doctor']->consultation_fee; ?></td>
                </tr>
                <tr class="text-[11px]">
                    <td class="bg-slate-50/50 font-bold">CONTACT</td>
                    <td class="font-mono"><?php echo $data['doctor']->email; ?></td>
                </tr>
            </table>
        </div>

        <div class="bg-[#e8f5ed] border border-[#217346]/20 p-4">
            <h4 class="text-[10px] font-black text-[#217346] uppercase tracking-widest mb-2">Duty Schedule</h4>
            <p class="text-[11px] font-bold text-slate-700 italic"><?php echo $data['doctor']->schedule; ?></p>
        </div>
    </div>

    <!-- Appointment Grid -->
    <div class="lg:col-span-3">
        <div class="bg-white border border-slate-300 shadow-sm overflow-hidden min-h-[400px]">
            <div class="p-3 border-b border-slate-300 bg-[#217346] flex justify-between items-center text-white">
                <h3 class="text-[10px] font-black uppercase tracking-widest">Incoming Patient Worksheet - Current Queue</h3>
                <span class="text-[9px] font-bold opacity-75 uppercase italic">Top 10 Priority Entries</span>
            </div>
            <div class="overflow-x-auto">
                <table class="excel-table">
                    <thead>
                        <tr>
                            <th class="w-16">SL</th>
                            <th>PATIENT FULL NAME</th>
                            <th class="w-32">SCHEDULED TIME</th>
                            <th class="w-32 text-center">PAY STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="text-[11px] text-slate-700">
                        <?php $i = 1; foreach($data['appointments'] as $apt) : ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="text-center font-bold bg-slate-50"><?php echo $i++; ?></td>
                            <td class="font-bold uppercase italic"><?php echo $apt->patient_name; ?></td>
                            <td class="font-mono">
                                <span class="font-black"><?php echo date('d/m/Y', strtotime($apt->appointment_date)); ?></span>
                                <span class="block text-[10px] text-slate-400 italic"><?php echo date('h:i A', strtotime($apt->appointment_time)); ?></span>
                            </td>
                            <td class="text-center">
                                <span class="px-2 py-0.5 border border-blue-200 bg-blue-50 text-blue-700 font-black text-[9px] uppercase tracking-tighter"><?php echo $apt->status; ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <?php if(count($data['appointments']) == 0) : ?>
                            <tr><td colspan="4" class="px-6 py-12 text-center text-slate-400 italic">No pending patients in the current queue.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
