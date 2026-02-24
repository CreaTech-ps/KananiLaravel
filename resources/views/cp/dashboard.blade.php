@extends('cp.layout')

@section('title', 'لوحة التحكم')

@section('content')
<div class="space-y-6">
    <section class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
        <h2 class="text-xl font-bold text-slate-800 dark:text-white mb-1">مرحباً بك في لوحة التحكم</h2>
        <p class="text-slate-600 dark:text-slate-400">إدارة محتوى موقع جمعية أصدقاء جامعة بيرزيت من خلال القائمة الجانبية.</p>
    </section>

    {{-- إحصائيات سريعة --}}
    <section id="stats" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
        <a href="{{ route('cp.dashboard') }}#news" class="cp-card rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm hover:shadow-md hover:border-primary/30 dark:hover:border-primary/40 transition-all">
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary">
                    <span class="material-symbols-outlined text-2xl">newspaper</span>
                </span>
                <div>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $stats['news'] }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">خبر</p>
                </div>
            </div>
        </a>
        <a href="{{ route('cp.dashboard') }}#scholarships" class="cp-card rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm hover:shadow-md hover:border-primary/30 dark:hover:border-primary/40 transition-all">
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary">
                    <span class="material-symbols-outlined text-2xl">school</span>
                </span>
                <div>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $stats['scholarships'] }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">منحة نشطة</p>
                </div>
            </div>
        </a>
        <a href="{{ route('cp.dashboard') }}#partners" class="cp-card rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm hover:shadow-md hover:border-primary/30 dark:hover:border-primary/40 transition-all">
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-primary/10 dark:bg-primary/20 text-primary">
                    <span class="material-symbols-outlined text-2xl">handshake</span>
                </span>
                <div>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $stats['partners'] }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">شريك</p>
                </div>
            </div>
        </a>
        <a href="{{ route('cp.dashboard') }}#requests" class="cp-card rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm hover:shadow-md hover:border-amber-500/30 dark:hover:border-amber-500/40 transition-all">
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400">
                    <span class="material-symbols-outlined text-2xl">pending_actions</span>
                </span>
                <div>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $stats['scholarship_applications'] }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">طلب منح</p>
                </div>
            </div>
        </a>
        <a href="{{ route('cp.dashboard') }}#requests" class="cp-card rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm hover:shadow-md hover:border-amber-500/30 dark:hover:border-amber-500/40 transition-all">
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400">
                    <span class="material-symbols-outlined text-2xl">volunteer_activism</span>
                </span>
                <div>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $stats['empowerment_requests'] }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">طلب تمكين</p>
                </div>
            </div>
        </a>
        <a href="{{ route('cp.dashboard') }}#requests" class="cp-card rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm hover:shadow-md hover:border-amber-500/30 dark:hover:border-amber-500/40 transition-all">
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center w-12 h-12 rounded-xl bg-amber-500/10 dark:bg-amber-500/20 text-amber-600 dark:text-amber-400">
                    <span class="material-symbols-outlined text-2xl">group_add</span>
                </span>
                <div>
                    <p class="text-2xl font-bold text-slate-800 dark:text-white">{{ $stats['membership_requests'] }}</p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">طلب انضمام</p>
                </div>
            </div>
        </a>
    </section>

    {{-- روابط سريعة حسب الأقسام --}}
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div id="site" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm">
            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-3">
                <span class="material-symbols-outlined text-primary">settings</span>
                إعدادات الموقع
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">الشعار، ألوان الهوية، روابط التواصل، التبرع.</p>
            <span class="text-sm text-primary font-medium">قريباً</span>
        </div>
        <div id="home" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm">
            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-3">
                <span class="material-symbols-outlined text-primary">home</span>
                الصفحة الرئيسية
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">Hero، إحصائيات، قصص النجاح.</p>
            <span class="text-sm text-primary font-medium">قريباً</span>
        </div>
        <div id="about" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm">
            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-3">
                <span class="material-symbols-outlined text-primary">info</span>
                من نحن والفريق
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">الرؤية، الرسالة، الأهداف، القيم، مجلس الإدارة، فريق العمل.</p>
            <span class="text-sm text-primary font-medium">قريباً</span>
        </div>
        <div id="projects" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm">
            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-3">
                <span class="material-symbols-outlined text-primary">folder_special</span>
                المشاريع
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">كنعاني، تمكين، المظلات.</p>
            <span class="text-sm text-primary font-medium">قريباً</span>
        </div>
        <div id="scholarships" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm">
            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-3">
                <span class="material-symbols-outlined text-primary">school</span>
                المنح الجامعية
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">قائمة المنح وطلبات التقديم.</p>
            <span class="text-sm text-primary font-medium">قريباً</span>
        </div>
        <div id="partners" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm">
            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-3">
                <span class="material-symbols-outlined text-primary">handshake</span>
                شركاء النجاح
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">أفراد وشركات.</p>
            <span class="text-sm text-primary font-medium">قريباً</span>
        </div>
        <div id="news" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm">
            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-3">
                <span class="material-symbols-outlined text-primary">newspaper</span>
                الأخبار
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">إدارة الأخبار والتصفية حسب التاريخ.</p>
            <span class="text-sm text-primary font-medium">قريباً</span>
        </div>
        <div id="stories" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm">
            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-3">
                <span class="material-symbols-outlined text-primary">auto_stories</span>
                قصص النجاح
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">قصص المستفيدين في الرئيسية.</p>
            <span class="text-sm text-primary font-medium">قريباً</span>
        </div>
        <div id="requests" class="rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-5 shadow-sm">
            <h3 class="font-bold text-slate-800 dark:text-white flex items-center gap-2 mb-3">
                <span class="material-symbols-outlined text-primary">inbox</span>
                الطلبات والنماذج
            </h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">طلبات المنح، التمكين، الانضمام للهيئة.</p>
            <span class="text-sm text-primary font-medium">قريباً</span>
        </div>
    </section>
</div>
@endsection
