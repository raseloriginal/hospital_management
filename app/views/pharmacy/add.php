<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-6 flex justify-between items-center">
    <div>
        <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Stock Inventory Entry</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Resource Log: Pharmaceutical Goods</p>
    </div>
    <a href="<?php echo URLROOT; ?>/pharmacy/index" class="text-slate-500 hover:text-[#217346] text-xs font-bold uppercase tracking-widest transition-colors flex items-center">
        <i class="fas fa-boxes mr-2"></i> Current Ledger
    </a>
</div>

<div class="bg-white border border-slate-300 shadow-sm overflow-hidden max-w-4xl">
    <div class="p-3 border-b border-slate-300 bg-[#217346] text-white">
        <h3 class="text-[11px] font-black uppercase tracking-widest">New Stock Item Acquisition Form</h3>
    </div>
    <div class="p-6">
        <form action="<?php echo URLROOT; ?>/pharmacy/add" method="post" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Row Item: BRAND NAME *</label>
                    <input type="text" name="name" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-black uppercase <?php echo (!empty($data['name_err'])) ? 'border-red-500' : ''; ?>" value="<?php echo $data['name']; ?>">
                    <span class="text-[10px] text-red-600 font-bold mt-1 uppercase italic"><?php echo $data['name_err']; ?></span>
                </div>

                <!-- Generic Name -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Chemical: GENERIC NAME</label>
                    <input type="text" name="generic_name" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-medium italic" value="<?php echo $data['generic_name']; ?>">
                </div>

                <!-- Category -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Class: CATEGORY *</label>
                    <input type="text" name="category" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold uppercase" value="<?php echo $data['category']; ?>" placeholder="E.G. TABLET, SYRUP">
                </div>

                <!-- Expiry -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Metric: EXPIRATION DATE *</label>
                    <input type="date" name="expiry_date" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-xs font-bold" value="<?php echo $data['expiry_date']; ?>">
                </div>

                <!-- Purchase Price -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Cost: UNIT PURCHASE PRICE (৳)</label>
                    <input type="number" step="0.01" name="purchase_price" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-sm font-mono font-bold" value="<?php echo $data['purchase_price']; ?>">
                </div>

                <!-- Sale Price -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Price: UNIT SALE PRICE (৳)</label>
                    <input type="number" step="0.01" name="sale_price" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-sm font-mono font-black text-[#217346]" value="<?php echo $data['sale_price']; ?>">
                </div>

                <!-- Stock Quantity -->
                <div class="flex flex-col">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Amount: STOCK QUANTITY (UNITS)</label>
                    <input type="number" name="stock_quantity" class="p-2 border border-slate-300 bg-slate-50 focus:bg-white focus:border-[#217346] outline-none transition-all text-sm font-bold" value="<?php echo $data['stock_quantity']; ?>">
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200">
                <button type="submit" class="bg-[#217346] hover:bg-slate-800 text-white px-10 py-2 rounded-sm font-black text-xs transition-all uppercase tracking-widest">
                    <i class="fas fa-file-export mr-2"></i> UPDATE STOCK LEDGER
                </button>
            </div>
        </form>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
