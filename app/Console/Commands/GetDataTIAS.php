<?php

namespace App\Console\Commands;

use App\Models\TagResult;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Exception;

class GetDataTIAS extends Command
{
    protected $signature = 'get:tias';
    protected $description = 'Get data from PMR';

    public function handle()
    {
        try {
            // Ambil data dari API
            $response = Http::timeout(60)->get('https://pickmyrace.frizacahya.com/getracetectagcheck');

            // Cek apakah response berhasil
            if ($response->failed()) {
                $this->error('HTTP request failed with status: ' . $response->status());
                return;
            }

            $data = $response->json();

            if (!isset($data['data'])) {
                $this->error('Unexpected response format: key "data" not found.');
                return;
            }

            // Proses data
            foreach ($data['data'] as $value) {
                try {
                    TagResult::getTagCheck($value);
                } catch (Exception $e) {
                    $this->error('Error processing item: ' . $e->getMessage());
                }
            }

            $this->info('✅ Data has been fetched from PMR successfully.');
        } catch (Exception $e) {
            // Tangkap error global, misal koneksi error
            $this->error('❌ Exception occurred: ' . $e->getMessage());
        }
    }
}
