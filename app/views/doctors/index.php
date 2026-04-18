<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Staffing Worksheet</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Master List: Medical Professionals</p>
    </div>
    <?php if($_SESSION['user_role'] == 'admin') : ?>
    <a href="<?php echo URLROOT; ?>/doctors/add" class="bg-[#217346] hover:bg-[#1a5c38] text-white px-4 py-1.5 rounded-sm font-bold shadow-sm transition-all flex items-center text-xs uppercase">
        <i class="fas fa-user-plus mr-2 text-[10px]"></i>
        Add New Staff
    </a>
    <?php endif; ?>
</div>

<?php flash('doctor_message'); ?>

<div class="excel-table-container">
    <table class="excel-table">
        <thead>
            <tr>
                <th>DR. NAME</th>
                <th>DEPARTMENT / SPECIALTY</th>
                <th>QUALIFICATIONS</th>
                <th>CONSULT FEE</th>
                <th>SCHEDULE</th>
                <th class="text-center w-36">ACTION</th>
            </tr>
        </thead>
        <tbody class="text-[11px] text-slate-700">
            <?php foreach($data['doctors'] as $doctor) : ?>
            <tr class="hover:bg-[#e8f5ed] transition-colors">
                <td class="font-bold uppercase tracking-tight">
                    <div class="flex items-center">
                        <span class="w-6 h-6 rounded-sm bg-slate-100 flex items-center justify-center mr-2 text-[9px] font-black text-slate-400 border border-slate-200"><?php echo substr($doctor->name, 0, 1); ?></span>
                        DR. <?php echo $doctor->name; ?>
                    </div>
                </td>
                <td class="font-semibold text-[#217346]"><?php echo $doctor->department; ?> - <?php echo $doctor->specialization; ?></td>
                <td class="italic"><?php echo $doctor->qualification; ?></td>
                <td class="font-mono font-bold">৳<?php echo $doctor->consultation_fee; ?></td>
                <td class="text-[10px] uppercase"><?php echo $doctor->schedule; ?></td>
                <td class="text-center p-0">
                    <div class="flex items-center justify-center -space-x-px h-8">
                        <a href="<?php echo URLROOT; ?>/doctors/show/<?php echo $doctor->id; ?>" class="px-3 py-2 border-r border-slate-200 hover:bg-[#217346] hover:text-white transition-all font-bold" title="Profile">
                            <i class="fas fa-id-badge mr-1"></i> VIEW
                        </a>
                        <a href="<?php echo URLROOT; ?>/doctors/edit/<?php echo $doctor->id; ?>" class="px-3 py-2 border-r border-slate-200 hover:bg-amber-600 hover:text-white transition-all font-bold" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo URLROOT; ?>/doctors/delete/<?php echo $doctor->id; ?>" method="post" onsubmit="return confirm('Remove doctor?');" class="inline">
                            <button type="submit" class="px-3 py-2 hover:bg-red-600 hover:text-white transition-all font-bold" title="Remove">
                                <i class="fas fa-user-minus"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
