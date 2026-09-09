/**
 * Admin Seamless Navigation & Transitions
 *
 * Provides smooth, lightweight client-side transitions between admin menu routes:
 * - Eliminates full-page reloads and layout flashes (FOUC).
 * - Preserves the sidebar and layout shell without unnecessary re-renders.
 * - Uses native document.startViewTransition where available, with CSS micro-fade fallback.
 * - Re-initializes Alpine.js on dynamic subtrees (destroyTree/initTree) cleanly.
 * - Handles browser Back/Forward (popstate) and provides an instant top progress bar.
 */

let activeAbortController = null;
let progressBarTimer = null;

function getProgressBar() {
    return document.getElementById('admin-progress-bar');
}

function startProgressBar() {
    const bar = getProgressBar();
    if (!bar) return;
    clearTimeout(progressBarTimer);
    bar.style.transition = 'width 0.25s ease-out, opacity 0.15s ease-in';
    bar.style.opacity = '1';
    bar.style.width = '35%';

    progressBarTimer = setTimeout(() => {
        if (bar.style.opacity === '1') {
            bar.style.width = '75%';
        }
    }, 200);
}

function finishProgressBar() {
    const bar = getProgressBar();
    if (!bar) return;
    clearTimeout(progressBarTimer);
    bar.style.transition = 'width 0.15s ease-out, opacity 0.2s ease-in 0.15s';
    bar.style.width = '100%';
    bar.style.opacity = '0';

    setTimeout(() => {
        bar.style.transition = 'none';
        bar.style.width = '0%';
    }, 350);
}

async function navigateTo(url, push = true) {
    const currentContent = document.getElementById('admin-page-content');
    if (!currentContent) {
        window.location.href = url;
        return;
    }

    if (activeAbortController) {
        activeAbortController.abort();
    }
    activeAbortController = new AbortController();

    startProgressBar();

    try {
        const response = await fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-Admin-PJAX': 'true',
            },
            signal: activeAbortController.signal,
        });

        // If response was redirected outside admin (e.g. login expired)
        const responseUrl = new URL(response.url);
        if (!responseUrl.pathname.startsWith('/admin')) {
            window.location.href = response.url;
            return;
        }

        if (!response.ok) {
            window.location.href = url;
            return;
        }

        const html = await response.text();
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');

        const newContent = doc.getElementById('admin-page-content');
        const newSidebarNav = doc.getElementById('admin-sidebar-nav');

        if (!newContent) {
            window.location.href = url;
            return;
        }

        // 1. Update Document Title
        if (doc.title) {
            document.title = doc.title;
        }

        // 2. Update Sidebar Active Navigation State
        const currentSidebarNav = document.getElementById('admin-sidebar-nav');
        if (currentSidebarNav && newSidebarNav) {
            currentSidebarNav.innerHTML = newSidebarNav.innerHTML;
        }

        // 3. Close mobile sidebar if open
        window.dispatchEvent(new CustomEvent('close-sidebar'));

        // 4. Update Main Content with smooth transition
        const performDOMUpdate = () => {
            // Clean up Alpine tree before DOM mutation
            if (window.Alpine && typeof window.Alpine.destroyTree === 'function') {
                window.Alpine.destroyTree(currentContent);
            }

            currentContent.innerHTML = newContent.innerHTML;

            // Initialize Alpine on the newly inserted content
            if (window.Alpine && typeof window.Alpine.initTree === 'function') {
                window.Alpine.initTree(currentContent);
            }

            // Scroll cleanly to top
            window.scrollTo({ top: 0, behavior: 'instant' });
        };

        if (document.startViewTransition) {
            document.startViewTransition(() => {
                performDOMUpdate();
            });
        } else {
            currentContent.classList.remove('admin-content-fade-in');
            currentContent.style.opacity = '0.3';
            requestAnimationFrame(() => {
                performDOMUpdate();
                requestAnimationFrame(() => {
                    currentContent.style.opacity = '';
                    currentContent.classList.add('admin-content-fade-in');
                });
            });
        }

        // 5. Update History
        if (push) {
            window.history.pushState({ path: url }, '', url);
        }

        finishProgressBar();
    } catch (err) {
        if (err.name === 'AbortError') {
            return;
        }
        finishProgressBar();
        window.location.href = url;
    } finally {
        activeAbortController = null;
    }
}

export function initAdminNavigation() {
    if (!document.getElementById('admin-page-content')) {
        return;
    }

    // Set initial history state
    if (window.location.pathname.startsWith('/admin')) {
        window.history.replaceState({ path: window.location.href }, '', window.location.href);
    }

    // Intercept navigation link clicks
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        if (!link) return;

        // Ignore modified clicks (cmd/ctrl/shift/alt) and non-left clicks
        if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) {
            return;
        }

        // Ignore explicitly excluded links
        if (
            link.target === '_blank' ||
            link.hasAttribute('download') ||
            link.hasAttribute('data-native') ||
            link.hasAttribute('data-no-pjax')
        ) {
            return;
        }

        const href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('javascript:')) {
            return;
        }

        let targetUrl;
        try {
            targetUrl = new URL(link.href, window.location.origin);
        } catch {
            return;
        }

        // Only handle internal links within /admin
        if (targetUrl.origin !== window.location.origin || !targetUrl.pathname.startsWith('/admin')) {
            return;
        }

        // If clicking link to identical page (without hash), prevent unnecessary reload
        if (targetUrl.pathname === window.location.pathname && targetUrl.search === window.location.search && !targetUrl.hash) {
            e.preventDefault();
            return;
        }

        // If clicking anchor on current page, allow standard browser hash scroll
        if (targetUrl.pathname === window.location.pathname && targetUrl.hash) {
            return;
        }

        e.preventDefault();
        navigateTo(targetUrl.href, true);
    });

    // Intercept GET form submissions in admin area (e.g. filters & search)
    document.addEventListener('submit', (e) => {
        const form = e.target;
        if (!form || (form.method && form.method.toLowerCase() !== 'get')) {
            return;
        }

        if (form.hasAttribute('data-native') || form.hasAttribute('data-no-pjax')) {
            return;
        }

        let actionUrl;
        try {
            actionUrl = new URL(form.action || window.location.href, window.location.origin);
        } catch {
            return;
        }

        if (actionUrl.origin !== window.location.origin || !actionUrl.pathname.startsWith('/admin')) {
            return;
        }

        e.preventDefault();

        // Build clean search params without empty fields
        const formData = new FormData(form);
        const searchParams = new URLSearchParams();
        for (const [key, value] of formData.entries()) {
            if (typeof value === 'string' && value.trim() !== '') {
                searchParams.append(key, value.trim());
            }
        }

        actionUrl.search = searchParams.toString();
        navigateTo(actionUrl.href, true);
    });

    // Handle Browser Back / Forward buttons
    window.addEventListener('popstate', (e) => {
        if (window.location.pathname.startsWith('/admin')) {
            navigateTo(window.location.href, false);
        }
    });
}
