<div class="user-panel min-vh-100 d-flex flex-column">
    <div class="position-fixed top-0 end-0 p-3">
        <a href="<?= base_url('index.php/auth/logout') ?>" class="btn btn-outline-light">Cerrar Sesión</a>
    </div>

    <div class="container flex-grow-1 d-flex flex-column justify-content-center py-5">
        <h1 class="text-center mb-4 text-white">Bienvenido al Sistema Veterinario</h1>
        
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="<?= base_url('index.php/user/mascotas') ?>" class="card text-decoration-none text-dark border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-heartbeat text-danger mb-2" style="font-size: 2rem;"></i>
                        <h5 class="card-title mb-0">Mis Mascotas</h5>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="<?= base_url('index.php/user/citas') ?>" class="card text-decoration-none text-dark border-0 h-100">
                    <div class="card-body text-center">
                        <i class="far fa-calendar-check text-primary mb-2" style="font-size: 2rem;"></i>
                        <h5 class="card-title mb-0">Mis Citas</h5>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="<?= base_url('index.php/user/historial') ?>" class="card text-decoration-none text-dark border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-file-medical text-success mb-2" style="font-size: 2rem;"></i>
                        <h5 class="card-title mb-0">Historial Médico</h5>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="<?= base_url('index.php/user/mapa') ?>" class="card text-decoration-none text-dark border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-map-marker-alt text-info mb-2" style="font-size: 2rem;"></i>
                        <h5 class="card-title mb-0">Ubicación</h5>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <a href="<?= base_url('index.php/user/perfil') ?>" class="card text-decoration-none text-dark border-0 h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-user text-primary mb-2" style="font-size: 2rem;"></i>
                        <h5 class="card-title mb-0">Mi Perfil</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>

</div>
<style>
.user-panel {
    background: #4e73df;
    min-height: 100vh !important;
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow-y: auto;
}

.card {
    cursor: pointer;
    position: relative;
    z-index: 1;
}

.card a {
    position: relative;
    z-index: 2;
}
</style>

.card {
    transition: transform 0.2s;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    cursor: pointer;
    border: none;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.2);
}

/* Eliminar cualquier estilo que pueda interferir */
.card a {
    text-decoration: none;
    color: inherit;
}
</style>

<!-- Eliminar el script anterior y usar este -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        if (card.getAttribute('onclick')) {
            card.style.cursor = 'pointer';
        }
    });
});
</script>

.card-body {
    padding: 2rem;
}

h1 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 2rem;
}

.card-title {
    font-size: 1.1rem;
    font-weight: 500;
    margin-top: 0.5rem;
}

.navbar {
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.nav-link {
    text-align: center;
    font-size: 1.2rem;
}

.nav-link.active {
    background-color: #e0e0ff;
    border-radius: 20px;
    padding: 5px 10px;
}

@media (max-width: 991.98px) {
    .container {
        padding: 1rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    h1 {
        font-size: 1.8rem;
    }
}
</style>

</div>
</div>
<!-- Eliminar o comentar este script si existe -->
<!--
<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileLink = document.querySelector('a[href*="user/perfil"]');
    if (profileLink) {
        profileLink.addEventListener('click', function(e) {
            e.preventDefault();
            const url = '<?= base_url('index.php/user/perfil') ?>';
            window.location.href = url;
        });
    }
});
</script>
-->
