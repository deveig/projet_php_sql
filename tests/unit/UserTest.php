<?php declare(strict_types=1);

require("model.php");
require("functions.php");

use PHPUnit\Framework\TestCase;

final class UserTest extends TestCase {
    public function testAddUser(): void {
        // Arrange
        $user_name = "henry";
        $new_user =  $this->getMockBuilder(Users::class)
            ->disableOriginalConstructor()
            ->getMock();
        $new_user->expects($this->exactly(1))
            ->method("signup")
            ->willReturn(true);
        // Act
        $data = add_user($user_name, $new_user);
        $user_error = $data [0];

        // Assert
        $this->assertSame(false, $data[0]);
    }

    public function testGetUserData(): void {
        // Arrange
        $user = "henry";
        $user_hash = password_hash($user, PASSWORD_DEFAULT);
        $data = [array("id" => 1, "user" => $user, "user_hash" => $user_hash)];
        $new_user =  $this->getMockBuilder(Users::class)
            ->disableOriginalConstructor()
            ->getMock();
        $new_user->expects($this->exactly(1))
            ->method("get_user_data")
            ->willReturn($data);
        // Act
        $user_added = get_user($new_user, $user_hash);
        // Assert
        $this->assertSame($data[0]["id"], $user_added[0]["id"]);
        $this->assertSame($data[0]["user"], $user_added[0]["user"]);
    }
}