<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./css/normalize.css" type="text/css" />
    <link rel="stylesheet" href="./css/recipe.css" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/025746aad5.js" crossorigin="anonymous"></script>
    <title>My cooking recipe</title>
</head>

<body>
    <header>
        <img class="picture" src="./assets/salad.jpg" alt="Salad" />
        <h1 class="main-title">Salad</h1>
        <p class="description"> Delicious flavored salad ! </p>
    </header>
    <main>
        <section>
            <h2 class="subtitle">Overview</h2>
            <dl class="features">
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
                <dt class="feature-picture feature-picture-decoration"> 7€ </dt>
                <dd class="feature">Cost</dd>
                <dt class="feature-picture feature-picture-decoration"> 45min </dt>
                <dd class="feature">Preparation time</dd>
                <dt class="feature-picture feature-picture-decoration"> 0min </dt>
                <dd class="feature">Cooking time</dd>
                <dt class="feature-picture feature-picture-decoration"> 20min </dt>
                <dd class="feature">Resting time</dd>
            </dl>
        </section>
        <section>
            <h2 class="subtitle">Ingredients</h2>
            <form method="post" action="index.php">
                <div class="item-handler">Servings: <button class="less-item" name="minus" value="minus">-</button>
                    <span><?= count($ingredients) ?></span>
                    <button class="more-item" name="plus" value="plus">+</button>
                </div>
                <table>
                    <caption class="table-legend">List of the recipe ingredients. Fill fields and click on plus button to add ingredient to
                        your recipe ! Click on minus button to remove it !</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><label for="name">Name</label></th>
                            <th><label for="quantity">Quantity</label></th>
                            <th><label for="metric">Metric</label></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td><input id="name" name="name"></td>
                            <td><input id="quantity" name="quantity"></td>
                            <td><input id="metric" name="metric"></td>
                        </tr>
                        <?php
                            for ($i = 0; $i < count($ingredients); $i++) {
                            ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($ingredients[$i]['ingredient']) ?></td>
                                    <td><?= htmlspecialchars($ingredients[$i]['quantity']) ?></td>
                                    <td><?= htmlspecialchars($ingredients[$i]['unit']) ?></td>
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
                                    <td class="warning" colspan="4">Your ingredient has a name and an unit, it quantity is a number.</td>
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