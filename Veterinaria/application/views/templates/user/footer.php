<footer class="footer">
    <div class="container">
        <div class="row justify-content-around text-center">
            <div class="col">
                <a href="<?= base_url('user') ?>" class="text-decoration-none">
                    <i class="bi bi-house-door-fill footer-icon"></i>
                    <div class="footer-text">Inicio</div>
                </a>
            </div>
            <div class="col">
                <a href="<?= base_url('user/mascotas') ?>" class="text-decoration-none">
                    <i class="bi bi-heart-pulse-fill footer-icon"></i>
                    <div class="footer-text">Mis Mascotas</div>
                </a>
            </div>
            <div class="col">
                <a href="<?= base_url('user/citas') ?>" class="text-decoration-none">
                    <i class="bi bi-calendar-check-fill footer-icon"></i>
                    <div class="footer-text">Mis Citas</div>
                </a>
            </div>
            <div class="col">
                <a href="<?= base_url('user/historial') ?>" class="text-decoration-none">
                    <i class="bi bi-journal-medical footer-icon"></i>
                    <div class="footer-text">Historial</div>
                </a>
            </div>
            <div class="col">
                <a href="<?= base_url('user/mapa') ?>" class="text-decoration-none">
                    <i class="bi bi-geo-alt-fill footer-icon"></i>
                    <div class="footer-text">Mapa</div>
                </a>
            </div>
            <div class="col">
                <a href="<?= base_url('user/perfil') ?>" class="text-decoration-none">
                    <i class="bi bi-person-fill footer-icon"></i>
                    <div class="footer-text">Perfil</div>
                </a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>