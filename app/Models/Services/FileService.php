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

    // public function convertTimestamp(array $data = [], string $format = 'd/m/y')
    // {
    //     if (empty($data)) {
    //         return $data;
    //     }

    //     for ($i = 0; $i < $data['row_length']; $i++) {
    //         for ($j = 0; $j < $data['col_length']; $j++) {
    //             if ($this->isValidTimeStamp($data[$i][$j])) {

    //             }
    //         }
    //     }


    // }

    // private function isValidTimeStamp(string $timestamp):bool
    // {
    //     return ((string) (int) $timestamp === $timestamp) 
    //         && ($timestamp <= PHP_INT_MAX)
    //         && ($timestamp >= ~PHP_INT_MAX);
    // }
}