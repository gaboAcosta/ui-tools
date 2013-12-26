GaboAcosta UI-Tools

This is a library I'm building to make my work easier

Currently I'm working a lot with zurb/foundation and Laravel and one of the must cumbersome part of the
development to me is coding a navigation bar which is aware of the route it's in so it can
highlight menus and elements to provide a visual guide.

Here is where the NavBar part of the UI-Tools comes into play.

To start add to the requirements in your composer.json:

```
"gaboacosta/ui-tools": "dev-master"
```

Next, copy the file /vendor/gaboacosta/ui-tools/GaboAcosta/UITools/NaviGation/config.navBar.php
to your /app/config folder, dont forget to rename it. You should now have /app/config/navBar.php

Next open up in your favorite editor /app/config/app.php and add this line to the providers array:

'GaboAcosta\UITools\Navigation\NavBarServiceProvider',

And this to your aliases array:

'NavBar'          => 'GaboAcosta\UITools\Navigation\FoundationNavBar',


Then open up the config file /app/config/navBar.php

Please note that the array for the menu entries is called routes, this means that as of this release you must
bind every menu item to a named route, I've provided a field called implemented so you can elements which don't
have a route yet, but the link to those will be just a #

http://laravel.com/docs/routing#named-routes


Finally In the layout or view where you want to display this menu just call:

NavBar::render()


Please help me improve this project by reporting issues or making pull request to add functionality

Also please remember that you will have to manually get zurb/foundation working in your project to be able
to use this library.

http://foundation.zurb.com/docs/