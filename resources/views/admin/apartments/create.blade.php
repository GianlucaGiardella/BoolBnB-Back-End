@extends('admin.layouts.base')

@section('contents')

    <h1>Aggiungi appartamento</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.apartments.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea type="text" class="form-control" id="description" name="description" rows="3"
                value="{{ old('description') }}"></textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Indirizzo</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
        </div>

        {{-- <div class="mb-3">
            <label for="latitude" class="form-label">Latitudine</label>
            <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude') }}">
        </div>

        <div class="mb-3">
            <label for="longitude" class="form-label">Longitudine</label>
            <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude') }}">
        </div> --}}

        <div class="mb-3">
            <label for="size" class="form-label">Metri Quadri</label>
            <input type="number" class="form-control" id="size" name="size" value="{{ old('size') }}">
        </div>

        <div class="mb-3">
            <label for="rooms" class="form-label">Camere</label>
            <input type="number" class="form-control" id="rooms" name="rooms" value="{{ old('rooms') }}">
        </div>

        <div class="mb-3">
            <label for="beds" class="form-label">Letti</label>
            <input type="number" class="form-control" id="beds" name="beds" value="{{ old('beds') }}">
        </div>

        <div class="mb-3">
            <label for="bathrooms" class="form-label">Bagni</label>
            <input type="number" class="form-control" id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}">
        </div>

        <div class="mb-3">
            <label for="visibility" class="form-label">Visibilità</label>
            <input type="checkbox" class="form-check-input" name="visibility" id="visibility"
                value="{{ old('visibility') }}">
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Immagine di copertina</label>
            <input type="text" class="form-control" id="cover" name="cover" value="{{ old('cover') }}">
        </div>

        <button type="submit" class="btn btn-primary">Aggiungi</button>
    </form>

@endsection

