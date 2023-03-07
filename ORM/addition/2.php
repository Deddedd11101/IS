<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <?php
  error_reporting(E_ALL);

  class Session
  {
    public $name;
    public $val;

    public function __construct()
    {
      session_start();
    }

    public function setSession($name, $val)
    {
      $this->name = $name;
      $this->val = $val;
      return $_SESSION[$this->name] = $this->val;
    }

    public function getSessionVal($name)
    {
      return $_SESSION[$name];
    }

    public function checkSession($name)
    {
      if (isset($_SESSION[$name])) {
        return true;
      }
      return 'Not found';
    }

    public function delSession($name)
    {
      unset($_SESSION[$name]);
    }
  }
  $check = new Session;
  $check->setSession('ses1', 'CHECK');// $_SESSION['ses1'] = 'CHECK'
echo '<br>';
  echo $check->getSessionVal('ses1');
  echo '<br>';
  echo $check->checkSession('ses1');
  echo '<br>';
  $check->delSession('ses1');
  echo $check->checkSession('ses1');
  ?>

</body>

</html>