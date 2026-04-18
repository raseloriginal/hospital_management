<?php $sysSettings = getSystemSettings(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $sysSettings->hospital_name; ?></title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT; ?>/public/img/<?php echo $sysSettings->favicon_path; ?>">
    <style>
        :root {
            --excel-green: <?php echo $sysSettings->primary_color; ?>;
            --excel-green-dark: <?php 
                $hex = $sysSettings->primary_color;
                // Simple darken logic or just use a fixed darker shade
                echo '#1a5c38'; 
            ?>;
            --excel-green-light: #e8f5ed;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f5f9;
        }
        .excel-table {
            border-collapse: collapse;
            width: 100%;
            min-width: 800px;
        }
        .excel-table th, .excel-table td {
            border: 1px solid #cbd5e1;
            padding: 8px 12px;
        }
        .excel-table th {
            background-color: var(--excel-green);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.05em;
        }
        .sidebar-active {
            background-color: var(--excel-green-dark);
            border-left: 5px solid #ffffff;
        }
        /* Responsive Table Wrapper */
        .excel-table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            background: white;
            border: 1px solid #cbd5e1;
        }
    </style>
</head>
<body class="<?php echo isLoggedIn() ? 'bg-slate-100' : 'bg-white'; ?>">
<?php if(isLoggedIn()) : ?>
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-800 text-white flex-shrink-0 hidden md:flex flex-col border-r border-slate-700">
            <div class="p-6 flex items-center space-x-3 bg-slate-900 border-b border-slate-700">
                <div class="bg-[#217346] p-2 rounded-md">
                    <i class="fas fa-hospital text-xl"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-bold tracking-tight"><?php echo $sysSettings->hospital_name; ?></span>
                    <span class="text-[8px] text-slate-400 uppercase tracking-widest"><?php echo $sysSettings->hospital_tagline; ?></span>
                </div>
            </div>
            
            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <a href="<?php echo URLROOT; ?>/pages/index" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors <?php echo (strpos($_GET['url'] ?? '', 'pages/index') !== false || empty($_GET['url'])) ? 'sidebar-active' : ''; ?>">
                    <i class="fas fa-th-large w-6 text-emerald-500"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                
                <?php if($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'receptionist') : ?>
                <a href="<?php echo URLROOT; ?>/patients/index" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <i class="fas fa-user-injured w-6"></i>
                    <span class="ml-3">Patients</span>
                </a>
                <?php endif; ?>

                <a href="<?php echo URLROOT; ?>/appointments/index" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <i class="fas fa-calendar-check w-6"></i>
                    <span class="ml-3">Appointments</span>
                </a>

                <?php if($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'doctor') : ?>
                <a href="<?php echo URLROOT; ?>/doctors/index" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <i class="fas fa-user-md w-6"></i>
                    <span class="ml-3">Doctors</span>
                </a>
                <?php endif; ?>

                <?php if($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'pharmacist') : ?>
                <a href="<?php echo URLROOT; ?>/pharmacy/index" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <i class="fas fa-pills w-6"></i>
                    <span class="ml-3">Pharmacy</span>
                </a>
                <?php endif; ?>

                <?php if($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'lab_tech') : ?>
                <a href="<?php echo URLROOT; ?>/laboratory/index" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <i class="fas fa-vial w-6"></i>
                    <span class="ml-3">Laboratory</span>
                </a>
                <?php endif; ?>

                <?php if($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'doctor' || $_SESSION['user_role'] == 'nurse') : ?>
                <a href="<?php echo URLROOT; ?>/wards/index" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors <?php echo (strpos($_GET['url'] ?? '', 'wards') !== false) ? 'sidebar-active' : ''; ?>">
                    <i class="fas fa-bed w-6 text-emerald-500"></i>
                    <span class="ml-3">Ward Map</span>
                </a>
                <?php endif; ?>

                <?php if($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'accountant') : ?>
                <a href="<?php echo URLROOT; ?>/expenses/index" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors <?php echo (strpos($_GET['url'] ?? '', 'expenses') !== false) ? 'sidebar-active' : ''; ?>">
                    <i class="fas fa-wallet w-6 text-emerald-500"></i>
                    <span class="ml-3">Financials</span>
                </a>
                <?php endif; ?>

                <?php if($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'accountant') : ?>
                <a href="<?php echo URLROOT; ?>/billing/index" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <i class="fas fa-file-invoice-dollar w-6 text-emerald-500"></i>
                    <span class="ml-3">Billing System</span>
                </a>
                <?php endif; ?>

                <?php if($_SESSION['user_role'] == 'admin') : ?>
                <a href="<?php echo URLROOT; ?>/settings/index" class="flex items-center px-4 py-3 rounded-lg hover:bg-slate-800 transition-colors <?php echo (strpos($_GET['url'] ?? '', 'settings') !== false) ? 'sidebar-active' : ''; ?>">
                    <i class="fas fa-cog w-6 text-emerald-500"></i>
                    <span class="ml-3">System Settings</span>
                </a>
                <?php endif; ?>

                <a href="<?php echo URLROOT; ?>/users/logout" class="flex items-center px-4 py-3 rounded-lg hover:bg-red-900/50 text-red-400 mt-6 transition-colors border-t border-slate-700 pt-6">
                    <i class="fas fa-sign-out-alt w-6"></i>
                    <span class="ml-3">Logout</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-8 z-10">
                <div class="flex items-center">
                    <button class="md:hidden text-slate-600 mr-4">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="text-lg font-semibold text-slate-800">
                        <?php 
                            $url = $_GET['url'] ?? 'Dashboard';
                            echo ucwords(str_replace(['/', '_'], [' > ', ' '], $url));
                        ?>
                    </h2>
                </div>
                
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <i class="far fa-bell text-slate-500 text-xl cursor-pointer"></i>
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full">3</span>
                    </div>
                    <div class="flex items-center space-x-3 border-l pl-6 border-slate-200">
                        <div class="text-right">
                            <p class="text-xs font-bold text-slate-800 uppercase"><?php echo $_SESSION['user_name']; ?></p>
                            <p class="text-[10px] text-[#217346] font-bold uppercase"><?php echo $_SESSION['user_role']; ?></p>
                        </div>
                        <img src="<?php echo URLROOT; ?>/public/img/default.png" class="w-8 h-8 rounded border border-slate-300" alt="Profile">
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-8">
<?php else : ?>
    <!-- Guest Navigation -->
    <nav class="bg-white/80 backdrop-blur-md fixed top-0 left-0 right-0 z-50 border-b border-slate-100 h-16">
        <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between">
            <a href="<?php echo URLROOT; ?>" class="flex items-center space-x-3">
                <div class="bg-[#217346] p-2 rounded-md">
                    <i class="fas fa-hospital text-white"></i>
                </div>
                <span class="text-lg font-black text-slate-800 tracking-tight uppercase"><?php echo $sysSettings->hospital_name; ?></span>
            </a>
            
            <div class="hidden md:flex items-center space-x-8">
                <a href="#services" class="text-xs font-bold text-slate-600 hover:text-[#217346] uppercase tracking-widest transition-colors">Services</a>
                <a href="#about" class="text-xs font-bold text-slate-600 hover:text-[#217346] uppercase tracking-widest transition-colors">About</a>
                <a href="#contact" class="text-xs font-bold text-slate-600 hover:text-[#217346] uppercase tracking-widest transition-colors">Contact</a>
                <a href="<?php echo URLROOT; ?>/users/login" class="bg-[#217346] text-white px-6 py-2 rounded-sm text-xs font-black uppercase tracking-widest hover:bg-slate-800 transition-all shadow-md">
                    Staff Portal <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                </a>
            </div>
        </div>
    </nav>
<?php endif; ?>
