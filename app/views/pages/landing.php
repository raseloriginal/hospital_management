<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center pt-16 overflow-hidden">
    <!-- Abstract Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-0 w-2/3 h-full bg-emerald-50 rounded-l-[200px] transform translate-x-20 -translate-y-10"></div>
        <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-blue-50 rounded-full blur-3xl opacity-60"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
        <div class="space-y-8">
            <div class="inline-flex items-center space-x-2 bg-emerald-100 text-[#217346] px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest">
                <i class="fas fa-certificate"></i>
                <span>ISO 9001:2015 Certified Medical Facility</span>
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-black text-slate-800 leading-[1.1] tracking-tight">
                Advanced Care <br>
                <span class="text-[#217346]">For Your Family</span>
            </h1>
            
            <p class="text-lg text-slate-500 leading-relaxed max-w-xl">
                Experience world-class healthcare with state-of-the-art technology and compassionate medical professionals. We are dedicated to providing the highest standard of Clinical excellence.
            </p>
            
            <div class="flex flex-wrap gap-4 pt-4">
                <a href="<?php echo URLROOT; ?>/users/login" class="bg-[#217346] text-white px-10 py-4 rounded-sm font-black text-xs uppercase tracking-widest hover:bg-slate-800 transition-all shadow-[8px_8px_0px_rgba(33,115,70,0.1)] flex items-center group">
                    Enter System Portal
                    <i class="fas fa-chevron-right ml-3 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="#services" class="bg-white border border-slate-200 text-slate-700 px-10 py-4 rounded-sm font-black text-xs uppercase tracking-widest hover:bg-slate-50 transition-all">
                    Explore Services
                </a>
            </div>

            <!-- Trust Badges -->
            <div class="flex items-center space-x-8 pt-8 border-t border-slate-100">
                <div>
                    <p class="text-2xl font-black text-slate-800"><?php echo $data['stats']['doctors']; ?>+</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Specialists</p>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800"><?php echo $data['stats']['beds']; ?>+</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Modern Beds</p>
                </div>
                <div>
                    <p class="text-2xl font-black text-slate-800">24/7</p>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Emergency</p>
                </div>
            </div>
        </div>

        <div class="relative hidden lg:block">
            <!-- Medical Visual Representation -->
            <div class="relative z-10 rounded-2xl overflow-hidden shadow-2xl border-8 border-white">
                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=1000" alt="Modern Hospital" class="w-full h-[600px] object-cover">
                <!-- Overlay Card -->
                <div class="absolute bottom-6 left-6 right-6 bg-white/90 backdrop-blur-md p-6 rounded-xl shadow-xl border border-white/50">
                    <div class="flex items-center space-x-4 mb-3">
                        <div class="w-12 h-12 bg-[#217346] rounded-lg flex items-center justify-center text-white text-xl">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div>
                            <p class="text-sm font-black text-slate-800 uppercase tracking-tight">Rapid Diagnostics</p>
                            <p class="text-[10px] text-slate-500 font-bold uppercase">Results within 12 hours</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Decorative Elements -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-400/20 rounded-full blur-2xl"></div>
            <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-blue-400/10 rounded-full blur-3xl"></div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section id="services" class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-20 space-y-4">
            <p class="text-[10px] font-black text-[#217346] uppercase tracking-widest">Our Expertise</p>
            <h2 class="text-4xl font-black text-slate-800 tracking-tight uppercase">Specialized Medical <span class="text-[#217346]">Departments</span></h2>
            <div class="w-20 h-1.5 bg-[#217346] mx-auto rounded-full"></div>
            <p class="text-slate-500 text-sm">We provide a wide range of specialized medical services supported by advanced technology and experienced consultants.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Service 1 -->
            <div class="bg-white p-8 border border-slate-200 hover:border-[#217346] transition-all group shadow-sm">
                <div class="w-12 h-12 bg-slate-50 text-slate-400 group-hover:bg-[#217346] group-hover:text-white transition-all flex items-center justify-center text-2xl mb-6 rounded-sm">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight mb-3">Cardiology Unit</h4>
                <p class="text-[11px] text-slate-500 leading-relaxed mb-6">Expert heart care including non-invasive diagnostics, interventional cardiology, and cardiac rehabilitation.</p>
                <a href="#" class="text-[9px] font-black uppercase tracking-widest text-[#217346] border-b-2 border-[#217346]/20 py-1 transition-all hover:border-[#217346]">Learn More</a>
            </div>

            <!-- Service 2 -->
            <div class="bg-white p-8 border border-slate-200 hover:border-[#217346] transition-all group shadow-sm">
                <div class="w-12 h-12 bg-slate-50 text-slate-400 group-hover:bg-[#217346] group-hover:text-white transition-all flex items-center justify-center text-2xl mb-6 rounded-sm">
                    <i class="fas fa-brain"></i>
                </div>
                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight mb-3">Neurology Lab</h4>
                <p class="text-[11px] text-slate-500 leading-relaxed mb-6">Advanced treatment for brain and nervous system disorders using the latest neuro-imaging and diagnostic tools.</p>
                <a href="#" class="text-[9px] font-black uppercase tracking-widest text-[#217346] border-b-2 border-[#217346]/20 py-1 transition-all hover:border-[#217346]">Learn More</a>
            </div>

            <!-- Service 3 -->
            <div class="bg-white p-8 border border-slate-200 hover:border-[#217346] transition-all group shadow-sm">
                <div class="w-12 h-12 bg-slate-50 text-slate-400 group-hover:bg-[#217346] group-hover:text-white transition-all flex items-center justify-center text-2xl mb-6 rounded-sm">
                    <i class="fas fa-child"></i>
                </div>
                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight mb-3">Pediatrics</h4>
                <p class="text-[11px] text-slate-500 leading-relaxed mb-6">Compassionate neonatal and pediatric care, from routine checkups to specialized surgery and intensive care.</p>
                <a href="#" class="text-[9px] font-black uppercase tracking-widest text-[#217346] border-b-2 border-[#217346]/20 py-1 transition-all hover:border-[#217346]">Learn More</a>
            </div>

            <!-- Service 4 -->
            <div class="bg-white p-8 border border-slate-200 hover:border-[#217346] transition-all group shadow-sm">
                <div class="w-12 h-12 bg-slate-50 text-slate-400 group-hover:bg-[#217346] group-hover:text-white transition-all flex items-center justify-center text-2xl mb-6 rounded-sm">
                    <i class="fas fa-microscope"></i>
                </div>
                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight mb-3">Laboratory</h4>
                <p class="text-[11px] text-slate-500 leading-relaxed mb-6">Full range of automated clinical laboratory tests with high precision and rapid digital report delivery systems.</p>
                <a href="#" class="text-[9px] font-black uppercase tracking-widest text-[#217346] border-b-2 border-[#217346]/20 py-1 transition-all hover:border-[#217346]">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- About Section with Data -->
