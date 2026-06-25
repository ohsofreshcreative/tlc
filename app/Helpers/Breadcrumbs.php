<?php 

namespace App\Helpers;

class Breadcrumbs
{
    public static function render(array $args = []): string
    {
        $defaults = [
            'home_label'      => __('Strona główna', 'custom'),
            'separator'       => '<span class="breadcrumbs__sep  font-black primary">•</span>',
            'container_class' => 'breadcrumbs absolute top-0 left-0 pl-6',
            'list_class'      => 'breadcrumbs__list flex gap-2',
            'item_class'      => 'breadcrumbs__item',
            'link_class'      => 'breadcrumbs__link',
            'current_class'   => 'breadcrumbs__current text-p-lighter',
            'show_home'       => true,
            'include_current' => true,
            'max_depth'       => 50,
        ];

        $a = array_merge($defaults, $args);

        // Don’t show on front page.
        if (is_front_page()) {
            return '';
        }

        $items = [];
        $pos = 1;

        $add = function (string $label, ?string $url = null, bool $current = false) use (&$items, &$pos) {
            $items[] = [
                'label'   => wp_strip_all_tags($label),
                'url'     => $url ? esc_url($url) : null,
                'current' => $current,
                'pos'     => $pos++,
            ];
        };

        // Home
        if (!empty($a['show_home'])) {
            $add($a['home_label'], home_url('/'), false);
        }

        // Helpers
        $add_page_ancestors = function (int $page_id) use (&$add, $a) {
            $ancestors = get_post_ancestors($page_id);
            if (!$ancestors) return;

            $ancestors = array_reverse($ancestors);
            $depth = 0;

            foreach ($ancestors as $ancestor_id) {
                if ($depth++ >= (int) $a['max_depth']) break;
                $add(get_the_title($ancestor_id), get_permalink($ancestor_id), false);
            }
        };

        $add_post_terms_chain = function (int $post_id, string $taxonomy) use (&$add, $a) {
            $terms = get_the_terms($post_id, $taxonomy);
            if (empty($terms) || is_wp_error($terms)) return;

            // Pick “primary” term: deepest term by parent chain, fallback first.
            $best = null;
            $bestDepth = -1;

            foreach ($terms as $t) {
                $depth = 0;
                $p = $t;
                while ($p && $p->parent) {
                    $p = get_term($p->parent, $taxonomy);
                    if (is_wp_error($p) || !$p) break;
                    $depth++;
                    if ($depth >= (int) $a['max_depth']) break;
                }
                if ($depth > $bestDepth) {
                    $bestDepth = $depth;
                    $best = $t;
                }
            }

            if (!$best) {
                $best = $terms[0];
            }

            // Add ancestors terms
            $anc = get_ancestors($best->term_id, $taxonomy);
            if (!empty($anc)) {
                $anc = array_reverse($anc);
                $depth = 0;
                foreach ($anc as $term_id) {
                    if ($depth++ >= (int) $a['max_depth']) break;
                    $term = get_term($term_id, $taxonomy);
                    if ($term && !is_wp_error($term)) {
                        $add($term->name, get_term_link($term), false);
                    }
                }
            }

            // Add current term (as part of chain, not “current page”)
            $add($best->name, get_term_link($best), false);
        };

        // MAIN ROUTING
        if (is_home()) {
            // Blog page
            $blog_id = (int) get_option('page_for_posts');
            if ($blog_id) {
                $add(get_the_title($blog_id), get_permalink($blog_id), true);
            } else {
                $add(__('Blog', 'custom'), null, true);
            }
        }
        elseif (is_search()) {
            $add(sprintf(__('Wyniki wyszukiwania: %s', 'custom'), get_search_query()), null, true);
        }
        elseif (is_404()) {
            $add(__('Nie znaleziono (404)', 'custom'), null, true);
        }
        elseif (is_category() || is_tag() || is_tax()) {
            $term = get_queried_object();
            if ($term && isset($term->term_id, $term->taxonomy)) {
                // Term ancestors
                $anc = get_ancestors($term->term_id, $term->taxonomy);
                if (!empty($anc)) {
                    $anc = array_reverse($anc);
                    $depth = 0;
                    foreach ($anc as $term_id) {
                        if ($depth++ >= (int) $a['max_depth']) break;
                        $t = get_term($term_id, $term->taxonomy);
                        if ($t && !is_wp_error($t)) {
                            $add($t->name, get_term_link($t), false);
                        }
                    }
                }
                $add($term->name, get_term_link($term), true);
            }
        }
        elseif (is_post_type_archive()) {
            $pt = get_query_var('post_type');
            if (is_array($pt)) $pt = reset($pt);
            $obj = $pt ? get_post_type_object($pt) : null;
            $add($obj && !empty($obj->labels->name) ? $obj->labels->name : __('Archiwum', 'custom'), null, true);
        }
        elseif (is_singular()) {
            $post_id = get_the_ID();
            $post_type = get_post_type($post_id);

            // WooCommerce product
            if ($post_type === 'product') {
                if (function_exists('wc_get_page_id')) {
                    $shop_id = (int) wc_get_page_id('shop');
                    if ($shop_id && $shop_id > 0) {
                        $add(get_the_title($shop_id), get_permalink($shop_id), false);
                    } else {
                        $add(__('Sklep', 'custom'), function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : null, false);
                    }
                } else {
                    $add(__('Sklep', 'custom'), null, false);
                }

                // Product category chain
                $add_post_terms_chain($post_id, 'product_cat');

                if (!empty($a['include_current'])) {
                    $add(get_the_title($post_id), null, true);
                }
            }
            // Standard post
            elseif ($post_type === 'post') {
                // Blog page if set
                $blog_id = (int) get_option('page_for_posts');
                if ($blog_id) {
                    $add(get_the_title($blog_id), get_permalink($blog_id), false);
                } else {
                    $add(__('Blog', 'custom'), get_post_type_archive_link('post'), false);
                }

                // Category chain
                $add_post_terms_chain($post_id, 'category');

                if (!empty($a['include_current'])) {
                    $add(get_the_title($post_id), null, true);
                }
            }
            // Pages
            elseif ($post_type === 'page') {
                $add_page_ancestors($post_id);
                if (!empty($a['include_current'])) {
                    $add(get_the_title($post_id), null, true);
                }
            }
            // Any CPT
            else {
                $obj = get_post_type_object($post_type);

                // Try to add CPT archive link (if exists)
                if ($obj && !empty($obj->has_archive)) {
                    $add($obj->labels->name ?? $obj->label ?? ucfirst($post_type), get_post_type_archive_link($post_type), false);
                } else {
                    // Fallback: just CPT label without link
                    $add($obj->labels->name ?? $obj->label ?? ucfirst($post_type), null, false);
                }

                // Optional taxonomy chain for CPT:
                // Picks the first "public" taxonomy for this CPT and adds its term chain (if any).
                $taxes = get_object_taxonomies($post_type, 'objects');
                if (!empty($taxes)) {
                    foreach ($taxes as $tax) {
                        if (empty($tax->public)) continue;
                        // Skip weird ones
                        if (in_array($tax->name, ['post_format'], true)) continue;

                        $terms = get_the_terms($post_id, $tax->name);
                        if (!empty($terms) && !is_wp_error($terms)) {
                            $add_post_terms_chain($post_id, $tax->name);
                            break; // only one taxonomy chain
                        }
                    }
                }

                if (!empty($a['include_current'])) {
                    $add(get_the_title($post_id), null, true);
                }
            }
        }
        else {
            // Any other archives
            if (is_date()) {
                $add(get_the_archive_title(), null, true);
            } elseif (is_author()) {
                $add(get_the_archive_title(), null, true);
            } else {
                $add(get_the_archive_title(), null, true);
            }
        }

        // Render HTML
        if (count($items) <= 1) {
            return '';
        }

        $container_class = esc_attr($a['container_class']);
        $list_class = esc_attr($a['list_class']);
        $item_class = esc_attr($a['item_class']);
        $link_class = esc_attr($a['link_class']);
        $current_class = esc_attr($a['current_class']);
        $sep = $a['separator'];

        $html  = '<nav class="' . $container_class . '" aria-label="' . esc_attr__('Breadcrumbs', 'custom') . '">';
        $html .= '<ol class="' . $list_class . '" itemscope itemtype="https://schema.org/BreadcrumbList">';

        $lastIndex = count($items) - 1;

        foreach ($items as $i => $it) {
            $isCurrent = !empty($it['current']) || $i === $lastIndex;

            $html .= '<li class="' . $item_class . '" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';

            if (!empty($it['url']) && !$isCurrent) {
                $html .= '<a class="' . $link_class . '" itemprop="item" href="' . $it['url'] . '">';
                $html .= '<span itemprop="name">' . esc_html($it['label']) . '</span>';
                $html .= '</a>';
            } else {
                $html .= '<span class="' . $current_class . '" aria-current="page" itemprop="name">' . esc_html($it['label']) . '</span>';
            }

            $html .= '<meta itemprop="position" content="' . (int) $it['pos'] . '">';
            $html .= '</li>';

            if ($i !== $lastIndex) {
                $html .= $sep;
            }
        }

        $html .= '</ol></nav>';

        return $html;
    }
}

