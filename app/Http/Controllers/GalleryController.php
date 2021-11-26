<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImagesGalleryRequest;
use App\Models\Gallery;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Gallery::class);

        if ($request->value === 'isPublished') {
            $galleries = Gallery::query()
                ->where('isPublished', '=', 1)
                ->orderBy('isPublished', 'DESC')
                ->orderBy('isDeleted', 'ASC')
                ->get();
        } elseif ($request->value === 'isDeleted') {
            $galleries = Gallery::query()
                ->where('isDeleted', '=', 1)
                ->orderBy('isPublished', 'DESC')
                ->orderBy('isDeleted', 'ASC')
                ->get();
        } else {
            $galleries = Gallery::query()
                ->orderBy('isPublished', 'DESC')
                ->orderBy('isDeleted', 'ASC')
                ->get();
        }

        return view('gallery.index', [
            'galleries' => $galleries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Gallery::class);

        return view('gallery.form', [
            'gallery' => new Gallery()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGalleryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryRequest $request)
    {
        $this->authorize('create', Gallery::class);

        if ($request->isMethod('post')) {
            $request->flash();

            $gallery = new Gallery();
            $gallery->fill($request->all());

            if ($gallery->save()) {
                return redirect()->route('gallery.show', $gallery)
                    ->with('success', 'Данные успешно добавлены!');
            }

            return redirect()->route('gallery.create')
                ->with('error', 'Ошибка добавления данных!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        $this->authorize('view', $gallery);

        return view('gallery.show', [
            'gallery' => $gallery
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $this->authorize('update', $gallery);

        return view('gallery.form', [
            'gallery' => $gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGalleryRequest  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $this->authorize('update', $gallery);

        if ($request->isMethod('put')) {
            $request->flash();

            $gallery->fill($request->all());

            if ($gallery->save()) {
                return redirect()->route('gallery.show', $gallery)
                    ->with('success', 'Данные успешно обновлены!');
            }

            return redirect()->route('gallery.update', $gallery)
                ->with('error', 'Ошибка обновления данных!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Gallery $gallery
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery, Request $request)
    {
        $this->authorize('delete', $gallery);

        if ($request->isMethod('delete')) {
            $gallery->isDeleted = !$gallery->isDeleted;
            $gallery->isPublished = 0;

            if ($gallery->save()) {
                return redirect()->route('gallery.index');
            }
        }

        return redirect()->route('gallery.index')
            ->with('error', 'Данные не были удалены!');
    }

    /**
     * Publication gallery
     *
     * @param Gallery $gallery
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function publication(Gallery $gallery, Request $request)
    {
        $this->authorize('publication', $gallery);

        if ($request->isMethod('put')) {
            $gallery->isPublished = !$gallery->isPublished;

            if ($gallery->save()) {
                return redirect()->route('gallery.index');
            }
        }

        return redirect()->route('gallery.index')
            ->with('error', 'Данные не были опубликованны!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Gallery $gallery
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function addImages(Gallery $gallery, Request $request)
    {
        $this->authorize('addImages', $gallery);

        return view('gallery.form-image', [
            'gallery' => $gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreImagesGalleryRequest $request
     * @param Gallery $gallery
     * @return $this
     */
    public function storeImages(StoreImagesGalleryRequest $request, Gallery $gallery)
    {
        $this->authorize('addImages', $gallery);

        if ($request->isMethod('post')) {
            if ($request->hasFile('files')) {
                $path = public_path('storage')."/galleries/{$gallery->id}/";
                $position = GalleryImage::query()->where('gallery_id', '=', $gallery->id)->count();

                foreach ($request->file('files') as $key => $file) {
                    $name = $file->getClientOriginalName();
                    $position++;

                    // проверяем на существование файла, если есть то переименовываем файл
                    if (file_exists($path.$name)) {
                        $name = $file->hashName();
                    }
                    $file->move($path, $name);

                    $image = new GalleryImage();
                    $image->gallery_id = $gallery->id;
                    $image->image = $name;
                    $image->position = $position;
                    $image->save();
                }
            }
        }

        return redirect()->route('gallery.show', $gallery)
            ->with('success', 'Данные успешно добавлены!');
    }
}
