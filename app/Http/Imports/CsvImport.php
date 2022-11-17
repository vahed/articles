<?php

namespace App\Http\Imports;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Article;
use Carbon\Carbon;

class CsvImport
{
    /**
     * Get filename and map the content into array
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function importCsv($request): array
    {
        $path = $request->file('csvFile')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        return array_slice($data, 1);
    }

    /**
     * Insert csv data into sections table
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function importSections($request)
    {
        $sections = $this->importCsv($request);

        foreach($sections as $k => $v){
            Section::firstOrCreate([
                'id' => $sections[$k][1],
                'section_name' => $sections[$k][2]
            ]);
        }
    }

    /**
     * Insert csv data into articles table
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function importArticles(Request $request)
    {
        $articles = $this->importCsv($request);
        
        foreach($articles as $k => $v){

            Article::firstOrCreate([
                'section_id' => $articles[$k][1],
                'title' => $articles[$k][3],
                'created' => $this->parseDate($articles[$k][4])
            ]);
        }
    }

    /**
     * Parse the date before insert into database table
     *
     * @param  string
     * @return timestamp
     */
    public function parseDate($date)
    {
        return Carbon::createFromFormat('d/m/Y H:i', $date)->format('d-m-Y H:i:s');
    }
}