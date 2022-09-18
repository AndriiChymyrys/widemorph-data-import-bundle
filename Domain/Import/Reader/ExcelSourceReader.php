<?php

declare(strict_types=1);

namespace WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader;

use Generator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\DTO\ImportForm\ImportFormDto;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Exception\ImportErrorValidationException;
use WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Reflection\Entity\EntityReflectionInterface;

class ExcelSourceReader extends AbstractSourceReader
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
        $worksheetHighestColumn = Coordinate::columnIndexFromString($worksheet->getHighestColumn());
        $fields = array_flip($entityDto->getEntity()->getFields());
        $highestColumn = max(array_keys($fields));
        $minColumn = min(array_keys($fields));

        if ($highestColumn > $worksheetHighestColumn) {
            throw new ImportErrorValidationException(
                sprintf(
                    'Highest input column should not be greater than file columns. Given %d when max sheet column is %d',
                    $highestColumn,
                    $worksheetHighestColumn
                )
            );
        }

        yield from $this->read($worksheet, $fields, $highestRow, $minColumn, $highestColumn);
    }

    public function support(array|UploadedFile $source, EntityReflectionInterface $entityReflection): bool
    {
        return $source instanceof UploadedFile;
    }

    /**
     * @param Worksheet $worksheet
     * @param array $fields
     * @param int $highestRow
     * @param int $minColumn
     * @param int $highestColumn
     *
     * @return Generator
     */
    protected function read(
        Worksheet $worksheet,
        array $fields,
        int $highestRow,
        int $minColumn,
        int $highestColumn
    ): Generator {
        for ($row = 1; $row <= $highestRow; ++$row) {
            $mapping = [];

            for ($col = $minColumn; $col <= $highestColumn; ++$col) {
                if (!isset($fields[$col])) {
                    continue;
                }

                $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();

                $mapping[$fields[$col]] = $value;
            }

            yield $mapping;
        }
    }
}
