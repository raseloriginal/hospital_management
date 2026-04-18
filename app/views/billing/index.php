<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Revenue & Billing Ledger</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Accounts Department - Financial Worksheet</p>
    </div>
    <a href="<?php echo URLROOT; ?>/billing/create" class="bg-[#217346] hover:bg-[#1a5c38] text-white px-4 py-1.5 rounded-sm font-bold shadow-sm transition-all flex items-center text-xs uppercase">
        <i class="fas fa-file-invoice mr-2 text-[10px]"></i>
        NEW INVOICE
    </a>
</div>

<?php flash('billing_message'); ?>

<div class="excel-table-container">
    <table class="excel-table">
        <thead>
            <tr>
                <th class="w-16">SL</th>
                <th class="w-32">INV NO</th>
                <th class="w-32">RELEASE DATE</th>
                <th>BILLING TO (PATIENT)</th>
                <th class="w-24 text-right">TOTAL AMOUNTS</th>
                <th class="w-28 text-center">PAY STATUS</th>
                <th class="text-center w-36">FINANCIAL ACTION</th>
            </tr>
        </thead>
        <tbody class="text-[11px] text-slate-700">
            <?php $i = 1; foreach($data['invoices'] as $inv) : ?>
            <tr class="hover:bg-[#e8f5ed] transition-colors">
                <td class="text-center bg-slate-50 font-bold"><?php echo $i++; ?></td>
                <td class="font-bold text-[#217346]"><?php echo $inv->invoice_no; ?></td>
                <td class="font-mono text-[10px]"><?php echo date('d/m/Y', strtotime($inv->created_at)); ?></td>
                <td class="font-bold uppercase tracking-tight"><?php echo $inv->patient_name; ?></td>
                <td class="text-right font-mono font-black py-2 bg-slate-50/50">৳<?php echo number_format($inv->total_amount, 2); ?></td>
                <td class="text-center">
                    <?php 
                        $status_class = 'bg-red-50 text-red-700 border-red-300';
                        if($inv->status == 'Paid') $status_class = 'bg-emerald-50 text-emerald-700 border-emerald-300';
                    ?>
                    <span class="px-3 py-1 rounded-sm border font-black text-[9px] uppercase <?php echo $status_class; ?>">
                        <?php echo $inv->status; ?>
                    </span>
                </td>
                <td class="text-center p-0">
                    <div class="flex items-center justify-center -space-x-px h-10">
                        <button onclick="window.print()" class="px-4 py-2 border-r border-slate-200 hover:bg-slate-800 hover:text-white transition-all font-bold" title="Print Statement">
                            <i class="fas fa-print"></i> PRINT
                        </button>
                        <?php if($inv->status == 'Unpaid') : ?>
                            <a href="<?php echo URLROOT; ?>/billing/pay/<?php echo $inv->id; ?>" class="px-4 py-2 hover:bg-[#217346] hover:text-white transition-all font-bold text-[#217346]" title="Collect Payment">
                                <i class="fas fa-cash-register"></i> PAY
                            </a>
                        <?php else : ?>
                            <span class="px-4 py-2 text-emerald-600 font-black italic">SETTLED</span>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot class="bg-slate-100 font-bold border-t border-slate-300">
            <tr>
                <td colspan="4" class="text-right px-4 py-2 uppercase tracking-tight">Current Sheet Total</td>
                <td class="text-right px-4 py-2 text-[#217346] font-black underline decoration-double">
                    ৳<?php 
                        echo number_format(array_reduce($data['invoices'], function($carry, $item){
                            return $carry + $item->total_amount;
                        }, 0), 2);
                    ?>
                </td>
                <td colspan="2" class="bg-slate-200"></td>
            </tr>
        </tfoot>
    </table>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
