<?php

/**
 * Title: Woo Coming Soon (custom)
 * Slug: woocommerce/coming-soon
 * Categories: hidden
 * Inserter: no
 */
?>

<?php
echo \Illuminate\Support\Facades\Vite::withEntryPoints([
  'resources/css/app.css',
  'resources/js/app.js',
])->toHtml();

/* echo \Roots\view('sections.header')->render();
 */
$source_page = get_page_by_path('coming-soon-content');
?>

<main id="main" class="main -spt">
  <?php
  if ($source_page instanceof WP_Post) {
    echo apply_filters('the_content', $source_page->post_content);
  } else {
    echo '<h1 style="color:#fff;text-align:center">Wracamy wkrótce!</h1>';
  }
  ?>
</main>

<!-- <?php echo \Roots\view('sections.footer')->render(); ?> -->