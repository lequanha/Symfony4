<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerX5o8M1V\srcTestProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerX5o8M1V/srcTestProjectContainer.php') {
    touch(__DIR__.'/ContainerX5o8M1V.legacy');

    return;
}

if (!\class_exists(srcTestProjectContainer::class, false)) {
    \class_alias(\ContainerX5o8M1V\srcTestProjectContainer::class, srcTestProjectContainer::class, false);
}

return new \ContainerX5o8M1V\srcTestProjectContainer(array(
    'container.build_hash' => 'X5o8M1V',
    'container.build_id' => '98befd76',
    'container.build_time' => 1540938600,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerX5o8M1V');