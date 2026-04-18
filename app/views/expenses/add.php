<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-6 flex items-center space-x-4">
    <a href="<?php echo URLROOT; ?>/expenses" class="w-8 h-8 flex items-center justify-center bg-slate-100 text-slate-500 rounded-sm hover:bg-slate-200 transition-colors">
        <i class="fas fa-chevron-left text-xs"></i>
    </a>
    <div>
        <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Log New Expense</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest leading-none">Record Operational & Procurement Costs</p>
    </div>
</div>

<div class="max-w-2xl bg-white border border-slate-300 shadow-sm">
    <div class="p-3 border-b border-slate-300 bg-slate-50">
        <h3 class="text-xs font-black text-slate-700 uppercase tracking-tight">Expense Entry Form</h3>
    </div>
    <form action="<?php echo URLROOT; ?>/expenses/add" method="post" class="p-6 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Category -->
            <div class="space-y-1">
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Expense Category</label>
                <select name="category" class="w-full border border-slate-300 bg-slate-50 p-2 text-xs font-bold uppercase focus:ring-1 focus:ring-[#217346] focus:border-[#217346] outline-none <?php echo (!empty($data['category_err'])) ? 'border-rose-500' : ''; ?>">
                    <option value="">-- Select Category --</option>
                    <option value="Salary" <?php echo ($data['category'] == 'Salary') ? 'selected' : ''; ?>>Salary</option>
                    <option value="Utility" <?php echo ($data['category'] == 'Utility') ? 'selected' : ''; ?>>Utility</option>
                    <option value="Rent" <?php echo ($data['category'] == 'Rent') ? 'selected' : ''; ?>>Rent</option>
                    <option value="Pharmacy Procurement" <?php echo ($data['category'] == 'Pharmacy Procurement') ? 'selected' : ''; ?>>Pharmacy Procurement</option>
                    <option value="Maintenance" <?php echo ($data['category'] == 'Maintenance') ? 'selected' : ''; ?>>Maintenance</option>
                    <option value="Other" <?php echo ($data['category'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                </select>
                <span class="text-[10px] text-rose-500 font-bold uppercase"><?php echo $data['category_err']; ?></span>
            </div>

            <!-- Date -->
            <div class="space-y-1">
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Expense Date</label>
                <input type="date" name="expense_date" value="<?php echo $data['expense_date']; ?>" class="w-full border border-slate-300 bg-slate-50 p-2 text-xs font-bold focus:ring-1 focus:ring-[#217346] focus:border-[#217346] outline-none <?php echo (!empty($data['date_err'])) ? 'border-rose-500' : ''; ?>">
                <span class="text-[10px] text-rose-500 font-bold uppercase"><?php echo $data['date_err']; ?></span>
            </div>

            <!-- Amount -->
            <div class="space-y-1">
                <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Amount (৳)</label>
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-slate-400 text-xs font-bold">৳</span>
                    <input type="number" step="0.01" name="amount" value="<?php echo $data['amount']; ?>" placeholder="0.00" class="w-full border border-slate-300 bg-slate-50 pl-8 pr-3 py-2 text-xs font-bold focus:ring-1 focus:ring-[#217346] focus:border-[#217346] outline-none <?php echo (!empty($data['amount_err'])) ? 'border-rose-500' : ''; ?>">
                </div>
                <span class="text-[10px] text-rose-500 font-bold uppercase"><?php echo $data['amount_err']; ?></span>
            </div>
        </div>

        <!-- Description -->
        <div class="space-y-1">
            <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Description / Remarks</label>
            <textarea name="description" rows="3" placeholder="Enter expense details..." class="w-full border border-slate-300 bg-slate-50 p-2 text-xs font-medium focus:ring-1 focus:ring-[#217346] focus:border-[#217346] outline-none"><?php echo $data['description']; ?></textarea>
        </div>

        <div class="pt-4 border-t border-slate-300 flex justify-end">
            <button type="submit" class="bg-[#217346] text-white px-8 py-2 rounded-sm text-xs font-bold uppercase tracking-widest shadow-sm hover:bg-[#1a5d38] transition-all">
                Save Expense Record
            </button>
        </div>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
