<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Stock Inventory Modification</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Editing Data for Inventory ID: <?php echo $data['id']; ?></p>
    </div>
    <a href="<?php echo URLROOT; ?>/pharmacy/index" class="text-slate-500 hover:text-[#217346] text-xs font-bold uppercase tracking-widest transition-colors flex items-center">
        <i class="fas fa-boxes mr-2"></i> Current Ledger
    </a>
</div>

<div class="bg-white border border-slate-300 shadow-sm overflow-hidden max-w-4xl">
    <div class="p-3 border-b border-slate-300 bg-[#217346] text-white flex justify-between">
        <h3 class="text-[11px] font-black uppercase tracking-widest">Stock Item Value Update Form</h3>
        <span class="text-[9px] font-bold opacity-75 uppercase italic tracking-tighter">Inventory Key: SKU-<?php echo str_pad($data['id'], 6, '0', STR_PAD_LEFT); ?></span>
    </div>
    <div class="p-6">
        <form action="<?php echo URLROOT; ?>/pharmacy/edit/<?php echo $data['id']; ?>" method="post" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Row Column: BRAND NAME *</label>
                    <input type="text" name="name" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-black uppercase <?php echo (!empty($data['name_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['name']; ?>">
                    <span class="text-[10px] text-red-600 font-bold mt-1 uppercase italic tracking-tight"><?php echo $data['name_err']; ?></span>
                </div>

                <!-- Generic Name -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Attribute: GENERIC NAME</label>
                    <input type="text" name="generic_name" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-medium italic" value="<?php echo $data['generic_name']; ?>">
                </div>

                <!-- Category -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Taxonomy: CATEGORY *</label>
                    <input type="text" name="category" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold uppercase" value="<?php echo $data['category']; ?>">
                </div>

                <!-- Expiry -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Validation: EXPIRATION DATE *</label>
                    <input type="date" name="expiry_date" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold" value="<?php echo $data['expiry_date']; ?>">
                </div>

                <!-- Purchase Price -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Financial Column: PURCHASE PRICE (৳)</label>
                    <input type="number" step="0.01" name="purchase_price" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-sm font-mono font-bold" value="<?php echo $data['purchase_price']; ?>">
                </div>

                <!-- Sale Price -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Revenue Metric: SALE PRICE (৳)</label>
                    <input type="number" step="0.01" name="sale_price" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-sm font-mono font-black text-[#217346]" value="<?php echo $data['sale_price']; ?>">
                </div>

                <!-- Stock Quantity -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Numeric Value: STOCK QUANTITY</label>
                    <input type="number" name="stock_quantity" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-sm font-bold" value="<?php echo $data['stock_quantity']; ?>">
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200 flex items-center">
                <button type="submit" class="bg-[#217346] hover:bg-slate-800 text-white px-10 py-2 rounded-sm font-black text-xs transition-all uppercase tracking-widest shadow-[4px_4px_0px_rgba(33,115,70,0.1)]">
                    <i class="fas fa-save mr-2"></i> UPDATE STOCK RECORD
                </button>
                <a href="<?php echo URLROOT; ?>/pharmacy/index" class="ml-6 text-xs font-bold text-slate-500 hover:text-red-600 transition-all uppercase tracking-widest">Discard Changes</a>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
