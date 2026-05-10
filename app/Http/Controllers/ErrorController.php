<?php

namespace App\Http\Controllers;

class ErrorController
{
    public function notFound()
    {
        $title = '404 - Halaman Tidak Ditemukan';
        return view()::render('pages.error.404', compact('title'));
    }

    public function internalServerError()
    {
        $title = '500 - Terjadi Kesalahan Server';
        return view()::render('pages.error.500', compact('title'));
    }
}