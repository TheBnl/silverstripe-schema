# Silverstripe Schema

Add schema's to you pages. This module comes with the following standard schema's

- WebSite schema (home page only)
- WebPage schema
- Breadcrumbs schema

To find out more about these schema's and why you should include them on your page see the [documentation](https://developers.google.com/search/docs/data-types/data-type-selector) by Google.

To add your own schemasyou can extend the base `SchemaBuilder` class.

### Creating new Schema's

There are three steps to do so:

#### 1. Turn on any of the predefined schema's in spatie/schema-org

For example

```yaml
Broarm\Schema\ComposerCleanup\SpatieCleanup:
  keep_files:
    - 'vendor/spatie/schema-org/src/AboutPage.php'
```

The spatie/schema.org package is included in the module and can be used to create schema's.

The composer cleanup task is used to remove all the files from the spatie/schema-org package that are not used in the module.

This is done to keep the module as lightweight as possible.

#### 2. Create a new SchemaBuilder

An example schema builder, that returns a basic array with properties.

```php
namespace MyCompany\MyApp\Pages;

use Spatie\SchemaOrg\AboutPage;

/**
 * Class MySchemaBuilder
 */
class MyAboutPageSchema extends SchemaBuilder
{
    public function getSchema($page) :AboutPage
    {
        return (new AboutPage())
            ->name('My About Page')
            ->url($page->AbsoluteLink())
            // more examples here, chose as you see fit.
            ->description($page->MetaDescription)
            ->datePublished(new DateTimeImmutable($page->Created))
            ->dateModified(new DateTimeImmutable($page->LastEdited))
            ->image($page->Image()->AbsoluteLink())
            ->mainEntityOfPage($page->AbsoluteLink())
            ->inLanguage('en');

    }
}
```

The output of the `get_schema()` method is json encoded and appended to the head of the page.
The output can either be an array or an object.

#### 3. Add to page

To add the schema's to different page types you simply specify these in the config as such:

```yaml
MyCompany\MyApp\Pages\AboutPage:
  active_schema:
    - 'MyCompany\MyApp\Pages\AboutPageSchema'
```
