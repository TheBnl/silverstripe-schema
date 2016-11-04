# Silverstripe Schema

Add schema's to you pages. This module comes with the following standard schema's
- Website schema
- Breadcrumbs schema
- Organization schema
- Local Business Schema

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
    public static function get_schema($object)
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
Schema:
  logo: 'path/to/your/logo.png'
  config:
    # The standard builders
    'Page':
      - WebsiteSchemaBuilder
      - BreadcrumbsSchemaBuilder
      - OrganizationSchemaBuilder
    # An example blog post schema (builder not implemented yet)
    'BlogPost':
      - ArticleSchemaBuilder
```

#### LocalBusinessSchemaBuilder

The local business schema builder searches for the following fields on the SiteConfig. `Address`, `Suburb`, `State`, `Postcode`, `Country` and `Phone` these can be easily added by the `silverstripe-australia/addressable` module. 
The local business builder also checks if the `Geocodable` extension is set and if so adds the lat and lng to the build schema. 

#### BreadcrumbsSchemaBuilder

The breadcrumb schema builder looks for the standard `getBreadcrumbItems()` method. 
You can overwrite this method on your page class if neccicary.

#### OrganizationSchemaBuilder

The organization builder requires a `phone` field on the site config. 
For the same as the builder now looks for `SocialMediaPlatform` relations on SiteConfig. 
This is something that will be changed for a more generic approach  

#### WebsiteSchemaBuilder

The website schema builder set the site name and url and if FulltextSearchable is enabled it also adds an Search Action. 
The search action is visible in google as a [Sitelinks Searchbox](https://developers.google.com/search/docs/data-types/sitelinks-searchbox).

### ToDo

The following Schema's are to be added in the near future, feel free to make a PR or any suggestions.

- Events
- Products
- Articles
- Courses
- Music
- Recipes
- Reviews
- Movies
- TVSeason
- TVEpisode
- Videos

## License

Copyright (c) 2016, Bram de Leeuw
All rights reserved.

All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

 * Redistributions of source code must retain the above copyright
   notice, this list of conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright
   notice, this list of conditions and the following disclaimer in the
   documentation and/or other materials provided with the distribution.
 * The name of Bram de Leeuw may not be used to endorse or promote products
   derived from this software without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.