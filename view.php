<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./css/normalize.css" type="text/css" />
    <link rel="stylesheet" href="./css/recipe.css" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Belgrano&family=Comfortaa:wght@300..700&display=swap"
      rel="stylesheet"
    />
    <script src="https://kit.fontawesome.com/025746aad5.js" crossorigin="anonymous"></script>
    <title>My cooking recipe</title>
</head>

<body>
    <header>
        <img class="picture" src="./assets/salad.jpg" alt="Salad" />
        <div>
            <h1 class="main-title">Salad</h1>
            <p class="description">Delicious flavored salad !</p>
      </div>
    </header>
    <main>
        <section>
            <h2 class="subtitle">Overview</h2>
            <dl class="features">
                <div>
                    <dt class="feature-picture">
                        <div class="rate">
                            <i class="fa-solid fa-star fa-2xs"></i>
                            <i class="fa-solid fa-star fa-2xs"></i>
                            <i class="fa-solid fa-star-half-stroke fa-2xs"></i>
                            <i class="fa-regular fa-star fa-2xs"></i>
                            <i class="fa-regular fa-star fa-2xs"></i>
                        </div>
                    </dt>
                    <dd class="feature">Difficulty</dd>
                </div>
                <div>
                    <dt class="feature-picture feature-picture-decoration">7€</dt>
                    <dd class="feature">Cost</dd>
                </div>
                <div>
                    <dt class="feature-picture feature-picture-decoration">45min</dt>
                    <dd class="feature">Preparation time</dd>
                </div>
                <div>
                    <dt class="feature-picture feature-picture-decoration">0min</dt>
                    <dd class="feature">Cooking time</dd>
                </div>
                <div>
                    <dt class="feature-picture feature-picture-decoration">20min</dt>
                    <dd class="feature">Resting time</dd>
                </div>
            </dl>
        </section>
        <section>
            <h2 class="subtitle">Ingredients</h2>
            <form method="post" action="index.php">
                <div class="item-handler"><span>Servings: 
                    <span><?= count($ingredients) ?></span></span>
                    <div>
                        <button class="more-item" name="plus" value="plus">+</button>
                        <button class="less-item" name="minus" value="minus">-</button>
                    </div>
                </div>
                <table>
                    <caption class="table-legend">List of the recipe ingredients. Fill fields and click on plus button to add ingredient to
                        your recipe ! Click on minus button to remove it !</caption>
                    <thead>
                        <tr>
                            <th class="item-datas item-number">N°</th>
                            <th class="item-datas"><label for="name">Name</label></th>
                            <th class="item-datas"><label for="quantity">Quantity</label></th>
                            <th class="item-datas"><label for="metric">Metric</label></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td class="item-datas"><input id="name" name="name"></td>
                            <td class="item-datas"><input id="quantity" name="quantity"></td>
                            <td class="item-datas"><input id="metric" name="metric"></td>
                        </tr>
                        <?php
                            for ($i = 0; $i < count($ingredients); $i++) {
                            ?>
                                <tr>
                                    <td class="item-datas item-number"><?= $i + 1 ?></td>
                                    <td class="item-datas"><?= htmlspecialchars($ingredients[$i]['ingredient']) ?></td>
                                    <td class="item-datas"><?= htmlspecialchars($ingredients[$i]['quantity']) ?></td>
                                    <td class="item-datas"><?= htmlspecialchars($ingredients[$i]['unit']) ?></td>
                                </tr>
                            <?php
                            }

                            if ($error === 'required fields') {
                            ?>
                                <tr>
                                    <td class="warning" colspan="4">All fields are required !</td>
                                </tr>
                            <?php
                            }
                            
                            if ($error === 'type') {
                            ?>
                                <tr>
                                    <td class="warning" colspan="4">Name and unit are words, quantity is a number.</td>
                                </tr>
                            <?php
                            }

                            if ($error === 'no ingredient to remove') {
                            ?>
                                <tr>
                                    <td class="warning" colspan="4">No ingredient to remove !</td>
                                </tr>
                            <?php
                            } ?>
                    </tbody>
                </table>
            </form>
        </section>
    </main>
</body>

</html>