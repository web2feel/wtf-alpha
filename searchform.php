<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="sr-only" for="s"><?php esc_html_e('Search for:', 'wtf-alpha'); ?></label>
    <div class="flex gap-2">
        <input 
            type="search" 
            id="s" 
            class="search-field flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
            placeholder="<?php esc_attr_e('Search &hellip;', 'wtf-alpha'); ?>" 
            value="<?php echo get_search_query(); ?>" 
            name="s"
        >
        <button 
            type="submit" 
            class="search-submit px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
        >
            <?php esc_html_e('Search', 'wtf-alpha'); ?>
        </button>
    </div>
</form>
