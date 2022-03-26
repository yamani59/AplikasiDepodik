<?php
class Flass
{
  static public function msg(String $message)
  {
?>
    <script>
      alert('<?= $message ?>')
    </script>
<?php
  }
}
