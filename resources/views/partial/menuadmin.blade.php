<div class="w-64 min-h-screen flex flex-col bg-gradient-to-b from-primary-green to-green-800 shadow-lg">
    <!-- Logo and Brand -->
    <div class="flex flex-col items-center py-6">
        <svg class="w-12 h-12 mb-2" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#ffffff">
            <g id="SVGRepo_iconCarrier">
                <title>recycle</title>
                <g id="Q3_icons" data-name="Q3 icons">
                    <g>
                        <path d="M45.4,33l-3.9-6.2A2,2,0,1,0,38.1,29L42,35.2H25.5l2.4-2.5a2.1,2.1,0,0,0-.1-2.9A2,2,0,0,0,25,30l-5.6,5.8a2.1,2.1,0,0,0,0,2.8l5.7,5.8a1.9,1.9,0,0,0,2.8,0,1.9,1.9,0,0,0,0-2.8l-2.2-2.3H42a3.9,3.9,0,0,0,3.5-2.1A4.2,4.2,0,0,0,45.4,33Z"></path>
                        <path d="M19.8,14.6l4.1-7.5,7.6,11.8-3.2-.7a2.1,2.1,0,0,0-2.4,1.6,1.9,1.9,0,0,0,1.5,2.3l7.8,1.7h.4a2,2,0,0,0,1.1-.3,2,2,0,0,0,.8-1.3l1.7-8a2.1,2.1,0,0,0-1.6-2.4,2.1,2.1,0,0,0-2.4,1.6l-.6,3L27.3,4.9A3.9,3.9,0,0,0,24,3a4.2,4.2,0,0,0-3.4,1.8h0l-4.3,7.8a2,2,0,0,0,3.5,1.9Z"></path>
                        <path d="M16.3,19.8a1.8,1.8,0,0,0-.9-1.3,1.9,1.9,0,0,0-1.5-.3L6.1,19.7a2.1,2.1,0,0,0-1.5,2.4,1.9,1.9,0,0,0,2.3,1.5l2.6-.5L2.7,32.9a4.2,4.2,0,0,0-.2,4.3A3.9,3.9,0,0,0,6,39.3h7.1a2,2,0,1,0,0-4H6l7.2-10.3.6,3.7a2,2,0,0,0,2,1.6h.4a2.1,2.1,0,0,0,1.6-2.4Z"></path>
                    </g>
                </g>
            </g>
        </svg>
        <h1 class="text-white text-xl font-bold">CleanSweep</h1>
        <div class="mt-4 border-b border-white/30 w-4/5 opacity-70"></div>
    </div>
    
    <!-- Menu Items -->
    <nav class="flex-grow px-4 py-4 space-y-2">
        <!-- Dashboard Menu -->
        <div class="mb-6">
            <h2 class="text-white/70 text-xs uppercase tracking-wider mb-2 px-3">Main Menu</h2>
            
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 
                     {{ request()->routeIs('admin.admin.dashboard') ? 
                        'bg-white/20 text-white font-medium shadow-sm' : 
                        'text-white/80 hover:bg-white/10' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"></path>
                </svg>
                <span>{{ __('Dashboard') }}</span>
            </a>
            
            <!-- Articles -->
            <a href="{{ route('admin.home') }}" 
               class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 mt-1
                     {{ request()->routeIs('admin.home') ? 
                        'bg-white/20 text-white font-medium shadow-sm' : 
                        'text-white/80 hover:bg-white/10' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"></path>
                </svg>
                <span>{{ __('Artikel') }}</span>
            </a>
        </div>
        
        <!-- Waste Management Section -->
        <div class="mb-6">
            <h2 class="text-white/70 text-xs uppercase tracking-wider mb-2 px-3">Waste Management</h2>
            
            <!-- Pickup Requests -->
            <a href="{{ route('admin.pickup-requests') }}" 
               class="flex items-center px-3 py-3 rounded-lg transition-all duration-200
                     {{ request()->routeIs('admin.pickup-requests') ? 
                        'bg-white/20 text-white font-medium shadow-sm' : 
                        'text-white/80 hover:bg-white/10' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19 7h-3V5.5A2.5 2.5 0 0 0 13.5 3h-3A2.5 2.5 0 0 0 8 5.5V7H5a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-8a3 3 0 0 0-3-3zm-9-1.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V7h-4zM8 18v-5h2v5zm3 0v-5h2v5zm5 0h-2v-5h2z"></path>
                </svg>
                <span>{{ __('Pickup Requests') }}</span>
            </a>
            
            <!-- TPA & TPS -->
            <a href="{{ route('tps-tpa.index') }}" 
               class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 mt-1
                     {{ request()->routeIs('tps-tpa.index') ? 
                        'bg-white/20 text-white font-medium shadow-sm' : 
                        'text-white/80 hover:bg-white/10' }}">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
                </svg>
                <span>{{ __('TPA & TPS') }}</span>
            </a>
        </div>
    </nav>
    
    <!-- Simple Footer -->
    <div class="px-4 py-4 mt-auto">
        <div class="border-t border-white/30 w-full opacity-70"></div>
    </div>
</div>


            