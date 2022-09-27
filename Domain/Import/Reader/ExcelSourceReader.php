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

/**
 * Class ExcelSourceReader
 *
 * @package WideMorph\Morph\Bundle\MorphDataImportBundle\Domain\Import\Reader
 */
class ExcelSourceReader extends AbstractSourceReader
{
    /**
     * {@inheritDoc}
     *
     * @throws ImportErrorValidationException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function readSource(
        array|UploadedFile $source,
        ImportFormDto $entityDto,
        EntityReflectionInterface $entityReflection
    ): Generator {
        $this->normalizeFieldIntValues($entityDto);
        $spreadsheet = IOFactory::load($entityDto->getFile()->getRealPath());

        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $worksheetHighestColumn = Coordinate::columnIndexFromString($worksheet->getHighestColumn());
        [$highestColumn, $minColumn] = $this->calculateMinMaxColumn($entityDto);

        if ($highestColumn > $worksheetHighestColumn) {
            throw new ImportErrorValidationException(
                sprintf(
                    'Highest input column should not be greater than file columns. Given %d when max sheet column is %d',
                    $highestColumn,
                    $worksheetHighestColumn
                )
            );
        }

        yield from $this->read($worksheet, $entityDto, $highestRow, $minColumn, $highestColumn);
    }

    public function support(array|UploadedFile $source, EntityReflectionInterface $entityReflection): bool
    {
        return $source instanceof UploadedFile;
    }

    /**
     * @param Worksheet $worksheet
     * @param ImportFormDto $entityDto
     * @param int $highestRow
     * @param int $minColumn
     * @param int $highestColumn
     *
     * @return Generator
     */
    protected function read(
        Worksheet $worksheet,
        ImportFormDto $entityDto,
        int $highestRow,
        int $minColumn,
        int $highestColumn
    ): Generator {
        $fieldsFlip = static fn(array $fields): array => array_flip(array_filter($fields));

        $fields = $fieldsFlip($entityDto->getEntity()->getFields());
        for ($row = 1; $row <= $highestRow; ++$row) {
            $data = $this->readRow($worksheet, $fields, $row, $minColumn, $highestColumn);

            foreach ($entityDto->getEntity()->getRelations() as $relation) {
                $relFields = $fieldsFlip($relation->getFields());
                $data['relations'][$relation->getNamespace()] = $this->readRow(
                    $worksheet,
                    $relFields,
                    $row,
                    $minColumn,
                    $highestColumn
                );
            }

            yield $data;
        }
    }

    /**
     * @param Worksheet $worksheet
     * @param array $fields
     * @param int $row
     * @param int $minColumn
     * @param int $highestColumn
     *
     * @return array
     */
    protected function readRow(
        Worksheet $worksheet,
        array $fields,
        int $row,
        int $minColumn,
        int $highestColumn
    ): array {
        $mapping = [];

        for ($col = $minColumn; $col <= $highestColumn; ++$col) {
            if (!isset($fields[$col])) {
                continue;
            }

            $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();

            $mapping[$fields[$col]] = $value;
        }

        return $mapping;
    }

    /**
     * @param ImportFormDto $entityDto
     *
     * @return array<int, int>
     */
    protected function calculateMinMaxColumn(ImportFormDto $entityDto): array
    {
        $maxFunc = static fn(array $fields): int => max(array_values($fields));
        $minFunc = static fn(array $fields): int => min(array_values($fields));

        $min = $minFunc($entityDto->getEntity()->getFields());
        $max = $maxFunc($entityDto->getEntity()->getFields());

        foreach ($entityDto->getEntity()->getRelations() as $relation) {
            $relMax = $maxFunc($relation->getFields());
            $relMin = $minFunc($relation->getFields());

            if ($relMax > $max) {
                $max = $relMax;
            }

            if ($relMin < $min && $relMin !== 0) {
                $min = $relMin;
            }
        }

        return [$max, $min];
    }
}
