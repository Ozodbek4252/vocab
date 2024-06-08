<?php

namespace Database\Seeders;

use App\Models\File as ModelsFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Smalot\PdfParser\Parser;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing files
        $folderPath = storage_path('app/public/files');

        // Check if the folder exists
        if (File::isDirectory($folderPath)) {
            // Delete the folder and its contents
            File::deleteDirectory($folderPath);
        }

        //? Copying first file
        // Copy the file from public/files to the storage directory
        $sourcePath = public_path('assets/files/Destination_C1_and_C2_Grammar_and_Vocabulary_with_answer_key.pdf');
        $destinationPath = storage_path('app/public/files/Destination_C1_and_C2_Grammar_and_Vocabulary_with_answer_key.pdf');

        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $file_path = 'files/Destination_C1_and_C2_Grammar_and_Vocabulary_with_answer_key.pdf';
        } elseif (File::exists($destinationPath)) {
            $file_path = 'files/Destination_C1_and_C2_Grammar_and_Vocabulary_with_answer_key.pdf';
        }

        // Get file size in bytes
        $fileSize = filesize($sourcePath);

        // Get number of pages
        $parser = new Parser();
        $pdf = $parser->parseFile($sourcePath);
        $details = $pdf->getDetails();
        $numberOfPages = isset($details['Pages']) ? $details['Pages'] : 0;

        ModelsFile::create([
            'name' => 'Destination_C1_and_C2_Grammar_and_Vocabulary_with_answer_key',
            'slug' => 'destination-c1-and-c2-grammar-and-vocabulary-with-answer-key',
            'path' => $file_path,
            'size' => $fileSize,
            'page' => $numberOfPages,
            'extension' => 'pdf',
        ]);


        //? Copying second file
        // Copy the file from public/files to the storage directory
        $sourcePath = public_path('assets/files/Philosophy_as_a_Way_of_Life_the_System_a.pdf');
        $destinationPath = storage_path('app/public/files/Philosophy_as_a_Way_of_Life_the_System_a.pdf');

        if (File::exists($sourcePath)) {
            // Create the destination directory if it doesn't exist
            File::ensureDirectoryExists(dirname($destinationPath));

            // Copy the file to the storage directory
            File::copy($sourcePath, $destinationPath);

            $file_path = 'files/Philosophy_as_a_Way_of_Life_the_System_a.pdf';
        } elseif (File::exists($destinationPath)) {
            $file_path = 'files/Philosophy_as_a_Way_of_Life_the_System_a.pdf';
        }

        // Get file size in bytes
        $fileSize = filesize($sourcePath);

        // Get number of pages
        $parser = new Parser();
        $pdf = $parser->parseFile($sourcePath);
        $details = $pdf->getDetails();
        $numberOfPages = isset($details['Pages']) ? $details['Pages'] : 0;

        ModelsFile::create([
            'name' => 'Philosophy_as_a_Way_of_Life_the_System_a',
            'slug' => 'philosophy-as-a-way-of-life-the-system-a',
            'path' => $file_path,
            'size' => $fileSize,
            'page' => $numberOfPages,
            'extension' => 'pdf',
        ]);
    }
}
