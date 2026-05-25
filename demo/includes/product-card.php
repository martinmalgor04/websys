<?php
declare(strict_types=1);

function renderProductCard(string $key, array $product, int $delay = 0): string
{
    $accent    = e($product['color']);
    $name      = e($product['name']);
    $desc      = e($product['short_desc']);
    $slug      = e($product['slug']);
    $iconName  = $product['icon'];
    $isActive  = ($slug === 'tango-gestion');

    $delayClass = $delay > 0 ? ' reveal-delay-' . min((int) ceil($delay / 80), 5) : '';

    /* Card variant según disponibilidad */
    $cardVariant  = $isActive
        ? 'card--texture card--spotlight'
        : 'card--minimal';

    ob_start(); ?>
    <motion-tilt max-tilt="<?= $isActive ? '5' : '3' ?>" speed="400">
        <article class="card <?= $cardVariant ?> reveal<?= $delayClass ?>"
                 style="--card-accent: <?= $accent ?>; position: relative;">

            <?php if ($isActive): ?>
                <span class="card__badge card__badge--available">Disponible</span>
            <?php else: ?>
                <span class="card__badge card__badge--soon">Próximamente</span>
            <?php endif; ?>

            <div class="card__icon">
                <?= icon($iconName) ?>
            </div>
            <h3 class="card__title"><?= $name ?></h3>
            <p class="card__desc"><?= $desc ?></p>

            <?php if ($isActive): ?>
                <a href="tango-gestion.php" class="card__link">
                    Conocer más <?= icon('arrow-right', 16) ?>
                </a>
            <?php else: ?>
                <span class="card__link" style="color: var(--color-text-tertiary); cursor: default;">
                    En desarrollo <?= icon('chevron-right', 16) ?>
                </span>
            <?php endif; ?>

        </article>
    </motion-tilt>
    <?php
    return ob_get_clean();
}
