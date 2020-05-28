<?php

function ddglaw_post_types () {
  register_post_type('partner', array (
      //'capability_type' => 'event',
      //'map_meta_cap' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail'),
      'rewrite' => array('slug' => 'שותפים'),
      'public' => true,
      'labels' => array (
          'name' => 'שותף',
          'add_new' => 'הוסף שותף',
          'edit_item' => 'ערוך שותף',
          'all_items' => 'כל השותפים',
          'singular_name' => 'שותף'
      ),
      'menu_icon' => 'dashicons-businessperson'
  ));

  register_post_type('occupation', array (
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail'),
      'rewrite' => array('slug' => 'תחומי עיסוק'),
      'public' => true,
      'labels' => array (
          'name' => 'תחומי עיסוק',
          'add_new' => 'הוסף תחום עיסוק',
          'edit_item' => 'ערוך תחום עיסוק',
          'all_items' => 'כל תחומי העיסוק',
          'singular_name' => 'תחום עיסוק'
      ),
      'menu_icon' => 'dashicons-awards'
  ));

  register_post_type('notary', array (
      'has_archive' => true,
      'supports' => array('title'),
      // 'capability_type' => 'notary',
      // 'map_meta_cap' => true,
      'public' => true,
      'show_in_rest' => true,
      'rewrite' => array('slug' => 'notary'),
      'labels' => array (
          'name' => 'נוטריון',
          'add_new' => 'הוסף רשומה נוטריונית',
          'edit_item' => 'ערוך אימות נוטריוני',
          'all_items' => 'כל רשומות הנוטריון',
          'singular_name' => 'נוטריון',
      ),
      'menu_icon' => 'dashicons-awards'
  ));

  register_post_type('approval_kind', array (
      'has_archive' => false,
      'supports' => array('title'),
      'public' => true,
      'show_in_rest' => true,
      'labels' => array (
          'name' => 'סוגי אימותים נוטריוניים',
          'add_new' => 'הוסף סוג אימות',
          'edit_item' => 'ערוך סוג אימות',
          'all_items' => 'כל סיווגי האימותים הנוטריוניים',
          'singular_name' => 'סוג אימות נוטריוני'
      ),
      'menu_icon' => 'dashicons-businessperson'
  ));
}

add_action('init', 'ddglaw_post_types');
