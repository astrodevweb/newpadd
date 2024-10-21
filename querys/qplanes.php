<?php
   // Función para hacer peticiones cURL
function makeRequest($url) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'apikey: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc',
            'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

// Obtener datos
$provedorsoportes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/proveedor_soporte?select=*');
$planes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/PlanesPublicidad?select=*');
$anios = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Anios?select=*');
$anios2 = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Anios?select=*');
$meses = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Meses?select=*');
$productos = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Productos?select=*');
$soportes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Soportes?select=*');
$campaigns = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Campania?select=*');
$clientes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Clientes?select=*');
$contratos = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Contratos?select=*');
$campania_temas = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/campania_temas?select=*');
$temas = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Temas?select=*');
$jsonData = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/json?select=*');
$ordenpublicidad = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/OrdenesDePublicidad');
$medios = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Medios?select=*');
$clasimedios = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/ClasificacionMedios?select=*');
$calendarMap2 = [];
$ordenes = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/OrdenDeCompra?select=*');
$ordenes2 = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/OrdenDeCompra?select=*');
$ordenepublicidad = makeRequest('https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/OrdenesDePublicidad?select=*');
$ordenMap = [];
foreach ($ordenes as $orden) {
    $ordenMap[] = [
        'id_orden_compra' => $orden['id_orden_compra'],
        'NombreOrden' => $orden['NombreOrden'],
        'id_campania' => $orden['id_campania'],
        // Agrega otros campos que sean necesarios
    ];
}



foreach ($jsonData as $calendar) {
    // Aquí asumimos que `id_calendar` es único y usamos su valor como clave en nuestro mapa
    $calendarMap2[$calendar['id_calendar']] = $calendar['matrizCalendario'];
}
$campaniaTemasMap = [];
foreach ($campania_temas as $relacion) {
    $campaniaTemasMap[$relacion['id_campania']][] = $relacion['id_temas'];
}
$temasMap = [];
foreach ($temas as $tema) {
    if ($tema['estado'] === true) {
    $temasMap[] = [
        'id' => $tema['id_tema'],
        'nombreTema' => $tema['NombreTema'],
        'CodigoMegatime' => $tema['CodigoMegatime'],
        'id_medio' => $tema['id_medio']
    ];
}
}




$soportesMap = [];
foreach ($soportes as $soporte) {
    if ($soporte['estado'] === true) {
    $soportesMap[] = [
        'id' => $soporte['id_soporte'],
        'nombreSoporte' => $soporte['nombreIdentficiador'],
        'idProveedor' => $soporte['id_proveedor']
    ];
}
}

$aniosMap = [];
foreach ($anios as $anio) {
    $aniosMap[$anio['id']] = $anio;
}
$mesesMap = [];
foreach ($meses as $mes) {
    $mesesMap[$mes['Id']] = $mes;
}


$contratosMap = [];
foreach ($contratos as $contrato) {  
    $contratosMap[] = [
        'id' => $contrato['id'],
        'nombreContrato' => $contrato['NombreContrato'],
        'idCliente' => $contrato['IdCliente'],
        'idProveedor' => $contrato['IdProveedor'], // Se asegura que el IdProveedor esté aquí
        'num_contrato' => $contrato['num_contrato']
    ];
}   
$clientesMap = [];
foreach ($clientes as $cliente) {  
    if ($cliente['estado'] === true) {
        $clientesMap[] = [
            'id' => $cliente['id_cliente'],
            'nombreCliente' => $cliente['nombreCliente']
        ];
    }
}
$productosMap = [];
foreach ($productos as $producto) {
    if ($producto['Estado'] === true) {
    $productosMap[] = [
        'id' => $producto['id'],
        'nombreProducto' => $producto['NombreDelProducto'],
        'idCliente' => $producto['Id_Cliente']
    ];
}
}
$campaignsMap = [];
foreach ($campaigns as $campaign) {
    if ($campaign['estado'] === true) {
        $campaignsMap[] = [
            'id' => $campaign['id_campania'],
            'nombreCampania' => $campaign['NombreCampania'],
            'idCliente' => $campaign['id_Cliente'],
            'IdAgencias' => $campaign['Id_Agencia'] // Asegúrate de que el valor sea correcto
        ];
    }
}
$productosMap2 = [];
foreach ($productos as $producto) {
    if ($producto['Estado'] === true) {
    $productosMap2[$producto['id']] = $producto['NombreDelProducto'];
}}
$clientesMap2 = [];
foreach ($clientes as $cliente) {
    if ($cliente['estado'] === true) {
    $clientesMap2[$cliente['id_cliente']] = $cliente['nombreCliente'];
}}
$contratosMap2 = [];
foreach ($contratos as $contrato) {
    $contratosMap2[$contrato['id']] = $contrato['NombreContrato'];
}
$soportesMap2 = [];
foreach ($soportes as $soporte) {
    if ($soporte['estado'] === true) {
    $soportesMap2[$soporte['id_soporte']] = $soporte['nombreIdentficiador'];
}}
$campaignsMap2 = [];
foreach ($campaigns as $campaign) {
    if ($campaign['estado'] === true) {
    $campaignsMap2[$campaign['id_campania']] = $campaign['NombreCampania'];
}}
$temasMap2 = [];
foreach ($temas as $tema) {
    if ($tema['estado'] === true) {
        // Agrega un array con el nombre del tema y el id_medio como valor
        $temasMap2[$tema['id_tema']] = [
            'NombreTema' => $tema['NombreTema'],
            'id_medio' => $tema['id_medio']  // Asegúrate de que 'id_medio' sea un campo válido en tu array $tema
        ];
    }
}