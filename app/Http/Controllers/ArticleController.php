<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImportRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Imports\CsvImport;
use Inertia\Inertia;

class ArticleController extends Controller
{

    public function import(StoreImportRequest $request, CsvImport $csvImport)
    {
        $csvImport->importSections($request);
        $csvImport->importArticles($request);

        return Inertia::render('Welcome', [
            'message' => 'The file is uploaded successfully'
        ]);

    }
}
