<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Http\Requests\StoreGalleryImageRequest;
use App\Http\Requests\UpdateGalleryImageRequest;

class GalleryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Gallery::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Gallery::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGalleryImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryImageRequest $request)
    {
        $this->authorize('create', Gallery::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GalleryImage  $galleryImage
     * @return \Illuminate\Http\Response
     */
    public function show(GalleryImage $galleryImage)
    {
        $this->authorize('view', $galleryImage);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GalleryImage  $galleryImage
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryImage $galleryImage)
    {
        $this->authorize('update', $galleryImage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGalleryImageRequest  $request
     * @param  \App\Models\GalleryImage  $galleryImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryImageRequest $request, GalleryImage $galleryImage)
    {
        $this->authorize('update', $galleryImage);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GalleryImage  $galleryImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryImage $galleryImage)
    {
        $this->authorize('delete', $galleryImage);
    }
}
