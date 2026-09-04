<!DOCTYPE html>
<html lang="en" class="h-full bg-[#FDFCF9]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TET Admin | Boutique CMS</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Custom Boutique Scrollbar for Sidebar -->
    <style>
        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>

    @livewireStyles
</head>
<body class="h-full font-sans text-slate-900 antialiased overflow-hidden">
    <div class="flex h-full">
        <!-- SIDEBAR: Institutional Navy -->
        <aside class="w-72 bg-[#1A365D] text-white flex flex-col shadow-2xl z-50 h-full">
            <div class="p-8 flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-pink-400 to-blue-400"></div>
                    <h1 class="font-serif text-2xl italic tracking-tighter">TET Admin</h1>
                </div>
                <p class="text-[9px] uppercase tracking-[0.3em] text-blue-300/60 mt-3 font-black">Boutique Command Center</p>
            </div>
            
            <!-- FIXED: Added overflow-y-auto and sidebar-scroll class -->
            <nav class="flex-1 px-6 space-y-1 overflow-y-auto sidebar-scroll pb-10">
                <a href="#" class="flex items-center gap-3 p-3 rounded-xl bg-white/10 text-white text-sm font-medium">
                    <span class="opacity-50 text-lg">📁</span> Dashboard
                </a>

                <div class="pt-8 pb-2 text-[10px] uppercase tracking-widest text-white/40 font-bold">Site Configuration</div>
                
                <a href="/admin/settings" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all text-white/70 hover:text-white text-sm {{ request()->is('admin/settings') ? 'bg-white/10 text-white' : '' }}">
                    <span class="text-lg">⚙️</span> General Identity
                </a>
                
                <a href="/admin/home" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all text-white/70 hover:text-white text-sm {{ request()->is('admin/home') ? 'bg-white/10 text-white' : '' }}">
                    <span class="text-lg">🏠</span> Home Page Content
                </a>

                <a href="/admin/about" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all text-white/70 hover:text-white text-sm {{ request()->is('admin/about') ? 'bg-white/10 text-white' : '' }}">
                    <span class="text-lg">📄</span> About Page Content
                </a>

                <a href="/admin/services" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all text-white/70 hover:text-white text-sm {{ request()->is('admin/services') ? 'bg-white/10 text-white' : '' }}">
                    <span class="text-lg">🛠️</span> Manage Services
                </a>

                <a href="/admin/booking" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all text-white/70 hover:text-white text-sm {{ request()->is('admin/booking') ? 'bg-white/10 text-white' : '' }}">
                    <span class="text-lg">🏢</span> TET Spaces (Enterprise)
                </a>

                <div class="pt-8 pb-2 text-[10px] uppercase tracking-widest text-white/40 font-bold">Advocacy & Media</div>

                <a href="/admin/projects" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all text-white/70 hover:text-white text-sm {{ request()->is('admin/projects') ? 'bg-white/10 text-white' : '' }}">
                    <span class="text-lg">📊</span> Advocacy Projects
                </a>

                <a href="/admin/news" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all text-white/70 hover:text-white text-sm {{ request()->is('admin/news') ? 'bg-white/10 text-white' : '' }}">
                    <span class="text-lg">📰</span> Media Journal
                </a>

                <a href="/admin/gallery" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all text-white/70 hover:text-white text-sm {{ request()->is('admin/gallery') ? 'bg-white/10 text-white' : '' }}">
                    <span class="text-lg">🖼️</span> Photo Gallery & Events
                </a>

                <div class="pt-8 pb-2 text-[10px] uppercase tracking-widest text-white/40 font-bold">Inquiries & Support</div>

                <a href="/admin/contact" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all text-white/70 hover:text-white text-sm {{ request()->is('admin/contact') ? 'bg-white/10 text-white' : '' }}">
                    <span class="text-lg">📞</span> Contact & Hotline
                </a>

                <a href="/admin/volunteer" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all text-white/70 hover:text-white text-sm {{ request()->is('admin/volunteer') ? 'bg-white/10 text-white' : '' }}">
                    <span class="text-lg">💜</span> Volunteer Management
                </a>

                <a href="/admin/donate" class="flex items-center gap-3 p-3 rounded-xl hover:bg-white/5 transition-all text-white/70 hover:text-white text-sm {{ request()->is('admin/donate') ? 'bg-white/10 text-white' : '' }}">
                    <span class="text-lg">💰</span> Donation Desk
                </a>
            </nav>

            <div class="p-6 border-t border-white/10 flex-shrink-0">
                <div class="bg-white/5 p-4 rounded-2xl flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-slate-400"></div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-bold truncate">Admin User</p>
                        <p class="text-[9px] text-white/40 uppercase tracking-widest">Sign Out</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN WORKSPACE -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>
</html>