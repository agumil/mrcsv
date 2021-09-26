<?php

namespace App\Models\Services;

class FileService
{
    protected $filepath;

    function __call($name, $arguments)
    {
        if ($name == "loadCsv") {
            switch (count($arguments)) {
                case 0:
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                    return $reader->load($this->filepath);
                case 1:
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                    return $reader->load($arguments[0]);
            }  
        }
    }

    public function store(object $file):void
    {
        $file->move(WRITEPATH.'uploads', "{$_SESSION['uuid']}.csv", true);
        $this->filepath = WRITEPATH . "uploads/{$_SESSION['uuid']}.csv";
    }
}