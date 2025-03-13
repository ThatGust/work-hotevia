<?php
/**
 * Theme defined pre-built layouts for
 * Site Origin Page Builder
 */

function newsplus_prebuilt_layouts( $layouts ){
$layouts['home-one'] = array (
	'name' => __( 'Home 01', 'newsplus' ),
	'description' => '',
	'screenshot' => get_template_directory_uri() . '/images/pb_screenshots/home_1.jpg',
  'widgets' => 
  array (
    0 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label black"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/featured/" title="View all posts in Featured">Featured</a></span> Our favorites</h2>

[posts_slider effect="slide" cats="" num="4" excerpt_length="150"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    1 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label red"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/blog/" title="View all latest news">Headlines</a></span> The most recent</h2>

[insert_posts num="6" display_style="list-small" cats="" ]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    2 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/technology/" title="View all posts in Technology">Technology</a></span> What\'s trending</h2>

[insert_posts cats="" num="2" display_style="two-col" excerpt_length="150"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 1,
        'cell' => 0,
        'id' => 2,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    3 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label orange">Popular</span> Most commented articles</h2>

[insert_posts cats="" num="2" display_style="list-big" excerpt_length="220" orderby="comment_count"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 0,
        'id' => 3,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    4 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label aqua">Staff Picks</span> The chosen ones from Editor</h2>

[posts_carousel cats="" num="8" excerpt_length="90"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 3,
        'cell' => 0,
        'id' => 4,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    1 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    2 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    3 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'weight' => 0.5,
    ),
    1 => 
    array (
      'grid' => 0,
      'weight' => 0.5,
    ),
    2 => 
    array (
      'grid' => 1,
      'weight' => 1,
    ),
    3 => 
    array (
      'grid' => 2,
      'weight' => 1,
    ),
    4 => 
    array (
      'grid' => 3,
      'weight' => 1,
    ),
  )
);

$layouts['home-two'] = array (
	'name' => __( 'Home 02', 'newsplus' ),
	'description' => '',
	'screenshot' => get_template_directory_uri() . '/images/pb_screenshots/home_2.jpg',
  'widgets' => 
  array (
    0 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label black"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/featured/" title="View all posts in Featured">Featured</a></span> Our favorites</h2>

[posts_slider effect="slide" cats="2" num="4" excerpt_length="150" imgwidth="560" imgheight="315"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    1 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label red"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/blog/" title="View all latest news">Headlines</a></span> Top News</h2>

[insert_posts display_style="one-col" num="1" cats="-1, -10" hide_excerpt="true" hide_meta="true" imgwidth="272" imgheight="153"]

[insert_posts display_style="list-plain" num="3" cats="-1, -10" offset="1"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    2 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/technology/" title="View all posts in Technology">Technology</a></span> What\'s trending</h2>

[insert_posts cats="5" num="3" display_style="three-col" excerpt_length="90" hide_video="true" imgwidth="272" imgheight="153"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 1,
        'cell' => 0,
        'id' => 2,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    3 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label orange">Lifestyle</span> People &amp; Culture</h2>

[insert_posts cats="4" num="3" display_style="three-col" excerpt_length="90" hide_video="true" imgwidth="272" imgheight="153"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 2,
        'cell' => 0,
        'id' => 3,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    4 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label aqua">Staff Picks</span> The chosen ones from Editor</h2>

[posts_carousel cats="4,5,6" num="8" excerpt_length="90" hide_video="true" imgwidth="272" imgheight="153"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 3,
        'cell' => 0,
        'id' => 4,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    1 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    2 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    3 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'weight' => 0.6670000000000000373034936274052597582340240478515625,
    ),
    1 => 
    array (
      'grid' => 0,
      'weight' => 0.333000000000000018207657603852567262947559356689453125,
    ),
    2 => 
    array (
      'grid' => 1,
      'weight' => 1,
    ),
    3 => 
    array (
      'grid' => 2,
      'weight' => 1,
    ),
    4 => 
    array (
      'grid' => 3,
      'weight' => 1,
    ),
  )
);

$layouts['home-three'] = array (
	'name' => __( 'Home 03', 'newsplus' ),
	'description' => '',
	'screenshot' => get_template_directory_uri() . '/images/pb_screenshots/home_3.jpg',
  'widgets' => 
  array (
    0 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label black"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/featured/" title="View all posts in Featured">Featured</a></span> Our favorites</h2>

[insert_posts cats="2" num="2" display_style="list-big" excerpt_length="280" hide_video="true" imgwidth="272" imgheight="153"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    1 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label red"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/technology/" title="View all posts in Technology">Technology</a></span> What\'s trending</h2>

[insert_posts display_style="one-col" num="1" cats="5" hide_excerpt="true" hide_meta="true" imgwidth="416" imgheight="234"]

[insert_posts display_style="list-small" num="3" cats="5" offset="1" imgwidth="80" imgheight="60"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 1,
        'cell' => 0,
        'id' => 1,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    2 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label brown"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/food/" title="View all posts in Food">Food</a></span> Dinner &amp; Recipe tips</h2>

[insert_posts display_style="one-col" num="1" cats="3" hide_excerpt="true" hide_meta="true" imgwidth="416" imgheight="234"]

[insert_posts display_style="list-small" num="3" cats="3" offset="1" imgwidth="80" imgheight="60"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 1,
        'cell' => 1,
        'id' => 2,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    3 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label aqua">Staff Picks</span> The chosen ones from Editor</h2>

[posts_carousel cats="2,3,4" num="8" excerpt_length="90" hide_video="true" imgwidth="272" imgheight="153"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 0,
        'id' => 3,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    4 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label blue"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/videos/" title="Watch all videos">Videos</a></span> from YouTube and Vimeo</h2>

[insert_posts display_style="two-col" num="2" cats="10" hide_meta="true" hide_excerpt="true" hide_video="true" imgwidth="416" imgheight="234"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 3,
        'cell' => 0,
        'id' => 4,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    5 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label orange"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in Lifestyle">Lifestyle</a></span> People and culture</h2>

[insert_posts cats="4" num="4" display_style="list-small" imgwidth="80" imgheight="60"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 4,
        'cell' => 0,
        'id' => 5,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    6 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label green"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in Photography">Photography</a></span> Tips &amp; Tricks</h2>

[insert_posts cats="6" num="4" display_style="list-small"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 4,
        'cell' => 1,
        'id' => 6,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '24px',
        'background_display' => 'tile',
      ),
    ),
    1 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '24px',
        'background_display' => 'tile',
      ),
    ),
    2 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '0px',
        'background_display' => 'tile',
      ),
    ),
    3 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    4 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'weight' => 1,
    ),
    1 => 
    array (
      'grid' => 1,
      'weight' => 0.5,
    ),
    2 => 
    array (
      'grid' => 1,
      'weight' => 0.5,
    ),
    3 => 
    array (
      'grid' => 2,
      'weight' => 1,
    ),
    4 => 
    array (
      'grid' => 3,
      'weight' => 1,
    ),
    5 => 
    array (
      'grid' => 4,
      'weight' => 0.5,
    ),
    6 => 
    array (
      'grid' => 4,
      'weight' => 0.5,
    ),
  )
);

$layouts['home-four'] = array (
	'name' => __( 'Home 04', 'newsplus' ),
	'description' => '',
	'screenshot' => get_template_directory_uri() . '/images/pb_screenshots/home_4.jpg',
  'widgets' => 
  array (
    0 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label black"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/featured/" title="View all posts in Featured">Featured</a></span> Our favorites</h2>

[posts_slider effect="slide" cats="2" num="4" excerpt_length="150" imgwidth="576" imgheight="324"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    1 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label red"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/blog/" title="View all latest news">Headlines</a></span> Top News</h2>

[insert_posts display_style="one-col" num="1" cats="-1,-10" hide_excerpt="true" hide_meta="true" imgwidth="272" imgheight="153"]

[insert_posts display_style="list-plain" num="3" cats="-1,-10" offset="1"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    2 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label brown"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/food/" title="View all posts in Food">Food</a></span> Dinner &amp; Recipe tips</h2>

[insert_posts display_style="three-col" num="3" cats="3" excerpt_length="90" hide_video="true" imgwidth="272" imgheight="153"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 1,
        'cell' => 0,
        'id' => 2,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    3 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label green"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in Photography">Photography</a></span> Tips &amp; Tricks</h2>

[insert_posts display_style="three-col" num="3" cats="6" excerpt_length="90" hide_video="true" imgwidth="272" imgheight="153"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 0,
        'id' => 3,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    4 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label orange"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in Lifestyle">Lifestyle</a></span> People and culture</h2>

[insert_posts cats="4" num="2" display_style="list-big" excerpt_length="280" hide_video="true" imgwidth="272" imgheight="153"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 3,
        'cell' => 0,
        'id' => 4,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    1 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    2 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    3 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'weight' => 0.6670000000000000373034936274052597582340240478515625,
    ),
    1 => 
    array (
      'grid' => 0,
      'weight' => 0.333000000000000018207657603852567262947559356689453125,
    ),
    2 => 
    array (
      'grid' => 1,
      'weight' => 1,
    ),
    3 => 
    array (
      'grid' => 2,
      'weight' => 1,
    ),
    4 => 
    array (
      'grid' => 3,
      'weight' => 1,
    ),
  )
);

$layouts['home-five'] = array (
	'name' => __( 'Home 05', 'newsplus' ),
	'description' => '',
	'screenshot' => get_template_directory_uri() . '/images/pb_screenshots/home_5.jpg',
  'widgets' => 
  array (
    0 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label red"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/blog/" title="View all latest news">Headlines</a></span> Top News</h2>

[insert_posts display_style="one-col" num="1" cats="-1,-10" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="272" imgheight="153"]

[insert_posts display_style="list-plain" num="3" cats="-1,-10" offset="1"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    1 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label black"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/featured/" title="View all posts in Featured">Featured</a></span> Our favorites</h2>

[posts_slider effect="slide" cats="2" num="4" excerpt_length="150" hide_video="true" imgwidth="560" imgheight="315"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    2 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label orange"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in Lifestyle">Lifestyle</a></span> People and culture</h2>

[insert_posts cats="4" num="2" display_style="list-big" excerpt_length="280" hide_video="true" imgwidth="272" imgheight="153"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 1,
        'cell' => 0,
        'id' => 2,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    3 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label blue"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/videos/" title="Watch all videos">Videos</a></span> from YouTube and Vimeo</h2>

[insert_posts display_style="three-col" num="3" cats="10" hide_meta="true" hide_excerpt="true" hide_video="true" imgwidth="272" imgheight="153"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 2,
        'cell' => 0,
        'id' => 3,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    4 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label green"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in Photography">Photography</a></span> Tips &amp; Tricks</h2>

[insert_posts display_style="three-col" num="3" cats="6" excerpt_length="90" hide_video="true" imgwidth="272" imgheight="153"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 3,
        'cell' => 0,
        'id' => 4,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    1 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    2 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    3 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'weight' => 0.333000000000000018207657603852567262947559356689453125,
    ),
    1 => 
    array (
      'grid' => 0,
      'weight' => 0.6670000000000000373034936274052597582340240478515625,
    ),
    2 => 
    array (
      'grid' => 1,
      'weight' => 1,
    ),
    3 => 
    array (
      'grid' => 2,
      'weight' => 1,
    ),
    4 => 
    array (
      'grid' => 3,
      'weight' => 1,
    ),
  )
);

$layouts['home-six'] = array (
	'name' => __( 'Home 06', 'newsplus' ),
	'description' => __( 'Use full width page template', 'newsplus' ),
	'screenshot' => get_template_directory_uri() . '/images/pb_screenshots/home_6.jpg',
  'widgets' => 
  array (
    0 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label black"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/featured/" title="View all posts in Featured">Featured</a></span> Our favorites</h2>

[posts_slider effect="slide" cats="2" num="4" excerpt_length="150" hide_video="true" imgwidth="384" imgheight="216"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    1 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label red"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/blog/" title="View all latest news">Headlines</a></span> The Most Recent</h2>

[insert_posts display_style="list-small" num="6" cats="-1,-10"  imgwidth="80" imgheight="60"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    2 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label orange">Popular</span> Most Commented</h2>

[insert_posts display_style="list-small" num="6" cats="-1,-10" orderby="comment_count"  imgwidth="80" imgheight="60"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 0,
        'cell' => 2,
        'id' => 2,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    3 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label brown"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/food/" title="View all posts in Food">Food</a></span> Dinner &amp; Recipe tips</h2>

[insert_posts display_style="three-col" num="6" cats="3" excerpt_length="90" hide_video="true" imgwidth="272" imgheight="153"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 1,
        'cell' => 0,
        'id' => 3,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    4 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label orange">Lifestyle</span> People &amp; Culture</h2>

[insert_posts display_style="one-col" num="1" cats="4" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="384" imgheight="216"]

[insert_posts display_style="list-small" num="5" cats="4" offset="1" imgwidth="80" imgheight="60"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 1,
        'cell' => 1,
        'id' => 4,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    5 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label green"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in Photography">Photography</a></span> Tips &amp; Tricks</h2>

[insert_posts display_style="one-col" num="1" cats="6" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="384" imgheight="216"]

[insert_posts display_style="list-small" num="5" cats="6" offset="1" imgwidth="80" imgheight="60"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 2,
        'cell' => 0,
        'id' => 5,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    6 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/technology/" title="View all posts in Technology">Technology</a></span> What\'s trending</h2>

[insert_posts display_style="three-col" num="6" cats="5" excerpt_length="90"  hide_video="true" imgwidth="272" imgheight="153"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 2,
        'cell' => 1,
        'id' => 6,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    1 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    2 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    1 => 
    array (
      'grid' => 0,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    2 => 
    array (
      'grid' => 0,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    3 => 
    array (
      'grid' => 1,
      'weight' => 0.6670000000000000373034936274052597582340240478515625,
    ),
    4 => 
    array (
      'grid' => 1,
      'weight' => 0.333000000000000018207657603852567262947559356689453125,
    ),
    5 => 
    array (
      'grid' => 2,
      'weight' => 0.333000000000000018207657603852567262947559356689453125,
    ),
    6 => 
    array (
      'grid' => 2,
      'weight' => 0.6670000000000000373034936274052597582340240478515625,
    ),
  )
);

$layouts['home-seven'] = array (
	'name' => __( 'Home 07', 'newsplus' ),
	'description' => '',
	'screenshot' => get_template_directory_uri() . '/images/pb_screenshots/home_7.jpg',
  'widgets' => 
  array (
    0 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label red"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/blog/" title="View all recent News">Headlines</a></span> Most recent news</h2>',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    1 => 
    array (
      'title' => '',
      'text' => '[insert_posts display_style="one-col" num="1" cats="-1,-10" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="416" imgheight="234"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 1,
        'cell' => 0,
        'id' => 1,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    2 => 
    array (
      'title' => '',
      'text' => '[insert_posts display_style="list-small" num="4" cats="-1,-10" offset="1" imgwidth="80" imgheight="60"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 1,
        'cell' => 1,
        'id' => 2,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    3 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label brown"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/food/" title="View all posts in Food">Food</a></span> Dinner &amp; Recipe tips</h2>',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 0,
        'id' => 3,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    4 => 
    array (
      'title' => '',
      'text' => '[insert_posts display_style="one-col" num="1" cats="3" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="416" imgheight="234"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 3,
        'cell' => 0,
        'id' => 4,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    5 => 
    array (
      'title' => '',
      'text' => '[insert_posts display_style="list-small" num="4" cats="3" offset="1" imgwidth="80" imgheight="60"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 3,
        'cell' => 1,
        'id' => 5,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    6 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label aqua"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/videos/" title="Watch all videos">Videos</a></span> from YouTube and Vimeo</h2>

[insert_posts cats="10" num="3" display_style="three-col" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="272" imgheight="153"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 4,
        'cell' => 0,
        'id' => 6,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    7 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/technology/" title="View all posts in Technology">Technology</a></span> What\'s trending</h2>',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 5,
        'cell' => 0,
        'id' => 7,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    8 => 
    array (
      'title' => '',
      'text' => '[insert_posts display_style="one-col" num="1" cats="5" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="416" imgheight="234"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 6,
        'cell' => 0,
        'id' => 8,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    9 => 
    array (
      'title' => '',
      'text' => '[insert_posts display_style="list-small" num="4" cats="5" offset="1" imgwidth="80" imgheight="60"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 6,
        'cell' => 1,
        'id' => 9,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    10 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label orange"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in Lifestyle">Lifestyle</a></span> All about people and culture</h2>',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 7,
        'cell' => 0,
        'id' => 10,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    11 => 
    array (
      'title' => '',
      'text' => '[insert_posts display_style="one-col" num="1" cats="4" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="416" imgheight="234"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 8,
        'cell' => 0,
        'id' => 11,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    12 => 
    array (
      'title' => '',
      'text' => '[insert_posts display_style="list-small" num="4" cats="4" offset="1" imgwidth="80" imgheight="60"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 8,
        'cell' => 1,
        'id' => 12,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '0px',
        'background_display' => 'tile',
      ),
    ),
    1 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    2 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '0px',
        'background_display' => 'tile',
      ),
    ),
    3 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    4 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    5 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '0px',
        'background_display' => 'tile',
      ),
    ),
    6 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    7 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '0px',
        'background_display' => 'tile',
      ),
    ),
    8 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'background_display' => 'tile',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'weight' => 1,
    ),
    1 => 
    array (
      'grid' => 1,
      'weight' => 0.5,
    ),
    2 => 
    array (
      'grid' => 1,
      'weight' => 0.5,
    ),
    3 => 
    array (
      'grid' => 2,
      'weight' => 1,
    ),
    4 => 
    array (
      'grid' => 3,
      'weight' => 0.5,
    ),
    5 => 
    array (
      'grid' => 3,
      'weight' => 0.5,
    ),
    6 => 
    array (
      'grid' => 4,
      'weight' => 1,
    ),
    7 => 
    array (
      'grid' => 5,
      'weight' => 1,
    ),
    8 => 
    array (
      'grid' => 6,
      'weight' => 0.5,
    ),
    9 => 
    array (
      'grid' => 6,
      'weight' => 0.5,
    ),
    10 => 
    array (
      'grid' => 7,
      'weight' => 1,
    ),
    11 => 
    array (
      'grid' => 8,
      'weight' => 0.5,
    ),
    12 => 
    array (
      'grid' => 8,
      'weight' => 0.5,
    ),
  )
);

$layouts['home-eight'] = array (
	'name' => __( 'Home 08', 'newsplus' ),
	'description' => __( 'Use full width page template', 'newsplus' ),
	'screenshot' => get_template_directory_uri() . '/images/pb_screenshots/home_8.jpg',
  'widgets' => 
  array (
    0 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label black"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/featured/" title="View all posts in Featured">Featured</a></span> Our favorites</h2>

[insert_posts display_style="one-col" num="1" cats="2" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="384" imgheight="216"]

[insert_posts display_style="list-small" num="5" cats="2" offset="1" imgwidth="80" imgheight="60"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    1 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label red"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/blog/" title="View all latest news">Headlines</a></span> The Most Recent</h2>

[insert_posts display_style="three-col" num="6" cats="-1,-10" excerpt_length="90" hide_video="true"  imgwidth="272" imgheight="153"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 0,
        'cell' => 1,
        'id' => 1,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    2 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label orange"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in Lifestyle">Lifestyle</a></span> People and culture</h2>

[insert_posts display_style="three-col" num="6" cats="4" excerpt_length="90" hide_video="true"  imgwidth="272" imgheight="153"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 1,
        'cell' => 0,
        'id' => 2,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    3 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label green"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in Photography">Photography</a></span> Tips &amp; Tricks</h2>

[insert_posts display_style="one-col" num="1" cats="6" hide_excerpt="true" hide_meta="true" hide_video="true"  imgwidth="384" imgheight="216"]

[insert_posts display_style="list-small" num="5" cats="6" offset="1" imgwidth="80" imgheight="60"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 1,
        'cell' => 1,
        'id' => 3,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    1 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'weight' => 0.333000000000000018207657603852567262947559356689453125,
    ),
    1 => 
    array (
      'grid' => 0,
      'weight' => 0.6670000000000000373034936274052597582340240478515625,
    ),
    2 => 
    array (
      'grid' => 1,
      'weight' => 0.6670000000000000373034936274052597582340240478515625,
    ),
    3 => 
    array (
      'grid' => 1,
      'weight' => 0.333000000000000018207657603852567262947559356689453125,
    ),
  )
);

$layouts['home-nine'] = array (
	'name' => __( 'Home 09', 'newsplus' ),
	'description' => __( 'Use full width page template', 'newsplus' ),
	'screenshot' => get_template_directory_uri() . '/images/pb_screenshots/home_9.jpg',
  'widgets' => 
  array (
    0 => 
    array (
      'title' => '',
      'text' => '[newsplus_news_ticker cats="-1" num="6"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    1 => 
    array (
      'title' => '',
      'text' => '[newsplus_grid_list cats="2" display_style="s1" num="5" aspect_ratio=".75" viewport_width="1112"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 1,
        'cell' => 0,
        'id' => 1,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    2 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label black">Featured</span> Story of month</h2>

[insert_posts query_type="posts" posts="67" display_style="one-col" num="1" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="384" imgheight="216"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 0,
        'id' => 2,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    3 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label teal"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in lifestyle">Lifestyle</a></span> Personal and Social</h2>

[insert_posts display_style="list-small" cats="4" num="4" imgwidth="80" imgheight="60"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 1,
        'id' => 3,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    4 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label orange">Popular</span> Most Commented</h2>

[insert_posts display_style="list-small" num="4" cats="-1" orderby="comment_count" imgwidth="80" imgheight="60"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 2,
        'id' => 4,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    5 => 
    array (
      'title' => '',
      'text' => '<a href="#"><img src="http://labs.saurabh-sharma.net/themes/newsplus/wp/wp-content/uploads/2016/05/ad_960.jpg" alt=""/></a>',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 3,
        'cell' => 0,
        'id' => 5,
        'style' => 
        array (
          'widget_css' => 'text-align: center;',
          'background_display' => 'tile',
        ),
      ),
    ),
    6 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label brown"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/food/" title="View all posts in Food">Food</a></span> Dinner &amp; Recipe tips</h2>

[insert_posts display_style="one-col" num="1" cats="3" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="384" imgheight="216"]

[insert_posts display_style="list-small" num="3" cats="3" offset="1" imgwidth="80" imgheight="60"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 4,
        'cell' => 0,
        'id' => 6,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    7 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label teal"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/photography/" title="View all posts in Photography">Photography</a></span> Techniques and tips</h2>

[insert_posts display_style="one-col" num="1" cats="6" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="384" imgheight="216"]

[insert_posts display_style="list-small" num="3" cats="6" offset="1" imgwidth="80" imgheight="60"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 4,
        'cell' => 1,
        'id' => 7,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    8 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label deep-orange"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/technology/" title="View all posts in Photography">Technology</a></span> See what\'s new</h2>

[insert_posts display_style="one-col" num="1" cats="5" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="384" imgheight="216"]

[insert_posts display_style="list-small" num="3" cats="5" offset="1" imgwidth="80" imgheight="60"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 4,
        'cell' => 2,
        'id' => 8,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    9 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label blue"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/videos/" title="View all posts in Videos">Videos</a></span> Most amazing ones</h2>

[insert_posts display_style="two-col" num="2" cats="10" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="400" imgheight="225" xclass="font-small"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 5,
        'cell' => 0,
        'id' => 9,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    10 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label red"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/videos/" title="View all posts chosen by staff">Handpicked</a></span> by staff</h2>

[insert_posts display_style="two-col" num="2" cats="10" hide_excerpt="true" hide_meta="true" hide_video="true" offset="2" xclass="font-small" imgwidth="400" imgheight="225"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 5,
        'cell' => 1,
        'id' => 10,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '32px',
        'background_display' => 'tile',
      ),
    ),
    1 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '40px',
        'background_display' => 'tile',
      ),
    ),
    2 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'bottom_margin' => '20px',
        'background_display' => 'tile',
      ),
    ),
    3 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '40px',
        'background_display' => 'tile',
      ),
    ),
    4 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'class' => 'font-small',
        'bottom_margin' => '24px',
        'background_image_attachment' => false,
        'background_display' => 'tile',
      ),
    ),
    5 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '0px',
        'background_image_attachment' => false,
        'background_display' => 'tile',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'weight' => 1,
    ),
    1 => 
    array (
      'grid' => 1,
      'weight' => 1,
    ),
    2 => 
    array (
      'grid' => 2,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    3 => 
    array (
      'grid' => 2,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    4 => 
    array (
      'grid' => 2,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    5 => 
    array (
      'grid' => 3,
      'weight' => 1,
    ),
    6 => 
    array (
      'grid' => 4,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    7 => 
    array (
      'grid' => 4,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    8 => 
    array (
      'grid' => 4,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    9 => 
    array (
      'grid' => 5,
      'weight' => 0.5,
    ),
    10 => 
    array (
      'grid' => 5,
      'weight' => 0.5,
    ),
  )
);

$layouts['home-ten'] = array (
	'name' => __( 'Home 10', 'newsplus' ),
	'description' => __( 'Use full width page template', 'newsplus' ),
	'screenshot' => get_template_directory_uri() . '/images/pb_screenshots/home_10.jpg',
  'widgets' => 
  array (
    0 => 
    array (
      'title' => '',
      'text' => '[newsplus_news_ticker cats="-1" num="6"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    1 => 
    array (
      'title' => '',
      'text' => '[newsplus_grid_list cats="2" display_style="s2" num="7" aspect_ratio="1" viewport_width="1112"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 1,
        'cell' => 0,
        'id' => 1,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    2 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label brown"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/food/" title="View all posts in Food">Food</a></span> Dinner &amp; Recipe tips</h2>

[insert_posts display_style="one-col" num="1" cats="3" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="400" imgheight="225"]

[insert_posts display_style="list-small" num="3" cats="3" offset="1"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 0,
        'id' => 2,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    3 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label teal"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/photography/" title="View all posts in Photography">Photography</a></span> Techniques and tips</h2>

[insert_posts display_style="one-col" num="1" cats="6" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="400" imgheight="225"]

[insert_posts display_style="list-small" num="3" cats="6" offset="1"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 1,
        'id' => 3,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    4 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label deep-orange"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/technology/" title="View all posts in Photography">Technology</a></span> See what\'s new</h2>

[insert_posts display_style="one-col" num="1" cats="5" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="400" imgheight="225"]

[insert_posts display_style="list-small" num="3" cats="5" offset="1"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 2,
        'id' => 4,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    5 => 
    array (
      'title' => '',
      'text' => '<a href="#"><img src="http://labs.saurabh-sharma.net/themes/newsplus/wp/wp-content/uploads/2016/05/ad_960.jpg" alt=""/></a>',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 3,
        'cell' => 0,
        'id' => 5,
        'style' => 
        array (
          'widget_css' => 'text-align: center;',
          'background_display' => 'tile',
        ),
      ),
    ),
    6 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label black">Featured</span> Story of month</h2>

[insert_posts query_type="posts" posts="67" display_style="one-col" num="1" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="400" imgheight="225"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 4,
        'cell' => 0,
        'id' => 6,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    7 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label teal"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in lifestyle">Lifestyle</a></span> Personal and Social</h2>

[insert_posts display_style="list-small" cats="4" num="4"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 4,
        'cell' => 1,
        'id' => 7,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    8 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label orange">Popular</span> Most Commented</h2>

[insert_posts display_style="list-small" num="4" cats="-1" orderby="comment_count"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 4,
        'cell' => 2,
        'id' => 8,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    9 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label blue"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/videos/" title="View all posts in Videos">Videos</a></span> Most amazing ones</h2>

[insert_posts display_style="two-col" num="2" cats="10" hide_excerpt="true" hide_meta="true" hide_video="true" xclass="font-small" imgwidth="400" imgheight="225"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 5,
        'cell' => 0,
        'id' => 9,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    10 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label red"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/videos/" title="View all posts chosen by staff">Handpicked</a></span> by staff</h2>

[insert_posts display_style="two-col" num="2" cats="10" hide_excerpt="true" hide_meta="true" hide_video="true" offset="2" xclass="font-small" imgwidth="400" imgheight="225"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 5,
        'cell' => 1,
        'id' => 10,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '32px',
        'background_display' => 'tile',
      ),
    ),
    1 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '40px',
        'background_display' => 'tile',
      ),
    ),
    2 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'class' => 'font-small',
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    3 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '40px',
        'background_display' => 'tile',
      ),
    ),
    4 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'bottom_margin' => '20px',
        'background_display' => 'tile',
      ),
    ),
    5 => 
    array (
      'cells' => 2,
      'style' => 
      array (
        'bottom_margin' => '0px',
        'background_image_attachment' => false,
        'background_display' => 'tile',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'weight' => 1,
    ),
    1 => 
    array (
      'grid' => 1,
      'weight' => 1,
    ),
    2 => 
    array (
      'grid' => 2,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    3 => 
    array (
      'grid' => 2,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    4 => 
    array (
      'grid' => 2,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    5 => 
    array (
      'grid' => 3,
      'weight' => 1,
    ),
    6 => 
    array (
      'grid' => 4,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    7 => 
    array (
      'grid' => 4,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    8 => 
    array (
      'grid' => 4,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    9 => 
    array (
      'grid' => 5,
      'weight' => 0.5,
    ),
    10 => 
    array (
      'grid' => 5,
      'weight' => 0.5,
    ),
  )
);

$layouts['home-eleven'] = array (
	'name' => __( 'Home 11', 'newsplus' ),
	'description' => __( 'Use full width page template', 'newsplus' ),
	'screenshot' => get_template_directory_uri() . '/images/pb_screenshots/home_11.jpg',
  'widgets' => 
  array (
    0 => 
    array (
      'title' => '',
      'text' => '[newsplus_news_ticker cats="-1" num="6"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 0,
        'cell' => 0,
        'id' => 0,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    1 => 
    array (
      'title' => '',
      'text' => '[newsplus_grid_list cats="2" display_style="s1" num="9" aspect_ratio=".666" viewport_width="1112"]',
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'grid' => 1,
        'cell' => 0,
        'id' => 1,
        'style' => 
        array (
          'background_image_attachment' => false,
          'background_display' => 'tile',
        ),
      ),
      'filter' => false,
    ),
    2 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label black">Featured</span> Story of month</h2>

[insert_posts query_type="posts" posts="67" display_style="one-col" num="1" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="400" imgheight="225"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 0,
        'id' => 2,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    3 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label teal"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/lifestyle/" title="View all posts in lifestyle">Lifestyle</a></span> Personal and Social</h2>

[insert_posts display_style="list-small" cats="4" num="4"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 1,
        'id' => 3,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    4 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label orange">Popular</span> Most Commented</h2>

[insert_posts display_style="list-small" num="4" cats="-1" orderby="comment_count"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 2,
        'cell' => 2,
        'id' => 4,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    5 => 
    array (
      'title' => '',
      'text' => '<a href="#"><img src="http://labs.saurabh-sharma.net/themes/newsplus/wp/wp-content/uploads/2016/05/ad_960.jpg" alt=""/></a>',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 3,
        'cell' => 0,
        'id' => 5,
        'style' => 
        array (
          'widget_css' => 'text-align: center;',
          'background_display' => 'tile',
        ),
      ),
    ),
    6 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label brown"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/food/" title="View all posts in Food">Food</a></span> Dinner &amp; Recipe tips</h2>

[insert_posts display_style="one-col" num="1" cats="3" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="400" imgheight="225"]

[insert_posts display_style="list-small" num="3" cats="3" offset="1"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 4,
        'cell' => 0,
        'id' => 6,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    7 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label teal"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/photography/" title="View all posts in Photography">Photography</a></span> Techniques and tips</h2>

[insert_posts display_style="one-col" num="1" cats="6" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="400" imgheight="225"]

[insert_posts display_style="list-small" num="3" cats="6" offset="1"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 4,
        'cell' => 1,
        'id' => 7,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    8 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label deep-orange"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/technology/" title="View all posts in Photography">Technology</a></span> See what\'s new</h2>

[insert_posts display_style="one-col" num="1" cats="5" hide_excerpt="true" hide_meta="true" hide_video="true" imgwidth="400" imgheight="225"]

[insert_posts display_style="list-small" num="3" cats="5" offset="1"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 4,
        'cell' => 2,
        'id' => 8,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    9 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label blue"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/videos/" title="View all posts in Videos">Videos</a></span> Most amazing ones</h2>

[insert_posts display_style="two-col" num="2" cats="10" hide_excerpt="true" hide_meta="true" hide_video="true" xclass="font-small" imgwidth="400" imgheight="225"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 5,
        'cell' => 0,
        'id' => 9,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
    10 => 
    array (
      'title' => '',
      'text' => '<h2 class="section-title"><span class="ss-label red"><a href="http://labs.saurabh-sharma.net/themes/newsplus/wp/category/videos/" title="View all posts chosen by staff">Handpicked</a></span> by staff</h2>

[insert_posts display_style="two-col" num="2" cats="10" hide_excerpt="true" hide_meta="true" hide_video="true" offset="2" xclass="font-small" imgwidth="400" imgheight="225"]',
      'filter' => false,
      'panels_info' => 
      array (
        'class' => 'WP_Widget_Text',
        'raw' => false,
        'grid' => 5,
        'cell' => 1,
        'id' => 10,
        'style' => 
        array (
          'background_display' => 'tile',
        ),
      ),
    ),
  ),
  'grids' => 
  array (
    0 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '32px',
        'background_display' => 'tile',
      ),
    ),
    1 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '40px',
        'background_display' => 'tile',
      ),
    ),
    2 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'bottom_margin' => '20px',
        'background_display' => 'tile',
      ),
    ),
    3 => 
    array (
      'cells' => 1,
      'style' => 
      array (
        'bottom_margin' => '40px',
        'background_display' => 'tile',
      ),
    ),
    4 => 
    array (
      'cells' => 3,
      'style' => 
      array (
        'class' => 'font-small',
        'bottom_margin' => '16px',
        'background_display' => 'tile',
      ),
    ),
    5 => 
    array (
      'cells' => 2,

      'style' => 
      array (
        'bottom_margin' => '0px',
        'background_image_attachment' => false,
        'background_display' => 'tile',
      ),
    ),
  ),
  'grid_cells' => 
  array (
    0 => 
    array (
      'grid' => 0,
      'weight' => 1,
    ),
    1 => 
    array (
      'grid' => 1,
      'weight' => 1,
    ),
    2 => 
    array (
      'grid' => 2,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    3 => 
    array (
      'grid' => 2,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    4 => 
    array (
      'grid' => 2,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    5 => 
    array (
      'grid' => 3,
      'weight' => 1,
    ),
    6 => 
    array (
      'grid' => 4,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    7 => 
    array (
      'grid' => 4,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    8 => 
    array (
      'grid' => 4,
      'weight' => 0.333333333333333314829616256247390992939472198486328125,
    ),
    9 => 
    array (
      'grid' => 5,
      'weight' => 0.5,
    ),
    10 => 
    array (
      'grid' => 5,
      'weight' => 0.5,
    ),
  )
);

return $layouts;
}

add_filter( 'siteorigin_panels_prebuilt_layouts', 'newsplus_prebuilt_layouts' );
?>