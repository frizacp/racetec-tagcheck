<?php

namespace App\Console\Commands;

use App\Models\TagResult;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetDataTIAS extends Command
{
    protected $signature = 'get:tias';

    protected $description = 'Get data from PMR';

    public function handle()
    {
        $data   =   Http::get('https://pickmyrace.frizacahya.com/getracetectagcheck')->json();

        foreach ($data['data'] as $value) {
            TagResult::getTagCheck($value);
        }

        $this->info('Data has been fetched from PMR');
    }
}
