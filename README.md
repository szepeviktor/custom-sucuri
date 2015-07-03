# Sucuri Scanner custom settings

### Restrict the admin interface to a specific user

Copy this to your wp-config.php

```php
define( 'O1_SUCURI_USER', 'your-username' );
```

### Hide Sucuri WAF related UI elements

The WAF menu and tab are not useful for users without WAF subscription.
"Website Firewall protection" postbox on Hardening tab should be also hidden.

### Hide Sucuri ads

Ads in the Sucuri Scanner plugin could be hidden manually.
This plugin hides the ads.

### Set data store path.

Sucuri Scanner's default datastore path is in the uploads directory.
This plugin sets the datastore path to `wp-content/sucuri`.
