<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Command Center Header -->
<div class="mb-8">
    <div class="flex items-center space-x-3 mb-2">
        <div class="w-10 h-10 bg-[#217346] flex items-center justify-center text-white rounded-md shadow-sm">
            <i class="fas fa-microchip text-xl"></i>
        </div>
        <div>
            <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Clinical Command Center</h2>
            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest leading-none">Real-time Operational & Financial Overview</p>
        </div>
    </div>
</div>

<!-- Key Performance Indicators (KPIs) -->
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
    <!-- Stat 1: Today Appointments -->
    <div class="bg-white border-l-4 border-l-[#217346] border border-slate-300 p-4 shadow-sm hover:translate-y-[-2px] transition-transform cursor-pointer">
        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Queue: Today</p>
        <div class="flex items-end justify-between">
            <h3 class="text-2xl font-black text-slate-800"><?php echo $data['stats']['today_appointments']; ?></h3>
            <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-[#217346]">
                <i class="fas fa-calendar-check text-xs"></i>
            </div>
        </div>
        <p class="text-[8px] text-emerald-600 font-bold mt-2 uppercase">Active Appointments</p>
    </div>

    <!-- Stat 2: Today Revenue -->
    <div class="bg-white border-l-4 border-l-blue-600 border border-slate-300 p-4 shadow-sm hover:translate-y-[-2px] transition-transform cursor-pointer">
        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Collection: Today</p>
        <div class="flex items-end justify-between">
            <h3 class="text-2xl font-black text-slate-800">৳<?php echo number_format($data['stats']['today_revenue'], 0); ?></h3>
            <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                <i class="fas fa-money-bill-wave text-xs"></i>
            </div>
        </div>
        <p class="text-[8px] text-blue-600 font-bold mt-2 uppercase tracking-tighter">Gross Collections</p>
    </div>

    <!-- Stat 3: Total Patients -->
    <div class="bg-white border-l-4 border-l-indigo-600 border border-slate-300 p-4 shadow-sm hover:translate-y-[-2px] transition-transform cursor-pointer">
        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Database: Patients</p>
        <div class="flex items-end justify-between">
            <h3 class="text-2xl font-black text-slate-800"><?php echo $data['stats']['total_patients']; ?></h3>
            <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600">
                <i class="fas fa-users text-xs"></i>
            </div>
        </div>
        <p class="text-[8px] text-indigo-600 font-bold mt-2 uppercase">Total Enrolled</p>
    </div>

    <!-- Stat 4: Bed Capacity -->
    <div class="bg-white border-l-4 border-l-purple-600 border border-slate-300 p-4 shadow-sm hover:translate-y-[-2px] transition-transform cursor-pointer">
        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Clinical Space: Beds</p>
        <div class="flex items-end justify-between">
            <h3 class="text-2xl font-black text-slate-800"><?php echo $data['stats']['available_beds']; ?>/<?php echo $data['stats']['total_beds']; ?></h3>
            <div class="w-8 h-8 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                <i class="fas fa-bed text-xs"></i>
            </div>
        </div>
        <p class="text-[8px] text-purple-600 font-bold mt-2 uppercase">Available Capacity</p>
    </div>

    <!-- Stat 5: Low Stock Pharma -->
    <div class="bg-white border-l-4 border-l-amber-600 border border-slate-300 p-4 shadow-sm hover:translate-y-[-2px] transition-transform cursor-pointer">
        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Inventory: Alerts</p>
        <div class="flex items-end justify-between">
            <h3 class="text-2xl font-black text-slate-800"><?php echo $data['stats']['low_stock_count']; ?></h3>
            <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-amber-600 animate-pulse">
                <i class="fas fa-exclamation-triangle text-xs"></i>
            </div>
        </div>
        <p class="text-[8px] text-amber-600 font-bold mt-2 uppercase">Critical Low Stock</p>
    </div>

    <!-- Stat 6: Pending Receivables -->
    <div class="bg-white border-l-4 border-l-rose-600 border border-slate-300 p-4 shadow-sm hover:translate-y-[-2px] transition-transform cursor-pointer">
        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Finance: AR</p>
        <div class="flex items-end justify-between">
            <h3 class="text-2xl font-black text-slate-800">৳<?php echo number_format($data['stats']['pending_receivables'] / 1000, 1); ?>k</h3>
            <div class="w-8 h-8 rounded-full bg-rose-50 flex items-center justify-center text-rose-600">
                <i class="fas fa-hand-holding-usd text-xs"></i>
            </div>
        </div>
        <p class="text-[8px] text-rose-600 font-bold mt-2 uppercase">Total Outstanding</p>
    </div>
</div>

<!-- Financial Health & Profitability (Category 3) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 items-stretch">
    <div class="md:col-span-2 bg-gradient-to-r from-slate-900 to-slate-800 border border-slate-700 p-6 shadow-xl relative overflow-hidden flex flex-col justify-center min-h-[140px]">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
            <div>
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Net Hospital Profitability</h3>
                <div class="flex items-baseline space-x-2">
                    <span class="text-4xl font-black text-white">৳<?php echo number_format($data['stats']['net_profit'] / 1000, 1); ?>k</span>
                    <span class="text-xs font-bold <?php echo $data['stats']['net_profit'] >= 0 ? 'text-emerald-400' : 'text-rose-400'; ?> uppercase">
                        <i class="fas <?php echo $data['stats']['net_profit'] >= 0 ? 'fa-caret-up' : 'fa-caret-down'; ?> mr-1"></i>
                        <?php echo $data['stats']['total_revenue'] > 0 ? round(($data['stats']['net_profit'] / $data['stats']['total_revenue']) * 100, 1) : 0; ?>% Margin
                    </span>
                </div>
            </div>
            <div class="flex space-x-8 border-l border-slate-700 pl-8">
                <div>
                    <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-1">Gross Collections</p>
                    <p class="text-lg font-black text-emerald-400">৳<?php echo number_format($data['stats']['total_revenue'] / 1000, 1); ?>k</p>
                </div>
                <div>
                    <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mb-1">Operational OpEx</p>
                    <p class="text-lg font-black text-rose-400">৳<?php echo number_format($data['stats']['total_expenses'] / 1000, 1); ?>k</p>
                </div>
            </div>
        </div>
        <!-- Background decoration -->
        <i class="fas fa-chart-pie absolute right-[-20px] bottom-[-20px] text-slate-700/20 text-9xl"></i>
    </div>
    
    <div class="bg-white border border-slate-300 p-6 shadow-sm flex flex-col justify-center min-h-[140px]">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-[10px] font-black text-slate-800 uppercase tracking-widest">Revenue vs Cost</h3>
            <i class="fas fa-balance-scale text-slate-400"></i>
        </div>
        <div class="w-full bg-slate-100 h-4 rounded-full overflow-hidden flex">
            <?php 
                $rev_p = $data['stats']['total_revenue'] + $data['stats']['total_expenses'] > 0 ? ($data['stats']['total_revenue'] / ($data['stats']['total_revenue'] + $data['stats']['total_expenses'])) * 100 : 50;
                $exp_p = 100 - $rev_p;
            ?>
            <div class="bg-[#217346] h-full" style="width: <?php echo $rev_p; ?>%"></div>
            <div class="bg-rose-500 h-full" style="width: <?php echo $exp_p; ?>%"></div>
        </div>
        <div class="flex justify-between mt-2 text-[8px] font-black uppercase tracking-tighter">
            <span class="text-[#217346]">Revenue (<?php echo round($rev_p); ?>%)</span>
            <span class="text-rose-500">Expenses (<?php echo round($exp_p); ?>%)</span>
        </div>
    </div>
</div>

<!-- Real-time Trends & Admission Monitor -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
    <!-- Clinical Traffic & Revenue Trend -->
    <div class="lg:col-span-8 bg-white border border-slate-300 shadow-sm overflow-hidden">
        <div class="p-3 border-b border-slate-300 bg-slate-50 flex justify-between items-center">
            <div class="flex items-center">
                <i class="fas fa-chart-line mr-2 text-[#217346]"></i>
                <h3 class="text-xs font-black text-slate-700 uppercase tracking-tight">Clinical Traffic & Revenue Trends (7 Days)</h3>
            </div>
            <div class="flex space-x-4">
                <div class="flex items-center space-x-1">
                    <span class="w-3 h-3 bg-[#217346] rounded-full"></span>
                    <span class="text-[9px] font-bold text-slate-500 uppercase">Revenue</span>
                </div>
                <div class="flex items-center space-x-1">
                    <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                    <span class="text-[9px] font-bold text-slate-500 uppercase">Visits</span>
                </div>
            </div>
        </div>
        <div class="p-4" style="height: 250px;">
            <canvas id="clinicalTrendChart"></canvas>
        </div>
    </div>

    <!-- Active Admission Monitor -->
    <div class="lg:col-span-4 bg-white border border-slate-300 shadow-sm overflow-hidden">
        <div class="p-3 border-b border-slate-300 bg-rose-50 flex justify-between items-center">
            <h3 class="text-xs font-black text-rose-800 uppercase tracking-tight">
                <i class="fas fa-bed mr-2"></i> Admission Monitor
            </h3>
            <span class="animate-pulse px-1.5 py-0.5 bg-rose-200 text-rose-800 text-[8px] font-black rounded-full uppercase">Live</span>
        </div>
        <div class="excel-table-container">
            <table class="excel-table">
                <thead>
                    <tr>
                        <th>PATIENT/BED</th>
                        <th class="text-right">ADMITTED</th>
                    </tr>
                </thead>
                <tbody class="text-[10px] text-slate-700">
                    <?php foreach($data['active_admissions'] as $adm) : ?>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-2">
                            <div class="font-bold uppercase leading-tight"><?php echo $adm->patient_name; ?></div>
                            <div class="text-[9px] text-slate-500 uppercase"><?php echo $adm->ward_name; ?> - B<?php echo $adm->bed_number; ?></div>
                        </td>
                        <td class="text-right align-middle text-slate-500 font-medium">
                            <?php echo date('M d, H:i', strtotime($adm->admission_date)); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($data['active_admissions'])) : ?>
                        <tr><td colspan="2" class="p-8 text-center text-slate-400 italic">No active admissions.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
    <!-- Main Diagnostic Feed -->
    <div class="lg:col-span-8 space-y-6">
        <!-- Diagnostic Lab Investigations -->
        <div class="bg-white border border-slate-300 shadow-sm overflow-hidden">
            <div class="p-3 border-b border-slate-300 bg-slate-50 flex justify-between items-center">
                <div class="flex items-center">
                    <i class="fas fa-vial mr-2 text-indigo-600"></i>
                    <h3 class="text-xs font-black text-slate-700 uppercase tracking-tight">Active Lab Investigations</h3>
                </div>
                <a href="<?php echo URLROOT; ?>/laboratory/index" class="text-[#217346] text-[10px] font-black hover:underline uppercase tracking-tighter">Diagnostic Registry</a>
            </div>
            <div class="excel-table-container">
                <table class="excel-table">
                    <thead>
                        <tr>
                            <th class="w-24">REQ ID</th>
                            <th>PATIENT NAME</th>
                            <th>TEST DESCRIPTION</th>
                            <th class="text-center w-28">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="text-[11px] text-slate-700">
                        <?php foreach($data['recent_lab'] as $lab) : ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="font-bold text-[#217346]">LAB-REQ-<?php echo str_pad($lab->id, 4, '0', STR_PAD_LEFT); ?></td>
                            <td class="font-bold uppercase tracking-tight"><?php echo $lab->patient_name; ?></td>
                            <td class="italic font-medium"><?php echo $lab->test_name; ?></td>
                            <td class="text-center">
                                <?php 
                                    $lab_status_class = 'bg-slate-100 text-slate-600 border-slate-300';
                                    if($lab->status == 'Pending') $lab_status_class = 'bg-amber-50 text-amber-600 border-amber-200';
                                    if($lab->status == 'In Progress') $lab_status_class = 'bg-blue-50 text-blue-600 border-blue-200';
                                    if($lab->status == 'Completed') $lab_status_class = 'bg-emerald-50 text-emerald-600 border-emerald-200';
                                ?>
                                <span class="px-2 py-0.5 text-[9px] border font-black uppercase tracking-widest <?php echo $lab_status_class; ?>"><?php echo $lab->status; ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(empty($data['recent_lab'])) : ?>
                            <tr><td colspan="4" class="p-8 text-center text-slate-400 italic">No active lab investigations recorded.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Appointments (Full Width) -->
        <div class="bg-white border border-slate-300 shadow-sm overflow-hidden">
            <div class="p-3 border-b border-slate-300 bg-slate-50 flex justify-between items-center">
                <div class="flex items-center">
                    <i class="fas fa-notes-medical mr-2 text-[#217346]"></i>
                    <h3 class="text-xs font-black text-slate-700 uppercase tracking-tight">Daily Clinical Engagement Log</h3>
                </div>
            </div>
            <div class="excel-table-container">
                <table class="excel-table">
                    <thead>
                        <tr>
                            <th>PATIENT IDENTITY</th>
                            <th>CONSULTING DOCTOR</th>
                            <th>SCHEDULED TIME</th>
                            <th class="text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="text-[11px] text-slate-700">
                        <?php foreach($data['recent_appointments'] as $apt) : ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="font-bold uppercase tracking-tight text-slate-900"><?php echo $apt->patient_name; ?></td>
                            <td class="font-semibold text-[#217346]">DR. <?php echo $apt->doctor_name; ?></td>
                            <td class="font-mono text-[10px]"><?php echo date('h:i A', strtotime($apt->appointment_time)); ?></td>
                            <td class="text-center">
                                <?php 
                                    $apt_status_class = 'bg-slate-100 text-slate-600 border-slate-300';
                                    if($apt->status == 'Confirmed') $apt_status_class = 'bg-emerald-50 text-emerald-600 border-emerald-200';
                                    if($apt->status == 'Pending') $apt_status_class = 'bg-amber-50 text-amber-600 border-amber-200';
                                ?>
                                <span class="px-2 py-0.5 text-[9px] border font-black uppercase tracking-widest <?php echo $apt_status_class; ?>"><?php echo $apt->status; ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Sidebar Insights -->
    <div class="lg:col-span-4 space-y-6">
        <!-- Doctor Performance Monitor (Category 3) -->
        <div class="bg-white border border-slate-300 shadow-sm overflow-hidden">
            <div class="p-3 border-b border-slate-300 bg-slate-50 flex justify-between items-center">
                <h3 class="text-xs font-black text-slate-700 uppercase tracking-tight">
                    <i class="fas fa-user-md mr-2 text-[#217346]"></i> Specialist Performance
                </h3>
            </div>
            <div class="p-4 space-y-4">
                <?php foreach($data['doctor_performance'] as $perf) : ?>
                <div class="space-y-1">
                    <div class="flex justify-between items-center text-[9px] font-black uppercase tracking-widest">
                        <span class="text-slate-600">DR. <?php echo $perf->name; ?></span>
                        <span class="text-[#217346]"><?php echo $perf->appointment_count; ?> VISITS</span>
                    </div>
                    <?php 
                        $max_visits = !empty($data['doctor_performance']) ? max(array_column($data['doctor_performance'], 'appointment_count')) : 1;
                        $perf_p = ($perf->appointment_count / $max_visits) * 100;
                    ?>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-[#217346] h-full" style="width: <?php echo $perf_p; ?>%"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Pharmacy Watchlist -->
        <div class="bg-white border border-slate-300 shadow-sm overflow-hidden">
            <div class="p-3 border-b border-slate-300 bg-amber-50">
                <h3 class="text-xs font-black text-amber-800 uppercase tracking-tight">
                    <i class="fas fa-boxes mr-2"></i> Inventory Watchlist
                </h3>
            </div>
            <div class="p-4 space-y-3">
                <?php foreach($data['low_stock_list'] as $item) : ?>
                <div class="flex items-center justify-between p-2 border border-amber-200 bg-white rounded-sm">
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-slate-800 uppercase"><?php echo $item->name; ?></span>
                        <span class="text-[9px] text-rose-600 font-bold uppercase tracking-tighter">Stock Level: <?php echo $item->stock_quantity; ?> UNITS</span>
                    </div>
                    <a href="<?php echo URLROOT; ?>/pharmacy/index" class="text-amber-800 hover:text-amber-600 transition-colors">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
                <?php endforeach; ?>
                <?php if(empty($data['low_stock_list'])) : ?>
                    <p class="text-[10px] text-emerald-600 font-bold text-center py-2 uppercase"><i class="fas fa-check-circle mr-1"></i> Inventory Healthy</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- On-Duty Clinical Specialists -->
        <div class="bg-white border border-slate-300 shadow-sm overflow-hidden">
            <div class="p-3 border-b border-slate-300 bg-emerald-50">
                <h3 class="text-xs font-black text-emerald-800 uppercase tracking-tight">
                    <i class="fas fa-stethoscope mr-2"></i> On-Duty Specialists
                </h3>
            </div>
            <div class="p-4 space-y-3">
                <?php foreach($data['on_duty_doctors'] as $dr) : ?>
                <div class="flex items-center space-x-3 p-2 border border-emerald-100 bg-slate-50 rounded-sm">
                    <div class="w-8 h-8 rounded-md bg-emerald-600 flex items-center justify-center text-white text-xs font-bold shadow-sm">
                        <?php echo substr($dr->name, 0, 1); ?>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] font-black text-slate-800 uppercase">DR. <?php echo $dr->name; ?></span>
                        <span class="text-[8px] text-[#217346] font-bold uppercase tracking-tight"><?php echo $dr->specialization; ?></span>
                    </div>
                    <div class="ml-auto w-2 h-2 bg-emerald-400 rounded-full animate-pulse shadow-[0_0_8px_rgba(52,211,153,0.5)]"></div>
                </div>
                <?php endforeach; ?>
                <?php if(empty($data['on_duty_doctors'])) : ?>
                    <p class="text-[10px] text-slate-400 font-bold text-center py-2 uppercase">No consultants listed.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Departmental Pulse -->
        <div class="bg-white border border-slate-300 shadow-sm overflow-hidden">
            <div class="p-3 border-b border-slate-300 bg-slate-50">
                <h3 class="text-xs font-black text-slate-700 uppercase tracking-tight">
                    <i class="fas fa-hospital-user mr-2 text-indigo-600"></i> Workload Distribution
                </h3>
            </div>
            <div class="p-4">
                <div class="space-y-4">
                    <?php foreach($data['dept_stats'] as $dept) : ?>
                    <div class="space-y-1">
                        <div class="flex justify-between items-center text-[9px] font-black uppercase tracking-widest">
                            <span class="text-slate-600"><?php echo $dept->department; ?></span>
                            <span class="text-[#217346]"><?php echo $dept->count; ?></span>
                        </div>
                        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden border border-slate-200">
                            <?php 
                                $total_staff = array_sum(array_column($data['dept_stats'], 'count'));
                                $percentage = $total_staff > 0 ? ($dept->count / $total_staff) * 100 : 0;
                            ?>
                            <div class="bg-[#217346] h-full" style="width: <?php echo $percentage; ?>%"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Core System Operations -->
        <div class="bg-[#217346] border border-slate-300 p-4 shadow-sm text-white">
            <h3 class="text-xs font-black mb-4 uppercase tracking-widest opacity-80">Quick Dispatch</h3>
            <div class="grid grid-cols-2 gap-2">
                <a href="<?php echo URLROOT; ?>/patients/register" class="flex flex-col items-center justify-center p-3 border border-white/20 hover:bg-white/10 transition-all rounded-sm">
                    <i class="fas fa-user-plus mb-2 text-xl"></i>
                    <span class="text-[9px] font-bold uppercase tracking-tighter text-center line-clamp-1">New Patient</span>
                </a>
                <a href="<?php echo URLROOT; ?>/appointments/book" class="flex flex-col items-center justify-center p-3 border border-white/20 hover:bg-white/10 transition-all rounded-sm">
                    <i class="fas fa-calendar-alt mb-2 text-xl"></i>
                    <span class="text-[9px] font-bold uppercase tracking-tighter text-center line-clamp-1">Book Visit</span>
                </a>
                <a href="<?php echo URLROOT; ?>/billing/create" class="flex flex-col items-center justify-center p-3 border border-white/20 hover:bg-white/10 transition-all rounded-sm">
                    <i class="fas fa-file-invoice-dollar mb-2 text-xl"></i>
                    <span class="text-[9px] font-bold uppercase tracking-tighter text-center line-clamp-1">Invoice</span>
                </a>
                <a href="<?php echo URLROOT; ?>/laboratory/request" class="flex flex-col items-center justify-center p-3 border border-white/20 hover:bg-white/10 transition-all rounded-sm">
                    <i class="fas fa-flask mb-2 text-xl"></i>
                    <span class="text-[9px] font-bold uppercase tracking-tighter text-center line-clamp-1">Lab Work</span>
                </a>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>

