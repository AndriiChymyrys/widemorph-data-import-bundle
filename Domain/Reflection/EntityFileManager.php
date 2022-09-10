<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection;

class EntityFileManager implements EntityFileManagerInterface
{
    public const BASE_ENTITY_FILE_PATH = '/src/Entity';
    public const BASE_ENTITY_NAME_SPACE = 'App\Entity\\';
    public const ENTITY_FOLDER_DIVIDER = '::';

    public function __construct(protected string $projectDir)
    {
    }

    public function scanEntityFolder(): array
    {
        $path = $this->projectDir . static::BASE_ENTITY_FILE_PATH;

        return $this->scanDir($path);
    }

    public function getEntityNameSpace(string $entityName): string
    {
        $name = str_replace(static::ENTITY_FOLDER_DIVIDER, '\\', $entityName);

        return static::BASE_ENTITY_NAME_SPACE . $name;
    }

    protected function scanDir(string $rootPath, array $foundFiles = [], string $itemFolderPath = ''): array
    {
        $paths = array_diff(scandir($rootPath), ['.', '..', '.gitignore']);

        foreach ($paths as $item) {
            $itemPath = $rootPath . '/' . $item;

            if (is_dir($itemPath)) {
                $foundFiles += $this->scanDir($itemPath, $foundFiles, $item);
            } else {
                $item = str_replace('.php', '', $item);
                $foundFiles[] = $itemFolderPath ? $itemFolderPath . static::ENTITY_FOLDER_DIVIDER . $item : $item;
            }
        }

        return $foundFiles;
    }
}
