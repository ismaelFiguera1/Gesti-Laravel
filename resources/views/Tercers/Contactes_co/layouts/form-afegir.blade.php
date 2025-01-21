<div id="overlay-form" class="overlay" style="display: none;">
    <div class="overlay-content">


        <div class="card">
            <div class="card-header">
                <button type="button" class="close-btn" id="close-form-btn">&times;</button>
                <h5>Afegir Contacte</h5>
            </div>
            <div class="card-body">
                <form action="{{route('contactes.afegir')}}" method="GET" id="form-afegir">
                    <div class="errors" id="error">

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nomcomplet" placeholder="Nom Complet *" value="{{old('nomcomplet')}}"/>
                                @if ($errors->has('nomcomplet'))
                                    <div class="text-danger">{{ $errors->first('nomcomplet') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="usuari" placeholder="Nom usuari *" value="{{old('usuari')}}"/>
                                @if ($errors->has('usuari'))
                                    <div class="text-danger">{{ $errors->first('usuari') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="E-mail *" value="{{old('email')}}"/>
                                @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="telefon" placeholder="Telèfon *" value="{{old('telefon')}}"/>
                                @if ($errors->has('telefon'))
                                    <div class="text-danger">{{ $errors->first('telefon') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="contrasenya" id="contrasenya1" placeholder="Contrasenya *" value=""/>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="ContrasnyaRep" id="contrasenya2" placeholder="Confirma la Contrasenya *" value=""/>
                            </div>
                            @if ($errors->has('contrasenya'))
                                <div class="text-danger">{{ $errors->first('contrasenya') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="button" class="btn btn-outline-secondary" id="close-form-btn-2">Tancar</button>
                        <button type="button" id="btn-afegir" class="btn btn-dark">Afegir Contact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
