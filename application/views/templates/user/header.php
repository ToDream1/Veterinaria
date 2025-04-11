<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Sistema Veterinario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    <style>
        .menu-card {
            transition: transform 0.3s;
            cursor: pointer;
        }
        .menu-card:hover {
            transform: translateY(-5px);
        }
        .menu-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            display: block;
        }
        .menu-card {
            transition: transform 0.2s;
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .menu-icon {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .menu-card {
                margin-bottom: 10px;
            }
            .menu-icon {
                font-size: 2rem;
                margin-bottom: 0;
            }
            .card-body {
                padding: 1rem;
            }
            .card-title {
                font-size: 1.1rem;
                margin-left: 1rem;
            }
        }
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .footer {
            position: fixed;
            bottom: 0;
            background: #4e73df;
            padding: 0.5rem 0;
        }
        
        @media (min-width: 769px) {
            .footer {
                left: 0;
                width: 50px;
                height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                padding: 0.5rem 0;
                box-shadow: 2px 0 5px rgba(0,0,0,0.1);
                transition: width 0.3s ease;
            }
            .footer:hover {
                width: 120px;
            }
            .footer .row {
                flex-direction: column;
                gap: 2.5rem;
                margin: 0;
                align-items: center;
            }
            .footer .col {
                text-align: center;
                padding: 0;
                width: 100%;
                position: relative;
            }
            .footer-icon {
                font-size: 1.3rem;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .footer-text {
                display: none;
                font-size: 0.7rem;
                color: white;
                margin-top: 0.2rem;
                text-align: center;
                white-space: nowrap;
            }
            .footer:hover .footer-text {
                display: block;
            }
            .footer:hover .col {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        }
            .footer-text {
                display: none;
            }
        
        
        @media (max-width: 768px) {
            .footer {
                width: 100%;
                padding: 0.8rem 0;
            }
            .footer-icon {
                font-size: 2rem;
                margin-bottom: 0;
            }
            .footer-text {
                display: none;
            }
        }
        .footer-icon {
            font-size: 1.5rem;
            color: white;
            margin-bottom: 0.2rem;
        }
        .footer-text {
            font-size: 0.8rem;
            color: white;
        }
        
        /* Ocultar footer en la página inicial para todas las pantallas */
        body.is-home .footer {
            display: none;
        }
        
        @media (max-width: 768px) {
            .footer {
                padding: 0.8rem 0;
            }
            .footer-icon {
                font-size: 2rem;
                margin-bottom: 0;
            }
            .footer-text {
                display: none;
            }
        }
    </style>
</head>
<body class="<?= isset($body_class) ? $body_class : '' ?>">