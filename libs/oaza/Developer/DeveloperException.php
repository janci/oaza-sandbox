<?php
namespace Oaza\Developer;
class DeveloperException  extends \Exception
{
   public function __construct($message="", $code=0){
        return parent::__construct($message, $code);
   }

}
