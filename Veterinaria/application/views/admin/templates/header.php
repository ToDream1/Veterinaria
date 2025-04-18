<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titulo) ? $titulo : 'Veterinaria Municipal' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>

    <!-- Eliminar el bloque de alertas si existe aquí -->
    <!-- Mantener solo la barra de navegación principal que contiene los enlaces a las diferentes secciones -->