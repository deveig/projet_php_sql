<?php declare(strict_types=1);

require("model.php");
require("functions.php");

use PHPUnit\Framework\TestCase;

final class IngredientTest extends TestCase
{
    public function testDisplayIngredients(): void
    {
        // Arrange
        $data = [array("id" => "1", "ingredient" => "salad", "quantity" => 3, "unit" => "pieces")];
        $list_of_ingredients = $this->getMockBuilder(Ingredients::class)
            ->disableOriginalConstructor()
            ->getMock();
        $list_of_ingredients->expects($this->exactly(1))
            ->method("display")
            ->willReturn($data);
        
        // Act
        $ingredients = display_ingredients($list_of_ingredients);

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

        // Act
        $error_message = add_ingredient($name, $quantity, $metric, $new_ingredient);

        // Assert
        $this->assertSame(false, $error_message);
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

        // Act
        $error_message = add_ingredient($name, $quantity, $metric, $new_ingredient);

        // Assert
        $this->assertSame("required fields", $error_message);
    }

    public function testDeleteTheLastIngredient(): void
    {
        // Arrange
        $data = [array("id" => "1", "ingredient" => "salad", "quantity" => 3, "unit" => "pieces")];
        $last_ingredient = $this->getMockBuilder(IngredientRemover::class)
            ->disableOriginalConstructor()
            ->getMock();

        $last_ingredient->expects($this->exactly(1))
            ->method("remove")
            ->willReturn(true);
        
        // Act
        $error_message = remove_ingredient($data, $last_ingredient);

        // Assert
        $this->assertSame(false, $error_message);
    }

    public function testDeleteWhenNoIngredient(): void
    {
        // Arrange
        $data = [];
        $last_ingredient = $this->getMockBuilder(IngredientRemover::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Act
        $error_message = remove_ingredient($data, $last_ingredient);

        // Assert
        $this->assertSame("no ingredient to remove", $error_message);
    }
}