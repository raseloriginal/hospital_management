<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="mb-8 flex justify-between items-end">
    <div>
        <div class="flex items-center space-x-2 mb-1">
            <span class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></span>
            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Ward Command & Control</h2>
        </div>
        <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest leading-none">Live Bed Occupancy & Real-time Clinical Admission Map</p>
    </div>
    
    <div class="flex space-x-4">
        <div class="flex items-center space-x-2">
            <div class="w-3 h-3 bg-emerald-50 border border-emerald-200"></div>
            <span class="text-[10px] font-black text-slate-500 uppercase">Available</span>
        </div>
        <div class="flex items-center space-x-2">
            <div class="w-3 h-3 bg-rose-500 border border-rose-600"></div>
            <span class="text-[10px] font-black text-slate-500 uppercase">Occupied</span>
        </div>
        <div class="flex items-center space-x-2">
            <div class="w-3 h-3 bg-amber-400 border border-amber-500"></div>
            <span class="text-[10px] font-black text-slate-500 uppercase">Cleaning/Maint</span>
        </div>
    </div>
</div>

<!-- Ward Summary Row -->
<div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
    <?php foreach($data['wards'] as $ward) : ?>
    <div class="bg-white border border-slate-300 p-4 shadow-sm relative overflow-hidden group hover:border-[#217346] transition-colors cursor-pointer">
        <div class="relative z-10">
            <p class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1"><?php echo $ward->type; ?></p>
            <h3 class="text-lg font-black text-slate-800 uppercase leading-none mb-4"><?php echo $ward->name; ?></h3>
            <div class="flex items-end justify-between">
                <div class="text-2xl font-black text-[#217346]"><?php echo $ward->available_beds; ?><span class="text-slate-300 mx-1">/</span><span class="text-sm text-slate-400"><?php echo $ward->total_beds; ?></span></div>
                <div class="text-[9px] font-bold text-slate-400 uppercase">Beds Avail</div>
            </div>
            <!-- Progress Mini Bar -->
            <div class="mt-3 w-full bg-slate-100 h-1 rounded-full overflow-hidden">
                <?php $occ_p = ($ward->total_beds > 0) ? (($ward->total_beds - $ward->available_beds) / $ward->total_beds) * 100 : 0; ?>
                <div class="bg-rose-500 h-full" style="width: <?php echo $occ_p; ?>%"></div>
            </div>
        </div>
        <i class="fas fa-hospital absolute right-[-10px] bottom-[-10px] text-slate-50 text-6xl group-hover:text-emerald-50/50 transition-colors"></i>
    </div>
    <?php endforeach; ?>
</div>

<!-- Live Bed Map Grid -->
<?php 
    $grouped_beds = [];
    foreach($data['beds'] as $bed) {
        $grouped_beds[$bed->ward_name][] = $bed;
    }
?>

<div class="space-y-12">
    <?php foreach($grouped_beds as $ward_name => $beds) : ?>
    <div class="bg-white border-t-2 border-t-[#217346] border border-slate-300 shadow-sm overflow-hidden">
        <div class="p-4 bg-slate-50 border-b border-slate-300 flex justify-between items-center">
            <h4 class="text-xs font-black text-slate-700 uppercase tracking-widest"><?php echo $ward_name; ?> SECTION</h4>
            <span class="text-[10px] font-bold text-slate-400 uppercase italic">Floor Location: Dynamic</span>
        </div>
        <div class="p-6 grid grid-cols-2 md:grid-cols-5 lg:grid-cols-10 gap-4">
            <?php foreach($beds as $bed) : ?>
                <div class="relative group">
                    <!-- Bed Icon Representative -->
                    <div class="aspect-square border-2 rounded-md flex flex-col items-center justify-center transition-all duration-300 <?php echo $bed->is_available ? 'bg-emerald-50 border-emerald-100 text-emerald-600' : 'bg-rose-500 border-rose-600 text-white shadow-lg shadow-rose-200'; ?>">
                        <i class="fas fa-bed text-xl mb-1 mt-2"></i>
                        <span class="text-[10px] font-black uppercase tracking-tighter"><?php echo $bed->bed_number; ?></span>
                        
                        <!-- Tooltip/Hover Effect -->
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity bg-slate-900/95 rounded-md z-20 flex flex-col items-center justify-center p-2 text-center">
                            <?php if($bed->is_available) : ?>
                                <p class="text-[8px] font-black text-emerald-400 uppercase tracking-widest mb-1">Status: Clear</p>
                                <a href="<?php echo URLROOT; ?>/admissions/create?bed=<?php echo $bed->id; ?>" class="text-[9px] font-bold text-white bg-emerald-600 px-2 py-1 rounded-sm uppercase">Admit Now</a>
                            <?php else : ?>
                                <p class="text-[8px] font-black text-rose-300 uppercase tracking-widest mb-0.5">Patient Found</p>
                                <p class="text-[10px] font-black text-white uppercase leading-tight mb-1"><?php echo $bed->patient_name; ?></p>
                                <a href="<?php echo URLROOT; ?>/patients/show/<?php echo $bed->patient_id; ?>" class="text-[8px] font-bold text-blue-300 uppercase hover:underline">View Medical File</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Floor/Status Indicator -->
                    <div class="mt-1.5 flex justify-center">
                        <?php if(!$bed->is_available) : ?>
                            <div class="flex space-x-0.5 text-[8px] font-black uppercase text-rose-600">
                                <span class="w-1.5 h-1.5 bg-rose-600 rounded-full animate-pulse"></span>
                                <span>Occupied</span>
                            </div>
                        <?php else : ?>
                            <span class="text-[8px] font-black text-slate-400 uppercase">Available</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
