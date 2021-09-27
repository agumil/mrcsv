<?php


// PSR 4

namespace App\Controllers;

use App\Models\Services\FileService;
use Dompdf\Dompdf;
use Exception;

class FileController extends BaseController
{
    private $file_service;

    public function __construct()
    {
        // Inisiasi model (service)
        $this->file_service = new FileService();
    }

    public function upload()
    {
        // Cek file yang valid
        $file = $this->request->getFile('file-upload');
        if (! $file->isValid()) {
            throw new \RuntimeException($file->getErrorString().'('.$file->getError().')');
        }

        // $isValidated = $this->validate([
        //     'file-upload' => [
        //         'max_size[file-upload,5120]',
        //         'mime_in[file-upload,text/csv,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.oasis.opendocument.spreadsheet,text/plain]',
        //         'ext_in[file-upload,csv,xls,xlsx,ods]',
        //     ],
        // ]);

        // Validasi
        $isValidated = $this->validate([
            'file-upload' => [
                'max_size[file-upload,5120]',
                'mime_in[file-upload,text/csv,text/plain]',
                'ext_in[file-upload,csv]',
            ],
        ]);

        // Cek validasi
        if (!$isValidated) {
            return redirect()->route('/')->with('notif', $this->validator->getError());
        }
        
        // Simpan file
        $this->file_service->store($file);

        // Akses halaman hasil upload (table)
        return redirect()->route('file/result');
    }

    public function result()
    {
        try {
            $filepath = WRITEPATH . "uploads/{$_SESSION['uuid']}.csv";
            $csv = $this->file_service->loadCsv($filepath);
        } catch (EXception $e) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('result', [
            'row_length' => count($csv->getActiveSheet()->toArray()),
            'col_length' => count($csv->getActiveSheet()->toArray()[0]),
            'data' => $csv->getActiveSheet()->toArray()
        ]);
    }

    public function print()
    {
        try {
            $filepath = WRITEPATH . "uploads/{$_SESSION['uuid']}.csv";
            $csv = $this->file_service->loadCsv($filepath);
        } catch (Exception $e) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $html = view('print', [
            'row_length' => count($csv->getActiveSheet()->toArray()),
            'col_length' => count($csv->getActiveSheet()->toArray()[0]),
            'data' => $csv->getActiveSheet()->toArray()
        ]);

        // Library DOMPDF
        $pdf = new Dompdf();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream('cetak.pdf', ['Attachment' => 0]);
    }
}
