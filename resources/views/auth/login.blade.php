@extends('layouts.app')

@section('title', 'Login Admin')

@section('styles')
<style>
    .login-container {
        max-width: 440px;
        margin: 5% auto;
    }
    .login-card {
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }
    .login-header {
        background: linear-gradient(135deg, var(--secondary) 0%, #1e293b 100%);
        padding: 2.5rem 2rem 2rem 2rem;
        text-align: center;
        color: #ffffff;
    }
    .login-header i {
        font-size: 3rem;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, var(--primary-light), var(--primary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <i class="fa-solid fa-user-shield"></i>
            <h3 class="fw-bold mb-1" style="font-family: var(--font-heading);">Portal Admin</h3>
            <p class="text-light-subtle mb-0 small">Masukkan username dan password untuk masuk ke dashboard.</p>
        </div>
        
        <div class="card-body p-4 p-md-5">
            <!-- Global error if any -->
            @if($errors->any())
                <div class="alert alert-danger border-0 rounded-3 small py-2 px-3 mb-4 d-flex align-items-center">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i>
                    <div>
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                
                <!-- Username Field -->
                <div class="mb-4">
                    <label for="username" class="form-label fw-semibold text-secondary small">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="text" 
                               name="username" 
                               id="username" 
                               class="form-control bg-light border-start-0 ps-0 @error('username') is-invalid @enderror" 
                               value="{{ old('username') }}" 
                               placeholder="Contoh: admin" 
                               required 
                               autofocus>
                    </div>
                    @error('username')
                        <span class="invalid-feedback d-block mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label fw-semibold text-secondary small mb-0">Password</label>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control bg-light border-start-0 ps-0 @error('password') is-invalid @enderror" 
                               placeholder="••••••••" 
                               required>
                    </div>
                    @error('password')
                        <span class="invalid-feedback d-block mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me Checkbox -->
                <div class="mb-4 form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label class="form-check-label text-muted small" for="remember">Ingat Saya di Perangkat Ini</label>
                </div>

                <!-- Submit Button -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-custom-primary py-2.5 fs-6">
                        <i class="fa-solid fa-right-to-bracket me-2"></i>Masuk Sekarang
                    </button>
                </div>
                
                <div class="text-center mt-4">
                    <a href="{{ route('catalog') }}" class="text-decoration-none text-muted small">
                        <i class="fa-solid fa-arrow-left me-1"></i>Kembali ke Katalog Publik
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
