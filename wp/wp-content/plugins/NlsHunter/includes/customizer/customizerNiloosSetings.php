<?php
include_once NLS__PLUGIN_PATH . '/includes/Hunter/NlsConfig.php';

function add_niloos_settings_section($wp_customize, $panel)
{
  /**
   * Add the new Niloos section
   */
  $section = $wp_customize->add_section('nls_settings_service', [
    'title' => __('Services - WSDL', 'NlsHunter'),
    'description' => __('Niloos WSDL services', 'NlsHunter'),
    'panel' => $panel
  ]);

  /**
   * Add the Directory Service Setting
   */
  $wp_customize->add_setting('setting_' . NlsConfig::NLS_DIRECTORY_SERVICE, array(
    'default' => NlsConfig::NLS_DIRECTORY_SERVICE_DEFAULT,
    'type' => 'option',
  ));

  $wp_customize->add_control('control_' . NlsConfig::NLS_DIRECTORY_SERVICE, array(
    'label' => __('Set WSDL for directory service', 'NlsHunter'),
    'section' => $section->id,
    'settings' => 'setting_' . NlsConfig::NLS_DIRECTORY_SERVICE,
    'type' => 'url'
  ));

  /**
   * Add Cards Service Setting
   */
  $wp_customize->add_setting('setting_' . NlsConfig::NLS_CARDS_SERVICE, array(
    'default' => NlsConfig::NLS_CARDS_SERVICE_DEFAULT,
    'type' => 'option',
  ));

  $wp_customize->add_control('control_' . NlsConfig::NLS_CARDS_SERVICE, array(
    'label' => __('Set WSDL for cards service', 'NlsHunter'),
    'section' => $section->id,
    'settings' => 'setting_' . NlsConfig::NLS_CARDS_SERVICE,
    'type' => 'url'
  ));

  /**
   * Add Directory Security Setting
   */
  $wp_customize->add_setting('setting_' . NlsConfig::NLS_SECURITY_SERVICE, array(
    'default' => NlsConfig::NLS_SECURITY_SERVICE_DEFAULT,
    'type' => 'option',
  ));

  $wp_customize->add_control('control_' . NlsConfig::NLS_SECURITY_SERVICE, array(
    'label' => __('Set WSDL for security service', 'NlsHunter'),
    'section' => $section->id,
    'settings' => 'setting_' . NlsConfig::NLS_SECURITY_SERVICE,
    'type' => 'url'
  ));

  /**
   * Add Directory Serach Setting
   */
  $wp_customize->add_setting('setting_' . NlsConfig::NLS_SEARCH_SERVICE, array(
    'default' => NlsConfig::NLS_SEARCH_SERVICE_DEFAULT,
    'type' => 'option',
  ));

  $wp_customize->add_control('control_' . NlsConfig::NLS_SEARCH_SERVICE, array(
    'label' => __('Set WSDL for search service', 'NlsHunter'),
    'section' => $section->id,
    'settings' => 'setting_' . NlsConfig::NLS_SEARCH_SERVICE,
    'type' => 'url'
  ));
}
