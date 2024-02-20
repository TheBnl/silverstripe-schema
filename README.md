# Silverstripe Schema

Add schema's to you pages. This module comes with the following standard schema's

- Website schema
- Breadcrumbs schema

To find out more about these schema's and why you should include them on your page see the [documentation](https://developers.google.com/search/docs/data-types/data-type-selector) by Google.

The end goal is to have a module that adds the necessary tools to easily make your own schema's. This is possible by extending the base `SchemaBuilder` class.

### Creating new Schema's

An example schema builder, that returns a basic array with properties.

```php
/**
 * Class MySchemaBuilder
 */
class MySchemaBuilder extends SchemaBuilder
{
    public function getSchema($page)
    {
        $mySchema = array(
            // schema properties
        )
        return $mySchema;
    }
}
```

The output of the `get_schema()` method is json encoded and appended to the head of the page.
The output can either be an array or an object. For the standard builders, the module supplies different `SchemaTypes` where schema's can be build with as an alternative to an array.
You can inspect one of the predefined builder to see these types in action. A complete list of possible schema types to work with would be
one of the future features. Submitting a pull request with any Schema types or builders you created would be much appreciated!

### Adding Schema's

To add the schema's to different page types you simply specify these in the config as such:

```yaml
Page:
  default_image: 'path/to/logo.png'
  extensions:
    - 'Broarm\Schema\SchemaExtension'
  active_schema:
    - 'Broarm\Schema\Builder\LocalBusiness'
    - 'Broarm\Schema\Builder\Website'
    - 'Broarm\Schema\Builder\Breadcrumbs'
BlogPost:
  active_schema:
    - 'Broarm\Schema\Builder\NewsArticle'
```

#### LocalBusinessSchemaBuilder

The local business schema builder searches for the following fields on the SiteConfig. `Address`, `Suburb`, `State`, `Postcode`, `Country` and `Phone` these can be easily added by the `silverstripe-australia/addressable` module.
The local business builder also checks if the `Geocodable` extension is set and if so adds the lat and lng to the build schema.

#### BreadcrumbsSchemaBuilder

The breadcrumb schema builder looks for the standard `getBreadcrumbItems()` method.
You can overwrite this method on your page class if neccicary.

#### OrganizationSchemaBuilder

The organization builder requires a `phone` field on the site config.
For the `SameAs` field (Shows social media link in the knowledge graph box) the builder now looks for `SocialMediaPlatform` relations on SiteConfig.
This is something that will be changed for a more generic approach

#### WebsiteSchemaBuilder

The website schema builder set the site name and url and if FulltextSearchable is enabled it also adds an Search Action.
The search action is visible in google as a [Sitelinks Searchbox](https://developers.google.com/search/docs/data-types/sitelinks-searchbox).

### ToDo

The following Schema's are to be added in the near future, feel free to make a PR or any suggestions.

- Events
- Products
- Courses
- Music
- Recipes
- Reviews
- Movies
- TVSeason
- TVEpisode
- Videos
