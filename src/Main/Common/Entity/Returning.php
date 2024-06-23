<?php

  namespace Microfw\Src\Main\Common\Entity;

  /**
   * Description of Returning
   *
   * @author ARGomes
   */
  class Returning {

      private int $value;
      private string $description;

      /**
       * Get the value of value
       */
      public function getValue() {
          return $this->value;
      }

      /**
       * Set the value of value
       *
       * @return  self
       */
      public function setValue($value) {
          $this->value = $value;

          return $this;
      }

      /**
       * Get the value of description
       */
      public function getDescription() {
          return $this->description;
      }

      /**
       * Set the value of description
       *
       * @return  self
       */
      public function setDescription($description) {
          $this->description = $description;

          return $this;
      }
  }
  