{{-- @extends('admin.layouts.base')

@section('contents')
    <h1 class="text-center">Inserire un nuovo appartamento </h1>
    <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container createContainer">

            <!-- name -->
            <div class="form-group col-12 d-flex align-items-center my-5">
                <label class="col-2 d-flex justify-content-end align-items-center m-0 pr-1" for="name">
                    Nome
                    <div class="icon d-flex align-items-center m-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 384 512">
                            <path
                                d="M336 0C362.5 0 384 21.49 384 48V464C384 490.5 362.5 512 336 512H240V432C240 405.5 218.5 384 192 384C165.5 384 144 405.5 144 432V512H48C21.49 512 0 490.5 0 464V48C0 21.49 21.49 0 48 0H336zM64 272C64 280.8 71.16 288 80 288H112C120.8 288 128 280.8 128 272V240C128 231.2 120.8 224 112 224H80C71.16 224 64 231.2 64 240V272zM176 224C167.2 224 160 231.2 160 240V272C160 280.8 167.2 288 176 288H208C216.8 288 224 280.8 224 272V240C224 231.2 216.8 224 208 224H176zM256 272C256 280.8 263.2 288 272 288H304C312.8 288 320 280.8 320 272V240C320 231.2 312.8 224 304 224H272C263.2 224 256 231.2 256 240V272zM80 96C71.16 96 64 103.2 64 112V144C64 152.8 71.16 160 80 160H112C120.8 160 128 152.8 128 144V112C128 103.2 120.8 96 112 96H80zM160 144C160 152.8 167.2 160 176 160H208C216.8 160 224 152.8 224 144V112C224 103.2 216.8 96 208 96H176C167.2 96 160 103.2 160 112V144zM272 96C263.2 96 256 103.2 256 112V144C256 152.8 263.2 160 272 160H304C312.8 160 320 152.8 320 144V112C320 103.2 312.8 96 304 96H272z" />
                        </svg>
                    </div>
                </label>
                <input type="text" class="form-control col-8 @error('name') is-invalid @enderror" id="name"
                    name="name" placeholder="aggiungi nome dell'appartamento" value="{{ old('name') }}">
                @error('name')
                    <div class="ml-3 alert alert-danger">Il nome è obbligatorio.</div>
                @enderror
            </div>

            <!-- description -->
            <div class="form-group col-12 d-flex align-items-center my-5">
                <label class="col-2 d-flex justify-content-end align-items-center m-0 pr-1" for="description">
                    Descrizione
                    <div class="icon d-flex align-items-center m-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512">
                            <path
                                d="M160 448h-32V224c0-17.69-14.33-32-32-32L32 192c-17.67 0-32 14.31-32 32s14.33 31.1 32 31.1h32v192H32c-17.67 0-32 14.31-32 32s14.33 32 32 32h128c17.67 0 32-14.31 32-32S177.7 448 160 448zM96 128c26.51 0 48-21.49 48-48S122.5 32.01 96 32.01s-48 21.49-48 48S69.49 128 96 128z" />
                        </svg>
                    </div>
                </label>
                <textarea class="col-8 form-control @error('description') is-invalid @enderror" id="description" name="description"
                    placeholder="aggiungi descrizione dell'appartamento" value="{{ old('description') }}"></textarea>
                @error('description')
                    <div class=" ml-3 alert alert-danger">La descrizione è obbligatorio</div>
                @enderror
            </div>

            <!-- number of rooms -->
            <div class="form-group col-12 d-flex align-items-center my-5">
                <label class="col-2 d-flex justify-content-end align-items-center m-0 pr-1" for="rooms">
                    Numero di stanze
                    <div class="icon d-flex align-items-center m-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M495.9 132.2C505.8 137.9 512 148.5 512 160V480C512 497.7 497.7 512 480 512C462.3 512 448 497.7 448 480V178.6L256 68.86L64 178.6V480C64 497.7 49.67 512 32 512C14.33 512 0 497.7 0 480V160C0 148.5 6.153 137.9 16.12 132.2L240.1 4.216C249.1-1.405 262-1.405 271.9 4.216L495.9 132.2zM216 168C216 145.9 233.9 128 256 128C278.1 128 296 145.9 296 168C296 190.1 278.1 208 256 208C233.9 208 216 190.1 216 168zM224 512C210.7 512 200 501.3 200 488V313.5L173.1 363.4C166.8 375 152.3 379.4 140.6 373.1C128.1 366.8 124.6 352.3 130.9 340.6L168.7 270.3C184.1 241.8 213.9 223.1 246.2 223.1H265.8C298.1 223.1 327.9 241.8 343.3 270.3L381.1 340.6C387.4 352.3 383 366.8 371.4 373.1C359.7 379.4 345.2 375 338.9 363.4L312 313.5V488C312 501.3 301.3 512 288 512C274.7 512 264 501.3 264 488V400H248V488C248 501.3 237.3 512 224 512V512z" />
                        </svg>
                    </div>
                </label>
                <input type="number" id="rooms" name="rooms" min="1" max="99"
                    value="{{ old('rooms') }}" class="col-1 form-control @error('rooms') is-invalid @enderror">

                @error('rooms')
                    <div class="invalid-feedback ml-3">Il numero di stanze è obbligatorio</div>
                @enderror
            </div>

            <!-- Letti -->
            <div class="form-group col-12 d-flex align-items-center my-5">
                <label class="col-2 d-flex justify-content-end align-items-center m-0 pr-1" for="beds">
                    Letti
                    <div class="icon d-flex align-items-center m-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                            <path
                                d="M96 318.3v1.689h1.689C97.12 319.4 96.56 318.9 96 318.3zM176 320c44.13 0 80-35.88 80-79.1s-35.88-79.1-80-79.1S96 195.9 96 240S131.9 320 176 320zM256 318.3C255.4 318.9 254.9 319.4 254.3 320H256V318.3zM544 160h-82.1L450.7 183.9C441.5 203.2 421.8 215.8 400 216c-21.23 0-40.97-12.31-50.3-31.35l-12.08-24.64H304c-8.836 0-16 7.161-16 15.1v175.1L64 352V80.01c0-8.834-7.164-15.1-16-15.1h-32c-8.836 0-16 7.163-16 15.1V496C0 504.8 7.164 512 16 512h32C56.84 512 64 504.8 64 496v-47.1h512V496c0 8.836 7.164 16 16 16h32c8.836 0 16-7.164 16-16V256C640 202.1 597 160 544 160zM624 48.01h-115.2l-24.88-37.31c-2.324-3.48-5.539-6.131-9.158-7.977c-1.172-.6016-2.486-.5508-3.738-.9512C468.8 1.035 466.5 0 464.1 0c-.625 0-1.25 .0254-1.875 .0781c-8.625 .6406-16.25 5.876-19.94 13.7l-42.72 90.81l-21.12-43.12c-4.027-8.223-12.39-13.44-21.54-13.44L208 48.02C199.2 48.01 192 55.18 192 64.02v15.99c0 8.836 7.163 15.1 15.1 16l133.1 .0091l36.46 74.55C382.5 178.8 390.8 184 400 184c9.219-.0781 17.78-5.438 21.72-13.78l45.91-97.52l8.406 12.62C480.5 91.1 487.1 96.01 496 96.01h128c8.836 0 16-7.164 16-16V64.01C640 55.18 632.8 48.01 624 48.01z" />
                        </svg>
                    </div>
                </label>
                <input type="number" id="beds" name="beds" min="1" max="99"
                    value="{{ old('beds') }}" class="col-1 form-control @error('beds') is-invalid @enderror">

                @error('beds')
                    <div class="invalid-feedback ml-3">Il numero di letti è obbligatorio</div>
                @enderror
            </div>

            <!-- Bagni -->
            <div class="form-group col-12 d-flex align-items-center my-5">
                <label class="col-2 d-flex justify-content-end align-items-center m-0 pr-1" for="bathrooms">
                    Bagni
                    <div class="icon d-flex align-items-center m-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M432 48C440.8 48 448 40.75 448 32V16C448 7.25 440.8 0 432 0h-416C7.25 0 0 7.25 0 16V32c0 8.75 7.25 16 16 16H32v158.7C11.82 221.2 0 237.1 0 256c0 60.98 33.28 115.2 84.1 150.4l-19.59 64.36C59.16 491.3 74.53 512 96.03 512h255.9c21.5 0 36.88-20.75 30.62-41.25L363 406.4C414.7 371.2 448 316.1 448 256c0-18.04-11.82-34.85-32-49.26V48H432zM96 72C96 67.63 99.63 64 104 64h48C156.4 64 160 67.63 160 72v16C160 92.38 156.4 96 152 96h-48C99.63 96 96 92.38 96 88V72zM224 288C135.6 288 64 273.7 64 256c0-17.67 71.63-32 160-32s160 14.33 160 32C384 273.7 312.4 288 224 288z" />
                        </svg>
                    </div>
                </label>
                <input type="number" id="bathrooms" name="bathrooms" min="1" max="99"
                    value="{{ old('bathrooms') }}" class="col-1 form-control @error('bathrooms') is-invalid @enderror">

                @error('bathrooms')
                    <div class="invalid-feedback ml-3">Il numero di bagni è obbligatorio</div>
                @enderror
            </div>

            <!-- metri quadrati -->
            <div class="form-group col-12 d-flex align-items-center my-5">
                <label class="col-2 d-flex justify-content-end align-items-center m-0 pr-1" for="bathrooms">
                    Metri quadrati
                    <div class="icon d-flex align-items-center m-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path
                                d="M416 32C433.7 32 448 46.33 448 64V128C448 145.7 433.7 160 416 160V352C433.7 352 448 366.3 448 384V448C448 465.7 433.7 480 416 480H352C334.3 480 320 465.7 320 448H128C128 465.7 113.7 480 96 480H32C14.33 480 0 465.7 0 448V384C0 366.3 14.33 352 32 352V160C14.33 160 0 145.7 0 128V64C0 46.33 14.33 32 32 32H96C113.7 32 128 46.33 128 64H320C320 46.33 334.3 32 352 32H416zM368 80V112H400V80H368zM96 160V352C113.7 352 128 366.3 128 384H320C320 366.3 334.3 352 352 352V160C334.3 160 320 145.7 320 128H128C128 145.7 113.7 160 96 160zM48 400V432H80V400H48zM400 432V400H368V432H400zM80 112V80H48V112H80z" />
                        </svg>
                    </div>
                </label>
                <input type="number" id="square_meters" name="square_meters" min="1" max="999"
                    value="{{ old('square_meters') }}"
                    class="col-1 form-control @error('square_meters') is-invalid @enderror">

                @error('square_meters')
                    <div class="invalid-feedback ml-3">Il numero di metri quadrati è obbligatorio</div>
                @enderror
            </div>

            <!-- address -->
            <div class="form-group col-12 d-flex align-items-center my-5">
                <label class="col-2 d-flex justify-content-end align-items-center m-0 pr-1" for="address">
                    Indirizzo completo
                    <div class="icon d-flex align-items-center m-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path
                                d="M168.3 499.2C116.1 435 0 279.4 0 192C0 85.96 85.96 0 192 0C298 0 384 85.96 384 192C384 279.4 267 435 215.7 499.2C203.4 514.5 180.6 514.5 168.3 499.2H168.3zM192 256C227.3 256 256 227.3 256 192C256 156.7 227.3 128 192 128C156.7 128 128 156.7 128 192C128 227.3 156.7 256 192 256z" />
                        </svg>
                    </div>
                </label>
                <input type="text" class="form-control col-8 @error('address') is-invalid @enderror" id="address"
                    name="address" placeholder="aggiungi l'indirizzo completo" value="{{ old('address') }}">
                @error('address')
                    <div class="alert alert-danger ml-3">L'indirizzo è obbligatorio</div>
                @enderror
            </div>

            <div class="form-check my-5 ml-5 col-2 pr-0 d-flex justify-content-start">
                <label class="form-check-label col-11 d-flex pr-4 pl-0" for="visible">
                    Visibile
                </label>
                <input class="form-check-input col-1 " type="checkbox" name="visible" id="visible" value="visible"
                    {{ old('visible') ? 'checked' : '' }}>
            </div>



            <div class="my-5 ml-5">
                <label for="mainImage" class="form-label">Inserisci l'immagine principale del tuo appartamento</label>
                <input class="form-control col-3" type="file" id="mainImage" name="mainImage">
            </div>

            <div class="form-group col-10 pl-4 ml-4 my-5">
                <label for="images">Inserisci delle altre immagini relative all'appartamento</label>
                <input class="form-control col-4" type="file" id="images" name="images[]" multiple><br><br>
            </div>


            {{-- <div class="form-group col-10 pl-4 my-5">
                <label class="col-2 d-flex">
                    <strong>Servizi</strong>
                    <div class="icon d-flex align-items-center m-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M280 145.3V112h16C309.3 112 320 101.3 320 88S309.3 64 296 64H215.1C202.7 64 192 74.75 192 87.1S202.7 112 215.1 112H232v33.32C119.6 157.3 32 252.4 32 368h448C480 252.4 392.4 157.3 280 145.3zM488 400h-464C10.75 400 0 410.7 0 423.1C0 437.3 10.75 448 23.1 448h464c13.25 0 24-10.75 24-23.1C512 410.7 501.3 400 488 400z" />
                        </svg>
                    </div>
                </label>
                @foreach ($services as $service)
                    <div class="form-check col-10 pl-4">
                        <input class="form-check-input" type="checkbox" name="services[]" id="{{ $service->slug }}"
                            value="{{ $service->id }}"
                            {{ old('services') && in_array($service->id, old('services')) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $service->id }}">
                            {{ $service->name }}
                        </label>
                    </div>
                @endforeach
            </div> --}}

{{-- <div class="d-flex">
                <button type="submit" class="btn btn-primary addApatmentBtn ml-4 mr-0">Aggiungi appartamento</button>
                <a href="{{ route('admin.apartments.index') }}">
                    <button type="button" class="btn btn-secondary cancelBtn ml-2">Annulla</button>
                </a>
            </div>
        </div>
    </form>
@endsection --}}
