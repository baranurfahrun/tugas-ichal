<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandLogo(fn () => view('filament.logo'))
            ->brandLogoHeight('4rem')
            ->darkMode(false)
            ->colors([
                'primary' => \Filament\Support\Colors\Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                \Filament\Pages\Dashboard::class,
            ])
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\LatestPengajuan::class,
                \App\Filament\Widgets\BirthsChart::class,
                \App\Filament\Widgets\FaskesChart::class,
            ])
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn (): string => '
                <style>
                    :root { 
                        --primary: #0891b2; 
                        --primary-soft: #ecfdf5;
                        --body-bg: #f0fdf9; 
                    }
                    body { font-family: "Outfit", sans-serif !important; background-color: var(--body-bg) !important; }
                    
                    /* Sidebar: Minimalist & Clean */
                    .fi-sidebar { background: white !important; border-right: 1px solid #e2e8f0 !important; }
                    .fi-sidebar-header { margin-bottom: 20px !important; }
                    .fi-sidebar-item-button { border-radius: 12px !important; margin: 5px 15px !important; color: #64748b !important; }
                    .fi-sidebar-item-active .fi-sidebar-item-button { 
                        background: linear-gradient(135deg, #06b6d4 0%, #10b981 100%) !important; 
                        color: white !important; 
                        box-shadow: 0 10px 15px -3px rgba(6, 182, 212, 0.3) !important;
                    }
                    .fi-sidebar-item-active .fi-sidebar-item-icon { color: white !important; }
                    
                    /* Header: Soft Gradient Ice Blue + Elegant Green */
                    .fi-topbar { 
                        background: linear-gradient(90deg, #0369a1 0%, #0891b2 35%, #06b6d4 65%, #10b981 100%) !important; 
                        height: 75px !important;
                    }
                    .fi-topbar .fi-logo span { color: white !important; }
                    
                    /* Modern Floating Background Section */
                    main::before {
                        content: ""; position: absolute; top: 0; left: 0; right: 0; height: 160px; 
                        background: linear-gradient(180deg, #06b6d4 0%, rgba(16, 185, 129, 0) 100%);
                        opacity: 0.08; z-index: 0; pointer-events: none;
                    }

                    /* Content Polish */
                    main { padding-top: 0 !important; padding-left: 20px !important; padding-right: 20px !important; padding-bottom: 20px !important; }
                    .fi-main-ctn { padding-top: 0 !important; padding-bottom: 0 !important; margin-top: 0 !important; }
                    .fi-page { padding-top: 0 !important; gap: 0.5rem !important; }
                    .fi-header { margin-top: 0 !important; padding-top: 0 !important; margin-bottom: 0 !important; gap: 0 !important; }
                    .fi-breadcrumbs { margin-top: 0 !important; margin-bottom: 0 !important; }
                    .fi-header-heading { margin-top: 0 !important; margin-bottom: 0 !important; line-height: 1 !important; }
                    .fi-wi-stats-overview, .fi-wi-chart-widget, .fi-section, .fi-ta-ctn { 
                        background: white !important; 
                        border-radius: 24px !important; 
                        border: 1px solid rgba(226, 232, 240, 0.8) !important; 
                        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -2px rgba(0, 0, 0, 0.02) !important;
                        transition: transform 0.3s ease, box-shadow 0.3s ease !important;
                    }
                    
                    .fi-wi-stats-overview-stat-ctn:hover, .fi-wi-chart-widget:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05) !important;
                    }

                    /* Widget & Chart Details */
                    .fi-wi-stats-overview-stat-ctn { border: none !important; padding: 20px !important; }
                    .fi-wi-chart-widget { padding: 30px !important; }
                    .fi-wi-chart-widget-header { border-bottom: 2px solid #f8fafc !important; margin-bottom: 20px !important; }
                    .fi-wi-chart-widget-heading { color: #1e293b !important; font-weight: 700 !important; font-size: 1.1rem !important; }
                    
                    /* Custom Scrollbar for Premium Feel */
                    ::-webkit-scrollbar { width: 8px; }
                    ::-webkit-scrollbar-track { background: #f1f5f9; }
                    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
                    ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
                    
                    /* Custom Login Background */
                    .fi-simple-layout {
                        background-image: url(/images/bg-login.jpeg) !important;
                        background-size: cover !important;
                        background-position: center !important;
                        background-repeat: no-repeat !important;
                        background-attachment: fixed !important;
                        position: relative !important;
                        z-index: 1;
                    }
                    /* Add a subtle overlay so the login card stands out against the background */
                    .fi-simple-layout::before {
                        content: "";
                        position: absolute;
                        inset: 0;
                        background: rgba(0, 0, 0, 0.4);
                        z-index: -1;
                    }
                    /* Ensure the card is above the overlay */
                    .fi-simple-main {
                        position: relative;
                        z-index: 1;
                    }
                    /* Hide "Masuk ke akun Anda" text */
                    .fi-simple-header-heading {
                        display: none !important;
                    }
                </style>'
            )
            ->renderHook(
                \Filament\View\PanelsRenderHook::BODY_END,
                fn (): string => '
                <script>
                    document.addEventListener("livewire:initialized", () => {
                        let lastUnreadCount = null;
                        let audioCtx = null;

                        // Create context on first interaction to unlock audio
                        const unlockAudio = () => {
                            if (!audioCtx) {
                                audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                            }
                            if (audioCtx.state === "suspended") {
                                audioCtx.resume();
                            }
                            ["click", "touchstart", "keydown", "mousedown"].forEach(e => {
                                document.removeEventListener(e, unlockAudio);
                            });
                        };
                        ["click", "touchstart", "keydown", "mousedown"].forEach(e => {
                            document.addEventListener(e, unlockAudio);
                        });
                        
                        const playNotificationSound = () => {
                            try {
                                if (!audioCtx) {
                                    audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                                }
                                if (audioCtx.state === "suspended") {
                                    audioCtx.resume();
                                }

                                const osc = audioCtx.createOscillator();
                                const gain = audioCtx.createGain();
                                
                                osc.connect(gain);
                                gain.connect(audioCtx.destination);
                                
                                osc.type = "sine";
                                osc.frequency.setValueAtTime(880, audioCtx.currentTime); 
                                osc.frequency.exponentialRampToValueAtTime(1760, audioCtx.currentTime + 0.05);
                                
                                gain.gain.setValueAtTime(0, audioCtx.currentTime);
                                gain.gain.linearRampToValueAtTime(0.5, audioCtx.currentTime + 0.02);
                                gain.gain.exponentialRampToValueAtTime(0.001, audioCtx.currentTime + 0.5);
                                
                                osc.start(audioCtx.currentTime);
                                osc.stop(audioCtx.currentTime + 0.6);
                                console.log("Ding played!");
                            } catch (e) {
                                console.error("Audio play failed:", e);
                            }
                        };

                        const checkNotificationCount = () => {
                            const btn = document.querySelector(".fi-topbar-database-notifications-btn");
                            if (btn) {
                                const badge = btn.querySelector(".fi-badge");
                                let currentCount = 0;
                                if (badge) {
                                    currentCount = parseInt(badge.innerText.trim().replace(/[^0-9]/g, "") || "0", 10);
                                }
                                
                                if (lastUnreadCount === null) {
                                    lastUnreadCount = currentCount;
                                    return;
                                }

                                if (currentCount > lastUnreadCount) {
                                    console.log("New notification detected! Playing sound...");
                                    playNotificationSound();
                                }
                                lastUnreadCount = currentCount;
                            }
                        };

                        checkNotificationCount();

                        Livewire.hook("commit", ({ component, commit, respond, succeed, fail }) => {
                            succeed(({ snapshot, effect }) => {
                                setTimeout(checkNotificationCount, 500); // add small delay to ensure DOM is updated
                            });
                        });
                    });
                </script>'
            )
            ->navigationItems([
                \Filament\Navigation\NavigationItem::make('Permohonan Baru')
                    ->url(fn (): string => \App\Filament\Resources\PengajuanKelahiranResource::getUrl('create'))
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.resources.pengajuan-kelahirans.create'))
                    ->icon('heroicon-o-plus-circle')
                    ->group('Manajemen Kependudukan')
                    ->sort(1),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
