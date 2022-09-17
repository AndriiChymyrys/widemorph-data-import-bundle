<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader;

use Generator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

class ExcelSourceReader implements SourceReaderInterface
{
    public function readSource(
        array|UploadedFile $source,
        ImportFormDto $entityDto,
        EntityReflectionInterface $entityReflection
    ): Generator {
        $reader = IOFactory::createReader(IOFactory::READER_ODS);

        $spreadsheet = $reader->load($source->getRealPath());

        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = Coordinate::columnIndexFromString($worksheet->getHighestColumn());
        $fields = array_flip($entityDto->getEntity()->getFields());

        for ($row = 1; $row <= $highestRow; ++$row) {
            $mapping = [];

            for ($col = 1; $col <= $highestColumn; ++$col) {
                if (!isset($fields[$col])) {
                    continue;
                }

                $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();

                $mapping[$fields[$col]] = $value;
            }

            yield $mapping;
        }
    }

    public function support(array|UploadedFile $source, EntityReflectionInterface $entityReflection): bool
    {
        return $source instanceof UploadedFile;
    }
}
