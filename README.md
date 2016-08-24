i18n
========

Provides language support to your site.

###PHP Methods
* `say(slug)` - return the appropriate text for the currently selected locale
* `select_locale(i18n)` - change the selected locale
* `set_phrase(i18n, slug, text)` - create, updated, or delete a phrase
* `set_language(i18n, name)` - create, update, or delete a language

All of the above methods are available as static methods
on the module class e.g. `\i18n\I18n::say()`.

###Template Methods
The below methods may be used within template files.

* `i18n_say(slug)` - works the same way as the method `say` above.
