# Magento Store Information
Get information about your Magento 2 store using GET requests to REST API endpoints.

The module is developed for Magento version **2.4.3**

# Usage

### Endpoints

- basic info: `/rest/V1/reiterus/informer`
- detail info: `/rest/V1/reiterus/informer/detail`

### Responses

Basic information for an anonymous user
```json
{
    "version": "2.4.3",
    "locale": "en_US",
    "timezone": "America\/Chicago",
    "currency": "USD"
}
```

The list of detailed information is formed at your discretion, it may look like this.
```json
[
    {
        "lifetime_sales": "29.00",
        "average_order": "14.50",
        "orders_number": "2",
        "customers_number": "1",
        "admins_number": "3",
        "extended_data": "from main application"
    }
]
```

### Set detail info
To generate a set of extended data for detailed information, 
you can use the plugin from the "[example](example/Plugin/InformerBefore.php)" directory. 
Don't forget to include the following information in your `di.xml` file.

```xml
<type name="Reiterus\Informer\Model\Informer">
    <plugin name="reiterus_fill_detail_info"
            type="Vendor\Module\Plugin\InformerBefore" />
</type>
```

### Endpoint testing

To check the functionality of endpoints via PhpStorm, you can use files from the request directory:

- base.http: get minimal base information
- detail.http: get detailed information you need
- token.http: get admin token

See more in the "[request](request)" folder.

# Installation
You can install the bundle in two ways

From packagist.org
```shell
composer require reiterus/informer-magento
```

From GitHub repository
```json
{
 "repositories": [
  {
   "type": "vcs",
   "url": "https://github.com/reiterus/informer-magento.git"
  }
 ]
}
```

# License

This library is released under the [MIT license](LICENSE).
