<footer class="s-footer">
    <div class="max-w-6xl mx-auto py-10 px-6 sm:px-8 text-center">
        <p style="font-size:0.8125rem;color:var(--text-muted);">
            {{ theme('footer_text', '© ' . date('Y') . ' ' . setting('site_name', __('translation.app_name')) . '. ' . __('All rights reserved.')) }}
        </p>
    </div>
</footer>
