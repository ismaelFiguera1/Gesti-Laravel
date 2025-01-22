<div id="overlay-form" class="overlay" style="display: none;">
    <div class="overlay-content">
        <fieldset>


                <button type="button" class="close-btn" id="close-form-btn">&times;</button>
                <h5>Afegir Contacte</h5>

            <div class="card-body">
                <form action="{{route('contactes.afegir')}}" method="get" id="form-afegir">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nomcomplet" placeholder="Nom Complet *" value="{{old('nomcomplet')}}" required/>
                                @error('nomcomplet')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="usuari" placeholder="Nom usuari *" value="{{old('usuari')}}"/>

                                @error('usuari')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="E-mail *" value="{{old('email')}}"/>
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="telefon" placeholder="Telèfon *" value="{{old('telefon')}}"/>
                                @error('telefon')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="contrasenya" id="contrasenya1" placeholder="Contrasenya *" />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="contrasenya_confirmation" id="contrasenya2" placeholder="Confirma la Contrasenya *" />
                            </div>
                            @error('contrasenya')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-outline-secondary" id="close-form-btn-2">Tancar</button>
                        <button type="button" id="btn-afegir" class="btn btn-dark">Afegir Contact</button>

                    </div>

                </form>

            </div>
        </fieldset>
        </div>

    </div>
</div>
