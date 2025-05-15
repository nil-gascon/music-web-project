<div class="login-container">
    <form class="login-form" action="/model/valida_inici_sessio.php" method="POST">
        <h2>Inici Sessió</h2>
        <div class="input-group">
            <label for="email">Usuari</label>
            <input type="text" id="email" name="email" placeholder="Posa el teu usuari" required>
        </div>
        <div class="input-group">
            <label for="password">Contrasenya</label>
            <input type="password" id="password" name="password" placeholder="Posa la teva contrasenya" required>
        </div>
        <button type="submit" class="login-btn">Inicia Sessió</button>
        <button class="registre-btn" onclick="carrega('registre')">Registra't</button>
    </form>
</div>