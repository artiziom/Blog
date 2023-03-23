<nav class="nav">
          <h2>Menu</h2>
          <ul class="nav-list">
            <li><a class="item" href="">🧑‍💻 O mnie</a></li>
            <li>
              <a
                class="item"
                href="https://www.google.com/intl/pl/calendar/about/"
                >📅 Kalendarz</a
              >
            </li>
            <li><a class="item" href="pizza.html">🍕 Pizzeria</a></li>
            <li><a class="item" href="game.php">🃏 Gra w oczko</a></li>
            <li><a class="item" href="to-do.html">🗒 Lista zadań</a></li>
            <li><a class="item" href="snake.html">🐍 Snake game</a></li>
            <?php
            if($roleID == 1){
              echo '<li><a class="item" href="adminPanel.php">🔑 Panel Administracyjny</a></li>';
            }
            ?>
            
            
          </ul>
          <h2>Kategorie</h2>
          <ul class="nav-list">
          <li><a class="item" href="blog.php?page=0">Wszytsko</a></li>
          <li><a class="item" href="blog.php?kategoria='1'">🎞 Karty graficzne</a></li>
          <li><a class="item" href="blog.php?kategoria='2'">💾 Dyski</a></li>
            <li><a class="item" href="blog.php?kategoria='3'">💻 Procesory</a></li>
            <li><a class="item" href="blog.php?kategoria='4'"> 🖨️Drukarki</a></li>
            <li><a class="item" href="blog.php?kategoria='5'"> 🎧Słucawki</a></li>
          </ul>
        </nav>