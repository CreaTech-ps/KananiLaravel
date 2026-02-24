class MainFooter extends HTMLElement {
  connectedCallback() {
    this.innerHTML = `
  <footer class="bg-white dark:bg-background-darks border-t border-slate-100 dark:border-primarys/10 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-12 gap-x-8 mb-16">
            
            <div class="flex flex-col items-center text-center sm:text-start">
                <a href="home.html" class="mb-6 block transition-transform hover:scale-105">
                    <img src="assets/img/KANANI-Logo-l.svg" alt="Logo" class="h-16 w-auto dark:hidden">
                    <img src="assets/img/KANANI-Logo-d.svg" alt="Logo" class="h-16 w-auto hidden dark:block">
                </a>
                <p class="text-slate-600 dark:text-slate-300 text-lg leading-relaxed opacity-90 text-justify" style="text-justify: inter-word;">
                    نعمل على تمكين طلبة جامعة بيرزيت وتوفير الدعم اللازم لمسيرتهم الأكاديمية من خلال برامج المنح والمشاريع التنموية المستدامة.
                </p>
            </div>

            <div class="text-center sm:text-start">
                <h3 class="font-bold text-slate-900 dark:text-white mb-6 flex items-center justify-center sm:justify-start gap-2 border-s-4 border-primarys ps-3 leading-none">
                    عن الجمعية
                </h3>
                <ul class="space-y-3 text-sm text-slate-500 dark:text-slate-400">
                                    <li><a href="home.html" class="hover:text-primarys transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primarys/20 group-hover:bg-primarys transition-colors"></span>المتجر</a></li>

                    <li><a href="home.html" class="hover:text-primarys transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primarys/20 group-hover:bg-primarys transition-colors"></span>الجمعية</a></li>
                    <li><a href="about_us.html" class="hover:text-primarys transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primarys/20 group-hover:bg-primarys transition-colors"></span>من نحن</a></li>
                    <li><a href="our_team.html" class="hover:text-primarys transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primarys/20 group-hover:bg-primarys transition-colors"></span>فريق العمل</a></li>
                    <li><a href="news.html" class="hover:text-primarys transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primarys/20 group-hover:bg-primarys transition-colors"></span>آخر الأخبار</a></li>
                </ul>
            </div>

            <div class="text-center sm:text-start">
                <h3 class="font-bold text-slate-900 dark:text-white mb-6 flex items-center justify-center sm:justify-start gap-2 border-s-4 border-primarys ps-3 leading-none">
                    برامجنا
                </h3>
                <ul class="space-y-3 text-sm text-slate-500 dark:text-slate-400">
                    <li><a href="canaanite.html" class="hover:text-primarys transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primarys/20 group-hover:bg-primarys transition-colors"></span>مشروع كنعاني</a></li>
                    <li><a href="enable.html" class="hover:text-primarys transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primarys/20 group-hover:bg-primarys transition-colors"></span>مشروع تمكين</a></li>
                    <li><a href="umbrellas.html" class="hover:text-primarys transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primarys/20 group-hover:bg-primarys transition-colors"></span>مشروع المظلات</a></li>
                    <li><a href="grants.html" class="hover:text-primarys transition-colors flex items-center justify-center sm:justify-start gap-2 group"><span class="w-1.5 h-1.5 rounded-full bg-primarys/20 group-hover:bg-primarys transition-colors"></span>المنح الدراسية</a></li>
                </ul>
            </div>

            <div class="text-center sm:text-start flex flex-col items-center sm:items-start">
                <h3 class="font-bold text-slate-900 dark:text-white mb-6">اشترك معنا</h3>
                <div class="relative w-full max-w-xs mb-8">
                    <input type="email" placeholder="البريد الإلكتروني" 
                        class="w-full bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 rounded-2xl py-3.5 px-4 text-sm focus:outline-none focus:border-primarys/50 transition-all placeholder:text-slate-400">
                    <button class="absolute end-1.5 top-1.5 bg-primarys text-white p-2 rounded-xl hover:brightness-110 active:scale-95 transition-all shadow-lg shadow-primarys/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-sm rtl:rotate-180">send</span>
                    </button>
                </div>
                
                <h3 class="font-bold mb-4 text-sm text-slate-900 dark:text-white">تابعنا على</h3>
                <div class="flex gap-4">
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-white/5 text-slate-400 hover:bg-[#1877F2] hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 dark:bg-white/5 text-slate-400 hover:bg-black hover:text-white transition-all duration-300">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="pt-8 border-t border-slate-100 dark:border-white/5 flex flex-col md:flex-row justify-between items-center gap-8 text-center md:text-start">
            <div class="flex flex-col md:flex-row items-center gap-4 md:gap-10">
                <p class="text-[11px] sm:text-xs text-slate-400 font-medium tracking-wide uppercase">
                    © 2026 جمعية أصدقاء جامعة بيرزيت
                </p>
                <div class="flex flex-wrap justify-center items-center gap-6">
                    <a href="tel:+97022982000" class="flex items-center gap-2 text-xs text-slate-500 hover:text-primarys transition-colors">
                        <span class="material-symbols-outlined text-[16px]">call</span>
                        <span dir="ltr">+970 2 298 2000</span>
                    </a>
                    <a href="mailto:info@fobzu.org" class="flex items-center gap-2 text-xs text-slate-500 hover:text-primarys transition-colors">
                        <span class="material-symbols-outlined text-[16px]">mail</span>
                        <span>info@fobzu.org</span>
                    </a>
                </div>
            </div>
            
            <div class="flex gap-8 text-[11px] sm:text-xs font-semibold text-slate-400">
                <a href="privacy.html" class="hover:text-primarys transition-all border-b border-transparent hover:border-primarys">سياسة الخصوصية</a>
                <a href="terms.html" class="hover:text-primarys transition-all border-b border-transparent hover:border-primarys">شروط الاستخدام</a>
            </div>
        </div>
    </div>
</footer>
`;
  }
}
customElements.define("main-footer", MainFooter);
