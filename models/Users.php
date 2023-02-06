<?php

/**
 * User Model Class
 * 
 * @author Celio Natti <celionatti@gmail.com>
 * @copyright 2023 Celionatti
 */

namespace app\models;

use app\models\UserModel;
use app\core\helpers\Token;
use app\core\helpers\Bcrypt;
use app\core\validators\MinValidator;
use app\core\validators\EmailValidator;
use app\core\validators\UniqueValidator;
use app\core\validators\MatchesValidator;
use app\core\validators\RequiredValidator;

class Users extends UserModel
{
   use Bcrypt;

   const PENDING_STATUS = 'pending';
   const VERIFIED_STATUS = 'verified';

   const USER_PERMISSION = 'user';
   const AUTHOR_PERMISSION = 'author';
   const EDITOR_PERMISSION = 'editor';
   const ADMIN_PERMISSION = 'admin';
   const MANAGER_PERMISSION = 'manager';

   public $id;
   public $uid;
   public string $username;
   public string $surname;
   public string $lastname;
   public string $email;
   public string $password;
   public string $confirmPassword;
   public $acl = self::USER_PERMISSION;
   public $avatar;
   public $phone;
   public $ref_uid;
   public $refer_by;
   public $status = self::VERIFIED_STATUS;
   public $token;
   public $blocked = 0;
   public $remember = '';
   public $created_at;
   public $updated_at;

   protected static $table = "users";
   protected static $_current_user = false;

   public function beforeSave()
   {
      $this->timestamps();

   }

   public function validateRegistration()
   {
      $this->runValidation(new RequiredValidator($this, ['field' => 'surname', 'msg' => "SurName is a required field."]));
      $this->runValidation(new RequiredValidator($this, ['field' => 'lastname', 'msg' => "Last Name is a required field."]));
      $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => "Email is a required field."]));
      $this->runValidation(new EmailValidator($this, ['field' => 'email', 'msg' => 'You must provide a valid email.']));
      $this->runValidation(new UniqueValidator($this, ['field' => ['email', 'surname'], 'msg' => 'A user with that email address already exists.']));

      $this->runValidation(new RequiredValidator($this, ['field' => 'acl', 'msg' => "Access Level is a required field."]));

      if ($this->isNew()) {
         $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'msg' => "Password is a required field."]));
         $this->runValidation(new RequiredValidator($this, ['field' => 'confirmPassword', 'msg' => "Confirm Password is a required field."]));
         $this->runValidation(new MatchesValidator($this, ['field' => 'confirmPassword', 'rule' => $this->password, 'msg' => "Your passwords do not match."]));
         $this->runValidation(new MinValidator($this, ['field' => 'password', 'rule' => 8, 'msg' => "Password must be at least 8 characters."]));

         $this->password = $this->hashPassword($this->password);
         $this->uid = Token::randomString(60);
      } else {
         $this->_skipUpdate = ['password'];
      }
   }

   public function validateLogin()
   {
      $this->runValidation(new RequiredValidator($this, ['field' => 'email', 'msg' => "Email is a required field."]));
      $this->runValidation(new EmailValidator($this, ['field' => 'email', 'msg' => 'You must provide a valid email.']));
      $this->runValidation(new RequiredValidator($this, ['field' => 'password', 'msg' => "Password is a required field."]));
   }

   public function login()
   {

   }

   public function loginFromCookie()
   {

   }

   public static function getCurrentUser()
   {
      return self::$_current_user;
   }

   public function logout()
   {

   }

   public function getDisplayName(): string
   {
      return trim($this->surname . ' ' . $this->lastname);
   }
}