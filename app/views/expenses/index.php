<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Expense Ledger</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest leading-none">Operational Cost Tracking & Financial Management</p>
    </div>
    <a href="<?php echo URLROOT; ?>/expenses/add" class="bg-[#217346] text-white px-4 py-2 rounded-sm text-xs font-bold uppercase tracking-widest shadow-sm hover:bg-[#1a5d38] transition-colors">
        <i class="fas fa-plus mr-2"></i> Log Expense
    </a>
</div>

<?php echo flash('expense_message'); ?>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white border border-slate-300 p-4 shadow-sm">
        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Expenditure</p>
        <h3 class="text-2xl font-black text-slate-800">৳<?php echo number_format($data['total_spent'], 2); ?></h3>
    </div>
</div>

<div class="bg-white border border-slate-300 shadow-sm overflow-hidden">
    <div class="excel-table-container">
        <table class="excel-table">
            <thead>
                <tr>
                    <th class="w-20">DATE</th>
                    <th>CATEGORY</th>
                    <th>DESCRIPTION</th>
                    <th class="text-right">AMOUNT (৳)</th>
                    <th class="text-center w-24">ACTIONS</th>
                </tr>
            </thead>
            <tbody class="text-[11px] text-slate-700">
                <?php foreach($data['expenses'] as $expense) : ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="font-mono text-slate-500"><?php echo $expense->expense_date; ?></td>
                    <td class="font-bold">
                        <?php 
                            $cat_class = 'bg-slate-100 text-slate-600';
                            if($expense->category == 'Salary') $cat_class = 'bg-blue-50 text-blue-600 border-blue-200';
                            if($expense->category == 'Pharmacy Procurement') $cat_class = 'bg-purple-50 text-purple-600 border-purple-200';
                            if($expense->category == 'Utility') $cat_class = 'bg-amber-50 text-amber-600 border-amber-200';
                        ?>
                        <span class="px-2 py-0.5 text-[9px] border font-black uppercase tracking-widest <?php echo $cat_class; ?>">
                            <?php echo $expense->category; ?>
                        </span>
                    </td>
                    <td class="italic text-slate-500"><?php echo $expense->description; ?></td>
                    <td class="text-right font-bold text-rose-600">-৳<?php echo number_format($expense->amount, 2); ?></td>
                    <td class="text-center">
                        <form action="<?php echo URLROOT; ?>/expenses/delete/<?php echo $expense->id; ?>" method="post" onsubmit="return confirm('Are you sure you want to remove this record?')">
                            <button type="submit" class="text-rose-600 hover:text-rose-800 transition-colors tooltip" title="Delete record">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($data['expenses'])) : ?>
                    <tr><td colspan="5" class="p-8 text-center text-slate-400 italic">No expense records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
