<?php declare(strict_types=1);

require("model.php");
require("functions.php");

use PHPUnit\Framework\TestCase;

final class IngredientTest extends TestCase
{
    public function testDisplayIngredients(): void
    {
        // Arrange
        $data = [array("id" => "1", "ingredient" => "salad", "quantity" => 3, "unit" => "pieces", "user" => 1)];
        $ingredient = $this->getMockBuilder(Ingredients::class)
            ->disableOriginalConstructor()
            ->getMock();
        $ingredient->expects($this->exactly(1))
            ->method("display")
            ->willReturn($data);
        $user_id = 1;
        
        // Act
        $ingredients = display_ingredients($ingredient, $user_id);

        // Assert
        $this->assertSame($data, $ingredients);
    }

    public function testAddAnIngredient(): void
    {
        // Arrange
        $name = "salad";
        $quantity = 3;
        $metric = "pieces";
        $new_ingredient = $this->getMockBuilder(IngredientAdder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $new_ingredient->expects($this->exactly(1))
            ->method("add")
            ->willReturn(true);
        $user_id = 1;

        // Act
        $ingredient_error = add_ingredient($name, $quantity, $metric, $new_ingredient, $user_id);

        // Assert
        $this->assertSame(false, $ingredient_error);
    }

    public function testAddAnInvalidIngredient(): void
    {
        // Arrange
        $name = "";
        $quantity = 3;
        $metric = "pieces";
        $new_ingredient = $this->getMockBuilder(IngredientAdder::class)
            ->disableOriginalConstructor()
            ->getMock();
        $user_id = 1;

        // Act
        $ingredient_error = add_ingredient($name, $quantity, $metric, $new_ingredient, $user_id);

        // Assert
        $this->assertSame("required fields", $ingredient_error);
    }

    public function testDeleteTheLastIngredient(): void
    {
        // Arrange
        $data = [array("id" => "1", "ingredient" => "salad", "quantity" => 3, "unit" => "pieces", "user" => 1)];
        $last_ingredient = $this->getMockBuilder(IngredientRemover::class)
            ->disableOriginalConstructor()
            ->getMock();

        $last_ingredient->expects($this->exactly(1))
            ->method("remove")
            ->willReturn(true);
        $user_id = 1;
        
        // Act
        $ingredient_error = remove_ingredient($data, $last_ingredient, $user_id);

        // Assert
        $this->assertSame(false, $ingredient_error);
    }

    public function testDeleteWhenNoIngredient(): void
    {
        // Arrange
        $data = [];
        $last_ingredient = $this->getMockBuilder(IngredientRemover::class)
            ->disableOriginalConstructor()
            ->getMock();
        $user_id = 1;

        // Act
        $ingredient_error = remove_ingredient($data, $last_ingredient, $user_id);

        // Assert
        $this->assertSame("no ingredient to remove", $ingredient_error);
    }
}