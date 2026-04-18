<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Master Patient Index</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Database View: Standard Grid</p>
    </div>
    <a href="<?php echo URLROOT; ?>/patients/register" class="bg-[#217346] hover:bg-[#1a5c38] text-white px-4 py-1.5 rounded-sm font-bold shadow-sm transition-all flex items-center text-xs uppercase">
        <i class="fas fa-plus mr-2 text-[10px]"></i>
        Add New Row
    </a>
</div>

<?php flash('patient_message'); ?>

<div class="bg-white border border-slate-300 shadow-sm overflow-hidden mb-8">
    <div class="p-2 border-b border-slate-300 bg-slate-50 flex items-center justify-between">
        <div class="relative w-80">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                <i class="fas fa-search text-[10px]"></i>
            </span>
            <input type="text" class="w-full pl-8 pr-3 py-1 text-[11px] border border-slate-300 focus:border-[#217346] outline-none transition-all placeholder:italic" placeholder="Search Master Patient Index...">
        </div>
        <div class="flex space-x-1">
            <button class="px-3 py-1 border border-slate-300 text-[10px] font-bold text-slate-600 hover:bg-white uppercase tracking-tighter">
                <i class="fas fa-filter mr-1"></i> Filter
            </button>
            <button class="px-3 py-1 border border-slate-300 text-[10px] font-bold text-slate-600 hover:bg-white uppercase tracking-tighter">
                <i class="fas fa-download mr-1 text-[#217346]"></i> Export XLS
            </button>
        </div>
    </div>
    
    <div class="excel-table-container">
        <table class="excel-table">
            <thead>
                <tr>
                    <th class="w-24">MRN/PID</th>
                    <th>PATIENT FULL NAME</th>
                    <th class="w-24">GENDER / AGE</th>
                    <th>PHONE CONTACT</th>
                    <th class="w-16">BLOOD</th>
                    <th class="text-center w-32">OPERATIONS</th>
                </tr>
            </thead>
            <tbody class="text-[11px] text-slate-700">
                <?php foreach($data['patients'] as $patient) : ?>
                <tr class="hover:bg-[#e8f5ed] transition-colors">
                    <td class="font-bold text-[#217346] bg-slate-50/50"><?php echo $patient->patient_id; ?></td>
                    <td class="font-bold uppercase tracking-tight"><?php echo $patient->name; ?></td>
                    <td><?php echo $patient->gender; ?> (<?php echo date_diff(date_create($patient->dob), date_create('today'))->y; ?>Y)</td>
                    <td class="font-mono"><?php echo $patient->phone; ?></td>
                    <td class="text-center font-bold text-red-700 bg-red-50/30"><?php echo $patient->blood_group; ?></td>
                    <td class="text-center p-0">
                        <div class="flex items-center justify-center -space-x-px h-8">
                            <a href="<?php echo URLROOT; ?>/patients/show/<?php echo $patient->id; ?>" class="px-3 py-2 border-r border-slate-200 hover:bg-[#217346] hover:text-white transition-all" title="View Record">
                                <i class="fas fa-file-medical"></i>
                            </a>
                            <a href="<?php echo URLROOT; ?>/patients/edit/<?php echo $patient->id; ?>" class="px-3 py-2 border-r border-slate-200 hover:bg-blue-600 hover:text-white transition-all" title="Edit Row">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?php echo URLROOT; ?>/patients/delete/<?php echo $patient->id; ?>" method="post" onsubmit="return confirm('Confirm permanent deletion?');" class="inline">
                                <button type="submit" class="px-3 py-2 hover:bg-red-600 hover:text-white transition-all" title="Delete Row">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                
                <?php if(count($data['patients']) == 0) : ?>
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic font-medium">No records found in the current view.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
