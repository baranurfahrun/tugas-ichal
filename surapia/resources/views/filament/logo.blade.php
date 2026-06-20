<style>
    .custom-logo-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        gap: 8px;
        line-height: 1.3;
        white-space: nowrap;
    }
    .custom-logo-container img {
        height: 64px; /* Slightly larger on login page */
        width: auto;
        object-fit: contain;
    }
    .custom-logo-text {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    /* When inside the topbar, make it a row layout */
    .fi-topbar .custom-logo-container {
        flex-direction: row;
        gap: 12px;
    }
    .fi-topbar .custom-logo-container img {
        height: 48px;
    }
    .fi-topbar .custom-logo-text {
        text-align: left;
        align-items: flex-start;
    }
    
    /* Override Filament's fixed height wrapper so tall stacked logos don't overflow */
    .fi-logo {
        height: auto !important;
    }
</style>

<div class="custom-logo-container">
    <img src="{{ asset('images/logo.png') }}" alt="Logo">
    <div class="custom-logo-text">
        <span style="font-size: 1.2rem; font-weight: 800; letter-spacing: 0.01em; color: #1e293b;">
            SURA'PIA TANA TORAJA
        </span>
        @auth
            @if(auth()->user()->faskes)
                <span style="font-size: 0.75rem; font-weight: 500; margin-top: 2px; display: block; opacity: 0.85;">
                    {{ auth()->user()->faskes->nama_faskes }}
                </span>
            @else
                <span style="font-size: 0.75rem; font-weight: 500; margin-top: 2px; display: block; opacity: 0.85;">
                    Dinas Kependudukan &amp; Pencatatan Sipil
                </span>
            @endif
        @endauth
    </div>
</div>
