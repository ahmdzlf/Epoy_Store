<!-- resources/views/components/navbar.blade.php -->
<nav class="bg-white shadow-sm">
  <div class="container mx-auto px-4">
    <div class="flex items-center justify-between h-20">
      
      <!-- LOGO -->
      <div class="flex items-center space-x-3">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
          <img src="{{ asset('images/logo.png') }}" alt="EpoyStore Logo" class="h-10 w-auto">
          <span class="text-lg font-semibold">EpoyStore</span>
        </a>
      </div>

      <!-- MENU (Desktop) -->
      <div class="hidden md:flex items-center space-x-8">
        <a href="{{ route('home') }}" class="text-gray-700 hover:text-black font-medium text-sm">Home</a>
        <a href="{{ route('shop') }}" class="text-gray-700 hover:text-black font-medium text-sm">Shop</a>
      </div>

      <!-- IKON KANAN -->
      <div class="flex items-center space-x-5">
        <!-- Search -->
        <button class="text-gray-700 hover:text-black">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-4.35-4.35M11 18a7 7 0 100-14 7 7 0 000 14z" />
          </svg>
        </button>

        <!-- Toggle Mobile -->
        <button id="mobileToggle" class="md:hidden text-gray-700 hover:text-black focus:outline-none">
          <svg id="iconOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg id="iconClose" class="hidden w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>

    <!-- MENU (Mobile) -->
    <div id="mobileMenu" class="hidden md:hidden border-t border-gray-100">
      <div class="flex flex-col items-start px-4 py-4 space-y-3">
        <a href="{{ route('home') }}" class="text-gray-700 hover:text-black text-sm font-medium">Home</a>
        <a href="{{ route('shop') }}" class="text-gray-700 hover:text-black text-sm font-medium">Shop</a>
      </div>
    </div>
  </div>
</nav>

<!-- Script Toggle Menu -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('mobileToggle');
    const menu = document.getElementById('mobileMenu');
    const openIcon = document.getElementById('iconOpen');
    const closeIcon = document.getElementById('iconClose');

    toggle.addEventListener('click', () => {
      menu.classList.toggle('hidden');
      openIcon.classList.toggle('hidden');
      closeIcon.classList.toggle('hidden');
    });
  });
</script>
