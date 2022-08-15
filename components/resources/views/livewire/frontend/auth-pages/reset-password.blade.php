<div>
    <section id="reset-password-page">
        <div class="page page-center">
            <div class="container-tight">
                <form class="card card-md" wire:submit.prevent="onResetPassword">

                    <div class="card-body">
                        <h2 class="text-center d-block pb-2">{{ __('Reset Password') }}!</h2>
                        <p class="text-muted mb-4">{{ __('Please enter your email address. You will receive a link to create a new password via email.') }}</p>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" wire:model="token">

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('Email') }}</label>
                            <input class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter your email') }}" type="email" wire:model="email" readonly />
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('Password') }}</label>
                            <input class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Enter password') }}" type="password" wire:model="password" required />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label class="form-label">{{ __('Confirm Password') }}</label>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('Enter confirm password') }}" type="password" wire:model="password_confirmation" required />
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">
                                <span>
                                  <div wire:loading wire:target="onResetPassword">
                                    <x-loading />
                                  </div>
                                  <span>{{ __('Reset Password') }}</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="text-center text-muted mt-3">
                    {{ __('Back to') }} 
                    <a href="{{ route('login') }}" tabindex="-1"> {{ __('Sign in') }}</a>
                </div>
            </div>
        </div>
    </section>
</div>
