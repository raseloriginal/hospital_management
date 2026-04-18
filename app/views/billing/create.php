<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Financial Transaction Entry</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Accounts Receivable: Invoice Generation</p>
    </div>
    <a href="<?php echo URLROOT; ?>/billing/index" class="text-slate-500 hover:text-[#217346] text-xs font-bold uppercase tracking-widest transition-colors flex items-center">
        <i class="fas fa-file-invoice-dollar mr-2"></i> Revenue Ledger
    </a>
</div>

<div class="bg-white border border-slate-300 shadow-sm overflow-hidden max-w-4xl">
    <div class="p-3 border-b border-slate-300 bg-[#217346] text-white">
        <h3 class="text-[11px] font-black uppercase tracking-widest">Patient Billing Form</h3>
    </div>
    <div class="p-6">
        <form action="<?php echo URLROOT; ?>/billing/create" method="post" class="space-y-6">
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

                <!-- Invoice Number (Auto-gen placeholder or manual) -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Row ID: INVOICE NUMBER (AUTO)</label>
                    <input type="text" class="p-2 border border-slate-300 bg-slate-100 text-slate-400 outline-none text-xs font-mono font-bold" value="INV-<?php echo date('Ymd'); ?>-XXXX" readonly>
                </div>

                <!-- Total Amount -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Valuation: TOTAL BILLABLE AMOUNT (৳) *</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-bold text-xs">৳</span>
                        <input type="number" step="0.01" name="total_amount" class="w-full pl-8 pr-3 py-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-sm font-black text-[#217346] <?php echo (!empty($data['amount_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['total_amount']; ?>">
                    </div>
                    <span class="text-[10px] text-red-600 font-bold mt-1 uppercase italic"><?php echo $data['amount_err']; ?></span>
                </div>

                <!-- Payment Status -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Status: PAYMENT STATE</label>
                    <select name="status" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold uppercase">
                        <option value="Unpaid">UNPAID (ACCOUNT RECEIVABLE)</option>
                        <option value="Paid">PAID (SETTLED)</option>
                    </select>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200">
                <button type="submit" class="bg-[#217346] hover:bg-slate-800 text-white px-10 py-2 rounded-sm font-black text-xs transition-all uppercase tracking-widest shadow-[4px_4px_0px_rgba(33,115,70,0.1)]">
                    <i class="fas fa-file-invoice-dollar mr-2"></i> POST INVOICE
                </button>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
