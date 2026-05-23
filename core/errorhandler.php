<?php
set_exception_handler(function(\Throwable $th) {
    http_response_code(($th->getCode() ?? 500));
    echo json_encode([
        'error' => $th->getMessage(),
        'file' => $th->getFile(),
        'line' => $th->getLine(),
        'trace' => $th->getTraceAsString(),
    ]);
});

set_error_handler(function($errno, $errstr, $errfile, $errline) {
    throw new \ErrorException($errstr, $errno, 500, $errfile, $errline);
});

register_shutdown_function(function() {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        http_response_code(500);
        echo json_encode([
            'error' => $error['message'],
            'file' => $error['file'],
            'line' => $error['line'],
            'trace' => $error['trace'],
        ]);
    }
});
