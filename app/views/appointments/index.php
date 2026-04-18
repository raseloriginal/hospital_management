<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Daily Appointment Queue</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Active Worksheet: <?php echo date('d M, Y'); ?></p>
    </div>
    <a href="<?php echo URLROOT; ?>/appointments/book" class="bg-[#217346] hover:bg-[#1a5c38] text-white px-4 py-1.5 rounded-sm font-bold shadow-sm transition-all flex items-center text-xs uppercase">
        <i class="fas fa-calendar-plus mr-2 text-[10px]"></i>
        BOOK NEW ENTRY
    </a>
</div>

<?php flash('appointment_message'); ?>

<div class="excel-table-container">
    <table class="excel-table">
        <thead>
            <tr>
                <th class="w-16">SL NO</th>
                <th class="w-24">DATE/TIME</th>
                <th>PATIENT NAME</th>
                <th>ASSIGNED DOCTOR</th>
                <th>APPOINTMENT REASON</th>
                <th class="w-24">STATUS</th>
                <th class="text-center w-28">ACTIONS</th>
            </tr>
        </thead>
        <tbody class="text-[11px] text-slate-700">
            <?php foreach($data['appointments'] as $appointment) : ?>
            <tr class="hover:bg-[#e8f5ed] transition-colors">
                <td class="font-bold text-center bg-slate-50"><?php echo $appointment->serial_no; ?></td>
                <td>
                    <span class="font-bold"><?php echo date('d/m/y', strtotime($appointment->appointment_date)); ?></span>
                    <span class="block text-[9px] text-slate-400"><?php echo date('h:i A', strtotime($appointment->appointment_time)); ?></span>
                </td>
                <td class="font-semibold uppercase tracking-tighter"><?php echo $appointment->patient_name; ?></td>
                <td class="font-medium text-[#217346]">DR. <?php echo $appointment->doctor_name; ?></td>
                <td class="italic text-slate-500"><?php echo isset($appointment->reason) ? $appointment->reason : 'Regular Check-up'; ?></td>
                <td class="text-center">
                    <?php 
                        $status_class = 'bg-slate-100 text-slate-600 border-slate-300';
                        if($appointment->status == 'Confirmed') $status_class = 'bg-emerald-50 text-emerald-700 border-emerald-300';
                        if($appointment->status == 'Cancelled') $status_class = 'bg-red-50 text-red-700 border-red-300';
                        if($appointment->status == 'Consulted') $status_class = 'bg-blue-50 text-blue-700 border-blue-300';
                    ?>
                    <span class="px-2 py-0.5 rounded-sm border font-bold text-[9px] uppercase <?php echo $status_class; ?>">
                        <?php echo $appointment->status; ?>
                    </span>
                </td>
                <td class="text-center p-0">
                    <div class="flex items-center justify-center -space-x-px h-8">
                        <?php if($appointment->status == 'Pending') : ?>
                            <a href="<?php echo URLROOT; ?>/appointments/confirm/<?php echo $appointment->id; ?>" class="px-3 py-2 border-r border-slate-200 hover:bg-[#217346] hover:text-white transition-all" title="Confirm">
                                <i class="fas fa-check"></i>
                            </a>
                        <?php endif; ?>
                        
                        <a href="<?php echo URLROOT; ?>/appointments/consult/<?php echo $appointment->id; ?>" class="px-3 py-2 border-r border-slate-200 hover:bg-blue-600 hover:text-white transition-all" title="Consult">
                            <i class="fas fa-prescription"></i>
                        </a>

                        <?php if($appointment->status != 'Cancelled' && $appointment->status != 'Consulted') : ?>
                            <a href="<?php echo URLROOT; ?>/appointments/cancel/<?php echo $appointment->id; ?>" onclick="return confirm('Cancel row?');" class="px-3 py-2 hover:bg-red-600 hover:text-white transition-all" title="Cancel">
                                <i class="fas fa-times"></i>
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