<section id="about" class="py-24">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
        <div class="space-y-8 order-2 lg:order-1">
            <h2 class="text-4xl font-black text-slate-800 tracking-tight leading-tight uppercase">
                Bridging Technology <br>
                <span class="text-[#217346]">With Human Care</span>
            </h2>
            <p class="text-sm text-slate-500 leading-relaxed">
                Founded with a vision to revolutionize healthcare delivery, our facility integrates advanced clinical management systems with patient-centric care models. We believe in transparency, efficiency, and the healing power of technology.
            </p>
            <div class="grid grid-cols-2 gap-8">
                <div class="border-l-4 border-[#217346] pl-6 py-2">
                    <h5 class="text-xs font-black text-slate-800 uppercase mb-2">Our Mission</h5>
                    <p class="text-[10px] text-slate-500 leading-relaxed italic">To provide accessible, high-quality healthcare that empowers our community and transforms lives through medicine.</p>
                </div>
                <div class="border-l-4 border-blue-600 pl-6 py-2">
                    <h5 class="text-xs font-black text-slate-800 uppercase mb-2">Our Vision</h5>
                    <p class="text-[10px] text-slate-500 leading-relaxed italic">To be the region's leading healthcare provider, recognized for clinical excellence and patient experience.</p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 order-1 lg:order-2">
            <div class="bg-emerald-50 aspect-square rounded-2xl flex flex-col items-center justify-center p-8 text-center group hover:bg-[#217346] transition-all">
                <span class="text-4xl font-black text-[#217346] group-hover:text-white mb-2"><?php echo $data['stats']['doctors']; ?>+</span>
                <span class="text-[10px] font-bold text-slate-400 group-hover:text-emerald-100 uppercase tracking-widest leading-none">Qualified Staff</span>
            </div>
            <div class="bg-blue-50 aspect-square rounded-2xl flex flex-col items-center justify-center p-8 mt-12 text-center group hover:bg-blue-600 transition-all">
                <span class="text-4xl font-black text-blue-600 group-hover:text-white mb-2"><?php echo $data['stats']['patients']; ?>+</span>
                <span class="text-[10px] font-bold text-slate-400 group-hover:text-blue-100 uppercase tracking-widest leading-none">Recovery Stories</span>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-20 bg-[#217346] relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 pointer-events-none">
        <div class="grid grid-cols-12 h-full">
            <?php for($i=0; $i<12; $i++): ?>
                <div class="border-r border-white h-full"></div>
            <?php endfor; ?>
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-6 text-center relative z-10 space-y-8">
        <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tight">Need Medical Assistance?</h2>
        <p class="text-emerald-100 text-lg opacity-80 max-w-2xl mx-auto">Our specialists are available 24/7 for emergency care and consultations. Connect with us instantly.</p>
        <div class="flex flex-wrap justify-center gap-6">
            <div class="flex items-center space-x-4 bg-white/10 backdrop-blur-md border border-white/20 px-8 py-4 rounded-sm">
                <i class="fas fa-phone-alt text-2xl text-white"></i>
                <div class="text-left">
                    <p class="text-[10px] text-emerald-200 font-bold uppercase tracking-widest leading-none mb-1">Emergency Helpline</p>
                    <p class="text-lg font-black text-white leading-none"><?php echo $sysSettings->hospital_phone; ?></p>
                </div>
            </div>
            <a href="<?php echo URLROOT; ?>/users/login" class="bg-white text-[#217346] px-12 py-4 rounded-sm font-black text-xs uppercase tracking-widest hover:bg-slate-800 hover:text-white transition-all self-center">
                Book Appointment
            </a>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
