<?php


 function autoload_0f2c50639c6556d9066ce90e5f376324($class)
{
    $classes = array(
        'MisClases\MisClasesMetodosSoapService' => __DIR__ .'/MisClasesMetodosSoapService.php'
    );
    if (!empty($classes[$class])) {
        include $classes[$class];
    };
}

spl_autoload_register('autoload_0f2c50639c6556d9066ce90e5f376324');

// Do nothing. The rest is just leftovers from the code generation.
{
}
