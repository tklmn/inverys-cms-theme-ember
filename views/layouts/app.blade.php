<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ seo_title($title ?? null) }}</title>

        <link rel="icon" type="image/svg+xml" href="{{ asset(setting('favicon', 'images/favicon.svg')) }}">

        @isset($meta)
            {{ $meta }}
        @endisset

        <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}" media="print" id="bootstrap-icons-css">
        <script @cspNonce>(function (l) { if (l.sheet) { l.media = 'all'; } else { l.addEventListener('load', function () { l.media = 'all'; }); } })(document.getElementById('bootstrap-icons-css'));</script>
        <noscript><link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}"></noscript>
        @vite(['resources/css/frontend/app.css', 'resources/js/frontend/app.js'])

        <style>
            :root {
                --accent: {{ theme('accent_color', '#d97706') }};
                --accent-hover: color-mix(in srgb, {{ theme('accent_color', '#d97706') }} 85%, white);
                --surface-0: #09090b;
                --surface-1: #111113;
                --surface-2: #18181b;
                --surface-3: #1f1f23;
                --border: rgba(255,255,255,0.06);
                --border-hover: rgba(255,255,255,0.12);
                --text-primary: #fafafa;
                --text-secondary: #a1a1aa;
                --text-muted: #8a8a93;
            }

            /* ── Base ─────────────────────────────────────────── */
            * { border-color: var(--border); }
            body { background: var(--surface-0) !important; color: var(--text-secondary) !important; -webkit-font-smoothing: antialiased; }
            h1, h2, h3, h4, h5, h6 { color: var(--text-primary); }
            a:not([class]):not(.s-no) { color: var(--accent); transition: color 0.15s; }
            a:not([class]):not(.s-no):hover { color: var(--accent-hover); }
            ::selection { background: color-mix(in srgb, var(--accent) 30%, transparent); }

            /* ── Navigation ───────────────────────────────────── */
            .s-nav { position: sticky; top: 0; z-index: 50; background: color-mix(in srgb, var(--surface-1) 80%, transparent); backdrop-filter: saturate(180%) blur(20px); -webkit-backdrop-filter: saturate(180%) blur(20px); border-bottom: 1px solid var(--border); }
            .s-nav-link { position: relative; padding: 0.5rem 0.75rem; font-size: 0.875rem; font-weight: 500; color: var(--text-primary); transition: color 0.2s; text-decoration: none; }
            .s-nav-link:hover { color: var(--accent); }
            .s-nav-link.active { color: var(--accent); }
            .s-nav-link.active::after { content: ''; position: absolute; bottom: -0.9375rem; left: 0.75rem; right: 0.75rem; height: 2px; background: var(--accent); border-radius: 1px; }
            .s-icon-btn { width: 2.25rem; height: 2.25rem; display: inline-flex; align-items: center; justify-content: center; border-radius: 0.5rem; color: var(--text-muted); transition: color 0.15s, background 0.15s; text-decoration: none; }
            .s-icon-btn:hover { color: var(--text-primary); background: rgba(255,255,255,0.06); }
            /* Menu button on small screens only: the unlayered .s-icon-btn would otherwise beat lg:hidden */
            @media (min-width: 64rem) { .nav-hamburger { display: none; } }
            .nav-mobile-panel { background: var(--surface-1) !important; }

            /* ── Header ───────────────────────────────────────── */
            .s-header { background: var(--surface-1); border-bottom: 1px solid var(--border); }
            .s-breadcrumb { display: flex; align-items: center; gap: 0.375rem; font-size: 0.8125rem; color: var(--text-muted); margin-bottom: 0.5rem; }
            .s-breadcrumb a { color: var(--text-muted); text-decoration: none; transition: color 0.15s; }
            .s-breadcrumb a:hover { color: var(--accent); }
            .s-breadcrumb .sep { opacity: 0.3; }
            .s-breadcrumb .current { color: var(--text-secondary); }

            /* ── Content ──────────────────────────────────────── */
            .s-card { background: var(--surface-2); border: 1px solid var(--border); border-radius: 0.875rem; padding: 1.25rem; transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s; text-decoration: none; display: block; }
            .s-card:hover { border-color: var(--border-hover); transform: translateY(-1px); box-shadow: 0 8px 32px rgba(0,0,0,0.3); }

            /* ── Footer ───────────────────────────────────────── */
            .s-footer { background: var(--surface-1); border-top: 1px solid var(--border); }

            /* ── Prose ────────────────────────────────────────── */
            .prose { --tw-prose-body: var(--text-secondary); --tw-prose-headings: var(--text-primary); --tw-prose-bold: var(--text-primary); --tw-prose-links: var(--accent); --tw-prose-counters: var(--text-muted); --tw-prose-bullets: var(--text-muted); --tw-prose-hr: var(--border); --tw-prose-quotes: var(--text-primary); --tw-prose-quote-borders: var(--accent); --tw-prose-code: var(--text-primary); --tw-prose-pre-code: var(--text-secondary); --tw-prose-pre-bg: var(--surface-2); --tw-prose-td-borders: var(--border); --tw-prose-th-borders: var(--border-hover); }

            /* ── Block overrides ──────────────────────────────── */
            .text-white .block-heading { color: inherit; }
            .text-white .block-text.prose { --tw-prose-body: rgb(255 255 255 / 0.9); --tw-prose-headings: white; --tw-prose-bold: white; --tw-prose-links: white; }

            /* ── Scroll-to-top ────────────────────────────────── */
            .s-scroll-top { position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 40; width: 2.75rem; height: 2.75rem; display: none; align-items: center; justify-content: center; border-radius: 0.75rem; background: var(--surface-3); border: 1px solid var(--border); color: var(--text-muted); cursor: pointer; transition: all 0.2s; }
            .s-scroll-top:hover { color: var(--text-primary); border-color: var(--border-hover); transform: translateY(-2px); box-shadow: 0 4px 16px rgba(0,0,0,0.3); }
            .s-scroll-top.visible { display: inline-flex; }
        </style>
        @if(theme_custom_css())
            <style id="theme-custom-css">{!! theme_custom_css() !!}</style>
        @endif
    </head>
    <body class="font-sans antialiased">
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:p-4" style="background:var(--surface-2);color:var(--accent);">
            {{ __('Skip to main content') }}
        </a>

        <div class="min-h-screen flex flex-col">
            @include('theme::layouts.navigation')

            {{-- Page header and header image sit inside <main>: a <header> directly
                 in <body> would be a second "banner" landmark next to the site
                 header, and the skip link should land on the page title. --}}
            @php($mainLabelText = isset($mainLabel) ? html_entity_decode(trim((string) $mainLabel), ENT_QUOTES | ENT_HTML5) : '')
            <main id="main-content" class="flex-1" @if($mainLabelText !== '') aria-label="{{ $mainLabelText }}" @endif>
                @isset($header)
                    @if(theme('show_page_title', true))
                    <header class="s-header">
                        <div class="max-w-6xl mx-auto px-6 sm:px-8 py-6">
                            {{ $header }}
                        </div>
                    </header>
                    @endif
                @endisset

                @isset($headerImage)
                    {{-- Alt text from the media library (current language); empty for
                         decorative images and for images outside the library.
                         Above the fold: high priority, scaled copies via srcset. --}}
                    @php($headerMedia = \App\Models\Media::findByPath((string) $headerImage))
                    <div class="max-w-6xl mx-auto px-6 sm:px-8 mt-6">
                        <x-responsive-image :src="trim((string) $headerImage)" sizes="(min-width: 72rem) 69rem, 100vw" :priority="true" alt="{{ $headerMedia?->altAttribute() ?? '' }}" class="w-full h-56 sm:h-72 object-cover rounded-xl" style="border:1px solid var(--border);" />
                    </div>
                @endisset

                <div class="{{ ((string)($template ?? 'container')) === 'full_width' ? '' : 'max-w-6xl mx-auto py-10 px-6 sm:px-8' }}">
                    {{ $slot }}
                </div>
            </main>

            @include('theme::layouts.footer')
        </div>

        @includeFirst(['theme::partials.search-overlay', 'frontend.partials.search-overlay'])

        <button class="s-scroll-top" id="scroll-to-top" aria-label="{{ __('Scroll to top') }}">
            <i class="bi bi-chevron-up"></i>
        </button>
        <script @cspNonce>
        (function(){
            var b=document.getElementById('scroll-to-top');
            window.addEventListener('scroll',function(){b.classList.toggle('visible',window.scrollY>300)});
            b.addEventListener('click',function(){window.scrollTo({top:0,behavior:'smooth'})});
        })();
        </script>
    </body>
</html>
