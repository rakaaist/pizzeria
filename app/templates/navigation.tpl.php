<header>
    <nav>
        <ul>
            <?php foreach ($data as $page => $link): ?>
                <li>
                    <a href="<?php print $link['link']; ?>"><?php print $page; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>
