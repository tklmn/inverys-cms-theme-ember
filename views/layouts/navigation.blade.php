<nav class="s-nav">
    <div class="max-w-6xl mx-auto px-6 sm:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ url('/') }}" class="site-logo s-no flex items-center gap-3 shrink-0" style="text-decoration:none;">
                @if(theme('logo_url'))
                    {{-- Shared logo partial of the CMS: custom logo, dark mode version, bundled wordmark --}}
                    @include('frontend.partials.site-logo', ['logo' => theme('logo_url'), 'logoDark' => theme('logo_url_dark'), 'siteName' => setting('site_name', __('translation.app_name'))])
                @else
                    <span style="font-size:1.125rem;font-weight:700;color:var(--text-primary);letter-spacing:-0.02em;">{{ setting('site_name', __('translation.app_name')) }}</span>
                @endif
                @if(theme('tagline'))
                    <span class="hidden xl:block whitespace-nowrap" style="font-size:0.75rem;color:var(--text-muted);border-left:1px solid var(--border);padding-left:0.75rem;">{{ theme('tagline') }}</span>
                @endif
            </a>

            {{-- Desktop nav: whatever does not fit on the line moves under "More" (script below) --}}
            <div class="hidden lg:flex min-w-0 flex-1 items-center justify-end gap-1 pl-6">
                <div class="flex min-w-0 items-center gap-1" data-ember-nav>
                @foreach($menuPages as $page)
                    @php
                        $isExternal = !empty($page->external_url);
                        $linkUrl = $isExternal
                            ? $page->external_url
                            : ($page->is_root ? route('home') : route('page.show', $page->slug));
                        $isActive = !$isExternal && (
                            ($page->is_root && request()->is('/')) ||
                            request()->is($page->slug) || request()->is($page->slug . '/*')
                        );
                    @endphp
                    <a href="{{ $linkUrl }}"
                       class="s-nav-link s-no whitespace-nowrap {{ $isActive ? 'active' : '' }}"
                       @if($isExternal && $page->external_url_new_window) target="_blank" rel="noopener noreferrer" @endif>
                        {{ $page->nav_title ?: $page->title }}
                    </a>
                @endforeach
                    <div class="relative" data-ember-more hidden>
                        <button type="button" class="s-nav-link whitespace-nowrap inline-flex items-center gap-1" aria-expanded="false" aria-haspopup="true">
                            {{ __('translation.frontend.nav_more') }}
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="ember-more-list absolute right-0 top-full mt-2 hidden w-56 flex-col gap-0.5 p-1.5" data-ember-more-list></div>
                    </div>
                </div>

                <div class="shrink-0" style="width:1px;height:1.25rem;background:var(--border);margin:0 0.5rem;"></div>

                {{-- Hook for plugins (e.g. language menu) --}}
                @foreach(app('plugin.navigation_hooks') as $navHook)
                    @includeIf($navHook)
                @endforeach

                @if(theme('show_search', true))
                    <button type="button" data-ember-search class="s-icon-btn" title="{{ __('translation.search') }}"><i class="bi bi-search" style="font-size:0.875rem;"></i></button>
                @endif
                @auth
                    @if(theme('show_profile', true))
                        <a href="{{ route('profile.edit') }}" class="s-icon-btn s-no" title="{{ __('translation.profile') }}"><i class="bi bi-person" style="font-size:1rem;"></i></a>
                    @endif
                    @if(auth()->user()->hasPermission('access-dashboard'))
                        <a href="{{ route('dashboard') }}" class="s-icon-btn s-no" title="{{ __('translation.navigation.dashboard') }}"><i class="bi bi-speedometer2" style="font-size:0.875rem;"></i></a>
                    @endif
                    @if(theme('show_logout', true))
                        <form method="POST" action="{{ route('logout') }}" class="inline-flex">@csrf<button type="submit" class="s-icon-btn" title="{{ __('translation.logout') }}"><i class="bi bi-box-arrow-right" style="font-size:0.875rem;"></i></button></form>
                    @endif
                @endauth
            </div>

            {{-- Mobile toggle --}}
            <button type="button" id="ember-nav-toggle" class="lg:hidden nav-hamburger s-icon-btn" aria-expanded="false" aria-controls="ember-mobile-menu" aria-label="{{ __('translation.frontend.toggle_navigation') }}">
                <span class="nav-hamburger-line"></span>
                <span class="nav-hamburger-line"></span>
                <span class="nav-hamburger-line"></span>
            </button>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div id="ember-mobile-menu" class="nav-mobile-panel lg:hidden" aria-hidden="true" inert>
        <div class="nav-mobile-panel-inner">
            <div class="px-6 py-4 space-y-1">
                @foreach($menuPages as $page)
                    @php
                        $mIsExternal = !empty($page->external_url);
                        $mLinkUrl = $mIsExternal ? $page->external_url : ($page->is_root ? route('home') : route('page.show', $page->slug));
                    @endphp
                    <a href="{{ $mLinkUrl }}" class="s-no block px-3 py-2.5 rounded-lg text-sm" style="color:var(--text-secondary);transition:background 0.15s;"
                       data-hover-bg="rgba(255,255,255,0.04)"
                       @if($mIsExternal && $page->external_url_new_window) target="_blank" @endif>
                        {{ $page->nav_title ?: $page->title }}
                    </a>
                @endforeach
            </div>
            <div class="px-6 py-4" style="border-top:1px solid var(--border);">
                @auth
                    @if(theme('show_profile', true))
                        <a href="{{ route('profile.edit') }}" class="s-no block px-3 py-2.5 rounded-lg text-sm" style="color:var(--text-secondary);">
                            <i class="bi bi-person mr-2"></i>{{ __('translation.profile') }}
                        </a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="s-no block px-3 py-2.5 rounded-lg text-sm" style="color:var(--text-secondary);">
                        <i class="bi bi-speedometer2 mr-2"></i>{{ __('translation.navigation.dashboard') }}
                    </a>
                    @if(theme('show_logout', true))
                        <form method="POST" action="{{ route('logout') }}">@csrf
                            <button type="submit" class="w-full text-left px-3 py-2.5 rounded-lg text-sm" style="color:var(--text-secondary);">
                                <i class="bi bi-box-arrow-right mr-2"></i>{{ __('translation.logout') }}
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="s-no block px-3 py-2.5 rounded-lg text-sm" style="color:var(--text-secondary);">
                        <i class="bi bi-box-arrow-in-right mr-2"></i>{{ __('translation.login') }}
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<style>
    .ember-more-list { border: 1px solid var(--border); border-radius: 0.75rem; background: var(--bg-elevated, var(--bg-secondary, #111)); box-shadow: 0 16px 40px -18px rgb(0 0 0 / 0.6); z-index: 60; }
    .ember-more-list.is-open { display: flex; }
    .ember-more-list > .s-nav-link { display: block; width: 100%; padding: 0.5rem 0.75rem; border-radius: 0.5rem; }
    .ember-more-list > .s-nav-link.active::after { display: none; }
</style>
<script @cspNonce>
// "More": trailing items that do not fit on the line
document.addEventListener('DOMContentLoaded', function () {
    var nav = document.querySelector('[data-ember-nav]');
    var more = nav ? nav.querySelector('[data-ember-more]') : null;
    var list = more ? more.querySelector('[data-ember-more-list]') : null;
    var btn = more ? more.querySelector('button') : null;
    if (!nav || !more || !list) return;
    var fit = function () {
        while (list.firstElementChild) nav.insertBefore(list.firstElementChild, more);
        more.hidden = true;
        if (window.innerWidth < 1024 || nav.scrollWidth <= nav.clientWidth + 1) return;
        more.hidden = false;
        var items = Array.prototype.slice.call(nav.children).filter(function (el) { return el !== more; });
        while (items.length > 1 && nav.scrollWidth > nav.clientWidth + 1) list.insertBefore(items.pop(), list.firstElementChild);
        btn.classList.toggle('active', !!list.querySelector('.active'));
    };
    var setMore = function (open) {
        list.classList.toggle('is-open', open);
        btn.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (open) document.dispatchEvent(new CustomEvent('dropdown:open', { detail: more }));
    };
    btn.addEventListener('click', function () { setMore(!list.classList.contains('is-open')); });
    document.addEventListener('click', function (event) {
        if (list.classList.contains('is-open') && !more.contains(event.target)) setMore(false);
    });
    // Only one dropdown at a time: another one opens, "More" closes
    document.addEventListener('dropdown:open', function (event) {
        if (list.classList.contains('is-open') && !more.contains(event.detail)) setMore(false);
    });
    var pending = false;
    window.addEventListener('resize', function () {
        if (pending) return;
        pending = true;
        window.requestAnimationFrame(function () { pending = false; fit(); });
    });
    fit();
    if (document.fonts && document.fonts.ready) document.fonts.ready.then(fit);
});
function emberSetMenu(open) {
    var m = document.getElementById('ember-mobile-menu'), b = document.getElementById('ember-nav-toggle');
    m.classList.toggle('is-open', open);
    m.setAttribute('aria-hidden', open ? 'false' : 'true');
    m.inert = !open;
    b.classList.toggle('is-active', open);
    b.setAttribute('aria-expanded', open ? 'true' : 'false');
    if (open) document.dispatchEvent(new CustomEvent('dropdown:open', { detail: m }));
}
function emberNavToggle() { emberSetMenu(!document.getElementById('ember-mobile-menu').classList.contains('is-open')); }
// Only one dropdown at a time: e.g. the language menu opens, the mobile menu closes
document.addEventListener('dropdown:open', function (event) {
    var m = document.getElementById('ember-mobile-menu');
    if (m && m.classList.contains('is-open') && !m.contains(event.detail)) emberSetMenu(false);
});
document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.getElementById('ember-nav-toggle');
    if (toggle) toggle.addEventListener('click', emberNavToggle);
    var search = document.querySelector('[data-ember-search]');
    if (search) search.addEventListener('click', function () { toggleSearchOverlay(); });
    document.querySelectorAll('[data-hover-bg]').forEach(function (el) {
        el.addEventListener('mouseover', function () { el.style.background = el.getAttribute('data-hover-bg'); });
        el.addEventListener('mouseout', function () { el.style.background = 'transparent'; });
    });
});
</script>