<!-- Dashboard Real-time Logic -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Clinical Trend Chart
    const ctx = document.getElementById('clinicalTrendChart').getContext('2d');
    
    // Prepare Data from PHP
    const trendData = {
        dates: <?php echo json_encode(array_column($data['revenue_trend'], 'date')); ?>,
        revenue: <?php echo json_encode(array_column($data['revenue_trend'], 'total')); ?>,
        visits: <?php echo json_encode(array_column($data['appointment_trend'], 'count')); ?>
    };

    const clinicalChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: trendData.dates.map(d => new Date(d).toLocaleDateString('en-US', { weekday: 'short' })),
            datasets: [
                {
                    label: 'Revenue (৳)',
                    data: trendData.revenue,
                    borderColor: '#217346',
                    backgroundColor: 'rgba(33, 115, 70, 0.05)',
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#217346',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y'
                },
                {
                    label: 'Visits',
                    data: trendData.visits,
                    borderColor: '#3b82f6',
                    backgroundColor: 'transparent',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#3b82f6',
                    pointRadius: 3,
                    tension: 0.1,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleFont: { size: 10, weight: '900' },
                    bodyFont: { size: 11 },
                    padding: 10,
                    cornerRadius: 4
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 9, weight: 'bold' }, color: '#64748b' }
                },
                y: {
                    position: 'left',
                    grid: { color: '#f1f5f9' },
                    ticks: { 
                        font: { size: 9, weight: 'bold' }, 
                        color: '#217346',
                        callback: value => '৳' + (value >= 1000 ? (value/1000).toFixed(1) + 'k' : value)
                    }
                },
                y1: {
                    position: 'right',
                    grid: { display: false },
                    ticks: { font: { size: 9, weight: 'bold' }, color: '#3b82f6' }
                }
            }
        }
    });

    // 2. Micro-interactions for live feeling
    // Simulate real-time data fetch (UI only for effect, actual data is fresh on reload)
    setInterval(() => {
        const liveIndicator = document.querySelector('.animate-pulse.bg-rose-200');
        if(liveIndicator) {
            liveIndicator.textContent = 'Updated: ' + new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            setTimeout(() => liveIndicator.textContent = 'Live', 2000);
        }
    }, 30000); // Pulse indicator update every 30s
});
</script>
