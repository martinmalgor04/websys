<?php
declare(strict_types=1);

/**
 * Escapa output para HTML
 */
function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Genera URL de asset relativa al root del sitio
 */
function asset(string $path): string
{
    return '/assets/' . ltrim($path, '/');
}

/**
 * Genera link de WhatsApp con mensaje pre-llenado
 */
function generateWhatsAppLink(string $message): string
{
    return 'https://wa.me/' . SITE_WHATSAPP . '?text=' . rawurlencode($message);
}

/**
 * Renderiza los schemas JSON-LD
 */
function renderSchemas(array $schemas): string
{
    $out = '';
    foreach ($schemas as $schema) {
        if (empty($schema)) continue;
        $out .= '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
    return $out;
}

/**
 * Schema: LocalBusiness
 */
function generateLocalBusinessSchema(): array
{
    return [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => SITE_NAME,
        'url' => SITE_URL,
        'telephone' => SITE_PHONE,
        'email' => SITE_EMAIL,
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => SITE_ADDRESS,
            'addressLocality' => 'Corrientes',
            'addressRegion' => 'Corrientes',
            'addressCountry' => 'AR',
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => '-27.4675311',
            'longitude' => '-58.8346995',
        ],
        'foundingDate' => (string) SITE_YEAR_FOUNDED,
    ];
}

/**
 * Schema: FAQPage
 */
function generateFAQSchema(array $faqs): array
{
    if (empty($faqs)) return [];
    $items = [];
    foreach ($faqs as $faq) {
        $items[] = [
            '@type' => 'Question',
            'name' => $faq['question'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['answer'],
            ],
        ];
    }
    return [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $items,
    ];
}

/**
 * Schema: Product
 */
function generateProductSchema(string $name, string $desc, string $url, string $image): array
{
    return [
        '@context' => 'https://schema.org',
        '@type' => 'SoftwareApplication',
        'name' => $name,
        'description' => $desc,
        'url' => $url,
        'image' => $image,
        'applicationCategory' => 'BusinessApplication',
        'operatingSystem' => 'Windows',
        'offers' => [
            '@type' => 'Offer',
            'availability' => 'https://schema.org/InStock',
        ],
    ];
}

/**
 * Schema: BreadcrumbList
 */
function generateBreadcrumbSchema(array $items): array
{
    $elements = [];
    foreach ($items as $i => $item) {
        $el = [
            '@type' => 'ListItem',
            'position' => $i + 1,
            'name' => $item['name'],
        ];
        if (!empty($item['url'])) {
            $el['item'] = $item['url'];
        }
        $elements[] = $el;
    }
    return [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $elements,
    ];
}
