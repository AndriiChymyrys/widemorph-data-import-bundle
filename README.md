# Morph data import

Intended for populate entities with data from excel/csv file and from api endpoint

### Install
Import routing to `routes.yaml`
```yaml
morph_data_import:
    resource: "@MorphDataImportBundle/Resources/config/routes/routing.xml"
    prefix: "morph_data_import"
    name_prefix: "morph_data_import_"
```

### Configuration
Add file `morph_data_import.yaml` in `config/packages` with content
```yaml
morph_data_import:
```
#### Include/Exclude Entities
By default, all entities in folder `src/Entity` are included, and you can import data for them

To exclude entities you can use field `exclude_entity` from config and specify entity namespace
```yaml
morph_data_import:
    exclude_entity:
        - 'App\Entity\InnerEntity'
```
To include only specific entities use field `include_entity` 
```yaml
morph_data_import:
    include_entity:
        - 'App\Entity\PublicEntity'
```
#### Config specific entity
To configure specific entity set entity namespace in `entities` field.

To exclude entity properties you can use:
```yaml
morph_data_import:
    entities:
        App\Entity\PublicEntity:
            exclude_properties:
                - id
```
By default, imported entities is saved to db by `WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler\SimpleImportHandlerService`
which simply save entities to db, if you need extra logic for entity save you can add your own handler by implement
`WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Handler\ImportHandlerInterface` and put this service to config
in `handler` field
```yaml
morph_data_import:
    entities:
        App\Entity\PublicEntity:
            exclude_properties:
                - id
            handler: App\Service\Import\Handler\MyEntityHandlerService
```

## Readers
To add you own reader you need to implement interface `WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader\SourceReaderInterface`

* `public function support(): bool` - return true if reader support uploaded file or api
* `public function getPriority(): int` - `support()` method can return `true` for many cases, but we will use only first match.
   You can specify the highest priority for your reader and your reader will be selected.
