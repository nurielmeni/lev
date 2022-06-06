<?php
class social_walker extends Walker_Nav_Menu
{
  public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    //parent::start_el($output, $item, $depth, $args);
    $output .= sprintf(
      '<li id="menu-item-%d" class="%s">
        <a target="%s" href="%s">
          <i class="btn-icon icon-%s" aria-hidden="true"></i>
          <span class="visible-hidden">%s</span>
        </a>',
      $item->ID,
      esc_html(implode(' ', $item->classes)),
      esc_html($item->target),
      esc_html($item->url),
      esc_html($item->description),
      esc_html($item->title)
    );
  }
}
