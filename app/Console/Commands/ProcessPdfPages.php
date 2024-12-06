<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Fpdf\Fpdf;
use setasign\Fpdi\Fpdi;
use File;

class ProcessPdfPages extends Command
{
    protected $signature = 'pdf:process';
    protected $description = 'Process all PDFs in a folder, removing every second page';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Folder where PDFs are stored
        $folderPath = storage_path('app/pdfs'); // Change this to your folder path
        $outputFolderPath = storage_path('app/processed_pdfs'); // Output folder path

        // Ensure the output folder exists
        if (!File::exists($outputFolderPath)) {
            File::makeDirectory($outputFolderPath, 0755, true);
        }

        // Get all PDF files in the folder
        $pdfFiles = File::files($folderPath);

        foreach ($pdfFiles as $pdfFile) {
            if ($pdfFile->getExtension() === 'pdf') {
                $this->info("Processing: {$pdfFile->getFilename()}");

                // Process the PDF
                $this->processPdf($pdfFile, $outputFolderPath);
            }
        }

        $this->info('PDF processing completed!');
    }

    public function processPdf($pdfFile, $outputFolderPath)
    {
        // Create FPDI instance
        $pdf = new Fpdi();

        // Get the total number of pages in the source PDF
        $pageCount = $pdf->setSourceFile($pdfFile->getRealPath());

        // Loop through each page and add it to the new PDF, skipping every second page
        for ($i = 1; $i <= $pageCount; $i++) {
            if ($i % 2 != 0) {  // Only keep odd-numbered pages
                // Import the page
                $template = $pdf->importPage($i);
                
                // Get the page size from the original PDF
                $size = $pdf->getTemplateSize($template);
                
                // Set the page size to match the original PDF's page size
                $pdf->addPage($size['orientation'], [$size['width'], $size['height']]);
                
                // Use the imported page template
                $pdf->useTemplate($template);
            }
        }

        // Save the modified PDF to the output folder
        $outputFile = $outputFolderPath . '/' . $pdfFile->getFilename();
        $pdf->Output('F', $outputFile);
    }
}
