<div style="display: flex; flex-direction: column; line-height: 1.3; white-space: nowrap;">
    <span style="font-size: 1.1rem; font-weight: 800; color: white; letter-spacing: 0.01em;">
        SURA'PIA TANA TORAJA
    </span>
    @auth
        @if(auth()->user()->faskes)
            <span style="font-size: 0.65rem; font-weight: 500; color: rgba(255,255,255,0.85); margin-top: 2px; display: block;">
                {{ auth()->user()->faskes->nama_faskes }}
            </span>
        @else
            <span style="font-size: 0.65rem; font-weight: 500; color: rgba(255,255,255,0.85); margin-top: 2px; display: block;">
                Dinas Kependudukan &amp; Pencatatan Sipil
            </span>
        @endif
    @endauth
</div>
