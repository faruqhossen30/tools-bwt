<div>
    <section id="register-page">
        <div class="page page-center">
            <div class="container-tight">
                <form class="card card-md" wire:submit.prevent="onRegister">

                    <div class="card-header text-center d-block pb-2 pt-4 border-0">
                        <h2>{{ __('Hello, Friend!') }}</h2>
                        <p class="mb-0">{{ __('Create an account to start journey with us.') }}</p>
                    </div>

                    <div class="card-body">

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <div class="mb-3">
                            <label class="form-label">{{ __('Full name') }}</label>
                            <input class="form-control @error('fullname') is-invalid @enderror" placeholder="{{ __('Enter your name') }}" type="text" wire:model="fullname" required autofocus />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Email') }}</label>
                            <input class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter your email') }}" type="email" wire:model="email" required />
                        </div>

                        <div class="mb-2">
                            <label class="form-label">{{ __('Password') }}</label>
                            <div class="input-group input-group-flat">
                                <input class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Enter password') }}" type="password" wire:model="password" required />
                            </div>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">
                                <span>
                                  <div wire:loading wire:target="onRegister">
                                    <x-loading />
                                  </div>
                                  <span>{{ __('Sign up') }}</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="text-center text-muted mt-3">
                    {{ __('Already have an account?') }} 
                    <a href="{{ route('login') }}" tabindex="-1">{{ __('Sign in') }}</a>
                </div>
            </div>
        </div>
    </section>
</div>