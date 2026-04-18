<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Diagnostic Test Registry</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Laboratory Information System (LIS)</p>
    </div>
    <a href="<?php echo URLROOT; ?>/laboratory/request" class="bg-[#217346] hover:bg-[#1a5c38] text-white px-4 py-1.5 rounded-sm font-bold shadow-sm transition-all flex items-center text-xs uppercase">
        <i class="fas fa-microscope mr-2 text-[10px]"></i>
        NEW LAB REQUEST
    </a>
</div>

<?php flash('lab_message'); ?>

<div class="excel-table-container">
    <table class="excel-table">
        <thead>
            <tr>
                <th class="w-16">SL</th>
                <th class="w-24">REQ DATE</th>
                <th>PATIENT NAME</th>
                <th>TEST DESCRIPTION</th>
                <th class="w-28 text-center">STATUS</th>
                <th class="text-center w-28">REPORT</th>
            </tr>
        </thead>
        <tbody class="text-[11px] text-slate-700">
            <?php $i = 1; foreach($data['requests'] as $req) : ?>
            <tr class="hover:bg-[#e8f5ed] transition-colors">
                <td class="text-center bg-slate-50 font-bold"><?php echo $i++; ?></td>
                <td class="font-mono text-[10px]"><?php echo date('d/m/y h:iA', strtotime($req->created_at)); ?></td>
                <td class="font-bold uppercase tracking-tighter"><?php echo $req->patient_name; ?></td>
                <td class="font-semibold text-[#217346]"><?php echo $req->test_name; ?></td>
                <td class="text-center">
                    <?php 
                        $status_class = 'bg-slate-100 text-slate-600 border-slate-300';
                        if($req->status == 'Pending') $status_class = 'bg-amber-50 text-amber-700 border-amber-300';
                        if($req->status == 'In Progress') $status_class = 'bg-blue-50 text-blue-700 border-blue-300';
                        if($req->status == 'Completed') $status_class = 'bg-emerald-50 text-emerald-700 border-emerald-300';
                    ?>
                    <span class="px-2 py-0.5 rounded-sm border font-bold text-[9px] uppercase <?php echo $status_class; ?>">
                        <?php echo $req->status; ?>
                    </span>
                </td>
                <td class="text-center p-0">
                    <div class="flex items-center justify-center -space-x-px h-8">
                        <?php if($req->status == 'Pending') : ?>
                            <a href="<?php echo URLROOT; ?>/laboratory/process/<?php echo $req->id; ?>" class="px-4 py-2 border-r border-slate-200 hover:bg-[#217346] hover:text-white transition-all font-bold" title="Process">
                                <i class="fas fa-flask"></i> START
                            </a>
                        <?php elseif($req->status == 'In Progress') : ?>
                            <a href="<?php echo URLROOT; ?>/laboratory/complete/<?php echo $req->id; ?>" class="px-4 py-2 border-r border-slate-200 hover:bg-emerald-600 hover:text-white transition-all font-bold" title="Complete">
                                <i class="fas fa-check-double"></i> DONE
                            </a>
                        <?php else : ?>
                            <a href="#" class="px-4 py-2 hover:bg-blue-600 hover:text-white transition-all font-bold" title="View Report">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
