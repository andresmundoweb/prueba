<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerM5b4gul\appProdProjectContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerM5b4gul/appProdProjectContainer.php') {
    touch(__DIR__.'/ContainerM5b4gul.legacy');

    return;
}

if (!\class_exists(appProdProjectContainer::class, false)) {
    \class_alias(\ContainerM5b4gul\appProdProjectContainer::class, appProdProjectContainer::class, false);
}

return new \ContainerM5b4gul\appProdProjectContainer(array(
    'container.build_hash' => 'M5b4gul',
    'container.build_id' => '9d4584a6',
    'container.build_time' => 1574977043,
), __DIR__.\DIRECTORY_SEPARATOR.'ContainerM5b4gul');
