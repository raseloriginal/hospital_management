<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-xl font-bold text-slate-800 uppercase tracking-tight">Pharmacy Inventory Sheet</h2>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Active Stock Ledger</p>
    </div>
    <a href="<?php echo URLROOT; ?>/pharmacy/add" class="bg-[#217346] hover:bg-[#1a5c38] text-white px-4 py-1.5 rounded-sm font-bold shadow-sm transition-all flex items-center text-xs uppercase">
        <i class="fas fa-plus mr-2 text-[10px]"></i>
        ADD MEDICINE
    </a>
</div>

<?php flash('pharmacy_message'); ?>

<div class="excel-table-container">
    <table class="excel-table">
        <thead>
            <tr>
                <th>BRAND NAME</th>
                <th>GENERIC NAME</th>
                <th>CATEGORY</th>
                <th class="w-24">UNIT PRICE</th>
                <th class="w-24 text-center">STOCK</th>
                <th>EXPIRY</th>
                <th class="text-center w-28">ACTIONS</th>
            </tr>
        </thead>
        <tbody class="text-[11px] text-slate-700">
            <?php foreach($data['items'] as $item) : ?>
            <tr class="hover:bg-[#e8f5ed] transition-colors">
                <td class="font-bold uppercase tracking-tighter"><?php echo $item->name; ?></td>
                <td class="italic text-slate-500"><?php echo $item->generic_name; ?></td>
                <td class="font-bold text-[#217346]"><?php echo $item->category; ?></td>
                <td class="font-mono">৳<?php echo $item->sale_price; ?></td>
                <td class="text-center">
                    <?php if($item->stock_quantity <= 10) : ?>
                        <span class="font-black text-red-600"><?php echo $item->stock_quantity; ?> (LOW)</span>
                    <?php else : ?>
                        <span class="font-bold"><?php echo $item->stock_quantity; ?></span>
                    <?php endif; ?>
                </td>
                <td class="text-[10px] font-bold <?php echo (strtotime($item->expiry_date) < time()) ? 'text-red-600 animate-pulse' : ''; ?>">
                    <?php echo date('M Y', strtotime($item->expiry_date)); ?>
                </td>
                <td class="text-center p-0">
                    <div class="flex items-center justify-center -space-x-px h-8">
                        <a href="<?php echo URLROOT; ?>/pharmacy/edit/<?php echo $item->id; ?>" class="px-4 py-2 border-r border-slate-200 hover:bg-blue-600 hover:text-white transition-all font-bold" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?php echo URLROOT; ?>/pharmacy/delete/<?php echo $item->id; ?>" method="post" onsubmit="return confirm('Remove item from inventory?');" class="inline">
                            <button type="submit" class="px-4 py-2 hover:bg-red-600 hover:text-white transition-all font-bold" title="Delete">
                                <i class="fas fa-trash-alt"></i>
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
