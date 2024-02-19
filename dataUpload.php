<?php

require 'vendor/autoload.php';

use PhpOffice\PhpWord\IOFactory;

// Function to extract table data and convert it to JSON
function extractTableData($table)
{
    $data = [];

    foreach ($table->getRows() as $row) {
        $rowData = [];
        foreach ($row->getCells() as $cell) {
            $rowData[] = $cell->getElements()[0]->getText();
        }
        $data[] = [
            'authors' => $rowData[0],
            'title' => $rowData[1],
            'publishedTo' => $rowData[2],
        ];
    }

    return $data;
}

// Load the Word file
$phpWord = IOFactory::load('data.docx');

// Assume the first table in the document contains the data
$table = $phpWord->getSections()[0]->getElements()[0];

// Extract table data
$jsonData = extractTableData($table);

// Write the extracted data to a JSON file
file_put_contents('output.json', json_encode($jsonData, JSON_PRETTY_PRINT));

echo "Data extracted and saved to output.json.\n";
