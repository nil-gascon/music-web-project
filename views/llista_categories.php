<section class="categories">
    <ul class="category-list">
        <?php foreach ($categories as $categoria): ?>
            <li>
                <a href="#" onclick="carrega(<?php printar($categoria['id']) ?>,'categoria');">
                    <img src="<?php printar($categoria['srcimg']) ?>" alt="<?php printar($categoria['nom']) ?>">
                    <div><?php printar($categoria['nom']) ?></div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</section>