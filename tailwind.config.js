import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                // === Legacy Dark Theme ===
                'iris-gleam': '#847dff',
                'cyan-signal': '#00b3dd',
                'pale-iris': '#d1c9ff',
                'deep-iris': '#4b49aa',
                'orchid-bloom': '#dd90d8',
                'periwinkle': '#90b8f0',
                'obsidian': '#0f1011',
                'abyss': '#090a0b',
                'graphite': '#2e2e2e',
                'steel': '#3f4041',
                'silver': '#cacaca',
                'fog': '#6a6b6b',
                'ash': '#9f9fa0',
                'cloud': '#f5f5f7',
                'pure': '#ffffff',
                'void': '#000000',

                // === Admin Design Guide (deisgn_admin.md) ===
                // Brand & Accents
                'adm-primary':       '#1D72FE',
                'adm-primary-hover': '#155CD4',
                'adm-primary-soft':  '#EBF2FF',

                // Sidebar / Navigation (Dark)
                'adm-sidebar':        '#111625',
                'adm-sidebar-border': '#1E2640',
                'adm-sidebar-text':   '#8F9CAE',
                'adm-sidebar-active': '#FFFFFF',
                'adm-sidebar-hover':  '#1A2238',

                // Canvas & Surface (Light)
                'adm-canvas':  '#F8FAFC',
                'adm-card':    '#FFFFFF',
                'adm-border':  '#E8EDF5',
                'adm-input':   '#F1F5F9',

                // Text Hierarchy
                'adm-text-main': '#0F172A',
                'adm-text-body': '#475569',
                'adm-text-muted':'#94A3B8',

                // Status / Metric Tints
                'adm-green-bg':  '#ECFDF5',
                'adm-green-fg':  '#10B981',
                'adm-blue-bg':   '#EFF6FF',
                'adm-blue-fg':   '#3B82F6',
                'adm-amber-bg':  '#FFFBEB',
                'adm-amber-fg':  '#F59E0B',
                'adm-rose-bg':   '#FEF2F2',
                'adm-rose-fg':   '#EF4444',
                'adm-purple-bg': '#FAF5FF',
                'adm-purple-fg': '#A855F7',
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['DM Serif Display', ...defaultTheme.fontFamily.serif],
                mono: ['Roboto Mono', ...defaultTheme.fontFamily.mono],
            },
            letterSpacing: {
                widest: '0.18em',
                wider: '0.1em',
            },
            borderRadius: {
                '4xl': '30px',
            }
        },
    },

    plugins: [forms],
};
