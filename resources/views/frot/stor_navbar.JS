class MainNavbar extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `
        <nav class="sticky top-0 z-50 bg-white/95 dark:bg-background-darks/95 backdrop-blur-md border-b border-slate-200 dark:border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 lg:px-16 h-16 flex items-center justify-between">
        
        <div class="flex items-center gap-8 xl:gap-12">
            <a href="home.html" class="shrink-0 transition-transform hover:scale-105">
                <img src="assets/img/KANANI-Logo-l.svg" alt="Logo" class="h-10 dark:hidden">
                <img src="assets/img/KANANI-Logo-d.svg" alt="Logo" class="h-10 hidden dark:block">
            </a>

            <div class="hidden ms-12 lg:flex items-center gap-5 xl:gap-8">
                <a class="text-sm font-medium text-primarys transition-colors " href="stor.html">المنتجات</a>
<a class="text-sm font-medium hover:text-primarys transition-colors text-slate-600 dark:text-slate-300" href="home.html">الجمعية</a>
                <div class="relative group">
                    <button class="flex items-center gap-1 text-sm font-medium hover:text-primarys transition-colors text-slate-600 dark:text-slate-300">
                        <span>من نحن</span>
                        <span class="material-symbols-outlined text-[18px] group-hover:rotate-180 transition-transform">expand_more</span>
                    </button>
                    <ul class="absolute start-0 mt-2 w-48 bg-white dark:bg-card-dark border border-slate-100 dark:border-white/10 rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 py-2">
                    <li><a href="about_us.html" class="block px-4 py-2 text-sm hover:bg-primarys/10 hover:text-primarys transition-colors">من نحن</a></li>
                        <li><a href="our_team.html" class="block px-4 py-2 text-sm hover:bg-primarys/10 hover:text-primarys transition-colors">فريقنا</a></li>
                    </ul>
                </div>

                <a class="text-sm font-medium hover:text-primarys transition-colors text-slate-600 dark:text-slate-300" href="success_partners.html">شركاء النجاح</a>
            </div>
        </div>

        <div class="flex items-center gap-3 sm:gap-6">
                <div class="hidden md:flex relative">
                    <input
                        class="bg-slate-100 dark:bg-surface-darks border border-slate-200 dark:border-primarys/20 rounded-lg py-2 pr-10 pl-4 text-sm focus:ring-2 focus:ring-primarys w-64 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500"
                        placeholder="ابحث عن منتج..." type="text" />
                    <span
                        class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-500 dark:text-[#9cbaaf]">search</span>
                </div>
                 <div class="flex items-center gap-4 relative group">
                    <button class="p-2 hover:bg-primarys/10 rounded-lg relative"><span
                            class="material-symbols-outlined">shopping_bag</span>
                        <span
                            class="absolute -top-1 -right-1 size-5 bg-primarys text-white text-[10px] font-bold rounded-full flex items-center justify-center border-2 border-background-light dark:border-background-dark">2</span></button>
                    <div
                        class="absolute top-full left-0 mt-2 w-80 bg-white dark:bg-background-dark border border-primarys/20 rounded-xl shadow-2xl z-[60] overflow-hidden hidden group-hover:block sm:block opacity-0 translate-y-2 pointer-events-none group-hover:opacity-100 group-hover:translate-y-0 group-hover:pointer-events-auto transition-all duration-200">
                        <div class="p-4 border-b border-primarys/10">
                            <h3 class="font-bold">سلة التسوق (2)</h3>
                        </div>
                        <div class="max-h-60 overflow-y-auto p-4 space-y-4">
                            <!-- Item 1 -->
                            <div class="flex gap-3">
                                <img alt="Item" class="size-12 rounded object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA_bjaDDd46u0nMObKTFIo1nZLV4W2qhb2J7HPC0p5XkgL5oTMHKIjE8aNPut67PapiIhPpHEtn0MO4uc4qeFMUncSMh6e0P-VQ04wH6KpZKavgphokLiejdCKQ8tbfMTwtKYTqEnS1t83Yzyi3TV8WmM1HRwSGi1yw1_ZYyJSD8N1TODmqwYwCUrvkgZQKfy1Md0L4zWzYdjqjvdZ4fkRITo45DJPw83yhcq6QBQKNTaEd1iZ83dvq5jR37dW5f-ELQyGd3S7YfC0" />
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-xs font-semibold truncate">شال فلسطيني مطرز يدوياً</h4>
                                    <p class="text-[10px] text-slate-500">الكمية: 1</p>
                                    <p class="text-xs font-bold text-primarys">450 NIS</p>
                                </div>
                            </div>
                            <!-- Item 2 -->
                            <div class="flex gap-3">
                                <img alt="Item" class="size-12 rounded object-cover"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBhdSnvUmU_-ElBxkWUGmvXR8T4SZ60tMw82PQnFQbAdOr4ASng8KUlX1LMLTlRR_17VaHjOe_s_w2mqPaLZfl8q2AH-FNVQHz1zpjtBuct4b8MuBnntE9Tb8H9s4oeqB8QjgNtQQEzqFauzkwWmqNEU8hLDsd6wMG6XbMNw1eAph2_74W4104X30jrqZbrEGr4CpJpE-yQpHBGHw8gqi91bJ7m7XzMjoZ_aj9e1N38TRlUmKEWK0vPuLXHLFCJVzpg82gf09wUYmY" />
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-xs font-semibold truncate">غطاء وسادة - شجرة زيتون</h4>
                                    <p class="text-[10px] text-slate-500">الكمية: 1</p>
                                    <p class="text-xs font-bold text-primarys">150 NIS</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-primarys/5 border-t border-primarys/10 space-y-2">
                            <div class="flex justify-between text-xs">
                                <span class="text-slate-500">المجموع</span>
                                <span>600 NIS</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="text-slate-500">الخصم</span>
                                <span class="text-primarys font-bold">-90 NIS</span>
                            </div>
                            <div class="flex justify-between items-center pt-2 border-t border-primarys/10">
                                <span class="font-bold">السعر الإجمالي</span>
                                <span class="text-lg font-bold text-primarys">510 NIS</span>
                            </div>
                            <div class="grid grid-cols-1 mt-4">

                                <button
                                    class="text-[10px] font-bold py-2 bg-primarys text-white rounded hover:bg-primarys/5">إتمام
                                    الشراء</button>
                            </div>
                        </div>
                    </div>

                </div>
            
            <button class="flex items-center gap-1 hover:text-primarys transition-colors text-sm font-medium text-slate-600 dark:text-slate-300">
                <span class="material-symbols-outlined text-[20px]">language</span>
                <span class="hidden sm:inline">EN</span>
            </button>
        

            <button id="mobile-menu-btn" class="lg:hidden p-2 text-slate-600 dark:text-slate-300 hover:bg-gray-100 dark:hover:bg-white/5 rounded-lg transition-colors">
                <span class="material-symbols-outlined text-3xl" id="menu-icon">menu</span>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="lg:hidden hidden bg-white dark:bg-background-darks border-b border-slate-200 dark:border-white/10 max-h-[calc(100vh-64px)] overflow-y-auto">
        <div class="flex flex-col p-4 space-y-4">
            <a href="home.html" class="text-base font-semibold text-slate-900 dark:text-white px-4">المنتجات</a>
            <a href="grants.html" class="text-base font-medium text-slate-600 dark:text-slate-300 px-4">الجمعية</a>
            <div class="px-4 border-s-2 border-primarys/20 ms-2">
                <span class="text-xs font-bold text-primarys uppercase">من نحن</span>
                <div class="flex flex-col mt-2 gap-3 ps-4">
                    <a href="about_us.html" class="text-sm text-slate-600 dark:text-slate-300">من نحن</a>
                    <a href="our_team.html" class="text-sm text-slate-600 dark:text-slate-300">فريقنا</a>
                </div>
            </div>



            
            <a href="success_partners.html" class="text-base font-medium text-slate-600 dark:text-slate-300 px-4">شركاء النجاح</a>
        </div>
    </div>
</nav>
<aside class="fixed ltr:right-4 rtl:left-4 top-1/2 -translate-y-1/2 z-[60] hidden xl:flex flex-col gap-3 p-2 rounded-2xl bg-white/80 dark:bg-bg-dark-card/60 backdrop-blur-md shadow-xl border border-slate-200 dark:border-slate-800">
    
    <a class="w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(11,166,109,0.4)] text-slate-400 dark:text-slate-500 hover:text-primarys" href="#" title="Facebook">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path></svg>
    </a>

    <a class="w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(11,166,109,0.4)] text-slate-400 dark:text-slate-500 hover:text-primarys" href="#" title="X (Twitter)">
        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>
    </a>

    <a class="w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(11,166,109,0.4)] text-slate-400 dark:text-slate-500 hover:text-primarys" href="#" title="LinkedIn">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path></svg>
    </a>

    <a class="w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(11,166,109,0.4)] text-slate-400 dark:text-slate-500 hover:text-primarys" href="#" title="WhatsApp">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path></svg>
    </a>

    <div class="h-[1px] w-8 mx-auto bg-slate-200 dark:bg-slate-700 my-1"></div>

    <a class="w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(11,166,109,0.4)] text-slate-400 dark:text-slate-500 hover:text-primarys" href="#" title="Email">
        <span class="material-symbols-outlined text-xl">mail</span>
    </a>

    <a class="w-10 h-10 flex items-center justify-center transition-all duration-300 rounded-lg hover:scale-110 hover:shadow-[0_0_15px_rgba(11,166,109,0.4)] text-slate-400 dark:text-slate-500 hover:text-primarys" href="#" title="Copy Link">
        <span class="material-symbols-outlined text-xl">link</span>
    </a>
</aside>
`;
  }
}
customElements.define("main-navbar", MainNavbar);
const menuBtn = document.getElementById("mobile-menu-btn");
const mobileMenu = document.getElementById("mobile-menu");
const menuIcon = document.getElementById("menu-icon");

menuBtn.addEventListener("click", () => {
  // تبديل ظهور القائمة
  const isHidden = mobileMenu.classList.contains("hidden");

  if (isHidden) {
    mobileMenu.classList.remove("hidden");
    menuIcon.innerText = "close"; // تغيير الأيقونة إلى X
  } else {
    mobileMenu.classList.add("hidden");
    menuIcon.innerText = "menu"; // إعادة الأيقونة إلى همبرجر
  }
});
