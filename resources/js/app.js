import './bootstrap';

// Import CSS dependencies
import 'overlayscrollbars/overlayscrollbars.css';

// Import Popper.js (required for Bootstrap)
import '@popperjs/core';

// Import Bootstrap JS (cần cho AdminLTE)
import 'bootstrap';

// Import OverlayScrollbars
import { OverlayScrollbars } from 'overlayscrollbars';

// Import AdminLTE JS
import 'admin-lte/dist/js/adminlte.min.js';

// AdminLTE and OverlayScrollbars Configuration
document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo AdminLTE nếu cần
    if (window.AdminLTE && window.AdminLTE.init) {
        window.AdminLTE.init();
    }
    
    // OverlayScrollbars Configuration for Sidebar
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
    };
    
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
    if (sidebarWrapper) {
        OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
                theme: Default.scrollbarTheme,
                autoHide: Default.scrollbarAutoHide,
                clickScroll: Default.scrollbarClickScroll,
            },
        });
    }
    
    // Image path runtime fix for AdminLTE
    const cssLink = document.querySelector('link[href*="css/adminlte.css"]');
    if (cssLink) {
        const cssHref = cssLink.getAttribute('href');
        const deploymentPath = cssHref.slice(0, cssHref.indexOf('css/adminlte.css'));
        
        // Find all images with absolute paths and fix them.
        document.querySelectorAll('img[src^="/assets/"]').forEach((img) => {
            const originalSrc = img.getAttribute('src');
            if (originalSrc) {
                const relativeSrc = originalSrc.slice(1); // Remove leading '/'
                img.src = deploymentPath + relativeSrc;
            }
        });
    }
});

