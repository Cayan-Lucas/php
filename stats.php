<?php
header('Content-Type: application/json');

// Função para pegar uso de CPU
function getCpuUsage() {
    $cpu = sys_getloadavg(); // Retorna a média de carga da CPU
    return $cpu[0]; // Retorna o valor de 1 minuto
}

// Função para pegar uso de RAM
function getMemoryUsage() {
    $free = shell_exec('free -m'); // Comando para pegar informações de memória
    $free = explode("\n", $free);
    $memory = preg_split('/\s+/', $free[1]);
    return [
        'memory_used' => $memory[2],  // Memória usada (em MB)
        'memory_total' => $memory[1]  // Memória total (em MB)
    ];
}

$data = [
    'cpu' => round(getCpuUsage(), 2),
    'memory_used' => round(getMemoryUsage()['memory_used'] / 1024, 2),
    'memory_total' => round(getMemoryUsage()['memory_total'] / 1024, 2)
];

echo json_encode($data);
?>
