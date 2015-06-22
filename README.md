# Redirects2
**Grav** plugin to redirect on a per page basis.

# Installation

Installing the Redirects2 plugin can only be done manually via a zip file until it is added to the Grav GPM.

## Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `redirects2`. You can find these files on [GitHub](https://github.com/dfrankland/grav-plugin-redirects2).

You should now have all the theme files under

    /your/site/grav/user/plugins/redirects2

# Updating

As development for the Redirects2 plugin continues, new versions may become available that add additional features and functionality, and improve compatibility with newer Grav releases. Updating Redirects2 can only be done manually until it is added to the Grav GPM.

## Manual Update

Manually updating Redirects2 is pretty simple. Here is what you will need to do to get this done:

* Delete the `your/site/user/plugins/redirects2` directory.
* Download the new version of the Redirects2 plugin from [GitHub](https://github.com/dfrankland/grav-plugin-redirects2).
* Unzip the zip file in `your/site/user/plugins` and rename the resulting folder to `redirects2`.
* Clear the Grav cache. The simplest way to do this is by going to the root Grav directory in terminal and typing `bin/grav clear-cache`.

> Note: Any changes you have made to any of the files listed under this directory will also be removed and replaced by the new set. Any files located elsewhere (for example a YAML settings file placed in `user/config/plugins`) will remain intact.

# Features

### URL (required)

Any URL that you wish to redirect a visitor to. The URL is validated by [FILTER_VALIDATE_URL](http://php.net/manual/en/filter.filters.validate.php) and must be a properly formatted URL according to [RFC 2396](http://www.faqs.org/rfcs/rfc2396.html).

```
redirects2:
  url: http://example.com
```

### HTTP Status Code (optional, default: 302)

Redirects may also specify an [HTTP/1.1 status code](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html) of [201](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html#sec10.2.2) or [3XX range](http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html#sec10.3) to be set before the redirect, according to the [PHP header() "Location:" parameter](http://php.net/manual/en/function.header.php#refsect1-function.header-parameters). If no status is set, header() will default to HTTP/1.1 status code 302 REDIRECT.

```
redirects2:
  url: http://example.com
  status: 303
```
