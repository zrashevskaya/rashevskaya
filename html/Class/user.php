<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 14.09.16
 * Time: 19:22
 */
class user {
  private $userId;
  public $firstName = 'dear friend';
  public $lastName;
  public $email;
  private $password;

  /**
   * @param mixed $firstName
   */
  public function setFirstName($firstName) {
    $this->firstName = $firstName;
  }

  /**
   * @param mixed $lastName
   */
  public function setLastName($lastName) {
    $this->lastName = $lastName;
  }

  /**
   * @return mixed
   */
  public function getFirstName() {
    return $this->firstName;
  }

  /**
   * @return mixed
   */
  public function getLastName() {
    return $this->lastName;
  }
}
