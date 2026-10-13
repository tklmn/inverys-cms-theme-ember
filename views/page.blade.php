<x-frontend-app-layout>
    <x-slot name="title">{{ $page->meta_title ?? $page->title }}</x-slot>
    <x-slot name="template">{{ $page->template ?? 'container' }}</x-slot>
    <x-slot name="meta">
        {{-- Description, robots, canonical, Open Graph and JSON-LD come from the CMS core (SEO head hook) --}}
        @if ($page->extra_css)<style>{!! \App\Helpers\HtmlHelper::cleanCss($page->extra_css) !!}</style>@endif
    </x-slot>

    @php
        $isFullWidth = ($page->template ?? 'container') === 'full_width';
        $isBlocks = ($page->content_type ?? 'html') === 'blocks' && !empty($page->blocks);
        $isHome = $page->is_root ?? false;
        $showBreadcrumbs = theme('show_breadcrumbs', true) && !$isHome;
        $showTitle = theme('show_page_title', true);
        // The home page and pages that start with a hero block (the stage, with its own H1) get no second page header
        $startsWithHero = $isBlocks && (($page->blocks[0]['type'] ?? '') === 'hero');

        $ancestors = collect([]);
        if ($showBreadcrumbs) {
            $parent = $page->parent;
            $root = \App\Models\Page::where('is_root', true)->first();
            $rootId = $root ? $root->id : null;
            while ($parent) {
                if ($rootId && $parent->id == $rootId) { $parent = $parent->parent; continue; }
                $ancestors->prepend($parent);
                $parent = $parent->parent;
            }
        }
    @endphp

    @unless($isHome || $startsWithHero)
    <x-slot name="header">
        @if($showBreadcrumbs)
            <div class="s-breadcrumb">
                <a href="{{ route('home') }}" class="s-no"><i class="bi bi-house-door"></i></a>
                @foreach($ancestors as $ancestor)
                    <span class="sep">/</span>
                    <a href="{{ $ancestor->is_root ? route('home') : route('page.show', $ancestor->slug) }}" class="s-no">{{ $ancestor->nav_title ?? $ancestor->title }}</a>
                @endforeach
                <span class="sep">/</span>
                <span class="current">{{ $page->nav_title ?? $page->title }}</span>
            </div>
        @endif
        {{-- No aria-label here: it would replace the visible title for screen
             readers and voice control (WCAG 2.5.3 Label in Name) --}}
        <h1 style="font-size:1.5rem;font-weight:700;color:var(--text-primary);letter-spacing:-0.02em;">
            {{ $page->title }}
        </h1>
        @if($page->subtitle)
            <p style="color:var(--text-muted);margin-top:0.375rem;">{{ $page->subtitle }}</p>
        @endif
    </x-slot>
    @endunless

    @if($page->header_image)
        <x-slot name="headerImage">{{ $page->header_image }}</x-slot>
    @endif

    {{-- The page's "ARIA label": names the main region (landmark navigation), never the heading --}}
    @if($page->aria_label)
        <x-slot name="mainLabel">{{ $page->aria_label }}</x-slot>
    @endif

    @if($isBlocks)
        <div class="page-blocks">
            {{-- A header image above the blocks takes the image priority --}}
            {!! app(\App\Services\BlockRenderer::class)->render($page->blocks, prioritizeFirstImage: ! $page->header_image) !!}
        </div>
    @else
        <div class="prose max-w-none">
            {!! \App\Helpers\HtmlHelper::clean($page->content) !!}
        </div>
    @endif

</x-frontend-app-layout>
