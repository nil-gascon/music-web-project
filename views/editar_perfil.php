<?php

$userId = $_SESSION['id'];
$user = obtenirUsuari($connexio, $userId);
pg_close($connexio);
?>

<div class="carret-cont">
    <form action="/model/val_editar_perfil.php" method="POST" enctype="multipart/form-data">

        <div class=form-group>
            <?php if (!empty($user['imatge'])): ?>
                <img src="<?php printar($user['imatge']); ?>" alt="Imatge de perfil" class="imatge-perfil">
            <?php endif; ?>
        </div>

        <div class=form-group>
            <label for="nom">Nom <span class="required">*</span></label>
            <input type="text" id="nom" name="nom" maxlength="30" value="<?php printar($user['nom']); ?>" required pattern="[A-Za-zÀ-ÿ\s]+" title="Només caràcters i espais">
        </div>


        <div class=form-group>
            <label for="correu">Adreça de correu electrònic <span class="required">*</span></label>
            <input type="email" id="email" name="email" value="<?php printar($user['email']); ?>" required>
        </div>

        <div class=form-group>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" pattern="[A-Za-z0-9]+" title="Camp alfanumèric">
            <small>Deixa en blanc si no vols canviar la contrasenya.</small>
        </div>

        <div class=form-group>
            <label for="adreca">Adreça</label>
            <input type="text" id="adreca" name="adreca" value="<?php printar($user['adreça']); ?>" maxlength="30">
        </div>

        <div class=form-group>
            <label for="poblacio">Població</label>
            <input type="text" id="poblacio" name="poblacio" value="<?php printar($user['població']); ?>" maxlength="30">
        </div>

        <div class=form-group>
            <label for="codi_postal">Codi Postal <span class="required">*</span></label>
            <input type="text" id="codi_postal" name="codi_postal" value="<?php printar($user['codi_postal']); ?>" required pattern="^\d{5}$" title="Ha de contenir exactament 5 dígits">
        </div>

        <div class=form-group>
            <label for="imatge">Imatge de perfil</label>
            <input type="file" id="imatge" name="imatge" accept="image/*">
        </div>

        <button type="submit" class="boto-actualitzar">Actualitzar Perfil</button>
    </form>
</div>