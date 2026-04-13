$functions = [
    'local_lms_update_section' => [
        'classname'   => 'local_lms_external',
        'methodname'  => 'update_section',
        'classpath'   => 'local/lms/externallib.php',
        'description' => 'Update section name',
        'type'        => 'write',
        'ajax'        => true,
    ],
];

$services = [
    'LMS Sync Service' => [
        'functions' => [
            'local_lms_update_section'
        ],
        'restrictedusers' => 0,
        'enabled' => 1,
    ],
];
