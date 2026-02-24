<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach($routes as $route)
    <url>
        <loc>{{ $route['url'] }}</loc>
        @if(isset($route['lastmod']))
        <lastmod>{{ $route['lastmod'] }}</lastmod>
        @endif
        <changefreq>{{ $route['changefreq'] ?? 'monthly' }}</changefreq>
        <priority>{{ $route['priority'] ?? '0.5' }}</priority>
        {{-- Alternate language links --}}
        @php
            $currentUrl = $route['url'];
            $arUrl = str_replace('/en/', '/', $currentUrl);
            $enUrl = str_replace('/ar/', '/en/', str_replace('/en/', '/en/', $currentUrl));
            if (!str_contains($arUrl, '/en/') && str_contains($currentUrl, '/en/')) {
                $arUrl = str_replace('/en/', '/', $currentUrl);
            } elseif (!str_contains($currentUrl, '/en/')) {
                $enUrl = str_replace(url('/'), url('/en'), $arUrl);
            }
        @endphp
        <xhtml:link rel="alternate" hreflang="ar" href="{{ $arUrl }}" />
        <xhtml:link rel="alternate" hreflang="en" href="{{ $enUrl }}" />
    </url>
@endforeach
</urlset>
