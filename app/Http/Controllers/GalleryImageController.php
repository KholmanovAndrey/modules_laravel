<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryImage;
use App\Http\Requests\StoreGalleryImageRequest;
use App\Http\Requests\UpdateGalleryImageRequest;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', GalleryImage::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', GalleryImage::class);

        return view('gallery-image.form', [
            'galleryImage' => new GalleryImage()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGalleryImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryImageRequest $request)
    {
        $this->authorize('create', GalleryImage::class);
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

        return view('gallery-image\form', [
            'galleryImage' => $galleryImage
        ]);
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

        if ($request->isMethod('put')) {
            $request->flash();

            $galleryImage->fill($request->all());

            if ($galleryImage->save()) {
                return redirect()->route('gallery.show', $galleryImage->gallery_id)
                    ->with('success', 'Данные успешно обновлены!');
            }

            return redirect()->route('gallery-image.update', $galleryImage)
                ->with('error', 'Ошибка обновления данных!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GalleryImage  $galleryImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryImage $galleryImage, Request $request)
    {
        $this->authorize('delete', $galleryImage);

        if ($request->isMethod('delete')) {
            $galleryImage->isDeleted = !$galleryImage->isDeleted;
            $galleryImage->isPublished = 0;

            if ($galleryImage->save()) {
                return redirect()->route('gallery.show', $galleryImage->gallery_id);
            }
        }

        return redirect()->route('gallery.show', $galleryImage->gallery_id)
            ->with('error', 'Данные не были удалены!');
    }

    /**
     * Publication gallery image
     *
     * @param GalleryImage $galleryImage
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function publication(GalleryImage $galleryImage, Request $request)
    {
        $this->authorize('publication', $galleryImage);

        if ($request->isMethod('put')) {
            $galleryImage->isPublished = !$galleryImage->isPublished;

            if ($galleryImage->save()) {
                return redirect()->route('gallery.show', $galleryImage->gallery_id);
            }
        }

        return redirect()->route('gallery.show', $galleryImage->gallery_id)
            ->with('error', 'Данные не были опубликованны!');
    }
}
