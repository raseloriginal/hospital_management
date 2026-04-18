document.addEventListener('DOMContentLoaded', function() {
    // Mobile Sidebar Toggle Logic
    const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
    const mainSidebar = document.getElementById('mainSidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (sidebarToggleBtn && mainSidebar) {
        sidebarToggleBtn.addEventListener('click', function() {
            mainSidebar.classList.toggle('-translate-x-full');
            if (sidebarOverlay) {
                sidebarOverlay.classList.toggle('hidden');
            }
        });

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                mainSidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
            });
        }
    }
});
