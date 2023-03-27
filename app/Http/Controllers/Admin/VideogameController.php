<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Videogame;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class VideogameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videogames = Videogame::orderBy('updated_at', 'DESC')->get();
        return view('admin.videogames.index', compact('videogames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $videogame = new Videogame();
        return view('admin.videogames.create', compact('videogame'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|unique:videogames|min:5|max:50',
                'platform' => 'required|string|min:5|max:20',
                'publisher' => 'required|string|min:5|max:50',
                'genre' => 'required|string|min:5|max:20',
                'image_url' => 'nullable|image|mimes:jpeg,jpg,png',
                'description' => 'required|string',
                'release_date' => 'required|string',
                'weight' => 'nullable|string',

            ],
            [
                'title.required' => 'Il nome videogioco è obbligatorio.',
                'title.unique' => 'Non possono esserci due nomi videogioco uguali.',
                'title.min' => 'Titolo: almeno 5 caratteri.',
                'title.max' => 'Titolo: massimo 50 caratteri.',
                'platform.required' => 'la piattaforma è obbligatoria.',
                'platform.min' => 'Piattaforma: almeno 5 caratteri.',
                'platform.max' => 'Piattaforma: massimo 20 caratteri.',
                'publisher.required' => 'Il publisher è obbligatorio.',
                'publisher.min' => 'Publisher: almeno 5 caratteri.',
                'publisher.max' => 'Publisher: massimo 20 caratteri.',
                'genre.required' => 'Il genere è obbligatorio.',
                'genre.min' => 'Genere: almeno 5 caratteri.',
                'genre.max' => 'Genere: massimo 20 caratteri.',
                'image_url.image' => 'L\'immagine deve essere un file di tipo immagine.',
                'image_url.mimes' => 'Le estensioni accettate sono: jpeg, jpg, png.',
                'description.required' => 'La descrizione è obbligatoria.',
                'release_date.required' => 'la data di rilascio è obbligatoria'
            ]
        );


        $data = $request->all();
        $videogame = new Videogame();

        if (Arr::exists($data, 'image_url')) {
            $img_url = Storage::put('videogames', $data['image_url']);
            $data['image_url'] = $img_url;
        }

        $videogame->fill($data);
        $videogame->save();

        return to_route('admin.videogames.show', $videogame->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Videogame $videogame)
    {
        return view('admin.videogames.show', compact('videogame'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videogame $videogame)
    {
        return view('admin.videogames.edit', compact('videogame'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videogame $videogame)
    {
        $request->validate(
            [
                'title' => ['required', 'string', Rule::unique('videogames')->ignore($videogame->id), 'min:5', 'max:50'],
                'platform' => 'required|string|min:5|max:20',
                'publisher' => 'required|string|min:5|max:50',
                'genre' => 'required|string|min:5|max:20',
                'image_url' => 'nullable|image|mimes:jpeg,jpg,png',
                'description' => 'required|string',
                'release_date' => 'required|string',
                'weight' => 'nullable|string',

            ],
            [
                'title.required' => 'Il nome videogioco è obbligatorio.',
                'title.unique' => 'Non possono esserci due nomi videogioco uguali.',
                'title.min' => 'Titolo: almeno 5 caratteri.',
                'title.max' => 'Titolo: massimo 50 caratteri.',
                'platform.required' => 'la piattaforma è obbligatoria.',
                'platform.min' => 'Piattaforma: almeno 5 caratteri.',
                'platform.max' => 'Piattaforma: massimo 20 caratteri.',
                'publisher.required' => 'Il publisher è obbligatorio.',
                'publisher.min' => 'Publisher: almeno 5 caratteri.',
                'publisher.max' => 'Publisher: massimo 20 caratteri.',
                'genre.required' => 'Il genere è obbligatorio.',
                'genre.min' => 'Genere: almeno 5 caratteri.',
                'genre.max' => 'Genere: massimo 20 caratteri.',
                'image_url.image' => 'L\'immagine deve essere un file di tipo immagine.',
                'image_url.mimes' => 'Le estensioni accettate sono: jpeg, jpg, png.',
                'description.required' => 'La descrizione è obbligatoria.',
                'release_date.required' => 'la data di rilascio è obbligatoria'
            ]
        );

        $data = $request->all();

        if (Arr::exists($data, 'image_url')) {
            if ($videogame->image_url) Storage::delete($videogame->image_url);
            $img_url = Storage::put('videogames', $data['image_url']);
            $data['image_url'] = $img_url;
        }

        $videogame->fill($data);
        $videogame->save();

        return to_route('admin.videogames.show', $videogame->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videogame $videogame)
    {
        if ($videogame->image_url) Storage::delete($videogame->image_url);

        $videogame->delete();
        return to_route('admin.videogames.index');
    }
}
