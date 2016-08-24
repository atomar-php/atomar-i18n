<?php
/**
 * Created by PhpStorm.
 * User: joel
 * Date: 8/24/16
 * Time: 1:51 PM
 */

namespace i18n;


class I18n {
  /**
   * Returns a locale sensitive string
   *
   * @param string $slug the slug of the phrase that will be returned
   * @return string
   */
  public static function say($slug) {
    $i18n = variable_get('i18n', 'en');
    $phrase = \R::findOne('i18n', ' i18n=? and slug=? ', array($i18n, $slug));
    if ($phrase->id) {
      return $phrase->message;
    } else {
      return '';
    }
  }

  /**
   * sets the locale that will be used when fetching phrases in the method say().
   * @param  string $i18n
   */
  public static function select_locale($i18n) {
    variable_set('i18n', $i18n);
  }

  /**
   * Creates, updates, or removes a phrase translation.
   *
   * @param string $i18n the language this translation belongs to
   * @param string $slug the slug of the text
   * @param string $text the translation of the text
   * @return bool true if successful
   */
  public static function set_phrase($i18n, $slug, $text='') {
    $phrase = \R::findOne('i18n', ' i18n=? slug=? ', array($i18n, $slug));
    if (!$phrase->id && $text !== null) {
      // create new phrase
      $phrase = \R::dispense('i18n');
      $phrase->i18n = $i18n;
      $phrase->slug = $slug;
    }
    // trash phrase
    if ($text === null) {
      if ($phrase->id) \R::trash($phrase);
      return true;
    } else {
      // update phrase
      $phrase->text = $text;
      return store($phrase);
    }
  }

  /**
   * Creates, updates, or removes a language specification
   * @param string $i18n the language code
   * @param string $name the human readable name of the language
   * @return boolean
   */
  public static function set_language($i18n, $name='') {
    $language = \R::findOne('i18nlanguage', ' i18n=? ', array($i18n));
    if (!$language->id && $name !== null) {
      // create new language
      $language = \R::dispense('i18nlanguage');
      $language->i18n = $i18n;
    }
    // trash language
    if ($name === null) {
      if ($language->id) \R::trash($language);
      return true;
    } else {
      // update language
      $language->name = $name;
      return store($language);
    }
  }
}