<div class="d-flex flex-column align-items-center">
    <div class="card p-4 shadow">
        @if ($videogame->exists)
        <form action="{{ route('admin.videogames.update', $videogame->id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @method('PUT')
        @else    
        <form action="{{ route('admin.videogames.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @endif
        @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Nome Gioco</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $videogame->title) }}" minlength="5" maxlength="50" required>
                        <small class="text-muted">Inserisci il nome del Videogioco</small>
                      </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="platform" class="form-label">Piattaforma</label>
                        <input type="text" class="form-control" id="platform" name="platform" value="{{ old('platform', $videogame->platform) }}" minlength="5" maxlength="20" required>
                        <small class="text-muted">Inserisci la piattaforma</small>
                      </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="release_date" class="form-label">Data Rilascio</label>
                        <input type="date" class="form-control" id="release_date" name="release_date" value="{{ old('release_date', $videogame->release_date) }}" required>
                        <small class="text-muted">Inserisci la data rilascio</small>
                      </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="publisher" class="form-label">Publisher</label>
                        <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher', $videogame->publisher) }}" minlength="5" maxlength="50" required>
                        <small class="text-muted">Inserisci il Publisher</small>
                      </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="genre" class="form-label">Genere</label>
                        <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre', $videogame->genre) }}" minlength="5" maxlength="20" required>
                        <small class="text-muted">Inserisci la piattaforma</small>
                      </div>
                </div>
                <div class="col-3">
                    <div class="mb-3">
                        <label for="weight" class="form-label">Peso</label>
                        <input type="text" class="form-control" id="weight" name="weight" value="{{ old('weight', $videogame->weight) }}" required>
                        <small class="text-muted">Inserisci il peso del Videogioco</small>
                      </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="description" class="form-label">Descrizione</label>
                        <textarea class="form-control" id="description" rows="7" name="description" required>{{ old('description', $videogame->description) }}</textarea>
                        <small class="text-muted">Inserisci una descrizione del Videogioco</small>
                      </div>
                </div>
                <div class="col-5">
                    <div class="mb-3">
                        <label for="image_url" class="form-label">Carica Immagine</label>
                        <input type="file" class="form-control" id="image_url" name="image_url">
                        <small class="text-muted">Scegli un'immagine per il Videogioco</small>
                      </div>
                </div>
                <div class="col-2">
                    <img id="img-preview" class="img-fluid" src="{{ $videogame->image_url ? asset('storage/' . $videogame->image_url) : 'https://marcolanci.it/utils/placeholder.jpg' }}" alt="preview">
                </div>
            </div>
            <div class="d-flex justify-content-end my-3">
                <button type="submit" class="btn btn-success w-25">Salva</button>
            </div>
        </form>
    </div>
    <a href="{{ route('admin.videogames.index') }}" class="btn btn-primary my-4 w-25">Torna Indietro</a>
</div>

@section('scripts')
    <script>
        const placeholder = 'https://marcolanci.it/utils/placeholder.jpg';

        const imageInput = document.getElementById('image_url');
        const imagePreview = document.getElementById('img-preview');

        imageInput.addEventListener('change', () => {
            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();
                reader.readAsDataURL(imageInput.files[0]);
                reader.onload = e => {
                    imagePreview.setAttribute('src', e.target.result);
                }
            } else imagePreview.setAttribute('src', placeholder);
        });
    </script>
@endsection