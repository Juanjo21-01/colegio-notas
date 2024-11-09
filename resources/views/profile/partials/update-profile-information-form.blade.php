<section>
    <header class="mb-4">
        <p class="text-muted">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="row mb-3">
            <div class="col">
                <label for="nombres" class="form-label">{{ __('Nombres') }}</label>
                <input id="nombres" name="nombres" type="text"
                    class="form-control @error('nombres') is-invalid @enderror"
                    value="{{ old('nombres', $user->nombres) }}" required autofocus autocomplete="name">
                @error('nombres')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col">
                <label for="apellidos" class="form-label">{{ __('Apellidos') }}</label>
                <input id="apellidos" name="apellidos" type="text"
                    class="form-control @error('apellidos') is-invalid @enderror"
                    value="{{ old('apellidos', $user->apellidos) }}" required autocomplete="family-name">
                @error('apellidos')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            {{-- dpi y telefono --}}
            <div class="col">
                <label for="dpi" class="form-label">{{ __('DPI') }}</label>
                <input id="dpi" name="dpi" type="text"
                    class="form-control @error('dpi') is-invalid @enderror" value="{{ old('dpi', $user->dpi) }}"
                    required autocomplete="username">
                @error('dpi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="col">
                <label for="telefono" class="form-label">{{ __('Teléfono') }}</label>
                <input id="telefono" name="telefono" type="text"
                    class="form-control @error('telefono') is-invalid @enderror"
                    value="{{ old('telefono', $user->telefono) }}" required autocomplete="username">
                @error('telefono')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>


        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email"
                class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}"
                required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="small text-warning">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="btn btn-link p-0 align-baseline text-warning">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="small text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-2">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="mb-0 small text-muted">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
